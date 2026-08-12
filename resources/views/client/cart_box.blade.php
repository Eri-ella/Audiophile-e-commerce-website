@extends('layout.simple_layout')

@section('content')
    <div class='flex flex-col px-7 py-10 rounded-lg bg-(--white_color) text-(--hard_black) max-w-90 h-100 z-20'>
        <div class='flex justify-between'>
            <h4 class='font-medium text-xl uppercase'>cart (<span>0</span>)</h4>
            <a href="#" class='text-(--mid_gray) underline hover:text-(--orange_principal)'>Remove all</a>
        </div>
        <div class='flex flex-col gap-7'>
            <div class='w-50 h-[1px] bg-(--mid_gray) my-5'></div>
            <h4 class='font-normal text-2xl'>Your Cart is empty.</h4>
            <p class='text-(--mid_gray)'>Continue shopping on the audiophile website <a href="#" class='text-(--mid_gray) hover:underline text-(--orange_principal)'>homepage.</a></p>
        </div>
        <div class='flex justify-between my-5'>
            <span class='text-(--mid_gray) uppercase'>total</span>
            <span class='text-medium text-xl tracking-[.25rem]'>$<span>0</span></span>
        </div>
        <a href="#" class='flex justify-center items-center w-full h-13 text-(--white_color) bg-(--orange_principal) uppercase font-semibold'>checkout</a>
    </div>
@endsection