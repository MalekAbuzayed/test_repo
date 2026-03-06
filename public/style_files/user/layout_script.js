/* ======================
   PAGE PRELOADER
====================== */
const pagePreloader = document.getElementById("pagePreloader");

function hidePagePreloader() {
    if (!pagePreloader) return;
    window.setTimeout(() => {
        pagePreloader.classList.add("is-hidden");
        document.body.classList.remove("preloading");
    }, 500);
}

if (document.readyState === "complete") {
    hidePagePreloader();
} else {
    window.addEventListener("load", hidePagePreloader);
}

/* ======================
   HERO SLIDER + DOTS
====================== */
const slides = document.querySelectorAll(".hero-slide");
const dots = document.querySelectorAll(".hero-dots .dot");
const heroTitle = document.getElementById("heroTitle");
const heroSubtitle = document.getElementById("heroSubtitle");
const heroBtn = document.getElementById("heroBtn");
const heroSlider = document.getElementById("heroSlider");

if (slides.length && dots.length && heroTitle && heroSubtitle && heroBtn) {
    let currentSlide = 0;
    let sliderTimer = null;

    const heroContent = [
        {
            title: "Save Money. Save the<br/>Planet.",
            subtitle: "Reduce electricity bills with efficient solar systems.",
            button: "Explore Services",
            link: "#services"
        },
        {
            title: "Power Your Home<br/>with Clean Energy.",
            subtitle: "High-efficiency solar solutions built for long-term performance.",
            button: "Get a Quote",
            link: "#contact"
        },
        {
            title: "Enterprise-Ready Solar<br/>for Businesses.",
            subtitle: "Scalable commercial solar systems with monitoring & support.",
            button: "Request Consultation",
            link: "#contact"
        }
    ];

    function goToSlide(index) {
        slides[currentSlide].classList.remove("active");
        dots[currentSlide].classList.remove("active");

        currentSlide = index;

        slides[currentSlide].classList.add("active");
        dots[currentSlide].classList.add("active");

        heroTitle.innerHTML = heroContent[currentSlide].title;
        heroSubtitle.textContent = heroContent[currentSlide].subtitle;
        heroBtn.textContent = heroContent[currentSlide].button;
        heroBtn.setAttribute("href", heroContent[currentSlide].link);
    }

    function nextSlide() {
        goToSlide((currentSlide + 1) % slides.length);
    }

    function startSlider() {
        stopSlider();
        sliderTimer = setInterval(nextSlide, 5200);
    }

    function stopSlider() {
        if (sliderTimer) clearInterval(sliderTimer);
    }

    dots.forEach((dot, i) => {
        dot.addEventListener("click", () => {
            goToSlide(i);
            startSlider();
        });
    });

    startSlider();

    if (heroSlider) {
        heroSlider.addEventListener("mouseenter", stopSlider);
        heroSlider.addEventListener("mouseleave", startSlider);
    }
}


/* ======================
   MOBILE MENU
====================== */
const burgerBtn = document.getElementById("burgerBtn");
const navLinks = document.getElementById("navLinks");
const productsNavItem = document.querySelector(".nav-item--has-dropdown");
const productsDropdownTrigger = document.querySelector(".nav-dropdown-trigger");
const placeholderProductLinks = document.querySelectorAll(".nav-sub-link[href='#']");

function isMobileNavViewport() {
    return window.innerWidth <= 760;
}

function closeProductsFold() {
    if (!productsNavItem || !productsDropdownTrigger) return;
    productsNavItem.classList.remove("is-open");
    productsDropdownTrigger.setAttribute("aria-expanded", "false");
}

if (burgerBtn && navLinks) {
    if (productsNavItem && productsDropdownTrigger) {
        productsNavItem.addEventListener("mouseenter", () => {
            if (isMobileNavViewport()) return;
            productsDropdownTrigger.setAttribute("aria-expanded", "true");
        });

        productsNavItem.addEventListener("mouseleave", () => {
            if (isMobileNavViewport()) return;
            productsDropdownTrigger.setAttribute("aria-expanded", "false");
        });

        productsNavItem.addEventListener("focusin", () => {
            if (isMobileNavViewport()) return;
            productsDropdownTrigger.setAttribute("aria-expanded", "true");
        });

        productsNavItem.addEventListener("focusout", (event) => {
            if (isMobileNavViewport()) return;
            if (!productsNavItem.contains(event.relatedTarget)) {
                productsDropdownTrigger.setAttribute("aria-expanded", "false");
            }
        });
    }

    if (productsDropdownTrigger && productsNavItem) {
        productsDropdownTrigger.addEventListener("click", (event) => {
            if (!isMobileNavViewport()) return;

            event.preventDefault();
            const isOpen = productsNavItem.classList.toggle("is-open");
            productsDropdownTrigger.setAttribute("aria-expanded", isOpen ? "true" : "false");
        });
    }

    placeholderProductLinks.forEach(link => {
        link.addEventListener("click", (event) => {
            event.preventDefault();

            if (!isMobileNavViewport()) return;

            navLinks.classList.remove("open");
            burgerBtn.setAttribute("aria-expanded", "false");
            closeProductsFold();
        });
    });

    burgerBtn.addEventListener("click", () => {
        const isOpen = navLinks.classList.toggle("open");
        burgerBtn.setAttribute("aria-expanded", isOpen ? "true" : "false");

        if (!isOpen) {
            closeProductsFold();
        }
    });

    document.querySelectorAll("#navLinks a").forEach(link => {
        link.addEventListener("click", () => {
            navLinks.classList.remove("open");
            burgerBtn.setAttribute("aria-expanded", "false");
            closeProductsFold();
        });
    });

    document.addEventListener("click", (event) => {
        if (!navLinks.contains(event.target) && !burgerBtn.contains(event.target)) {
            navLinks.classList.remove("open");
            burgerBtn.setAttribute("aria-expanded", "false");
            closeProductsFold();
        }
    });

    window.addEventListener("resize", () => {
        if (window.innerWidth > 760) {
            navLinks.classList.remove("open");
            burgerBtn.setAttribute("aria-expanded", "false");
            closeProductsFold();
        }
    });
}


/* ======================
   ACTIVE NAV HIGHLIGHT
====================== */
const sections = document.querySelectorAll(".section-anchor");
const navItems = document.querySelectorAll(".nav-link");

const sectionObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const id = entry.target.getAttribute("id");
            navItems.forEach(a => {
                a.classList.toggle("active", a.getAttribute("href") === `#${id}`);
            });
        }
    });
}, { threshold: 0.55 });

sections.forEach(s => sectionObserver.observe(s));


/* ======================
   REVEAL ON SCROLL
====================== */
const reveals = document.querySelectorAll(".reveal");
const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add("show");
            revealObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.18 });

reveals.forEach(el => revealObserver.observe(el));


/* ======================
   COUNTERS
====================== */
let countersStarted = false;

function animateCounter(el, target, suffix = "") {
    let value = 0;
    const step = Math.max(1, Math.floor(target / 70));

    const timer = setInterval(() => {
        value += step;
        if (value >= target) {
            value = target;
            clearInterval(timer);
        }
        el.textContent = `${value}${suffix}`;
    }, 18);
}

function startCounters() {
    if (countersStarted) return;
    countersStarted = true;

    document.querySelectorAll(".count").forEach(el => {
        const target = parseInt(el.dataset.count, 10);

        // decide suffix from surrounding UI
        const parentText = el.parentElement.textContent;

        let suffix = "";
        if (parentText.includes("%")) suffix = "";
        if (parentText.includes("MW")) suffix = "";
        if (parentText.includes("/7")) suffix = "";

        animateCounter(el, target, "");
    });
}

const anyCounterTrigger = document.querySelector("#about");
if (anyCounterTrigger) {
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                startCounters();
                counterObserver.disconnect();
            }
        });
    }, { threshold: 0.35 });

    counterObserver.observe(anyCounterTrigger);
}

/* ======================
   NAVBAR STATE ON SCROLL
====================== */
const navbar = document.getElementById("navbar");
const NAV_SCROLL_THRESHOLD = 24;

function syncNavbarState() {
    if (!navbar) return;
    const isScrolled = window.scrollY > NAV_SCROLL_THRESHOLD;
    navbar.classList.toggle("navbar--scrolled", isScrolled);
    navbar.classList.toggle("navbar--floating", !isScrolled);
}

syncNavbarState();
window.addEventListener("scroll", syncNavbarState);




