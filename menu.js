var tlacitko = document.querySelector(".menu-icon");
var menu = document.querySelector(".menu");
var krizek = document.querySelector(".x-icon");
tlacitko.addEventListener("click", function(){
    menu.classList.toggle("menu--open");
})

krizek.addEventListener("click", function(){
    menu.classList.toggle("menu--open");
})