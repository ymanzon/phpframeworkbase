// Selector de ubicación con Leaflet (OpenStreetMap, sin llave de API).
// Lo usan los formularios de crear/editar inmueble. Lee el centro y los
// valores iniciales de los data-* de #mapaUbicacion.
(function () {
    var mapaDiv = document.getElementById('mapaUbicacion');
    if (!mapaDiv) return;
    var latInput = document.getElementById('latitud');
    var lngInput = document.getElementById('longitud');
    var dirInput = document.getElementById('direccion');

    // Sin Leaflet (CDN bloqueado o sin internet): deja los campos editables.
    if (typeof L === 'undefined') {
        mapaDiv.innerHTML = '<p class="text-muted p-3">El mapa no cargó (revisa tu conexión). Puedes escribir la latitud y longitud a mano.</p>';
        if (latInput) latInput.readOnly = false;
        if (lngInput) lngInput.readOnly = false;
        return;
    }

    var centroLat = parseFloat(mapaDiv.dataset.centroLatitud) || 20.967;
    var centroLng = parseFloat(mapaDiv.dataset.centroLongitud) || -89.623;
    var zoom = parseInt(mapaDiv.dataset.zoom, 10) || 12;
    var lat0 = parseFloat(mapaDiv.dataset.latitud);
    var lng0 = parseFloat(mapaDiv.dataset.longitud);
    var tieneUbicacion = !isNaN(lat0) && !isNaN(lng0);

    var map = L.map('mapaUbicacion').setView(
        [tieneUbicacion ? lat0 : centroLat, tieneUbicacion ? lng0 : centroLng],
        tieneUbicacion ? 15 : zoom
    );
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = null;
    function ponerMarcador(lat, lng) {
        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng], { draggable: true }).addTo(map);
            marker.on('dragend', function () {
                var p = marker.getLatLng();
                actualizar(p.lat, p.lng, true);
            });
        }
        map.setView([lat, lng], Math.max(map.getZoom(), 15));
    }
    function actualizar(lat, lng, buscarDireccion) {
        latInput.value = lat.toFixed(6);
        lngInput.value = lng.toFixed(6);
        if (buscarDireccion) geocodificarInverso(lat, lng);
    }
    function geocodificarInverso(lat, lng) {
        fetch('https://nominatim.openstreetmap.org/reverse?format=json&lat=' + lat + '&lon=' + lng)
            .then(function (r) { return r.json(); })
            .then(function (d) {
                if (d && d.display_name && dirInput) dirInput.value = d.display_name;
            })
            .catch(function () { /* sin dirección automática; el usuario la escribe */ });
    }

    if (tieneUbicacion) ponerMarcador(lat0, lng0);

    map.on('click', function (e) {
        ponerMarcador(e.latlng.lat, e.latlng.lng);
        actualizar(e.latlng.lat, e.latlng.lng, true);
    });

    var btnBuscar = document.getElementById('btnBuscarDireccion');
    if (btnBuscar) {
        btnBuscar.addEventListener('click', function () {
            var q = document.getElementById('buscarDireccion').value.trim();
            if (!q) return;
            fetch('https://nominatim.openstreetmap.org/search?format=json&limit=1&q=' + encodeURIComponent(q + ', Mérida, Yucatán'))
                .then(function (r) { return r.json(); })
                .then(function (res) {
                    if (res && res.length) {
                        var lat = parseFloat(res[0].lat), lng = parseFloat(res[0].lon);
                        ponerMarcador(lat, lng);
                        actualizar(lat, lng, false);
                        if (dirInput) dirInput.value = res[0].display_name;
                    } else {
                        alert('No se encontró esa dirección. Prueba con otra referencia o haz clic en el mapa.');
                    }
                })
                .catch(function () {
                    alert('No se pudo buscar la dirección. Revisa tu conexión o haz clic en el mapa.');
                });
        });
    }

    var btnMia = document.getElementById('btnMiUbicacion');
    if (btnMia) {
        btnMia.addEventListener('click', function () {
            if (!navigator.geolocation) {
                alert('Tu navegador no soporta geolocalización.');
                return;
            }
            navigator.geolocation.getCurrentPosition(function (pos) {
                ponerMarcador(pos.coords.latitude, pos.coords.longitude);
                actualizar(pos.coords.latitude, pos.coords.longitude, true);
            }, function () {
                alert('No se pudo obtener tu ubicación. Haz clic en el mapa.');
            });
        });
    }

    var btnQuitar = document.getElementById('btnQuitarUbicacion');
    if (btnQuitar) {
        btnQuitar.addEventListener('click', function () {
            if (marker) { map.removeLayer(marker); marker = null; }
            latInput.value = '';
            lngInput.value = '';
            if (dirInput) dirInput.value = '';
        });
    }
})();
