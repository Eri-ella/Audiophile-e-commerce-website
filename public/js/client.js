import '../css/client.css';

function toggleMenu() {
    const menu = document.querySelector(".menu");

    if (menu) {
        menu.classList.contains('hidden') ?
        menu.classList.replace('hidden', 'flex') :
        menu.classList.replace('flex', 'hidden')
    }
    
}

function appearMenu() {
    const menu_clicker = document.querySelector(".menu-clicker");

    if (menu_clicker) {
        menu_clicker.addEventListener('click', 
            toggleMenu
        );
    }
}

document.addEventListener('DOMContentLoaded', function(){
    appearMenu();
})