// let search = document.querySelector(".search-box");
// document.querySelector("#search-icon").onclick = () => {
//   search.classList.toggle("active");
//   menu.classList.remove("active");
// };

// let menu = document.querySelector(".navbar");
// document.querySelector("#menu-icon").onclick = () => {
//   menu.classList.toggle("active");
//   search.classList.remove("active");
// };

//hide manu and search bar when click on scroll
window.onscroll = () => {
  search.classList.remove("active");
  menu.classList.remove("active");
};

const userMenu = document.querySelector(".user-menu img");
const dropdown = document.querySelector(".dropdown");
const hamburger = document.querySelector(".hamburger");
const menu = document.querySelector(".menu");

userMenu.addEventListener("click", () => {
  console.log("clicked");
  dropdown.classList.toggle("active");
});

hamburger.addEventListener("click", () => {
  menu.classList.toggle("active");
});

const carBtn = document.querySelector("button#cart-btn");
console.log(carBtn);
const cartmenu = document.querySelector(".cart-dropdown");

carBtn.addEventListener("click", () => {
  console.log("clicked");
  cartmenu.classList.toggle("active");
});
/// phone number
document.getElementById("phone").addEventListener("input", function (e) {
  var phone = e.target.value;
  // Remove any non-digit characters
  phone = phone.replace(/\D/g, "");
  e.target.value = phone;
});

