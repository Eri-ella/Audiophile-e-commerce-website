@extends('layout.client_layout')

@section('acceuil-content')
<section class="bg-[#101010] py-16 text-center md:py-24">
    <h1 class="text-4xl font-bold uppercase tracking-[2px] text-white">Earphones</h1>
</section>

<section class="mx-auto grid w-full max-w-[1950px] grid-cols-1 items-center gap-12 px-6 py-10 sm:px-10 md:grid-cols-2 md:gap-24 md:px-20 md:py-14 lg:px-32 xl:px-40">
    <div>
        <span class="mb-6 block text-sm font-medium uppercase tracking-[0.5em] text-[#D87D4A]">New product</span>
        <h2 class="mb-8 text-4xl font-bold uppercase leading-[1.15] text-[#101010] md:text-5xl">
            YX1 Wireless<br class="hidden md:block"> Earphones
        </h2>
        <p class="mb-10 max-w-[700px] leading-[1.8] text-[#808080]">
            Tailor your listening experience with bespoke dynamic drivers from the new YX1 Wireless Earphones. Enjoy incredible high-fidelity sound even in noisy environments with its active noise cancellation feature.
        </p>
        <a href="{{ route('earphone1') }}" class="inline-block bg-[#D87D4A] px-10 py-5 text-sm font-bold uppercase tracking-[0.15em] text-white transition-colors duration-300 hover:bg-[#FBAF85]">
            See product
        </a>
    </div>
    <div class="ml-auto inline-flex w-fit items-center justify-center rounded-xl bg-[#F1F1F1] p-4 md:p-6">
        <img src="{{ asset('page_autre/earphone.jpg') }}"
             alt="YX1 Wireless Earphones"
             class="h-[280px] w-auto object-contain md:h-[400px]">
    </div>
</section>
<div class='hidden menu justify-center md:hidden'>@include('layout.product_layout')</div>
<div class='justify-center'>@include('layout.description_layout')</div>
@endsection