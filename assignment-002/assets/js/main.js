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
    // Back to Top Button
const backToTop = document.getElementById("back-to-top");

if (backToTop) {
    window.addEventListener("scroll", function () {
        if (window.scrollY > 300) {
            backToTop.classList.add("show");
        } else {
            backToTop.classList.remove("show");
        }
    });

    backToTop.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });

}
// Contact Form Validation
const contactForm = document.getElementById("contact-form");

if (contactForm) {
    contactForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const name = document.getElementById("full-name").value.trim();
        const email = document.getElementById("email").value.trim();
        const phone = document.getElementById("phone").value.trim();
        const subject = document.getElementById("subject").value.trim();
        const message = document.getElementById("message").value.trim();

        const nameError = document.getElementById("name-error");
        const emailError = document.getElementById("email-error");
        const phoneError = document.getElementById("phone-error");
        const subjectError = document.getElementById("subject-error");
        const messageError = document.getElementById("message-error");
        const successMessage = document.getElementById("form-success");

        nameError.textContent = "";
        emailError.textContent = "";
        phoneError.textContent = "";
        subjectError.textContent = "";
        messageError.textContent = "";
        successMessage.textContent = "";

        let isValid = true;

        if (name === "") {
            nameError.textContent = "Please enter your full name.";
            isValid = false;
        }

        if (email === "") {
            emailError.textContent = "Please enter your email.";
            isValid = false;
        } else if (!email.includes("@") || !email.includes(".")) {
            emailError.textContent = "Please enter a valid email address.";
            isValid = false;
        }

        if (phone === "") {
            phoneError.textContent = "Please enter your phone number.";
            isValid = false;
        }

        if (subject === "") {
            subjectError.textContent = "Please enter a subject.";
            isValid = false;
        }

        if (message === "") {
            messageError.textContent = "Please enter your message.";
            isValid = false;
        }

        if (isValid) {
            successMessage.textContent =
                "Thank you! Your message has been submitted successfully.";

            contactForm.reset();
        }
    });
}
}
