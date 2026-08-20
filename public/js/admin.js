import ApexCharts from 'apexcharts';

// change de couleur des onglets selectionnés - admin

function toggleOnglet () {
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

document.addEventListener('DOMContentLoaded', function() {
    toggleOnglet();
    togglePage();
    initSalesChart();
});