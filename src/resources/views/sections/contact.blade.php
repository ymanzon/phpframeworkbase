<!-- Contact Section -->
<section class="section contact" id="contact">
    <div class="container">
        <div class="section-title">
            <h2>Contáctanos</h2>
            <p>Estamos aquí para ayudarte a encontrar tu hogar ideal.</p>
        </div>
        <div class="contact-container">
            <div class="contact-info">
                <h3>Conectemonos</h3>
                <p>Nuestro equipo está listo para ayudarte con todas tus necesidades inmobiliarias. Contáctanos a través de cualquiera de los siguientes canales.</p>
                <div class="contact-details">
                    <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h4>Nuestra oficina</h4>
                                <p>{{ config('inmobiliaria.direccion') }}</p>
                            </div>
                        </div>
                    <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h4>Horario</h4>
                                <p>{{ config('inmobiliaria.horario') }}</p>
                            </div>
                        </div>
                    <div class="contact-item">
                        <i class="fas fa-phone-alt"></i>
                        <div>
                            <h4>Teléfono</h4>
                            <p><a href="tel:{{ str_replace(' ', '', config('inmobiliaria.telefono')) }}">{{ config('inmobiliaria.telefono') }}</a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h4>Email</h4>
                            <p>{{ config('inmobiliaria.correo') }}</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-whatsapp"></i>
                        <div>
                            <h4>WhatsApp</h4>
                            <p><a href="https://wa.me/{{ config('inmobiliaria.whatsapp') }}?text={{ urlencode(config('inmobiliaria.whatsapp_mensaje_generico')) }}" target="_blank">{{ config('inmobiliaria.telefono') }}</a></p>
                        </div>
                    </div>

                </div>

            </div>

            <div class="contact-form">
                <h3>Escríbenos</h3>
                <p>Déjanos tus datos y un asesor te contacta.</p>
                @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
                @endif
                <form method="POST" action="{{ route('contacto.enviar') }}">
                    @csrf
                    <input type="hidden" name="origen" value="contacto">
                    <div class="form-group">
                        <label for="lead-nombre">Nombre *</label>
                        <input type="text" id="lead-nombre" name="nombre" value="{{ old('nombre') }}" required maxlength="100">
                        @error('nombre')<small class="form-error">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label for="lead-correo">Correo *</label>
                        <input type="email" id="lead-correo" name="correo" value="{{ old('correo') }}" required maxlength="150">
                        @error('correo')<small class="form-error">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label for="lead-telefono">Teléfono</label>
                        <input type="tel" id="lead-telefono" name="telefono" value="{{ old('telefono') }}" maxlength="30">
                        @error('telefono')<small class="form-error">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label for="lead-mensaje">Mensaje *</label>
                        <textarea id="lead-mensaje" name="mensaje" required maxlength="1000">{{ old('mensaje') }}</textarea>
                        @error('mensaje')<small class="form-error">{{ $message }}</small>@enderror
                    </div>
                    <button type="submit">Enviar mensaje</button>
                </form>
                <p class="form-note">Al enviar aceptas nuestro <a href="{{ route('aviso-privacidad') }}">aviso de privacidad</a>.</p>
            </div>
        </div>
    </div>
</section>