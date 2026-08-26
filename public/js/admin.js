import ApexCharts from 'apexcharts';

// change de couleur des onglets selectionnés - admin

// change de couleur des onglets selectionnés - admin
function toggleOnglet() {
    const onglet_tab = document.querySelectorAll('.onglet');
    
    onglet_tab.forEach(element => {
        element.addEventListener('click', () => {
            onglet_tab.forEach(elt => {
                elt.classList.remove('bg-(--orange_principal)');
                elt.classList.remove('hover:bg-[#d18459]');
                elt.classList.add('hover:bg-(--mid_gray)/50');
            });
            element.classList.add('bg-(--orange_principal)');
            element.classList.add('hover:bg-[#d18459]');
            element.classList.remove('hover:bg-(--mid_gray)');
        });
    });
}

// Gérer le clic sur "Voir tout" dans les transactions
function handleTransactionClicker() {
    const transaction_clicker = document.querySelector('.transaction-clicker');
    const transaction_onglet = document.querySelector('.onglet-transaction');
    const pageId = transaction_onglet?.dataset.page;
    
    if (!transaction_clicker || !transaction_onglet) return;
    
    transaction_clicker.addEventListener('click', (e) => {
        e.preventDefault();
        
        const page = document.getElementById(pageId);
        const toutesLesPages = document.querySelectorAll('[id$="-page"]');
        
        if (page && transaction_onglet) {
            changePage(page, toutesLesPages);
            
            const onglet_tab = document.querySelectorAll('.onglet');
            onglet_tab.forEach(elt => {
                elt.classList.remove('bg-(--orange_principal)');
                elt.classList.remove('hover:bg-[#d18459]');
                elt.classList.add('hover:bg-(--mid_gray)/50');
            });
            transaction_onglet.classList.add('bg-(--orange_principal)');
            transaction_onglet.classList.add('hover:bg-[#d18459]');
            transaction_onglet.classList.remove('hover:bg-(--mid_gray)');
        }
    });
}

// Gérer le clic sur "+ Ajouter un appareil" dans les produits
function handleProductClicker() {
    const product_clicker = document.querySelector('.product-clicker');
    const product_onglet = document.querySelector('.onglet-product');
    const pageId = product_onglet?.dataset.page;
    
    if (!product_clicker || !product_onglet) return;
    
    product_clicker.addEventListener('click', (e) => {
        e.preventDefault();
        
        const page = document.getElementById(pageId);
        const toutesLesPages = document.querySelectorAll('[id$="-page"]');
        
        if (page && product_onglet) {
            changePage(page, toutesLesPages);
            
            const onglet_tab = document.querySelectorAll('.onglet');
            onglet_tab.forEach(elt => {
                elt.classList.remove('bg-(--orange_principal)');
                elt.classList.remove('hover:bg-[#d18459]');
                elt.classList.add('hover:bg-(--mid_gray)/50');
            });
            product_onglet.classList.add('bg-(--orange_principal)');
            product_onglet.classList.add('hover:bg-[#d18459]');
            product_onglet.classList.remove('hover:bg-(--mid_gray)');
        }
    });
}

// fontions d'affichage des pages de la partie admin

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

// fonction d'affichage du graphe 

async function initSalesChart() {
    const res = await fetch('/admin/dashboard/sales-data');
    const { labels, data } = await res.json();

    const options = {
        chart: {
            type: 'line',
            height: 200,
        },
        series: [{
            name: 'sales',
            data: [30, 30, 125, 80, 125, 30, 30, 91, 125, 30, 91, 125]
        }],
        xaxis: {
            categories: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jui', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        fill: {
            colors: ['#D87D4A']
        }
    };

    new ApexCharts(document.querySelector('#sales-chart'), options).render();
}

// Fonction pour activer l'onglet selon l'URL actuelle
function setActiveTabFromUrl() {
    const currentPath = window.location.pathname;
    const onglets = document.querySelectorAll('.onglet');
    
    onglets.forEach(elt => {
        // Retirer toutes les classes actives
        elt.classList.remove('bg-(--orange_principal)');
        elt.classList.remove('hover:bg-[#d18459]');
        elt.classList.add('hover:bg-(--mid_gray)/50');
        
        // Vérifier si le href de l'onglet correspond à l'URL actuelle
        if (elt.getAttribute('href') === currentPath) {
            elt.classList.add('bg-(--orange_principal)');
            elt.classList.add('hover:bg-[#d18459]');
            elt.classList.remove('hover:bg-(--mid_gray)');
        }
    });
}

// Appeler au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    setActiveTabFromUrl(); 
    togglePage();
    initSalesChart();
    handleTransactionClicker();
    handleProductClicker();
});