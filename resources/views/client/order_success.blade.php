@extends('layout.client_layout')

@section('acceuil-content')
<div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-black/50 px-4 py-8 backdrop-blur-md">

    <div class="w-full max-w-[458px] rounded-lg bg-white p-8 shadow-2xl">

        {{-- Rond orange avec le check --}}
        <div class="mb-8 flex h-14 w-14 items-center justify-center rounded-full bg-[#D87D4A]">
            <svg width="18" height="14" viewBox="0 0 14 11" xmlns="http://www.w3.org/2000/svg">
                <path fill="none" stroke="#FFF" stroke-width="2" d="m1 4.526 3.973 4.056L12.246 1"/>
            </svg>
        </div>

        <h1 class="mb-4 text-2xl font-bold uppercase leading-tight text-[#101010]">
            Thank you<br>for your order
        </h1>
        <p class="mb-8 text-sm text-[#808080]">
            Commande #{{ $commande->id }} — vous recevrez un email de confirmation sous peu.
        </p>

        {{-- Bloc produits + total --}}
        <div class="overflow-hidden rounded-lg">

            <div class="bg-[#F2F2F2] p-6">
                @foreach ($commande->products as $product)
                    <div class="mb-4 flex items-center gap-4 border-b border-black/10 pb-4 last:mb-0 last:border-0 last:pb-0">
                        <img src="{{ asset($product->image_1 ?? $product->image_description) }}"
                             alt="{{ $product->name }}"
                             class="h-12 w-12 flex-shrink-0 rounded-lg object-cover">

                        <p class="text-sm font-bold text-[#101010]">{{ $product->name }}</p>

                        <p class="ml-auto text-sm font-bold text-[#808080]">$ {{ number_format($product->price, 0, ',', ',') }}</p>

                        <p class="text-sm font-bold text-[#808080]">x{{ $product->pivot->quantity }}</p>
                    </div>
                @endforeach
            </div>

            <div class="flex items-center justify-between bg-black px-6 py-5">
                <p class="text-sm uppercase text-[#808080]">Grand total</p>
                <p class="text-lg font-bold text-white">$ {{ number_format($commande->amount, 0, ',', ',') }}</p>
            </div>
        </div>

        <a href="{{ route('acceuil') }}"
           class="mt-8 block bg-[#D87D4A] py-4 text-center text-sm font-bold uppercase tracking-[0.15em] text-white transition-colors hover:bg-[#FBAF85]">
            Back to home
        </a>
    </div>

</div>
@endsection