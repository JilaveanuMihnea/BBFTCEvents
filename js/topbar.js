function openMenu() {
  alert("merge");
  console.log("isworking");
}
const input = document.querySelector("input[type=search]");
input.onsearch = () => {
  const cautarea = `${input.value}`;
  console.log(cautarea);
};
