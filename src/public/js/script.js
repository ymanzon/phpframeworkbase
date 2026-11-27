
$.ajax({
    url: "/api/inmuebles",
    method: "GET",
    datatype: "json",
    beforeSend: function () {
       $("#propertiesGrid").removeClass("properties-grid");
       togglePreloader(true);
    },
    success: function (response) {
        $("#propertiesGrid").addClass("properties-grid");

        properties = response.data.map((item) => ({
            id: item.id,
            title: item.nombre,
            location: item.ciudad,
            //price: formatDecimal(item.precio),
            price: item.precio,
            type: item.tipo,
            beds: item.numero_cuartos,
            baths: item.numero_banos,
            //area: formatDecimal(item.tamano_terreno),
            area: item.tamano_terreno,
            floors: item.numero_pisos,
            builds: item.tamano_construccion,
            //builds: item.tamano_construccion,
            image:
                item?.fotos?.length > 0
                    ? item.fotos[0]
                    : "https://via.placeholder.com/300",
            featured: item.featured || false,
        }));

        displayProperties();

        // Property filtering (ciudad)
        filterBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                // Update active button
                filterBtns.forEach((btn) => btn.classList.remove("active"));
                btn.classList.add("active");

                filtrosCatalogo.ciudad = btn.dataset.filter;
                displayProperties();
            });
        });

        // Buscador: operación, precio máximo, recámaras mínimas y orden.
        // Se combinan con el filtro de ciudad y vuelven a dibujar el catálogo.
        const filtroOperacion = document.getElementById("filtroOperacion");
        if (filtroOperacion) {
            filtroOperacion.addEventListener("change", (e) => {
                filtrosCatalogo.operacion = e.target.value;
                displayProperties();
            });
        }
        const filtroPrecioMax = document.getElementById("filtroPrecioMax");
        if (filtroPrecioMax) {
            filtroPrecioMax.addEventListener("input", (e) => {
                filtrosCatalogo.precioMax = e.target.value;
                displayProperties();
            });
        }
        const filtroRecamaras = document.getElementById("filtroRecamaras");
        if (filtroRecamaras) {
            filtroRecamaras.addEventListener("change", (e) => {
                filtrosCatalogo.recamarasMin = e.target.value;
                displayProperties();
            });
        }
        const filtroOrden = document.getElementById("filtroOrden");
        if (filtroOrden) {
            filtroOrden.addEventListener("change", (e) => {
                filtrosCatalogo.orden = e.target.value;
                displayProperties();
            });
        }
        const limpiarFiltros = document.getElementById("limpiarFiltros");
        if (limpiarFiltros) {
            limpiarFiltros.addEventListener("click", () => {
                filtrosCatalogo.ciudad = "todo";
                filtrosCatalogo.operacion = "todas";
                filtrosCatalogo.precioMax = "";
                filtrosCatalogo.recamarasMin = "";
                filtrosCatalogo.orden = (window.INMOBILIARIA || {}).orden || "recientes";
                if (filtroOperacion) filtroOperacion.value = "todas";
                if (filtroPrecioMax) filtroPrecioMax.value = "";
                if (filtroRecamaras) filtroRecamaras.value = "";
                if (filtroOrden) filtroOrden.value = filtrosCatalogo.orden;
                filterBtns.forEach((btn) =>
                    btn.classList.toggle("active", btn.dataset.filter === "todo")
                );
                displayProperties();
            });
        }
    },
    error: function (error) {
        console.log(error);
    },
    complete: function () {
        console.log("Properties loaded successfully.");
    },
});

// DOM Elements
const header = document.getElementById("header");
const mobileMenuBtn = document.getElementById("mobileMenuBtn");
const navLinks = document.getElementById("navLinks");
const loginBtn = document.getElementById("loginBtn");
const loginModal = document.getElementById("loginModal");
const closeModal = document.getElementById("closeModal");
const propertiesGrid = document.getElementById("propertiesGrid");
const filterBtns = document.querySelectorAll(".filter-btn");
const testimonials = document.querySelectorAll(".testimonial");
const dots = document.querySelectorAll(".dot");
const contactForm = document.getElementById("contactForm");
const loginForm = document.getElementById("loginForm");

// Header scroll effect
window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
        header.classList.add("scrolled");
    } else {
        header.classList.remove("scrolled");
    }
});

// Mobile menu toggle
mobileMenuBtn.addEventListener("click", () => {
    navLinks.classList.toggle("active");
    mobileMenuBtn.innerHTML = navLinks.classList.contains("active")
        ? '<i class="fas fa-times"></i>'
        : '<i class="fas fa-bars"></i>';
});

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();

        if (this.getAttribute("href") === "#") return;

        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            window.scrollTo({
                top: target.offsetTop - 80,
                behavior: "smooth",
            });

            // Close mobile menu if open
            if (navLinks.classList.contains("active")) {
                navLinks.classList.remove("active");
                mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
            }
        }
    });
});

// Login modal
/*loginBtn.addEventListener("click", (e) => {
    e.preventDefault();
    loginModal.style.display = "flex";
});*/

window.addEventListener("click", (e) => {
    if (e.target === loginModal) {
        loginModal.style.display = "none";
    }
});

// Filtros del buscador (welcome.blade.php): ciudad, operación (tipo Venta/
// Renta), precio máximo, recámaras mínimas y orden. El orden inicial sale
// del config (orden_propiedades) y el select lo puede cambiar.
const filtrosCatalogo = {
    ciudad: "todo",
    operacion: "todas",
    precioMax: "",
    recamarasMin: "",
    orden: (window.INMOBILIARIA || {}).orden || "recientes",
};

// Foto de una propiedad: si ya es una URL (http, ej. Unsplash) se usa tal
// cual; si es un nombre de archivo, vive en storage/ (subido desde el panel).
function fotoUrl(foto) {
    if (!foto) return "https://via.placeholder.com/300";
    return foto.indexOf("http") === 0 ? foto : "storage/" + foto;
}

// Display properties
// Lee los valores del config desde window.INMOBILIARIA (lo pone el layout
// landing con config/inmobiliaria.php): estilo de tarjeta, propiedades por
// página, orden y mostrar/ocultar precio. Sin eso, usa los valores de antes.
function displayProperties() {
    propertiesGrid.innerHTML = "";
    const cfg = window.INMOBILIARIA || {};

    let filteredProperties = properties.filter((property) => {
        if (
            filtrosCatalogo.ciudad !== "todo" &&
            property.location !== filtrosCatalogo.ciudad
        )
            return false;
        // Operación: el campo tipo de la tabla es Venta o Renta.
        if (
            filtrosCatalogo.operacion !== "todas" &&
            property.type !== filtrosCatalogo.operacion
        )
            return false;
        if (
            filtrosCatalogo.precioMax !== "" &&
            Number(property.price) > Number(filtrosCatalogo.precioMax)
        )
            return false;
        if (
            filtrosCatalogo.recamarasMin !== "" &&
            Number(property.beds) < Number(filtrosCatalogo.recamarasMin)
        )
            return false;
        return true;
    });

    if (filtrosCatalogo.orden === "precio_menor") {
        filteredProperties.sort((a, b) => a.price - b.price);
    } else if (filtrosCatalogo.orden === "precio_mayor") {
        filteredProperties.sort((a, b) => b.price - a.price);
    }

    if (filteredProperties.length === 0) {
        propertiesGrid.innerHTML =
            '<p class="text-center" style="grid-column: 1 / -1; padding: 40px 0;">No hay propiedades que coincidan con los filtros. Prueba quitar alguno.</p>';
        return;
    }
    if (cfg.porPagina) {
        filteredProperties = filteredProperties.slice(0, cfg.porPagina);
    }
    if (cfg.estiloTarjeta) {
        propertiesGrid.classList.add("tarjeta-" + cfg.estiloTarjeta);
    }

    filteredProperties.forEach((property) => {
        const priceHtml =
            cfg.mostrarPrecio === false
                ? ""
                : `<div class="property-price">$${formatNumber(
                      property.price
                  )} <span>/ ${property.type}</span></div>`;
        
        const propertyCard = document.createElement("div");
        propertyCard.className = "property-card";
        propertyCard.innerHTML = `
                    <div class="property-img">
                    <a href="inmueble/detail/${property.id}" target="_black" >
<img src="${fotoUrl(property.image)}" alt="${property.title}">${property.featured? '<span class="property-badge">Destacado</span>': ""}
                    </a></div>
                    <div class="property-info">
                        ${priceHtml}
                        <h3 class="property-title">${property.title}</h3>
                        <div class="property-location">
                            <i class="fas fa-map-marker-alt"></i> ${
                                property.location
                            }
                        </div>
                        <div class="property-features" style="font-size:13px">
                            <span><i class="fas fa-building"></i> ${property.floors} Pisos</span>
                            <span><i class="fas fa-bed"></i> ${property.beds} ${typeof property.beds === "number" ? "Camas" : property.beds}</span>
                            <span><i class="fas fa-bath"></i> ${ formatNumberwhiouthDecimals(property.baths)} Baños</span>
                            <span><i class="fas fa-ruler-combined"></i> ${formatNumber(property.builds)} m²</span>
                        </div>
                        <div class="property-features" style="font-size:13px">
                            <span><i class="fas fa-maximize"></i> ${formatNumber(property.area)} m²</span>
                        </div>
                        <a href="https://wa.me/${(window.INMOBILIARIA || {}).whatsapp || ''}?text=Estoy%20interesado%20en%20${encodeURIComponent(
                            property.title
                        )}%20por%20$${formatNumber(
            property.price
        )}" class="whatsapp-btn" target="_blank">
                            <i class="fab fa-whatsapp"></i> Contactar agente
                        </a>
                    </div>
                `;
        propertiesGrid.appendChild(propertyCard);
    });
}

loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    alert("Login functionality would be implemented here.");
    loginModal.style.display = "none";
    loginForm.reset();
});

function formatNumber(price) {
    const formatter = new Intl.NumberFormat("en-US", {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
    });
    result = formatter.format(price);

    return result;
}

function formatNumberwhiouthDecimals(value) {
    const formatter = new Intl.NumberFormat("en-US", {
        minimumFractionDigits: 1,
        maximumFractionDigits: 1,
    });
    result = formatter.format(value);

    return result;
}

function togglePreloader(show = true) {
  if (show) {
    $('#preloader').addClass('active');
  } else {
    $('#preloader').removeClass('active');
  }
}


//omitir la cantidad del decimal en las cantidades numericas
function formatDecimal(value) {
    const str = value.toString();
    const parts = str.split(".");
    if (parts.length > 1) {
        return parts[0]; // Retorna solo la parte entera
    }
    return str; // Si no hay parte decimal, retorna el valor original
}