let backToTopVisible = false;
let isAnimating = false; 
const menuIcon = document.querySelector('.menu-icon');
const dropdownMenu = document.querySelector('.dropdown-menu');

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

menuIcon.addEventListener('click', function() {
    dropdownMenu.classList.toggle('active');
});