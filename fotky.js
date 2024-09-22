const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.slide');
const prevBtn = document.querySelector('.prev');
const nextBtn = document.querySelector('.next');
let currentIndex = 0;
let autoSlideInterval;
let isAutoSliding = true;

function showSlide(index) {
    if (index < 0) index = slides.length - 1;
    if (index >= slides.length) index = 0;
    slider.style.transform = `translateX(-${index * 100}%)`;
    currentIndex = index;
}

prevBtn.addEventListener('click', () => {
    showSlide(currentIndex - 1);
    resetAutoSlide();
});

nextBtn.addEventListener('click', () => {
    showSlide(currentIndex + 1);
    resetAutoSlide();
});

function startAutoSlide() {
    if (isAutoSliding) {
        autoSlideInterval = setInterval(() => showSlide(currentIndex + 1), 7000);
    }
}

function stopAutoSlide() {
    clearInterval(autoSlideInterval);
}

function resetAutoSlide() {
    stopAutoSlide();
    startAutoSlide();
}

// Page Visibility API
function handleVisibilityChange() {
    if (document.hidden) {
        stopAutoSlide();
    } else {
        startAutoSlide();
    }
}

// Listen for visibility change events
document.addEventListener("visibilitychange", handleVisibilityChange);

// Initial start of auto-sliding
startAutoSlide();