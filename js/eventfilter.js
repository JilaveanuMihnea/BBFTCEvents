// todo fill in dropdown options

const selectBtns = document.querySelectorAll(".select-btn");
const items = document.querySelectorAll(".selection");

selectBtns.forEach((selectBtn) => {
  selectBtn.addEventListener("click", () => {
    selectBtn.classList.toggle("open");
  });
});

items.forEach((item) => {
  item.addEventListener("change", () => {
    item.classList.toggle("selected");

    let checked = document.querySelectorAll(".selected");
    let btnText = document.querySelector(".btn-text");
    if (checked && checked.length > 0) {
      btnText.innerText = checked.length + " selectate";
    } else {
      btnText.innerText = "Selecteaza judete";
    }
  });
});
// items.addEventListener("clck", () => {});
