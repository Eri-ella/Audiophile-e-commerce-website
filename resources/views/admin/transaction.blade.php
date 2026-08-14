@php
    $products = [
        "elt1" => [ 
            "numero" => 'AP-10482',
            "mail" => 'client@mail.com',
            "date" => '08 août 2026',
            "price" => 2999,
            "paiement" => 'e-money',
            "status" => 'en attente',
        ],
        "elt2" => [ 
            "numero" => 'AP-10482',
            "mail" => 'client@mail.com',
            "date" => '08 août 2026',
            "price" => 2999,
            "paiement" => 'e-money',
            "status" => 'en attente',
        ],
        "elt3" => [ 
            "numero" => 'AP-10482',
            "mail" => 'client@mail.com',
            "date" => '08 août 2026',
            "price" => 2999,
            "paiement" => 'e-money',
            "status" => 'en attente',
        ],
    ]
@endphp

@extends('layout.simple_layout')

@section('content')
<div class='bg-(--broken_white) flex flex-col gap-3 p-5'>
    <div class='flex justify-between'>
        <span>
            <h2 class='uppercase font-semibold text-2xl'>transactions</h2>
            <p class='text-(--mid_gray) text-base sm:pr-5'>Historique des paiements de tous les clients</p>
        </span>
        <span>
            <a href=""  class='flex justify-center items-center px-3 py-2 border-1 border-gray-200 uppercase font-semibold hover:bg-gray-100 rounded-lg'>Exporter en csv</a>
        </span>
    </div>
    <div class='flex gap-5'>
        <span>
            <input type="text" name="search_product" placeholder="Rechercher une commande" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 min-w-60 bg-(--white_color) placeholder:text-(--mid_gray)'>
        </span>
        <span>
            <select name="all_categories" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                <option value="" disabled selected>Tous les statuts</option>
                <option value="" >Payée</option>
                <option value="" >En attente</option>
            </select>
        </span>
        <span>
            <select name="all_status"  class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                <option value="" disabled selected>Tous les moyens de paiement</option>
                <option value="">e-Money</option>
                <option value="">Cash on delivery</option>
            </select>
        </span>
    </div>
    <div class='w-full overflow-hidden rounded-lg bg-(--white_color) border-1 border-gray-100'>
        <table class=' p-2 text-sm w-full'>
            <thead>
                <tr class="text-left uppercase text-(--mid_gray) font-normal border border-gray-400 rounded-lg ">
                    <th>n° commande</th>
                    <th>client</th>
                    <th>date</th>
                    <th>articles</th>
                    <th>montant</th>
                    <th>paiement</th>
                    <th>statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class='border border-gray-400 rounded-lg'>
                        <td>
                            <span class='font-medium'>#<span>{{ $product["numero"] }}</span>
                        </td>
                        <td class='capitalize'>{{ $product["mail"] }}</td>
                        <td>{{ $product["date"] }}</td>
                        <td>$<span>{{ $product["price"] }}</span></td>
                        <td class='flex items-center justify-center uppercase bg-red-200 text-red-400 max-w-25 rounded-lg'><iconify-icon icon="icon-park-outline:dot"></iconify-icon>{{ $product["paiement"] }}</td>
                        <td class='flex items-center justify-center uppercase bg-orange-200 text-orange-400 max-w-25 rounded-lg'><iconify-icon icon="icon-park-outline:dot"></iconify-icon>{{ $product["status"] }}</td>
                        <td class='text-(--mid_gray)'>
                            <iconify-icon icon="iconamoon:eye-thin" class=''></iconify-icon>
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