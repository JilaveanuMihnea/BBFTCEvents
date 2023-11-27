const openMenu = document.querySelector("#show-menu");
const hideMenuIcon = document.querySelector("#hide-menu");
const sideMenu = document.querySelector("#nav-menu");
const overlay = document.querySelector("#obfuscate");

openMenu.addEventListener("click", function () {
  sideMenu.classList.add("active");
  overlay.classList.add("active");
});

hideMenuIcon.addEventListener("click", function () {
  sideMenu.classList.remove("active");
  overlay.classList.remove("active");
});

overlay.addEventListener("click", function () {
  sideMenu.classList.remove("active");
  overlay.classList.remove("active");
});
