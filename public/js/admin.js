import ApexCharts from 'apexcharts';

// change de couleur des onglets selectionnés - admin
function toggleOnglet() {
    const currentPath = window.location.pathname;
    const onglets = document.querySelectorAll('.onglet');

        onglets.forEach(elt => {
        elt.classList.remove('bg-(--orange_principal)', 'hover:bg-[#d18459]');
        elt.classList.add('hover:bg-(--mid_gray)/50');
        
        if (elt.href.endsWith(currentPath)) {
            elt.classList.add('bg-(--orange_principal)', 'hover:bg-[#d18459]');
            elt.classList.remove('hover:bg-(--mid_gray)/50'); // Fixed mismatch here
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

// fonction d'affichage du graphe 
async function initSalesChart() {
    const chartEl = document.querySelector('#sales-chart');
    if (!chartEl) return;   

    try {
        const res = await fetch('/admin/dashboard/sales-data');
        if (!res.ok) throw new Error(`Réponse HTTP ${res.status}`);

        const { labels, data } = await res.json();

        const options = {
            chart: {
                type: 'line',
                height: 260,
                toolbar: { show: false },
                fontFamily: 'Manrope, sans-serif',
            },
            series: [{ name: 'Ventes', data }],
            xaxis: {
                categories: labels,
                labels: { style: { colors: '#6C6C6C', fontSize: '11px' } },
            },
            stroke: {
                curve: "smooth",
            },
            colors: ['#D87D4A'],
            dataLabels: { enabled: false },
            grid: { borderColor: '#E7E7E7', strokeDashArray: 4 },
            tooltip: { y: { formatter: (v) => '$' + v.toLocaleString() } },
        };

        new ApexCharts(chartEl, options).render();
    } catch (err) {
        console.error('Impossible de charger le graphe des ventes :', err);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    toggleOnglet();
    initSalesChart();
    handleTransactionClicker();
    handleProductClicker();
});

