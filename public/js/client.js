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

function toggleCart() {
    const cart_box = document.querySelector(".cart-box");
    // const cart_box_clicker = document.querySelector(".cart-box-clicker");

    if (cart_box) {
        cart_box.classList.contains('hidden') ?
        cart_box.classList.replace('hidden', 'flex') :
        cart_box.classList.replace('flex', 'hidden');

        // cart_box.classList.contains('flex') && cart_box.focus();

        // if(document.activeElement != cart_box ||document.activeElement != cart_box_clicker) {
        //     cart_box.classList.replace('flex', 'hidden');
        // }
    } 
}

function appearCart() {
    const cart_box_clicker = document.querySelector(".cart-box-clicker");

    if (cart_box_clicker) {
        cart_box_clicker.addEventListener('click', 
            toggleCart
        );
    }
}

document.addEventListener('DOMContentLoaded', function(){
    appearMenu();
})