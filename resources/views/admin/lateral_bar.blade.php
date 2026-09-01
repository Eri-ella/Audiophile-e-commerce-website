@vite(['public/js/admin.js'])

<div class='flex flex-col h-full w-50 bg-(--black_color) text-(--white_color) text-sm gap-3 p-5 relative'>
    <svg height="150" width="150" xmlns="" class='absolute z-10 top-0 left-0'>
        <circle r="90" cx="40" cy="40" fill="none" stroke="#de936715" stroke-width="2" />
        <circle r="60" cx="40" cy="40" fill="none" stroke="#de93672a" stroke-width="2" />
        <circle r="35" cx="40" cy="40" fill="none" stroke="#de936749" stroke-width="2" />
        <circle r="20" cx="40" cy="40" fill="none" stroke="#de93676c" stroke-width="2" />
    </svg>
    <div class='flex flex-col gap-2 z-20'>
        <h2 class='text-xl font-bold'>audio<span class=' text-(--orange_principal)'>file</span></h2>
        <p class='uppercase text-(--white_color)/50 text-sm'>administration</p>
    </div>
    <div class='flex flex-col gap-2'>
        <h4 class='uppercase text-(--white_color)/50'>général</h4>
        <a href="{{ route('admin.tableau-bord') }}" 
           class='onglet flex items-center gap-2 p-2 rounded-lg bg-(--orange_principal) cursor-pointer hover:bg-[#d18459]' 
           data-page='dashboard-page'>
            <iconify-icon icon="hugeicons:menu-square"></iconify-icon>Tableau de bord
        </a>
    </div>
    
    <div class='flex flex-col gap-2'>
        <h4 class='uppercase text-(--white_color)/50'>catalogue</h4>
        <a href="{{ route('admin.product') }}" 
           class='onglet flex items-center gap-2 p-2 rounded-lg cursor-pointer hover:bg-(--mid_gray)/50' 
           data-page='product-page'>
            <iconify-icon icon="mdi:cube-outline"></iconify-icon>Produits
        </a>
        <a href="{{ route('admin.category') }}" 
           class='onglet flex items-center gap-2 p-2 rounded-lg cursor-pointer hover:bg-(--mid_gray)/50' 
           data-page='category-page'>
            <iconify-icon icon="vaadin:lines-list" class='text-[10px]'></iconify-icon>Catégorie
        </a>
    </div>

    <div class='flex flex-col gap-2'>
        <h4 class='uppercase text-(--white_color)/50'>activité</h4>
        <a href="{{ route('admin.transaction') }}" 
           class='onglet onglet-transaction flex items-center gap-2 p-2 rounded-lg cursor-pointer hover:bg-(--mid_gray)/50' 
           data-page='transaction-page'>
            <iconify-icon icon="material-symbols-light:note-outline-sharp"></iconify-icon>Transactions
        </a>
        <a href="{{ route('admin.user') }}" 
           class='onglet flex items-center gap-2 p-2 rounded-lg cursor-pointer hover:bg-(--mid_gray)/50' 
           data-page='user-page'>
            <iconify-icon icon="mynaui:users"></iconify-icon>Utilisateurs
        </a>
    </div>
    
    <div class='flex flex-col gap-2'>
        <h4 class='uppercase text-(--white_color)/50'>compte</h4>
        <a href="{{ route('admin.setting') }}" 
           class='onglet flex items-center gap-2 p-2 rounded-lg cursor-pointer hover:bg-(--mid_gray)/50' 
           data-page='setting-page'>
            <iconify-icon icon="uil:setting"></iconify-icon>Paramètres
        </a>
    </div>
    
    <div class='flex flex-col gap-2 w-40 absolute bottom-5'>
        <div class='w-full h-[1px] bg-(--mid_gray)'></div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class='flex items-center rounded-lg gap-2 p-2 w-full cursor-pointer hover:bg-red-700/25'>
                <iconify-icon icon="mdi:logout"></iconify-icon>Déconnexion
            </button>
        </form>
    </div>
</div>