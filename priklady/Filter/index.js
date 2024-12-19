var tlacitko = document.querySelector(".menu-icon");
var menu = document.querySelector(".menu");

tlacitko.addEventListener("click", function(){
    menu.classList.toggle("menu--open");
})