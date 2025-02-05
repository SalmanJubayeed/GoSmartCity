// Service Navbar dropdown menu
document.addEventListener("DOMContentLoaded", function () {
    var dropdown = document.querySelector(".nav-item.dropdown");
    dropdown.addEventListener("mouseenter", function () {
      this.querySelector(".dropdown-menu").classList.add("show");
    });
    dropdown.addEventListener("mouseleave", function () {
      this.querySelector(".dropdown-menu").classList.remove("show");
    });
  });