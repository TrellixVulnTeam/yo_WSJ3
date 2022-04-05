window.addEventListener('DOMContentLoaded', event => {
    // Navbar 
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
 
        navbarCollapsible.classList.add('navbar-shrink')

    };

    // navbar 
    navbarShrink();

    // Reducir la barra de navegación cuando se hace scroll
    document.addEventListener('scroll', navbarShrink);

    // Activar Bootstrap Scrollspy
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            offset: 74,
        });
    };

    //Contraer la barra de navegación cuenta está visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

});


