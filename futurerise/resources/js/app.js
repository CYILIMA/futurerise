document.addEventListener('DOMContentLoaded', () => {
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');

    if (navToggle && navLinks) {
        navToggle.addEventListener('click', () => {
            const isOpen = navLinks.classList.toggle('is-open');
            navToggle.setAttribute('aria-expanded', String(isOpen));
        });

        navLinks.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('is-open');
                navToggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    const carousels = Array.from(document.querySelectorAll('[data-carousel]'));

    carousels.forEach((carousel) => {
        const track = carousel.querySelector('[data-carousel-track]');
        const slides = Array.from(carousel.querySelectorAll('[data-carousel-slide]'));
        const prevButton = carousel.querySelector('.carousel-button.prev');
        const nextButton = carousel.querySelector('.carousel-button.next');
        const indicators = Array.from(carousel.querySelectorAll('.carousel-indicator'));
        let activeIndex = 0;
        let autoRotate;

        const getSlideWidth = () => carousel.clientWidth;

        const updateCarousel = (index) => {
            if (slides.length === 0) {
                return;
            }

            activeIndex = ((index % slides.length) + slides.length) % slides.length;
            const offset = activeIndex * getSlideWidth();
            track.style.transform = `translateX(-${offset}px)`;

            indicators.forEach((indicator, indicatorIndex) => {
                const active = indicatorIndex === activeIndex;
                indicator.classList.toggle('active', active);
                indicator.setAttribute('aria-current', active ? 'true' : 'false');
            });
        };

        const startAutoRotate = () => {
            clearInterval(autoRotate);
            if (slides.length <= 1) {
                return;
            }
            autoRotate = setInterval(() => updateCarousel(activeIndex + 1), 4000);
        };

        const resetAutoRotate = () => {
            startAutoRotate();
        };

        prevButton?.addEventListener('click', () => {
            updateCarousel(activeIndex - 1);
            resetAutoRotate();
        });

        nextButton?.addEventListener('click', () => {
            updateCarousel(activeIndex + 1);
            resetAutoRotate();
        });

        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                updateCarousel(index);
                resetAutoRotate();
            });
        });

        window.addEventListener('resize', () => updateCarousel(activeIndex));

        updateCarousel(0);
        startAutoRotate();
    });
});
