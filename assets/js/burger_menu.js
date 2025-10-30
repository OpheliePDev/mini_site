// Logique d'ouverture/fermeture du menu burger.
document.addEventListener('DOMContentLoaded', () => {
    const button = document.getElementById('menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const iconOpen = document.getElementById('icon-open');
    const iconClose = document.getElementById('icon-close');

    if (button && mobileMenu) {
        button.addEventListener('click', () => {
            // Toggle la visibilité du menu mobile
            mobileMenu.classList.toggle('hidden');
            
            // Toggle des icônes (Burger <-> Croix)
            iconOpen.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
            
            // Met à jour l'état ARIA
            const isExpanded = mobileMenu.classList.contains('hidden') ? 'false' : 'true';
            button.setAttribute('aria-expanded', isExpanded);
        });
    }
});
