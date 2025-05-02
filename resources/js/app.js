

import './bootstrap';
// import Alpine from 'alpinejs';

import Swiper from 'swiper';
import 'swiper/swiper-bundle.css'; // Импортируем стили Swiper
Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.swiper-container', {
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        loop: true,
        speed: 1000,
    });
});
// public/js/app.js

document.addEventListener('DOMContentLoaded', function () {
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');

    // Показываем/скрываем кнопку при прокрутке
    window.addEventListener('scroll', function () {
        if (window.scrollY > 800) {
            scrollToTopBtn.classList.add('visible');
            scrollToTopBtn.classList.remove('invisible');
        } else {
            scrollToTopBtn.classList.remove('visible');
            scrollToTopBtn.classList.add('invisible');
        }
    });

    // Прокрутка наверх при нажатии на кнопку
    scrollToTopBtn.addEventListener('click', function () {
        window.scrollTo({
            top: 0,
            behavior: 'smooth' // Плавная прокрутка
        });
    });
});

document.querySelectorAll('.accordion').forEach(button => {
    button.addEventListener('click', function () {
        const panel = this.nextElementSibling;
        const arrow = this.querySelector('.arrow');
        const isActive = panel.style.display === 'block';

        panel.style.display = isActive ? 'none' : 'block';
        this.classList.toggle('active', !isActive);
        arrow.textContent = isActive ? '▶' : '▼';
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Показываем уведомление, если пользователь еще не согласился
    if (!localStorage.getItem('cookieConsent')) {
        document.getElementById('cookieConsent').classList.remove('hidden');
    }

    // Обработка клика на кнопку
    document.getElementById('acceptCookies').addEventListener('click', function() {
        localStorage.setItem('cookieConsent', 'true');
        document.getElementById('cookieConsent').classList.add('hidden');
    });
});
