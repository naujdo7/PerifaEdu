// Menu Hamburger — inicialização segura
document.addEventListener('DOMContentLoaded', function () {

    const menuToggle = document.querySelector('.menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    const header     = document.querySelector('header');

    // Sai se os elementos não existirem na página
    if (!menuToggle || !mobileMenu || !header) return;

    /* ── Abrir / fechar ── */
    menuToggle.addEventListener('click', function (e) {
        e.stopPropagation();
        const isOpen = mobileMenu.classList.toggle('active');
        menuToggle.classList.toggle('active', isOpen);
        document.body.style.overflow = isOpen ? 'hidden' : '';
    });

    /* ── Fechar ao clicar num link do mobile ── */
    mobileMenu.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', closeMenu);
    });

    /* ── Fechar ao clicar fora do header ── */
    document.addEventListener('click', function (e) {
        if (!header.contains(e.target) && mobileMenu.classList.contains('active')) {
            closeMenu();
        }
    });

    /* ── Fechar ao voltar para desktop ── */
    window.addEventListener('resize', function () {
        if (window.innerWidth > 1120) closeMenu();
    });

    function closeMenu() {
        menuToggle.classList.remove('active');
        mobileMenu.classList.remove('active');
        document.body.style.overflow = '';
    }

    /* ── Sombra no scroll ── */
    window.addEventListener('scroll', function () {
        header.style.boxShadow = window.pageYOffset > 10
            ? '0 12px 40px rgba(0,0,0,.15)'
            : '0 8px 32px rgba(0,0,0,.1)';
    });

    /* ── Link ativo ── */
    const currentPath = location.pathname;
    document.querySelectorAll('.desktop-menu a, .mobile-menu a').forEach(function (link) {
        link.classList.remove('active');
        const href = link.getAttribute('href') || '';
        if (
            (href.includes('index') && (currentPath === '/' || currentPath.endsWith('/PerifaEdu/') || currentPath.endsWith('index.php'))) ||
            (href !== '#' && href.length > 2 && currentPath.includes(href.replace(/^\.\//, '').replace('.html', '').replace('.php', '')))
        ) {
            link.classList.add('active');
        }
    });

});