const body = document.body;
const actBtn = document.querySelector(".action_btn");
const dropActBtn = document.querySelector(".drop_action_btn");
const toggleBtn = document.querySelector(".toggle_btn");
const toggleBtnicon = document.querySelector(".toggle_btn i");
const dropDownMenu = document.querySelector(".dropdown_menu");
const begin_btn = document.querySelector(".begin-btn");

toggleBtn.onclick = function () {
  dropDownMenu.classList.toggle("open");
  const isOpen = dropDownMenu.classList.contains("open");

  toggleBtnicon.classList = isOpen ? "fa-solid fa-xmark" : "fa-solid fa-bars";
};

actBtn.addEventListener("click", darkMode);
dropActBtn.addEventListener("click", darkMode);
begin_btn.onclick = function () {
  alert("COMING SOON");
};

function darkMode() {
  body.classList.toggle("darkmode");
}
