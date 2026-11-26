<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPMailer\PHPMailer\PHPMailer;  
use Illuminate\Support\Str;

class SecurityController extends Controller
{
    // Show the password reset form
    public function showResetForm()
    {
        return view('auth.passwords.email');
    }   
    //recibe el correo electrónico del usuario con un csrf token y envie un enlace de restablecimiento de contraseña
    public function reset(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'email' => 'required|email',
        ], [
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe tener un formato válido.',
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //generar token de restablecimiento
        $token = Str::random(60);
        
        //buscar el usuario por email
        $user = User::where('email', $request->email)->first();
        //validar si el usuario existe
        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'El correo no existe.'])
                ->withInput();
        }

        //validar si el usuario ya tiene un token de restablecimiento y no ha expirado
        if ($user->reset_token && $user->reset_token_expiry > now()) {
            return redirect()->back()
                ->withErrors(['email' => 'Ya has solicitado un restablecimiento recientemente, tiene que esperar ' . env('PASSWORD_RESET_EXPIRY', 60). ' minutos para volver a solicitarlo.'])
                ->withInput();
        }

        //actualizar el usuario con el token de restablecimiento
        // Aquí deberías buscar el usuario por email y actualizar su token 
        User::where('email', $request->email)->update(['reset_token' => $token, 'reset_token_expiry' => now()->addMinutes((int)env('PASSWORD_RESET_EXPIRY', 60))]);

        //generar el body del correo electrónico
        $body = "Para restablecer tu contraseña, haz clic en el siguiente enlace:   \n";
        $body .= url('/password/change/' . $token) . "\n";   
        $body .= "Si no solicitaste este cambio, ignora este mensaje."; 
        //obtener las configuraciones de correo electrónico para el envio usando PHPMailer
        $mail = new \PHPMailer\PHPMailer\PHPMailer();
        //obtener las condiguraciones de correo electrónico desde el archivo .env
        $mail->isSMTP();
        $mail->Host = env('MAIL_HOST'); 
        $mail->SMTPAuth = true;
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->SMTPSecure = env('MAIL_ENCRYPTION');
        $mail->Port = env('MAIL_PORT');
        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $mail->addAddress($request->email); 
        $mail->Subject = 'Restablecimiento de contraseña';
        $mail->Body = $body;
        $mail->isHTML(true); //enviar el correo electrónico en formato texto plano
        $mail->CharSet = 'UTF-8'; //establecer el charset a UTF-8

        //enviar el correo electrónico
        if (!$mail->send()) {
            return response()->json(['message' => 'Error al enviar el enlace de restablecimiento.'], 500);
        }   

        return view('auth.passwords.email', [
            'status' => 'Hemos enviado un enlace de restablecimiento de contraseña a tu correo electrónico.'
        ]);
    }


    public function showChangeForm($token)
    {
        // Verificar si el token es válido y no ha expirado
        $user = User::where('reset_token', $token)
            ->where('reset_token_expiry', '>', now())
            ->first();  

        if (!$user) {
            return redirect()->route('password.request')
                ->withErrors(['token' => 'El token de restablecimiento es inválido o ha expirado, debe solicitar uno nuevo.']);
        }

        return view('auth.passwords.change', ['token' => $token, 'email'=> $user->email]);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //se buscara el usuario por el email y el token proporcionado
        $user = User::where('reset_token', $request->token)
            ->where('email', $request->email)
            ->where('reset_token_expiry', '>', now())
            ->first();

        if (!$user) {
            return redirect()->route('auth.password.request')
                ->withErrors(['token' => 'El token de restablecimiento es inválido o ha expirado, debe solicitar uno nuevo.']); 
        }

        // Actualizar la contraseña del usuario
        $user->password = bcrypt($request->password);   
        $user->reset_token = null; // Limpiar el token de restablecimiento
        $user->reset_token_expiry = null; // Limpiar la expiración del token
        $user->save();

        // Suponiendo que el usuario se ha encontrado y actualizado correctamente
        return redirect()->route('login')
            ->with('success', 'Tu contraseña ha sido restablecida correctamente.');
    }
}   