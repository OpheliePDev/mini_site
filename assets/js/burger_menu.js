function initializeBurgerMenu() {
    const button = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (!button || !mobileMenu) {
        return;
    }

    const newButton = button.cloneNode(true);
    button.parentNode.replaceChild(newButton, button);
    
    const iconOpen = newButton.querySelector('#icon-open');
    const iconClose = newButton.querySelector('#icon-close');
    
    if (!iconOpen || !iconClose) {
        return;
    }

    mobileMenu.classList.add('hidden');
    iconOpen.classList.remove('hidden');
    iconClose.classList.add('hidden');
    newButton.setAttribute('aria-expanded', 'false');

    newButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        
        iconOpen.classList.toggle('hidden');
        iconClose.classList.toggle('hidden');
        
        const isExpanded = mobileMenu.classList.contains('hidden') ? 'false' : 'true';
        newButton.setAttribute('aria-expanded', isExpanded);
    });
}

document.addEventListener('DOMContentLoaded', initializeBurgerMenu);
document.addEventListener('turbo:load', initializeBurgerMenu);