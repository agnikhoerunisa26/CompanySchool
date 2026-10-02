import './animations';
import './interactions';

document.addEventListener('DOMContentLoaded', function () {
    // Tombol hamburger untuk membuka/tutup menu navbar di layar kecil (mobile)
    const toggle = document.getElementById('navbarToggle');
    const menu = document.getElementById('navbarMenu');

    if (toggle && menu) {
        toggle.addEventListener('click', function () {
            menu.classList.toggle('open');
        });
    }
});