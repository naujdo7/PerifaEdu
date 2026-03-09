// Menu Hamburger
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    const header = document.querySelector('header');
    
    // Toggle menu
    menuToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        this.classList.toggle('active');
        mobileMenu.classList.toggle('active');
        
        // Impede a rolagem da página quando o menu está aberto
        if (mobileMenu.classList.contains('active')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    });
    
    // Fechar o menu quando um link for clicado
    mobileMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function() {
            menuToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
            document.body.style.overflow = '';
        });
    });
    
    // Fechar o menu ao clicar fora dele
    document.addEventListener('click', function(e) {
        if (!header.contains(e.target) && mobileMenu.classList.contains('active')) {
            menuToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
    
    // Fechar o menu ao redimensionar a tela (se voltar para desktop)
    window.addEventListener('resize', function() {
        if (window.innerWidth > 1120) {
            menuToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
    
    // Efeito de scroll no header
    let lastScroll = 0;
    const headerHeight = header.offsetHeight;
    
    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;
        
        // Adicionar sombra ao header quando scrollar
        if (currentScroll > 10) {
            header.style.boxShadow = '0 12px 40px rgba(0, 0, 0, 0.15)';
        } else {
            header.style.boxShadow = '0 8px 32px rgba(0, 0, 0, 0.1)';
        }
        
        lastScroll = currentScroll;
    });
    
    // Highlight do link ativo na navegação
    const currentLocation = location.pathname;
    const desktopLinks = document.querySelectorAll('.desktop-menu a');
    const mobileLinks = document.querySelectorAll('.mobile-menu a');
    
    const updateActiveLink = (links) => {
        links.forEach(link => {
            link.classList.remove('active');
            
            const href = link.getAttribute('href');
            if (href && (
                (href === './index.php' && currentLocation === '/index.php') ||
                (href === './index.php' && currentLocation === '/PerifaEdu/') ||
                (currentLocation.includes(href.replace('./', '').replace('.html', '')))
            )) {
                link.classList.add('active');
            }
        });
    };
    
    updateActiveLink(desktopLinks);
    updateActiveLink(mobileLinks);
});