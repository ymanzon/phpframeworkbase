<!-- Calculadora hipotecaria -->
@if(config('inmobiliaria.secciones.calculadora'))
<section class="section calculadora" id="calculadora">
    <div class="container">
        <div class="section-title">
            <h2>Calcula tu mensualidad</h2>
            <p>Estima cuánto pagarías al mes por tu casa con un crédito hipotecario.</p>
        </div>
        <div class="calculadora-grid">
            <div class="calculadora-form">
                <div class="form-group">
                    <label for="calcPrecio">Precio de la propiedad ($)</label>
                    <input type="number" id="calcPrecio" value="2500000" min="0" step="1000">
                </div>
                <div class="form-group">
                    <label for="calcEnganche">Enganche (%)</label>
                    <input type="number" id="calcEnganche" value="20" min="0" max="90" step="1">
                </div>
                <div class="form-group">
                    <label for="calcAnos">Plazo (años)</label>
                    <select id="calcAnos">
                        <option value="5">5 años</option>
                        <option value="10">10 años</option>
                        <option value="15">15 años</option>
                        <option value="20" selected>20 años</option>
                        <option value="25">25 años</option>
                        <option value="30">30 años</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="calcTasa">Tasa anual (%)</label>
                    <input type="number" id="calcTasa" value="10.5" min="0" max="30" step="0.1">
                </div>
            </div>
            <div class="calculadora-resultado">
                <p class="calc-etiqueta">Mensualidad estimada</p>
                <p class="calc-cuota">$<span id="calcCuota">0</span> <small>/ mes</small></p>
                <p>Enganche: $<span id="calcEngancheMonto">0</span></p>
                <p>Monto del crédito: $<span id="calcMontoCredito">0</span></p>
                <p class="calc-nota">Estimación informativa, no incluye seguros ni comisiones. La mensualidad real depende del banco, la tasa vigente y tu perfil crediticio.</p>
            </div>
        </div>
    </div>
</section>
@endif
