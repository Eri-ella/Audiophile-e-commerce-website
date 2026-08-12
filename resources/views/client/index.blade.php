@extends('layout.client_layout')

@section('acceuil-content')
    <section class='flex text-(--white_color) bg-(--black_color) font-semibold relative min-h-screen px-30 py-10'>
        <span class='bg-(--mid_gray) w-full min-[800px]:w-[80%] h-[1px] z-20 top-0 left-0 min-[800px]:left-35 absolute'></span>
        <div class='flex flex-col gap-10 w-full z-10 justify-center max-[750px]:items-center max-[750px]:text-center '>
            <p class='text-(--mid_gray) uppercase tracking-[.5em]'>new product</p>
            <h2 class='font-bold text-5xl uppercase max-w-90'>XX99 Mark II Headphones</h2>
            <p class='text-(--mid_gray) max-w-90'>Experience natural, lifelike audio and exceptional build quality made for the passionate music enthusiast.</p>
            <a href="" class='flex items-center justify-center bg-(--orange_principal) hover:bg-(--orange_hover) w-35 h-10 uppercase'>see product</a>
        </div>
        <div class='absolute right-0 top-0 bg-radial from-[#222222] from-0% to-(--black_color) to-45%'>
            <img src="{{ asset('page_acceuil/casque_acceuil.png') }}" alt="" class='min-w-150'>
        </div>
    </section>

    <div class='bg-(--hard_gray) w-full h-20'></div>

    <section class='justify-center py-20 px-5 sm:px-35'>@include('layout.product_layout')</section>

    <section class='flex flex-col justify-center py-20 max-[700px]:px-5 px-35 gap-15'>

        <div class='flex max-[700px]:flex-col text-(--white_color) bg-(--orange_principal) font-semibold relative overflow-hidden max-h-150 max-[700px]:max-h-250 justify-between items-center px-15 pt-30 gap-5 rounded-lg'>
            <svg height="1000" width="1000" xmlns="" class='absolute top-10 left-[-20%] max-[700px]:invisible'>
                <circle r="500" cx="500" cy="500" fill="none" stroke="#de9267" stroke-width="2" />
                <circle r="300" cx="500" cy="500" fill="none" stroke="#de9267" stroke-width="2" />
                <circle r="260" cx="500" cy="500" fill="none" stroke="#de9267" stroke-width="2" />
            </svg>
            <svg height="1000" width="1000" xmlns="" class='absolute top-[-30%] left-[-30%] invisible max-[700px]:visible'>
                <circle r="500" cx="500" cy="500" fill="none" stroke="#de9267" stroke-width="2" />
                <circle r="300" cx="500" cy="500" fill="none" stroke="#de9267" stroke-width="2" />
                <circle r="260" cx="500" cy="500" fill="none" stroke="#de9267" stroke-width="2" />
            </svg>
            <div class='z-10 top-35 right-110 '>
                <img src="{{ asset('page_acceuil/big_speakers.png') }}" alt="" class='max-[700px]:max-h-70 max-h-130 max-w-ful'>
            </div>
            <div class='z-10 flex flex-col gap-10 max-[700px]:my-15 max-[700px]:items-center max-[700px]:text-center'>
                <h2 class='font-bold text-5xl uppercase max-w-50'>ZX9 speaker</h2>
                <p class='text-(--white_color)/50 max-w-90'>Upgrade to premium speakers that are phenomenally built to deliver truly remarkable sound.</p>
                <a href="" class='flex items-center justify-center bg-(--hard_black) hover:bg-(--hard_gray) w-35 h-10 uppercase'>see product</a>
            </div>
        </div>

        <div class='flex justify-between items-center bg-radial-[at_25%_75%] from-(--soft_gray) to-[#b2b2b2] pl-20 min-h-70 rounded-lg relative overflow-hidden'>
            <div class='flex flex-col gap-10 z-10'>
                <h2 class='font-semibold text-3xl uppercase max-w-90'>ZX7 speaker</h2>
                <a href="" class='flex items-center justify-center bg-transparent border-1 border-(--hard_black) hover:bg-(--hard_black) hover:text-(--white_color) w-35 h-10 uppercase'>see product</a>
            </div>
            <div class='absolute right-0 h-full'>
                <img src="{{ asset('page_acceuil/ZX7_speaker.png') }}" alt="" class='h-full'>
            </div>
        </div>

        <div class='flex max-[700px]:flex-col w-full min-h-50 gap-5'>
            <div class='w-1/2 max-[700px]:w-full'>
                <img src="{{ asset('page_autre/earphones_2.jpg') }}" alt="earphones" class='w-full rounded-lg min-h-70'>
            </div>
            <div class='flex flex-col w-1/2 max-[700px]:w-full justify-center bg-(--soft_gray) rounded-lg gap-10 p-10 min-h-70'>
                <h2 class='font-semibold text-3xl uppercase max-w-90'>YX1 earphones</h2>
                <a href="" class='flex items-center justify-center bg-transparent border-1 border-(--hard_black) hover:bg-(--hard_black) hover:text-(--white_color) w-35 h-10 uppercase'>see product</a>
            </div>
        </div>
    </section>

    <section class='justify-center'>@include('layout.description_layout')</section>

@endsection