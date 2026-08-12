<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Description</title>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    @vite(['public/js/client.js'])
</head>
    <section class='flex flex-col sm:flex-row justify-center items-center w-full sm:px-40 px-20 py-20 gap-5'>
        <div class="w-full min-[640px]:hidden">
            <img src="{{ asset('page_acceuil/avatar_long.jpg') }}" alt="avatar" class='rounded-lg'>
        </div>
        <div class="flex flex-col w-full gap-10 sm:pr-15 min-[640px]:justify-center sm:text-left text-center">
            <h2 class='uppercase font-semibold text-[2.5rem]/10'>Bringing you the <span class='text-(--orange_principal)'>best</span> audio gear</h2>
            <p class='text-(--mid_gray) text-base sm:pr-5'>Located at the heart of New York City, Audiophile is the premier store for high end headphones, earphones, speakers, and audio accessories. We have a large showroom and luxury demonstration rooms available for you to browse and experience a wide range of our products. Stop by our store to meet some of the fantastic people who make Audiophile the best place to buy your portable audio equipment.</p>
        </div>
        <div class="w-full hidden min-[640px]:flex">
            <img src="{{ asset('page_acceuil/avatar.jpg') }}" alt="avatar" class='rounded-lg min-w-75'>
        </div>
    </section>
</html>