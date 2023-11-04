fetch("../data/jud.json")
  .then((response) => response.json())
  .then((json) => {
    const currentlist = document.getElementById("jud");
    json.forEach((element) => {
      const label = document.createElement("label");
      label.setAttribute("for", element.name);
      const li = document.createElement("li");
      li.className = "item";
      const input = document.createElement("input");
      input.type = "checkbox";
      input.name = element.ind;
      input.id = element.name;
      input.className = "selection jud";
      const span1 = document.createElement("span");
      span1.className = "checkbox";
      const i = document.createElement("i");
      i.className = "fa-solid fa-check check-icon";
      span1.append(i);
      const span2 = document.createElement("span");
      span2.className = "item-text";
      span2.textContent = element.name;
      li.append(input);
      li.append(span1);
      li.append(span2);
      label.append(li);
      currentlist.append(label);
    });
  });

fetch("../data/format.json")
  .then((response) => response.json())
  .then((json) => {
    const currentlist = document.getElementById("fmt");
    json.forEach((element) => {
      const label = document.createElement("label");
      label.setAttribute("for", element.name);
      const li = document.createElement("li");
      li.className = "item";
      const input = document.createElement("input");
      input.type = "checkbox";
      input.name = element.ind;
      input.id = element.name;
      input.className = "selection fmt";
      const span1 = document.createElement("span");
      span1.className = "checkbox";
      const i = document.createElement("i");
      i.className = "fa-solid fa-check check-icon";
      span1.append(i);
      const span2 = document.createElement("span");
      span2.className = "item-text";
      span2.textContent = element.name;
      li.append(input);
      li.append(span1);
      li.append(span2);
      label.append(li);
      currentlist.append(label);
    });
  });

fetch("../data/tip.json")
  .then((response) => response.json())
  .then((json) => {
    const currentlist = document.getElementById("tip");
    json.forEach((element) => {
      const label = document.createElement("label");
      label.setAttribute("for", element.name);
      const li = document.createElement("li");
      li.className = "item";
      const input = document.createElement("input");
      input.type = "checkbox";
      input.name = element.ind;
      input.id = element.name;
      input.className = "selection tip";
      const span1 = document.createElement("span");
      span1.className = "checkbox";
      const i = document.createElement("i");
      i.className = "fa-solid fa-check check-icon";
      span1.append(i);
      const span2 = document.createElement("span");
      span2.className = "item-text";
      span2.textContent = element.name;
      li.append(input);
      li.append(span1);
      li.append(span2);
      label.append(li);
      currentlist.append(label);
    });
  });

//event listeners
var get_items = false;
const showfilters = document.querySelector("#show-filters");
const closepopup = document.querySelector(".close-button");
const popup = document.querySelector(".popup-form");
const popupobf = document.querySelector("#popup-obfuscate");

showfilters.addEventListener("click", () => {
  popup.classList.add("active");
  popupobf.classList.add("active");
  if (!get_items) {
    get_items = true;
    const items = document.querySelectorAll(".selection");
    console.log(items);
    items.forEach((item) => {
      item.addEventListener("change", () => {
        item.classList.toggle("selected");

        let checkedJud = document.querySelectorAll(".jud.selected");
        let checkedFmt = document.querySelectorAll(".fmt.selected");
        let checkedTip = document.querySelectorAll(".tip.selected");
        let btnTextJud = document.querySelector("#btn-text-jud");
        let btnTextFmt = document.querySelector("#btn-text-fmt");
        let btnTextTip = document.querySelector("#btn-text-tip");
        if (checkedJud && checkedJud.length > 0) {
          btnTextJud.innerText = checkedJud.length + " selectate";
        } else {
          btnTextJud.innerText = "Selecteaza judete";
        }
        if (checkedFmt && checkedFmt.length > 0) {
          btnTextFmt.innerText = checkedFmt.length + " selectate";
        } else {
          btnTextFmt.innerText = "Selecteaza format";
        }
        if (checkedTip && checkedTip.length > 0) {
          btnTextTip.innerText = checkedTip.length + " selectate";
        } else {
          btnTextTip.innerText = "Selecteaza tip";
        }
      });
    });
  }
});

closepopup.addEventListener("click", () => {
  popup.classList.remove("active");
  popupobf.classList.remove("active");
});

popupobf.addEventListener("click", () => {
  popup.classList.remove("active");
  popupobf.classList.remove("active");
});

//---
const selectBtns = document.querySelectorAll(".select-btn");
// const items = document.querySelectorAll(".selection");

selectBtns.forEach((selectBtn) => {
  selectBtn.addEventListener("click", () => {
    selectBtn.classList.toggle("open");
  });
});
