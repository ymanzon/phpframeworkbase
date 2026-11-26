@extends('layouts.landingpage')

@section('title', 'Iniciar Sesión - Sistema de Inmuebles')

@section('content')
<div class="min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="main-container">
                    <!-- Header -->
                    <div class="welcome-header">
                        <div class="text-center py-4">
                            <i class="fas fa-lock fa-3x mb-3"></i>
                            <h2 class="h3 mb-0">Recuperar contraseña</h2>
                            <p class="mb-0 opacity-75">Introduzca su correo electronico</p>
                        </div>
                    </div>


                    <!-- Login Form -->
                    <div class="p-4">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <!-- Token -->
                            <input type="hidden" name="token" value="{{ $token }}">

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </label>
                                <input type="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    id="email"
                                    name="email"
                                    value="{{ $email }}"
                                    readonly >
                            </div>

                             <!-- Password -->
                            <div class="mb-4">
                                <label for="password" class="form-label">
                                    <i class="fas fa-key me-2"></i>Contraseña
                                </label>
                                <div class="input-group">
                                    <input type="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        id="password"
                                        name="password"
                                        placeholder="Ingresa tu contraseña"
                                        required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                             <!-- Password confirmation -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-key me-2"></i>Confirmar Contraseña
                                </label>
                                <div class="input-group">
                                    <input type="password"
                                        class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        placeholder="Ingresa tu contraseña"
                                        required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-custom btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i>
                                    Actualizar contraseña
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Footer -->
                    <div class="text-center py-3">  
                        <p class="mb-0 text-muted">
                            @if(isset($status))
                                <div class="alert alert-info">
                                    {{ $status }}
                                </div>
                            @endif
                        </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .input-group-text {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }

    .alert-info {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border: 1px solid rgba(102, 126, 234, 0.2);
        border-radius: 10px;
    }

    @media (max-width: 768px) {
        .main-container {
            margin: 1rem;
            border-radius: 10px;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('password_confirmation');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            confirmPasswordField.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            confirmPasswordField.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    // Auto-fill demo credentials
    $(document).ready(function() {
        $('.alert-info').on('click', function() {
            $('#password').val('admin123');
        });
    });
</script>
@endsection