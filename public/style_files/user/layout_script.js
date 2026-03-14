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
   NAVBAR + MOBILE MENU
====================== */
const navbar = document.getElementById("navbar");
const burgerBtn = document.getElementById("burgerBtn");
const navLinks = document.getElementById("navLinks");
const productsNavItem = document.querySelector(".nav-item--has-dropdown");
const productsDropdownTrigger = document.querySelector(".nav-dropdown-trigger");

function isMobileNavViewport() {
    return window.innerWidth <= 980;
}

function closeProductsFold() {
    if (!productsNavItem || !productsDropdownTrigger) return;
    productsNavItem.classList.remove("is-open");
    productsDropdownTrigger.setAttribute("aria-expanded", "false");
}

function closeNavMenu() {
    if (!navLinks || !burgerBtn) return;
    navLinks.classList.remove("open");
    burgerBtn.classList.remove("open");
    burgerBtn.setAttribute("aria-expanded", "false");
    closeProductsFold();
}

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

    productsDropdownTrigger.addEventListener("click", (event) => {
        if (!isMobileNavViewport()) return;

        event.preventDefault();
        const isOpen = productsNavItem.classList.toggle("is-open");
        productsDropdownTrigger.setAttribute("aria-expanded", isOpen ? "true" : "false");
    });
}

if (burgerBtn && navLinks) {
    burgerBtn.addEventListener("click", () => {
        const isOpen = navLinks.classList.toggle("open");
        burgerBtn.classList.toggle("open", isOpen);
        burgerBtn.setAttribute("aria-expanded", isOpen ? "true" : "false");

        if (!isOpen) {
            closeProductsFold();
        }
    });

    document.querySelectorAll("#navLinks a").forEach((link) => {
        link.addEventListener("click", () => {
            closeNavMenu();
        });
    });

    document.addEventListener("click", (event) => {
        if (!navLinks.contains(event.target) && !burgerBtn.contains(event.target)) {
            closeNavMenu();
        }
    });

    window.addEventListener("resize", () => {
        if (!isMobileNavViewport()) {
            closeNavMenu();
        }
    });
}

function syncNavbarState() {
    if (!navbar) return;
    navbar.classList.toggle("is-scrolled", window.scrollY > 32);
}

syncNavbarState();
window.addEventListener("scroll", syncNavbarState);

/* ======================
   ACTIVE ANCHOR STATE
====================== */
const anchorSections = document.querySelectorAll(".section-anchor[id]");
const trackedNavItems = document.querySelectorAll(".js-section-track[data-section-target]");

if (anchorSections.length && trackedNavItems.length) {
    const anchorObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;

            const targetId = entry.target.id;
            trackedNavItems.forEach((item) => {
                item.classList.toggle("active", item.dataset.sectionTarget === targetId);
            });
        });
    }, { threshold: 0.45 });

    anchorSections.forEach((section) => anchorObserver.observe(section));
}

/* ======================
   REVEAL ON SCROLL
====================== */
const reveals = document.querySelectorAll(".reveal");

if (reveals.length) {
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.18 });

    reveals.forEach((el) => revealObserver.observe(el));
}
