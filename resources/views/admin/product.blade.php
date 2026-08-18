@php
    $products = [
        "elt1" => [ 
            "name" => 'XX99 Mark II',
            "ref" => 'HP-XX99-2',
            "category" => 'casques',
            "price" => 2999,
            "stock" => 18,
            "status" => 'en stock',
        ],
        "elt2" => [ 
            "name" => 'XX99 Mark II',
            "ref" => 'HP-XX99-2',
            "category" => 'casques',
            "price" => 2999,
            "stock" => 18,
            "status" => 'en stock',
        ],
        "elt3" => [ 
            "name" => 'XX99 Mark II',
            "ref" => 'HP-XX99-2',
            "category" => 'casques',
            "price" => 2999,
            "stock" => 18,
            "status" => 'en stock',
        ],
    ]
@endphp

@extends('layout.simple_layout')

@section('content')
<div class='bg-(--broken_white) flex flex-col gap-3 p-5'>
    <h2 class='uppercase font-semibold text-2xl'>Produits</h2>
    <p class='text-(--mid_gray) text-base sm:pr-5'>Gérez le catalogue d'appareils audio de la boutique</p>
    <a href=""  class='flex justify-center items-center w-full h-10 text-(--white_color) bg-(--orange_principal) uppercase font-semibold hover:bg-(--orange_hover) rounded-lg'>+ Ajouter un appareil</a>
    <div class='flex gap-5'>
        <span>
            <input type="text" name="search_product" placeholder="Rechercher un produit" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 min-w-50 bg-(--white_color) placeholder:text-(--mid_gray)'>
        </span>
        <span>
            <select name="all_categories" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                <option value="" disabled selected>Toutes les catégories</option>
                <option value="" >Headphones</option>
                <option value="" >Speakers</option>
                <option value="" >Earphones</option>
            </select>
        </span>
        <span>
            <select name="all_status"  class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                <option value="" disabled selected>Tous les statuts</option>
                <option value="">En stock</option>
                <option value="">En rupture</option>
            </select>
        </span>
    </div>
    <div class='w-full overflow-hidden rounded-lg bg-(--white_color) border-1 border-gray-400'>
        <table class=' p-2 text-sm w-full border-collapse'>
            <thead>
                <tr class="text-left uppercase text-(--mid_gray) font-normal border border-gray-200 rounded-lg ">
                    <th class="pl-4 pb-2">produit</th>
                    <th class="pb-2">catégorie</th>
                    <th class="pb-2">prix</th>
                    <th class="pb-2">stock</th>
                    <th class="pb-2">statut</th>
                    <th class="pb-2"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class='border border-gray-100 rounded-lg'>
                        <td class=' p-2 flex items-center gap-2 my-2 ml-2'>
                            <span class='bg-(--mid_gray)/25 size-10 flex items-center justify-center rounded-lg'>
                                <iconify-icon icon="ri:headphone-line"></iconify-icon>
                            </span>
                            <span class='flex flex-col text-xs'>
                                <span class='font-medium'>{{ $product["name"] }}</span>
                                <span class='font-light'>RÉF. <span>{{ $product["ref"] }}</span></span>
                            </span>
                        </td>
                        <td class='capitalize'>{{ $product["category"] }}</td>
                        <td>$<span>{{ $product["price"] }}</span></td>
                        <td>{{ $product["stock"] }}</td>
                        <td>
                            <div class='flex items-center justify-center uppercase bg-red-200 text-red-400 max-w-25 rounded-lg'>
                                <iconify-icon icon="icon-park-outline:dot"></iconify-icon>
                                <span>{{ $product["status"] }}</span>
                            </div>
                        </td>
                        <td class='text-(--mid_gray)'>
                            <iconify-icon icon="streamline-ultimate:pen-write" class=''></iconify-icon>
                        </td>
                        <td class='text-(--mid_gray)'>
                            <iconify-icon icon="tabler:trash" class=''></iconify-icon>
                        </td>
                    </tr>
                @empty
                    <tr>
                        Il n'y aucun element dans ce tableau
                    </tr>
                @endforelse
                
            </tbody>
        </table>
    </div>
</div>

@endsection