@extends('layout.simple_layout')

@section('content')
    <div class='flex w-full h-screen'>
        <div class='flex flex-col w-1/2 h-screen bg-radial-[at_0%_0%] from-[#222222] to-(--hard_black) justify-center gap-5 md:px-40 relative'>
            <svg height="630" width="700" xmlns="" class='absolute z-10 top-0 left-0'>
                <circle r="330" cx="350" cy="300" fill="none" stroke="#de936736" stroke-width="2" />
                <circle r="230" cx="350" cy="300" fill="none" stroke="#de93675b" stroke-width="2" />
                <circle r="160" cx="350" cy="300" fill="none" stroke="#de93678a" stroke-width="2" />
                <circle r="90" cx="350" cy="300" fill="none" stroke="#de9367e1" stroke-width="2" />
            </svg>
            <p class='uppercase text-(--orange_principal) font-medium tracking-[.3rem] z-10'>espace administrateur</p>
            <h2 class='uppercase text-(--white_color) text-4xl font-bold z-10'>pilotez la boutique audiophile</h2>
            <p class=' text-(--mid_gray) z-10'>Gérez le catalogue d'appareils, suivez chaque commande et gardez un œil sur l'activité de la boutique — tout depuis un seul endroit.</p>
        </div>
        <div class='flex flex-col w-1/2 h-screen justify-center gap-5 md:px-40'>
            <p class='text-3xl font-bold'>audio<span class=' text-(--orange_principal)'>file</span></p>
            <h3 class='uppercase font-medium text-xl'>connexion</h3>
            <p class=' text-(--mid_gray)'>Accédez à votre tableau de bord administrateur.</p>
            <form action="" method="POST" class='flex flex-col gap-5'>
                <p class='uppercase font-medium'>adresse e-mail</p>
                <input type="email" name="mail" placeholder="admin@audiophile.com" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full'>
                <p class='uppercase font-medium'>mot de passe</p>
                <input type="password" name="passe" placeholder=". . . . ." class='border-1 border-(--mid_gray)/50  hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full'>
                <input type="submit" value="se connecter" class='flex justify-center items-center w-full h-13 text-(--white_color) bg-(--orange_principal) uppercase font-semibold hover:bg-(--orange_hover) rounded-lg'>
            </form>
        </div>
    </div>
@endsection