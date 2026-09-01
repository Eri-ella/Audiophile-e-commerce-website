<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'public/js/client.js',
    ])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body 
    x-data='{ 
        open: false, 
    }'  
    class='flex flex-col'>

    {{-- ===== Toast : "X item(s) has been added to your cart..." ===== --}}
    @if (session('cart_success'))
        <div id="cart-toast"
             class="fixed left-1/2 top-6 z-50 flex -translate-x-1/2 items-center gap-3 whitespace-nowrap rounded-lg bg-white px-6 py-4 shadow-[0_20px_50px_rgba(0,0,0,0.2)] transition-all duration-300">
            <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-(--orange_principal)">
                <svg width="12" height="9" viewBox="0 0 14 11" xmlns="http://www.w3.org/2000/svg">
                    <path fill="none" stroke="#FFF" stroke-width="2" d="m 4.526 3.973 4.056L12.246 1" />
                </svg>
            </div>
            <p class="text-sm font-medium text-(--hard_black)">
                {{ session('cart_success')['qty'] }} item(s) has been added to your cart. You now have {{ session('cart_success')['total'] }} in your shopping cart.
            </p>
        </div>

        <script>
            setTimeout(() => {
                const toast = document.getElementById('cart-toast');
                if (toast) {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translate(-50%, -10px)';
                    setTimeout(() => toast.remove(), 300);
                }
            }, 3000);
        </script>
    @endif

    <header class='flex justify-between items-center bg-(--hard_black) text-(--white_color) md:px-35 px-10 py-10'>
        <div class='flex items-center gap-5'>
            <iconify-icon icon="material-symbols:menu" class='md:hidden text-3xl mt-2 menu-clicker'></iconify-icon>
            <a href={{ Route('acceuil') }}><p class='text-3xl font-bold'>audiophile</p></a>
        </div>
        <ul class='md:flex hidden uppercase gap-5 text-sm font-semibold tracking-[.15rem]'>
            <a href={{ Route('acceuil') }}>
                <li class='hover:text-(--orange_principal)'>home</li>
            </a>
            <a href={{ Route('headphones') }}>
                <li class='hover:text-(--orange_principal)'>headphones</li>
            </a>
            <a href={{ Route('speakers') }}>
                <li class='hover:text-(--orange_principal)'>speakers</li>
            </a>
            <a href={{ Route('earphones') }}>
                <li class='hover:text-(--orange_principal)'>earphones</li>
            </a>
        </ul>

        {{-- ===== Icône panier + badge compteur ===== --}}
        @php
            $cartCount = collect(session('cart', []))->sum('qty');
        @endphp
        <div class="relative">
            <iconify-icon icon="mdi-light:cart" @click="open = true" class='text-2xl cart-box-clicker cursor-pointer'></iconify-icon>
            @if ($cartCount > 0)
                <span class="pointer-events-none absolute -right-2 -top-2 flex h-[18px] w-[18px] items-center justify-center rounded-full bg-(--orange_principal) text-[11px] font-bold text-white">
                    {{ $cartCount }}
                </span>
            @endif
        </div>
    </header>
    <div class='hidden menu justify-center md:hidden'>@include('layout.product_layout')</div>
    @yield('acceuil-content')
        <div x-show="open" 
        x-transition
        class='fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 rounded-lg'
        style="display: none;"> 
            <div @click.away="open = false" 
                x-effect="document.body.classList.toggle('overflow-hidden', open)"
                class='fixed top-35 right-25 z-20 modal-fixe'>
                {{-- <div class='hidden cart-box '> --}}
                @include('client.cart_box')
            </div>
        </div>
    <footer class='flex flex-col justify-between items-center bg-(--hard_black) text-(--white_color) md:px-35 px-10 py-10 min-h-100 relative'>
        <div class='flex flex-col md:flex-row justify-between w-full max-[460px]:items-center '>
            <div>
                <span class='w-20 h-1 bg-(--orange_principal) absolute top-0 max-[460px]:left-[40%]'></span>
                <a href={{ Route('acceuil') }}><p class='text-3xl font-bold'>audiophile</p></a>
            </div>
            <ul class='flex flex-row max-[460px]:flex-col max-[460px]:items-center items-end uppercase gap-4 max-[460px]:gap-7 text-sm font-medium pr-5 pl-5 md:pl-0 py-10 md:py-0'>
                <a href={{ Route('acceuil') }}>
                    <li class='hover:text-(--orange_principal)'>home</li>
                </a>
                <a href={{ Route('headphones') }}>
                    <li class='hover:text-(--orange_principal)'>headphones</li>
                </a>
                <a href={{ Route('speakers') }}>
                    <li class='hover:text-(--orange_principal)'>speakers</li>
                </a>
                <a href={{ Route('earphones') }}>
                    <li class='hover:text-(--orange_principal)'>earphones</li>
                </a>
            </ul>
        </div>
        <div class='flex max-[460px]:flex-col size-full items-center justify-between grow gap-40 max-[460px]:gap-10 relative'>
            <div class='flex flex-col gap-15'>
                <p class='text-(--mid_gray) font-medium'>Audiophile is an all in one stop to fulfill your audio needs. We're a small team of music lovers and sound specialists who are devoted to helping you get the most out of personal audio. Come and visit our demo facility - we're open 7 days a week.</p>
                <p class='text-(--mid_gray) font-bold'>Copyright 2021. All Rights Reserved</p>
            </div>
            <div class="flex w-full justify-end max-[460px]:justify-center gap-4 text-3xl md:static max-[460px]:static absolute bottom-0">
                <a href="#"><iconify-icon icon="uil:facebook" class='hover:text-(--orange_principal)'></iconify-icon></a>
                <a href="#"><iconify-icon icon="mdi:twitter" class='hover:text-(--orange_principal)'></iconify-icon></a>
                <a href="#"><iconify-icon icon="mdi:instagram" class='hover:text-(--orange_principal)'></iconify-icon></a>
            </div>
        </div>
    </footer>
</body>
</html>