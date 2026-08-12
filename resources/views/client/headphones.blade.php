@extends('layout.client_layout')

@section('acceuil-content')
<section class="bg-[#101010] py-12 text-center md:py-16">
    <h1 class="text-4xl font-bold uppercase tracking-[2px] text-white">Headphones</h1>
</section>

<section class="mx-auto grid w-full max-w-[1950px] grid-cols-1 items-center gap-12 px-6 py-10 sm:px-10 md:grid-cols-2 md:gap-24 md:px-20 md:py-14 lg:px-32 xl:px-40">
    <div>
        <span class="mb-6 block text-sm font-medium uppercase tracking-[0.5em] text-[#D87D4A]">New product</span>
        <h2 class="mb-8 text-4xl font-bold uppercase leading-[1.15] text-[#101010] md:text-5xl">
            XX99 Mark II<br class="hidden md:block"> Headphones
        </h2>
        <p class="mb-10 max-w-[700px] leading-[1.8] text-[#808080]">
            The new XX99 Mark II headphones is the pinnacle of pristine audio. It redefines your premium headphone experience by reproducing the balanced depth and precision of studio-quality sound.
        </p>
        <a href="{{ route('headphile1') }}" class="inline-block bg-[#D87D4A] px-10 py-5 text-sm font-bold uppercase tracking-[0.15em] text-white transition-colors duration-300 hover:bg-[#FBAF85]">
            See product
        </a>
    </div>
    <div class="flex h-[200px] items-center justify-center rounded-xl bg-[#F1F1F1] md:h-[450px]">
    <img src="{{ asset('page_autre/audiophile_black.jpg') }}"
         alt="XX99 Mark II Headphones"
         class="max-h-[100%] w-auto object-contain">  
</div>
</section>

<section class="mx-auto grid w-full max-w-[1950px] grid-cols-1 items-center gap-12 px-6 py-10 sm:px-10 md:grid-cols-2 md:gap-24 md:px-20 md:py-14 lg:px-32 xl:px-40">
    <div class="order-2 flex h-[200px] items-center justify-center rounded-xl bg-[#F1F1F1] md:order-none md:h-[450px]">
        <img src="{{ asset('page_acceuil/audiophile2.jpg') }}"
             alt="XX99 Mark I Headphones"
             class="max-h-[100%] w-auto object-contain">
    </div>
    <div class="order-1 md:order-none">
        <h2 class="mb-8 text-4xl font-bold uppercase leading-[1.15] text-[#101010] md:text-5xl">
            XX99 Mark I<br class="hidden md:block"> Headphones
        </h2>
        <p class="mb-10 max-w-[700px] leading-[1.8] text-[#808080]">
            As the gold standard for headphones, the classic XX99 Mark I offers detailed and accurate audio reproduction for audiophiles, mixing engineers, and music aficionados alike in studios and on the go.
        </p>
        <a href="{{ route('headphile2') }}" class="inline-block bg-[#D87D4A] px-10 py-5 text-sm font-bold uppercase tracking-[0.15em] text-white transition-colors duration-300 hover:bg-[#FBAF85]">
            See product
        </a>
    </div>
</section>

<section class="mx-auto grid w-full max-w-[1950px] grid-cols-1 items-center gap-12 px-6 py-10 sm:px-10 md:grid-cols-2 md:gap-24 md:px-20 md:py-14 lg:px-32 xl:px-40">
    <div>
        <h2 class="mb-8 text-4xl font-bold uppercase leading-[1.15] text-[#101010] md:text-5xl">
            XX59<br class="hidden md:block"> Headphones
        </h2>
        <p class="mb-10 max-w-[700px] leading-[1.8] text-[#808080]">
            Enjoy your audio almost anywhere and customize it to your specific tastes with the XX59 headphones. The stylish yet durable versatile wireless headset is a brilliant companion at home or on the move.
        </p>
        <a href="{{ route('headphile3') }}" class="inline-block bg-[#D87D4A] px-10 py-5 text-sm font-bold uppercase tracking-[0.15em] text-white transition-colors duration-300 hover:bg-[#FBAF85]">
            See product
        </a>
    </div>
    <div class="ml-auto inline-flex w-fit items-center justify-center rounded-xl bg-[#F1F1F1] p-3 md:p-5">
    <img src="{{ asset('page_autre/audiophile3.jpg') }}"
         alt="XX59 Headphones"
         class="h-[280px] w-auto object-contain md:h-[400px]">
</div>
</section>
<div class='hidden menu justify-center md:hidden'>@include('layout.product_layout')</div>
<div class='justify-center'>@include('layout.description_layout')</div>
@endsection