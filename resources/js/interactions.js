// ============================================
// INTERAKSI & EFEK VISUAL TAMBAHAN
// (terpisah dari animations.js — tidak mengubahnya)
// ============================================

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const isFinePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;

// ---------- 1. PROGRESS BAR SCROLL DI ATAS HALAMAN ----------
function initScrollProgress() {
    if (document.querySelector('.admin-layout')) return;

    const bar = document.createElement('div');
    bar.className = 'scroll-progress';
    document.body.appendChild(bar);

    const update = () => {
        const h = document.documentElement;
        const scrolled = h.scrollTop;
        const max = h.scrollHeight - h.clientHeight;
        bar.style.width = max > 0 ? (scrolled / max) * 100 + '%' : '0%';
    };

    update();
    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);
}

// ---------- 2. NAVBAR SEMBUNYI SAAT SCROLL KE BAWAH ----------
function initNavbarAutoHide() {
    const navbar = document.querySelector('.navbar');
    if (!navbar) return;

    let lastY = window.scrollY;

    window.addEventListener(
        'scroll',
        () => {
            const y = window.scrollY;
            if (y > lastY && y > 140) {
                navbar.classList.add('navbar-hidden');
            } else {
                navbar.classList.remove('navbar-hidden');
            }
            lastY = y;
        },
        { passive: true }
    );
}

// ---------- 3. TRANSISI HALAMAN (fade saat pindah link) ----------
function initPageTransition() {
    const overlay = document.createElement('div');
    overlay.className = 'page-transition';
    document.body.appendChild(overlay);

    // fade-in saat halaman baru selesai dimuat
    requestAnimationFrame(() => document.body.classList.add('page-loaded'));

    document.querySelectorAll('a[href]').forEach((link) => {
        const href = link.getAttribute('href');
        if (
            !href ||
            href.startsWith('#') ||
            href.startsWith('mailto:') ||
            href.startsWith('tel:') ||
            href.startsWith('javascript:') ||
            link.target === '_blank' ||
            link.hasAttribute('download') ||
            link.dataset.noTransition !== undefined ||
            new URL(href, window.location.href).origin !== window.location.origin
        ) {
            return;
        }

        link.addEventListener('click', (e) => {
            if (e.metaKey || e.ctrlKey || e.shiftKey) return;
            e.preventDefault();
            overlay.classList.add('active');
            setTimeout(() => (window.location.href = href), 280);
        });
    });
}

// ---------- 4. CURSOR GLOW (desktop saja) ----------
function initCursorGlow() {
    if (!isFinePointer || reduceMotion || document.querySelector('.admin-layout')) return;

    const glow = document.createElement('div');
    glow.className = 'cursor-glow';
    document.body.appendChild(glow);

    let x = window.innerWidth / 2;
    let y = window.innerHeight / 2;
    let gx = x;
    let gy = y;

    window.addEventListener('mousemove', (e) => {
        x = e.clientX;
        y = e.clientY;
        glow.classList.add('show');
    });

    document.addEventListener('mouseleave', () => glow.classList.remove('show'));

    function loop() {
        gx += (x - gx) * 0.15;
        gy += (y - gy) * 0.15;
        glow.style.transform = `translate(${gx}px, ${gy}px)`;
        requestAnimationFrame(loop);
    }
    loop();
}

// ---------- 5. TOMBOL MAGNETIC (tertarik ke arah kursor) ----------
function initMagneticButtons() {
    if (!isFinePointer || reduceMotion) return;

    document.querySelectorAll('.btn, .cart-btn').forEach((btn) => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const relX = e.clientX - rect.left - rect.width / 2;
            const relY = e.clientY - rect.top - rect.height / 2;
            btn.style.transform = `translate(${relX * 0.18}px, ${relY * 0.35 - 2}px)`;
        });

        btn.addEventListener('mouseleave', () => {
            btn.style.transform = '';
        });
    });
}

// ---------- 6. TILT 3D DI KARTU ----------
function initTiltCards() {
    if (!isFinePointer || reduceMotion) return;

    const selector =
        '.feature-card, .produk-card, .program-card, .kontak-social-card, .eskul-card, .admin-stat-card';

    document.querySelectorAll(selector).forEach((card) => {
        card.style.transformStyle = 'preserve-3d';
        card.style.willChange = 'transform';

        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const px = (e.clientX - rect.left) / rect.width - 0.5;
            const py = (e.clientY - rect.top) / rect.height - 0.5;
            const rotateX = (-py * 7).toFixed(2);
            const rotateY = (px * 7).toFixed(2);
            card.style.transform = `perspective(700px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-6px) scale(1.015)`;
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
        });
    });
}

// ---------- 7. RIPPLE SAAT KLIK TOMBOL ----------
function initRipple() {
    document.querySelectorAll('.btn, .cart-btn, .page-btn, .admin-page-btn').forEach((btn) => {
        const computed = getComputedStyle(btn);
        if (computed.position === 'static') btn.style.position = 'relative';
        btn.style.overflow = 'hidden';

        btn.addEventListener('click', (e) => {
            const rect = btn.getBoundingClientRect();
            const ripple = document.createElement('span');
            const size = Math.max(rect.width, rect.height) * 1.6;

            ripple.className = 'ripple-effect';
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = e.clientX - rect.left - size / 2 + 'px';
            ripple.style.top = e.clientY - rect.top - size / 2 + 'px';

            btn.appendChild(ripple);
            setTimeout(() => ripple.remove(), 650);
        });
    });
}

// ---------- 8. JUDUL HERO MUNCUL PER-KATA ----------
function initHeroTextSplit() {
    if (reduceMotion) return;

    const heading = document.querySelector(
        '.hero-content h1, .profil-hero-content h1, .artikel-hero-content h1, .galeri-hero-content h1, .eskul-hero-content h1, .kontak-hero-content h1, .produk-hero-content h1'
    );
    if (!heading || heading.dataset.split) return;

    heading.dataset.split = 'true';
    const words = heading.textContent.trim().split(/\s+/);

    heading.innerHTML = words
        .map(
            (word, i) =>
                `<span class="split-word" style="animation-delay:${0.08 + i * 0.07}s">${word}</span>`
        )
        .join(' ');
}

// ---------- JALANKAN SEMUA ----------
document.addEventListener('DOMContentLoaded', () => {
    initScrollProgress();
    initNavbarAutoHide();
    initPageTransition();
    initCursorGlow();
    initMagneticButtons();
    initTiltCards();
    initRipple();
    initHeroTextSplit();
});