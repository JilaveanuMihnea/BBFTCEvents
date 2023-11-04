var input = document.querySelector('.img');
input.addEventListener('change', function (e) {
  console.log(this.files[0]['name']);
  document.querySelector('#crazy').innerText = this.files[0]['name'];
});
