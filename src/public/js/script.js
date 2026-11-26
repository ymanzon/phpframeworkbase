
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

        // Property filtering
        filterBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                // Update active button
                filterBtns.forEach((btn) => btn.classList.remove("active"));
                btn.classList.add("active");

                const filter = btn.dataset.filter;
                displayProperties(filter);
            });
        });
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

// Display properties
function displayProperties(filter = "todo") {
    propertiesGrid.innerHTML = "";

    const filteredProperties =
        filter === "todo"
            ? properties
            : properties.filter((property) => property.location === filter);

    filteredProperties.forEach((property) => {
        
        const propertyCard = document.createElement("div");
        propertyCard.className = "property-card";
        propertyCard.innerHTML = `
                    <div class="property-img">
                    <a href="inmueble/detail/${property.id}" target="_black" >
<img src="storage/${property.image}" alt="${property.title}">${property.featured? '<span class="property-badge">Destacado</span>': ""}
                    </a></div>
                    <div class="property-info">
                        <div class="property-price">$${formatNumber(
                            property.price
                        )} <span>/ ${property.type}</span></div>
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
                        <a href="https://wa.me/52999123456?text=Estoy%20interesado%20en%20${encodeURIComponent(
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