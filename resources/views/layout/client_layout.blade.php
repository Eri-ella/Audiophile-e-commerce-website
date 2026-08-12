<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    @vite(['public/js/client.js'])
</head>
<body class='flex flex-col'>
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
        <a href={{ Route('cart') }}><iconify-icon icon="mdi-light:cart" class='text-2xl cart-box-clicker'></iconify-icon></a>
    </header>
    <div class='hidden menu justify-center md:hidden'>@include('layout.product_layout')</div>
    @yield('acceuil-content')
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
    @vite(['public/js/client.js'])
</body>
</html>