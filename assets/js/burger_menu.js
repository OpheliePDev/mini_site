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
    // Lazy-load menu JS uniquement sur mobile
    if (window.innerWidth < 1024) {
      const menuToggle = document.getElementById("menu-toggle");
      const menu = document.getElementById("mobile-menu");
      const openIcon = document.getElementById("icon-open");
      const closeIcon = document.getElementById("icon-close");

      menuToggle.addEventListener("click", () => {
        menu.classList.toggle("hidden");
        openIcon.classList.toggle("hidden");
        closeIcon.classList.toggle("hidden");
      });
    }
});
