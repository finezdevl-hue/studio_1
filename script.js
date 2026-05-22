// script.js

// ========================================
// MOBILE MENU
// ========================================

const menuBtn = document.getElementById("menuBtn");
const navMenu = document.getElementById("navMenu");

if (menuBtn && navMenu) {

  menuBtn.addEventListener("click", () => {

    navMenu.classList.toggle("active");

  });

}



// ========================================
// SERVICE CARD ANIMATION
// ========================================

const serviceCards = document.querySelectorAll(".service-card");

serviceCards.forEach((card) => {

  card.style.opacity = "0";
  card.style.transform = "translateY(40px)";
  card.style.transition = "all 0.6s ease";

});


function animateServiceCards() {

  serviceCards.forEach((card) => {

    const cardTop = card.getBoundingClientRect().top;

    if (cardTop < window.innerHeight - 50) {

      card.style.opacity = "1";
      card.style.transform = "translateY(0)";

    }

  });

}



// ========================================
// REVEAL ANIMATION
// ========================================

const reveals = document.querySelectorAll(".reveal");

function revealOnScroll() {

  reveals.forEach((item) => {

    const top = item.getBoundingClientRect().top;

    if (top < window.innerHeight - 100) {

      item.classList.add("active");

    }

  });

}



// ========================================
// NAVBAR SCROLL EFFECT
// ========================================

const navbar = document.querySelector(".navbar");

function navbarScrollEffect() {

  if (window.scrollY > 50) {

    navbar.style.padding = "18px 7%";
    navbar.style.boxShadow = "0 5px 20px rgba(0,0,0,0.08)";

  } else {

    navbar.style.padding = "22px 7%";
    navbar.style.boxShadow = "none";

  }

}



// ========================================
// SMOOTH SCROLL
// ========================================

document.querySelectorAll('a[href^="#"]').forEach((anchor) => {

  anchor.addEventListener("click", function (e) {

    e.preventDefault();

    const target = document.querySelector(this.getAttribute("href"));

    if (target) {

      target.scrollIntoView({
        behavior: "smooth"
      });

    }

  });

});



// ========================================
// WINDOW SCROLL EVENTS
// ========================================

window.addEventListener("scroll", () => {

  animateServiceCards();

  revealOnScroll();

  navbarScrollEffect();

});



// ========================================
// INITIAL LOAD
// ========================================

animateServiceCards();

revealOnScroll();

navbarScrollEffect();

const contactForm = document.getElementById("contact-form");
const successMessage = document.getElementById("successMessage");
const formError = document.getElementById("formError");
const contactSubmitButton = document.getElementById("contact-submit");

if (contactForm) {

  contactForm.addEventListener("submit", async (event) => {

    event.preventDefault();

    if (formError) {

      formError.style.display = "none";
      formError.textContent = "";

    }

    if (!contactForm.reportValidity()) {
      return;
    }

    if (contactSubmitButton) {

      contactSubmitButton.disabled = true;
      contactSubmitButton.textContent = "Sending...";

    }

    try {

      const response = await fetch(contactForm.action, {
        method: "POST",
        body: new FormData(contactForm),
        headers: {
          "X-Requested-With": "XMLHttpRequest"
        }
      });

      const result = await response.json();

      if (!response.ok || !result.success) {
        throw new Error(result.message || "Unable to send your message right now.");
      }

      contactForm.reset();
      contactForm.style.display = "none";

      if (successMessage) {

        successMessage.classList.add("active");

        window.scrollTo({
          top: successMessage.offsetTop - 120,
          behavior: "smooth"
        });

      }

    } catch (error) {

      if (formError) {

        formError.textContent = error.message;
        formError.style.display = "block";

      }

    } finally {

      if (contactSubmitButton) {

        contactSubmitButton.disabled = false;
        contactSubmitButton.textContent = "Send Message";

      }

    }

  });

}
