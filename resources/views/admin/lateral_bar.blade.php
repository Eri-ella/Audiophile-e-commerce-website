@extends('layout.simple_layout')

@section('content')
    <div class='flex flex-col h-screen max-w-50 bg-(--black_color) text-(--white_color) text-sm gap-5 p-5'>
        <div class='flex flex-col gap-2'>
            <h2 class='text-xl font-bold'>audio<span class=' text-(--orange_principal)'>file</span></h2>
            <p class='uppercase text-(--white_color)/50'>administration</p>
        </div>
        <div class='w-full h-[1px] bg-(--mid_gray)'></div>
        <div class='flex flex-col gap-2'>
            <h4 class='uppercase text-(--white_color)/50'>général</h4>
            <p class='onglet flex items-center gap-2 p-2 rounded-lg bg-(--orange_principal)'><iconify-icon icon="hugeicons:menu-square" class=''></iconify-icon>Tableau de bord</p>
        </div>
        <div class='flex flex-col gap-2'>
            <h4 class='uppercase text-(--white_color)/50'>catalogue</h4>
            <p class='onglet flex items-center gap-2 p-2 rounded-lg'><iconify-icon icon="mdi:cube-outline" class=''></iconify-icon>Produits</p>
            <p class='onglet flex items-center gap-2 p-2 rounded-lg'><iconify-icon icon="ic:baseline-plus" class=''></iconify-icon>Ajouter un article</p>
        </div>
        <div class='flex flex-col gap-2'>
            <h4 class='uppercase text-(--white_color)/50'>activité</h4>
            <p class='onglet flex items-center gap-2 p-2 rounded-lg'><iconify-icon icon="material-symbols-light:note-outline-sharp" class=''></iconify-icon>Transactions</p>
            <p class='onglet flex items-center gap-2 p-2 rounded-lg'><iconify-icon icon="mynaui:users" class=''></iconify-icon>Utilisateurs</p>
        </div>
        <div class='flex flex-col gap-2'>
            <h4 class='uppercase text-(--white_color)/50'>compte</h4>
            <p class='onglet flex items-center gap-2 p-2 rounded-lg'><iconify-icon icon="uil:setting" class=''></iconify-icon>Paramètres</p>
        </div>
    </div>
    <script>
        const onglet_tab = document.querySelectorAll('.onglet');

        function toggleBg(elt) {
            elt.classList.add('bg-(--orange_principal)');
        }

        onglet_tab.forEach(element => {
            element.addEventListener('click', function(event) {
                toggleBg(element);
            });
        });
    </script>
@endsection