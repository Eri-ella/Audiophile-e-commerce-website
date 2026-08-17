@php $firstProduct = $commande->products->first(); @endphp
@extends('layout.simple_layout')

@section('content')
    <div class='flex flex-col px-7 py-10 rounded-lg bg-(--white_color) text-(--hard_black) max-w-110 h-120 z-20 gap-5'>
        <div class='bg-(--orange_principal) text-(--white_color) max-w-13 h-13 flex items-center justify-center rounded-full'>
            <iconify-icon icon="fluent-mdl2:accept-medium" class='md:hidden text-3xl mt-2'></iconify-icon>
        </div>
        <h4 class='font-medium uppercase text-2xl'>thank you <br>for your order</h4>
        <p class='text-(--mid_gray) mb-5'>You will receive an email confirmation shortly.</p>

        <div class='grid grid-cols-5 h-25'>
            @if($firstProduct)
                <div class='col-span-3 bg-(--soft_gray) rounded-tl-lg rounded-bl-lg flex justify-between items-center p-3 gap-2 font-medium'>
                    <img src="{{ asset($firstProduct->image_1) }}" alt="product" class='max-h-10'>
                    <div>
                        <p>{{ $firstProduct->name }}</p>
                        <p class='text-(--mid_gray)'>$ {{ number_format($firstProduct->price, 0, ',', ',') }}</p>
                    </div>
                    <span class='text-(--mid_gray)'>x<span>{{ $firstProduct->pivot->quantity }}</span></span>
                </div>
            @else
                <div class='col-span-3 bg-(--soft_gray) rounded-tl-lg rounded-bl-lg flex items-center p-3 gap-2 font-medium'>
                    <p class='text-(--mid_gray) text-sm'>No product details available</p>
                </div>
            @endif

            <div class='col-span-2 bg-(--black_color) text-(--white_color) rounded-tr-lg rounded-br-lg p-3'>
                <p class='text-(--mid_gray) uppercase font-medium'>Grand Total</p>
                <span class='font-bold text-xl'>$ <span>{{ $commande->amount }}</span></span>
            </div>
        </div>

        <a href="{{ route('acceuil') }}" class='flex justify-center items-center w-full h-13 text-(--white_color) bg-(--orange_principal) uppercase font-semibold hover:bg-(--orange_hover)'>back to home</a>
    </div>
@endsection