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

function changePage (pageActive, toutesLesPages) {
    if (pageActive) {
        toutesLesPages.forEach(page => {
            if (page) {
                page.classList.remove('block');
                page.classList.add('hidden');
            }
        });
        pageActive.classList.remove('hidden');
        pageActive.classList.add('block');
    } 
}

function togglePage() {
    const onglets = document.querySelectorAll('.onglet');
    const toutesLesPages = document.querySelectorAll('[id$="-page"]');

    onglets.forEach(onglet => {
        const pageId = onglet.dataset.page;
        if (!pageId) return;

        const page = document.getElementById(pageId);
        if (!page) {
            console.warn(`Page avec l'id "${pageId}" introuvable.`);
            return;
        }

        onglet.addEventListener('click', () => {
            changePage(page, toutesLesPages);
        });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    toggleOnglet();
    togglePage();
});