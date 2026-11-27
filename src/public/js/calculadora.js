// Calculadora hipotecaria: precio, enganche %, años y tasa anual
// -> cuota mensual con la fórmula estándar de amortización:
// M = P * r(1+r)^n / ((1+r)^n - 1), r = tasa mensual, n = meses.
// Si la sección no está en la página, no hace nada.
(function () {
    function el(id) {
        return document.getElementById(id);
    }

    function num(value, defecto) {
        const n = parseFloat(value);
        return isNaN(n) ? defecto : n;
    }

    function formato(n) {
        return new Intl.NumberFormat("en-US", {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
        }).format(n);
    }

    function calcular() {
        const precioEl = el("calcPrecio");
        if (!precioEl) return;

        const precio = Math.max(0, num(precioEl.value, 0));
        const enganchePct = Math.min(90, Math.max(0, num(el("calcEnganche").value, 20)));
        const anos = Math.max(1, num(el("calcAnos").value, 20));
        const tasaAnual = Math.max(0, num(el("calcTasa").value, 10.5));

        const enganche = (precio * enganchePct) / 100;
        const credito = precio - enganche;
        const meses = anos * 12;
        const r = tasaAnual / 100 / 12;

        let cuota = 0;
        if (credito > 0 && meses > 0) {
            if (r === 0) {
                cuota = credito / meses;
            } else {
                const factor = Math.pow(1 + r, meses);
                cuota = (credito * r * factor) / (factor - 1);
            }
        }

        el("calcCuota").textContent = formato(cuota);
        el("calcEngancheMonto").textContent = formato(enganche);
        el("calcMontoCredito").textContent = formato(credito);
    }

    // La ficha de la propiedad prellena el precio con el de la propiedad.
    window.prellevarCalculadora = function (precio) {
        const precioEl = el("calcPrecio");
        if (!precioEl) return;
        precioEl.value = Math.round(Number(precio) || 0);
        calcular();
    };

    function init() {
        if (!el("calcPrecio")) return;
        ["calcPrecio", "calcEnganche", "calcAnos", "calcTasa"].forEach(function (id) {
            el(id).addEventListener("input", calcular);
            el(id).addEventListener("change", calcular);
        });
        calcular();
    }

    document.addEventListener("DOMContentLoaded", init);
})();
