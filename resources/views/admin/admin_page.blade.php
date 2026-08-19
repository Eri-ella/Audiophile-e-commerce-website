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
                <div class='block' id='dashboard-page'>
                    @include('admin.tableau_bord')
                </div>
                <div class='hidden' id='product-page'>
                    @include('admin.product')
                </div>
                <div class='hidden' id='category-page'>
                    @include('admin.category')
                </div>
                <div class='hidden' id='add-product-page'>
                    @include('admin.add_product')
                </div>
                <div class='hidden' id='transaction-page'>
                    @include('admin.transaction')
                </div>
                <div class='hidden' id='user-page'>
                    @include('admin.user')
                </div>
                <div class='hidden' id='setting-page'>
                    @include('admin.setting')
                </div>
            </div>
        </div>
    </div>
@endsection