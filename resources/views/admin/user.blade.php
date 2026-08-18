@php
    $products = [
        "elt1" => [ 
            "initial" => "MI",
            "name" => 'midoriya izuku',
            "email" => 'izuku@mha/com',
            "telephone" => '+2290123252624',
            "number" => 18,
            "amount" => 2999,
            "date" => '23 - 03 - 26',
        ],
    ]
@endphp

@extends('layout.simple_layout')

@section('content')
<div class='bg-(--broken_white) flex flex-col gap-3 p-5'>
    <h2 class='uppercase font-semibold text-2xl'>utilisateurs</h2>
    <p class='text-(--mid_gray) text-base sm:pr-5'>Clients inscrits sur la boutique</p>
    <div class='flex gap-5'>
        <span>
            <input type="text" name="search_product" placeholder="Rechercher un produit" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 min-w-50 bg-(--white_color) placeholder:text-(--mid_gray)'>
        </span>
    </div>
    <div class='w-full overflow-hidden rounded-lg bg-(--white_color) border-1 border-gray-400'>
        <table class=' p-2 text-sm w-full border-collapse'>
            <thead>
                <tr class="text-left uppercase text-(--mid_gray) font-normal border border-gray-200 rounded-lg ">
                    <th class="pl-4 pb-2">client</th>
                    <th class="pb-2">e-mail</th>
                    <th class="pb-2">telephone</th>
                    <th class="pb-2">commandes</th>
                    <th class="pb-2">total dépensé</th>
                    <th class="pb-2">dernière commande</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class='border border-gray-200 rounded-lg'>
                        <td class=' p-2 flex items-center gap-2 my-2 ml-2'>
                            <span class='bg-(--black_color) text-(--white_color) font-medium size-10 flex items-center justify-center rounded-full'>
                                {{ $product["initial"] }}
                            </span>
                            <span class='font-medium capitalize'>{{ $product["name"] }}</span>
                        </td>
                        <td class=''>{{ $product["email"] }}</td>
                        <td class=''>{{ $product["telephone"] }}</td>
                        <td>{{ $product["number"] }}</td>
                        <td>$<span>{{ $product["amount"] }}</span></td>
                        <td>{{ $product["date"] }} </td>
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