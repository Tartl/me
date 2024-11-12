document.addEventListener('DOMContentLoaded', function() {
    const aboutSections = document.querySelectorAll('.about');

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('about--onscreen');
                observer.unobserve(entry.target); // Stop observing once it's visible
            }
        });
    }, {
        threshold: 0.1 // Trigger when 10% of the element is visible
    });

    aboutSections.forEach(section => {
        observer.observe(section);
    });
});