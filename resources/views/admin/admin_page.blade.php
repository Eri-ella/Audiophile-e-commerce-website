@extends('layout.simple_layout')

@section('content')

@vite(['public/js/admin.js'])

<div class='relative flex w-full min-h-screen overflow-hidden'>
    
    <div class='absolute top-0 left-0 h-full bg-white transition-transform duration-500 ease-in-out max-[800px]:-translate-x-full'>
        @include('admin.lateral_bar')
    </div>

    <div class='flex flex-col w-full min-h-screen transition-all duration-500 ease-in-out pl-50 max-[800px]:pl-0 bg-(--broken_white)'>
        <div class='shadow-sm z-10'>
            @include('admin.nav_bar')
        </div>
        <div class='transition-all duration-500 ease-in-out'>
            @if (str_contains($section, 'product'))
                @include('admin.product')
            @elseif (str_contains($section, 'category'))
                @include('admin.category')
            @elseif (str_contains($section, 'add-product'))
                @include('admin.add_product')
            @elseif (str_contains($section, 'transaction'))
                @include('admin.transaction')
            @elseif (str_contains($section, 'user'))
                @include('admin.user')
            @elseif (str_contains($section, 'setting'))
                @include('admin.setting')
            @else
                @include('admin.tableau_bord')
            @endif
        </div>
        
    </div>
</div>
@endsection