// ============================================
// ANIMASI WEBSITE
// ============================================

const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// ---------- 1. SCROLL REVEAL ----------
// Daftar elemen yang akan dianimasikan saat masuk layar.
// Elemen dalam satu grid akan muncul bertahap (stagger).
const REVEAL_SELECTORS = [
    '.features-container > *',
    '.sambutan-container > *',
    '.artikel-header',
    '.artikel-grid > *',
    '.program-keahlian h2',
    '.program-grid > *',
    '.ekskul h2',
    '.ekskul-desc',
    '.ekskul-grid > *',
    '.sejarah-container > *',
    '.visimisi-container > *',
    '.struktur-chart > *',
    '.section-title-center',
    '.artikel-top-grid > *',
    '.artikel-bottom-grid > *',
    '.galeri-item',
    '.galeri-filter',
    '.galeri-cta',
    '.eskul-grid > *',
    '.eskul-cta',
    '.produk-title',
    '.produk-grid > *',
    '.kontak-grid > *',
    '.kontak-social-grid > *',
    '.detail-section > *',
    '.admin-stat-card',
    '.admin-activity-box',
    '.admin-table-box',
];

function initScrollReveal() {
    if (prefersReduced || !('IntersectionObserver' in window)) return;

    const targets = [];

    REVEAL_SELECTORS.forEach((selector) => {
        document.querySelectorAll(selector).forEach((el, index) => {
            if (el.classList.contains('reveal')) return;
            el.classList.add('reveal');
            // jeda bertahap: 0ms, 90ms, 180ms, ... (maksimal 450ms)
            el.style.setProperty('--reveal-delay', Math.min(index, 5) * 90 + 'ms');
            targets.push(el);
        });
    });

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;

                const el = entry.target;
                el.classList.add('is-visible');
                observer.unobserve(el);

                // Setelah animasi selesai, lepas class supaya tidak mengganggu efek hover
                setTimeout(() => {
                    el.classList.remove('reveal', 'is-visible');
                    el.style.removeProperty('--reveal-delay');
                }, 1100);
            });
        },
        { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
    );

    targets.forEach((el) => observer.observe(el));
}

// ---------- 2. NAVBAR SHADOW SAAT SCROLL ----------
function initNavbarScroll() {
    const navbar = document.querySelector('.navbar');
    if (!navbar) return;

    const toggle = () => {
        navbar.classList.toggle('navbar-scrolled', window.scrollY > 10);
    };

    toggle();
    window.addEventListener('scroll', toggle, { passive: true });
}

// ---------- 3. COUNTER ANGKA (Dashboard admin) ----------
function animateCounter(el) {
    const target = parseInt(el.textContent.replace(/\D/g, ''), 10);
    if (isNaN(target)) return;

    const duration = 1200;
    const start = performance.now();

    function tick(now) {
        const progress = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3); // ease-out
        el.textContent = Math.round(target * eased);
        if (progress < 1) requestAnimationFrame(tick);
    }

    el.textContent = '0';
    requestAnimationFrame(tick);
}

function initCounters() {
    if (prefersReduced) return;
    document.querySelectorAll('.admin-stat-value, .admin-simple-stat strong').forEach((el) => {
        // hanya animasikan yang isinya murni angka
        if (/^\d+$/.test(el.textContent.trim())) animateCounter(el);
    });
}

// ---------- 4. TOMBOL KEMBALI KE ATAS ----------
function initBackToTop() {
    if (document.querySelector('.admin-layout')) return; // tidak di halaman admin

    const btn = document.createElement('button');
    btn.className = 'back-to-top';
    btn.setAttribute('aria-label', 'Kembali ke atas');
    btn.innerHTML =
        '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>';
    document.body.appendChild(btn);

    window.addEventListener(
        'scroll',
        () => btn.classList.toggle('show', window.scrollY > 400),
        { passive: true }
    );

    btn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

// ---------- 5. HERO SAAT HALAMAN DIBUKA ----------
function initHeroIntro() {
    document
        .querySelectorAll('.hero-content, .profil-hero-content, .artikel-hero-content, .galeri-hero-content, .eskul-hero-content, .kontak-hero-content, .produk-hero-content')
        .forEach((el) => el.classList.add('hero-intro'));
}

// ---------- JALANKAN SEMUA ----------
document.addEventListener('DOMContentLoaded', () => {
    initHeroIntro();
    initScrollReveal();
    initNavbarScroll();
    initCounters();
    initBackToTop();
});