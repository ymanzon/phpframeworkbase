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
        </div>
    </div>
</section>