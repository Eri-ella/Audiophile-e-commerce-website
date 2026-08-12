@extends('layout.client_layout')

@section('acceuil-content')
<section class="bg-(--hard_black) py-12 text-center md:py-16">
    <h1 class="text-4xl font-bold uppercase tracking-[2px] text-white">Speakers</h1>
</section>
<section class="mx-auto grid w-full max-w-[1950px] grid-cols-1 items-center gap-12 px-6 py-10 sm:px-10 md:grid-cols-2 md:gap-24 md:px-20 md:py-14 lg:px-32 xl:px-40">
    <div class="order-2 mr-auto inline-flex w-fit items-center justify-center rounded-xl bg-[#F1F1F1] p-4 md:order-none md:p-6">
        <img src="{{ asset('page_autre/speaker1.jpg') }}"
             alt="ZX9 Speaker"
             class="h-[280px] w-auto object-contain md:h-[400px]">
    </div>
    <div class="order-1 md:order-none">
        <span class="mb-6 block text-sm font-medium uppercase tracking-[0.5em] text-[#D87D4A]">New product</span>
        <h2 class="mb-8 text-4xl font-bold uppercase leading-[1.15] text-[#101010] md:text-5xl">
            ZX9<br class="hidden md:block"> Speaker
        </h2>
        <p class="mb-10 max-w-[700px] leading-[1.8] text-[#808080]">
            Upgrade your sound system with the all new ZX9 active speaker. It's a bookshelf speaker system that offers truly wireless connectivity -- creating new possibilities for more pleasing and practical audio setups.
        </p>
        <a href="{{ route('speaker1') }}" class="inline-block bg-[#D87D4A] px-10 py-5 text-sm font-bold uppercase tracking-[0.15em] text-white transition-colors duration-300 hover:bg-[#FBAF85]">
            See product
        </a>
    </div>
</section>


<section class="mx-auto grid w-full max-w-[1950px] grid-cols-1 items-center gap-12 px-6 py-10 sm:px-10 md:grid-cols-2 md:gap-24 md:px-20 md:py-14 lg:px-32 xl:px-40">
    <div>
        <h2 class="mb-8 text-4xl font-bold uppercase leading-[1.15] text-[#101010] md:text-5xl">
            ZX7 Speaker
        </h2>
        <p class="mb-10 max-w-[700px] leading-[1.8] text-[#808080]">
            Stream high quality sound wirelessly with minimal to no loss. The ZX7 speaker uses high-end audiophile components that represents the top of the line powered speakers for home or studio use.
        </p>
        <a href="{{ route('speaker2') }}" class="inline-block bg-[#D87D4A] px-10 py-5 text-sm font-bold uppercase tracking-[0.15em] text-white transition-colors duration-300 hover:bg-[#FBAF85]">
            See product
        </a>
    </div>
    <div class="ml-auto inline-flex w-fit items-center justify-center rounded-xl bg-[#F1F1F1] p-4 md:p-6">
        <img src="{{ asset('page_autre/speaker2.jpg') }}"
             alt="ZX7 Speaker"
             class="h-[280px] w-auto object-contain md:h-[400px]">
    </div>
</section>
<div class='hidden menu justify-center md:hidden'>@include('layout.product_layout')</div>
<div class='justify-center'>@include('layout.description_layout')</div>
@endsection