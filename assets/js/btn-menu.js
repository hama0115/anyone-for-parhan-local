const btn = document.querySelector(".btn-menu");
const nav = document.querySelector(".site-menu");

btn.addEventListener("click", () => {
  nav.classList.toggle("open-menu");
});