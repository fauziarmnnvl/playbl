import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {

    const sections = document.querySelectorAll('section, footer');
    const dots = document.querySelectorAll('.dot');

    function updateActiveDot() {

        let current = 0;
        const scrollPosition = window.scrollY + (window.innerHeight / 2);

        sections.forEach((section, index) => {

            if (scrollPosition >= section.offsetTop) {
                current = index;
            }

        });

        dots.forEach(dot => {
            dot.classList.remove('active');
        });

        if (dots[current]) {
            dots[current].classList.add('active');
        }
    }

    window.addEventListener('scroll', updateActiveDot);

    updateActiveDot();

    dots.forEach(dot => {

        dot.addEventListener('click', () => {

            const targetIndex = parseInt(dot.dataset.target);

            if (sections[targetIndex]) {

                window.scrollTo({
                    top: sections[targetIndex].offsetTop,
                    behavior: 'smooth'
                });

            }

        });

    });

});

/* ===================================
   HERO SLIDESHOW
=================================== */

const slides = document.querySelectorAll('.hero-slide');

if(slides.length){

    let currentSlide = 0;

    setInterval(() => {

        slides[currentSlide].classList.remove('active');

        currentSlide++;

        if(currentSlide >= slides.length){
            currentSlide = 0;
        }

        slides[currentSlide].classList.add('active');

    }, 5000);

}