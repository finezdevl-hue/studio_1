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
