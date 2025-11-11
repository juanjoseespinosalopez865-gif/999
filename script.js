document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slide');
    const leftArrow = document.querySelector('.slider-arrow.left');
    const rightArrow = document.querySelector('.slider-arrow.right');
    let currentSlide = 0;
    const totalSlides = slides.length;
    let autoSlideInterval;

    function setupInfiniteSlider() {
        const firstSlideClone = slides[0].cloneNode(true);
        const lastSlideClone = slides[totalSlides - 1].cloneNode(true);

        slider.appendChild(firstSlideClone);
        slider.insertBefore(lastSlideClone, slides[0]);

        slider.style.transform = `translateX(-100%)`;
    }

    function moveSlide(direction) {
        clearInterval(autoSlideInterval);

        currentSlide += direction;
        updateSlider(true);

        setTimeout(startAutoSlide, 5000);
    }

    function updateSlider(withTransition = false) {
        if (withTransition) {
            slider.style.transition = 'transform 0.5s ease-in-out';
        } else {
            slider.style.transition = 'none';
        }

        slider.style.transform = `translateX(-${(currentSlide + 1) * 100}%)`;

        if (currentSlide === totalSlides) {
            setTimeout(() => {
                slider.style.transition = 'none';
                currentSlide = 0;
                slider.style.transform = `translateX(-100%)`;
            }, 500);
        } else if (currentSlide === -1) {
            setTimeout(() => {
                slider.style.transition = 'none';
                currentSlide = totalSlides - 1;
                slider.style.transform = `translateX(-${totalSlides * 100}%)`;
            }, 500);
        }
    }

    function startAutoSlide() {
        clearInterval(autoSlideInterval);
        autoSlideInterval = setInterval(() => {
            currentSlide++;
            updateSlider(true);
        }, 5000);
    }

    setupInfiniteSlider();
    startAutoSlide();

    leftArrow.addEventListener('click', () => moveSlide(-1));
    rightArrow.addEventListener('click', () => moveSlide(1));
});

// barra de navegacion mobile

// Función para manejar la barra de navegación móvil
let lastScrollMobile = 0;

window.addEventListener('scroll', () => {
    const mobileNavbar = document.querySelector('.mobile-navbar');
    if (!mobileNavbar) return;

    const currentScroll = window.pageYOffset;
    
    // Si estamos en la parte superior de la página, siempre mostramos la barra
    if (currentScroll <= 0) {
        mobileNavbar.classList.remove('mobile-navbar--hidden');
        return;
    }
    
    // Ocultamos la barra al hacer scroll hacia abajo y la mostramos al hacer scroll hacia arriba
    if (currentScroll > lastScrollMobile && !mobileNavbar.classList.contains('mobile-navbar--hidden')) {
        mobileNavbar.classList.add('mobile-navbar--hidden');
    } else if (currentScroll < lastScrollMobile && mobileNavbar.classList.contains('mobile-navbar--hidden')) {
        mobileNavbar.classList.remove('mobile-navbar--hidden');
    }
    
    lastScrollMobile = currentScroll;
});