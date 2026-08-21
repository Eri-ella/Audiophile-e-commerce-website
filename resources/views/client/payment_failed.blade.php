@extends('layout.client_layout')

@section('acceuil-content')
<div class="mx-auto max-w-[600px] px-6 py-20 text-center">
    <div class="mb-8 text-6xl">❌</div>
    <h1 class="mb-4 text-3xl font-bold uppercase text-[#101010]">Paiement échoué</h1>
    <p class="mb-8 text-[#808080]">Votre paiement n'a pas pu être traité. Aucun montant n'a été débité.</p>
    <a href="{{ route('cart') }}"
       class="inline-block bg-[#D87D4A] px-8 py-4 text-sm font-bold uppercase tracking-[0.1em] text-white hover:bg-[#FBAF85]">
        Retourner au panier
    </a>
</div>
@endsection