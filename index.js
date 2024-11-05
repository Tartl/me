let backToTopVisible = false;

window.addEventListener('scroll', function() {
    const backToTopButton = document.querySelector('.back-to-top');
    
    if (window.scrollY > 100) {
        if (!backToTopVisible) {  // Only run if button is currently hidden
            backToTopButton.style.display = 'block';
            setTimeout(() => {
                backToTopButton.style.opacity = '1';
            }, 10);  // Small delay for the fade-in to apply smoothly
            backToTopVisible = true;
        }
    } else {
        if (backToTopVisible) {  // Only run if button is currently visible
            backToTopButton.style.opacity = '0';
            setTimeout(() => {
                backToTopButton.style.display = 'none';
            }, 300);  // Delay matches the transition duration
            backToTopVisible = false;
        }
    }
});