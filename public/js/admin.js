function toggleOnglet () {
    const onglet_tab = document.querySelectorAll('.onglet');
    
    onglet_tab.forEach(element => {
        element.addEventListener('click', () => {
            onglet_tab.forEach(elt => {
                elt.classList.remove('bg-(--orange_principal)');
            });
            element.classList.add('bg-(--orange_principal)');
        });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    toggleOnglet();
});