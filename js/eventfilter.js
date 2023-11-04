// todo fill in dropdown options

const showfilters = document.querySelector('#show-filters');
const popup = document.querySelector('.popup-form');
const popupobf = document.querySelector('#popup-obfuscate');
const selectBtns = document.querySelectorAll('.select-btn');
const items = document.querySelectorAll('.selection');

showfilters.addEventListener('click', () => {
  popup.classList.add('active');
  popupobf.classList.add('active');
});

popupobf.addEventListener('click', () => {
  popup.classList.remove('active');
  popupobf.classList.remove('active');
});

selectBtns.forEach((selectBtn) => {
  selectBtn.addEventListener('click', () => {
    selectBtn.classList.toggle('open');
  });
});

items.forEach((item) => {
  item.addEventListener('change', () => {
    item.classList.toggle('selected');

    let checked = document.querySelectorAll('.selected');
    let btnText = document.querySelector('.btn-text');
    if (checked && checked.length > 0) {
      btnText.innerText = checked.length + ' selectate';
    } else {
      btnText.innerText = 'Selecteaza judete';
    }
  });
});
// items.addEventListener("clck", () => {});
