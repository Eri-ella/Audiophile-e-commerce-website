@extends('layout.simple_layout')

@section('content')
<h2 class='uppercase font-semibold text-2xl'>Produits</h2>
<p class='text-(--mid_gray) text-base sm:pr-5'>Gérez le catalogue d'appareils audio de la boutique</p>
<a href=""  class='flex justify-center items-center w-full h-10 text-(--white_color) bg-(--orange_principal) uppercase font-semibold hover:bg-(--orange_hover) rounded-lg'>+ Ajouter un appareil</a>
<div>
    <span>
        <input type="text" name="search_product" placeholder="Rechercher un produit" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 min-w-50 bg-(--soft_gray) placeholder:text-(--mid_gray)'>
    </span>
    <span>
        <select></select>

    </span>
    <span></span>

</div>
@endsection