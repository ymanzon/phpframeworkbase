// Mapa del catálogo en la página principal (Leaflet + OpenStreetMap).
// Se centra en la ciudad del filtro y muestra con marcadores los inmuebles
// filtrados. Lo alimenta public/js/script.js: cada vez que filtra o carga el
// catálogo llama a window.actualizarMapaCatalogo(lista, filtro).
// Los centros de ciudad y el centro por defecto llegan en
// window.INMOBILIARIA.ciudades (config/inmobiliaria.php, clave 'ciudades').
(function () {
    var mapaDiv = document.getElementById('mapaCatalogo');
    if (!mapaDiv) return;

    // Sin Leaflet (CDN bloqueado o sin internet): el catálogo sigue igual,
    // solo no se muestra el mapa.
    if (typeof L === 'undefined') {
        mapaDiv.innerHTML = '<p class="text-muted p-3">El mapa no cargó (revisa tu conexión). El catálogo de abajo sigue funcionando.</p>';
        return;
    }

    var cfg = window.INMOBILIARIA || {};
    var ciudades = cfg.ciudades || {};
    var defecto = ciudades.Merida || { latitud: 20.967, longitud: -89.623, zoom: 12 };

    var map = L.map('mapaCatalogo').setView([defecto.latitud, defecto.longitud], defecto.zoom);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var capaMarcadores = L.layerGroup().addTo(map);

    function precio(p) {
        if (typeof formatNumber === 'function') return formatNumber(p.price);
        return p.price;
    }

    window.actualizarMapaCatalogo = function (lista, filtro) {
        capaMarcadores.clearLayers();
        var puntos = [];

        (lista || []).forEach(function (p) {
            var lat = parseFloat(p.latitud), lng = parseFloat(p.longitud);
            if (isNaN(lat) || isNaN(lng)) return; // sin ubicación: no se marca
            puntos.push([lat, lng]);
            var popup = '<strong>' + p.title + '</strong><br>$' + precio(p) +
                ' / ' + p.type + '<br><a href="inmueble/detail/' + p.id + '">Ver detalle</a>';
            L.marker([lat, lng]).addTo(capaMarcadores).bindPopup(popup);
        });

        // Centrado: si el filtro es una ciudad, se centra en ella; si es
        // "todo", se ajusta para que se vean todos los marcadores.
        if (filtro && filtro !== 'todo' && ciudades[filtro]) {
            var c = ciudades[filtro];
            map.setView([c.latitud, c.longitud], c.zoom);
        } else if (puntos.length > 1) {
            map.fitBounds(puntos, { padding: [30, 30] });
        } else if (puntos.length === 1) {
            map.setView(puntos[0], 15);
        } else {
            map.setView([defecto.latitud, defecto.longitud], defecto.zoom);
        }
    };
})();
