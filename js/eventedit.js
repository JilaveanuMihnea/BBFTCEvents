const judet = document.querySelector("#judet").textContent;
const typ = document.querySelector("#typ").textContent;

fetch("../data/jud.json")
  .then((response) => response.json())
  .then((json) => {
    const dd = document.querySelector("#jud");
    json.forEach((element) => {
      const option = document.createElement("option");
      option.value = element.ind;
      option.innerText = element.name;
      if (element.ind == judet) {
        option.selected = true;
      }
      console.log(option);
      dd.append(option);
    });
  });

fetch("../data/tip.json")
  .then((response) => response.json())
  .then((json) => {
    const dd = document.querySelector("#tip");
    json.forEach((element) => {
      const option = document.createElement("option");
      option.value = element.ind;
      option.innerText = element.name;
      if (element.ind == typ) {
        option.selected = true;
      }
      console.log(option);
      dd.append(option);
    });
  });

var input = document.querySelector(".img");
input.addEventListener("change", function (e) {
  console.log(this.files[0]["name"]);
  document.querySelector("#crazy").innerText = this.files[0]["name"];
});
