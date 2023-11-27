const overlay = document.querySelector("#obfuscate");
const delbtn = document.querySelector("#delbtn");
const delform = document.querySelector(".delete-form");
const closebtn = document.querySelector("#closebtn");

delbtn.addEventListener("click", function () {
  delform.classList.add("active");
  overlay.classList.add("active");
});

closebtn.addEventListener("click", function () {
  delform.classList.remove("active");
  overlay.classList.remove("active");
});

overlay.addEventListener("click", function () {
  sideMenu.classList.remove("active");
  overlay.classList.remove("active");
  delform.classList.remove("active");
});

alert("dogus");
