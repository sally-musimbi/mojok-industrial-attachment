// =========================================
// NEXORA DIGITAL SOLUTIONS
// Assignment 002 - Main JavaScript
// =========================================

// Mobile Navigation
const menuToggle = document.getElementById("menu-toggle");
const navLinks = document.getElementById("nav-links");

if (menuToggle && navLinks) {
    menuToggle.addEventListener("click", function () {
        navLinks.classList.toggle("show");
    });
}


// Dynamic Copyright Year
const yearElement = document.getElementById("year");

if (yearElement) {
    yearElement.textContent = new Date().getFullYear();
}
