let backToTopVisible = false;
let isAnimating = false; 
var tlacitko = document.querySelector(".menu-icon");
var menu = document.querySelector(".menu");
var krizek = document.querySelector(".x-icon");
window.addEventListener('scroll', function() {
    const backToTopButton = document.querySelector('.back-to-top');
    
    if (window.scrollY > 100) {
        if (!backToTopVisible && !isAnimating) {
            backToTopVisible = true;
            backToTopButton.style.display = 'block';
            setTimeout(() => {
                backToTopButton.style.opacity = '1';
            }, 10);
        }
    } else {
        if (backToTopVisible && !isAnimating) {
            isAnimating = true; 
            backToTopButton.style.opacity = '0';
            setTimeout(() => {
                backToTopButton.style.display = 'none';
                backToTopVisible = false; 
                isAnimating = false; 
            }, 300); 
        }
    }
});

tlacitko.addEventListener("click", function(){
    menu.classList.toggle("menu--open");
})

krizek.addEventListener("click", function(){
    menu.classList.toggle("menu--open");
})

