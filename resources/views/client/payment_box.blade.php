@extends('layout.simple_layout')

@section('content')
    <div class='flex flex-col px-7 py-10 rounded-lg bg-(--white_color) text-(--hard_black) max-w-90 h-100 z-20'>
        <div>
            <iconify-icon icon="fluent-mdl2:accept-medium" class='md:hidden text-3xl mt-2 menu-clicker'></iconify-icon>
        </div>
        <h4>thank you <br>for your order</h4>
        <p>You will receive an email confirmation shortly.</p>
        <div>
            <div>
                <img src="" alt="">
                <div>
                    <p>product name</p>
                    <p>product price</p>
                </div>
                <span>x<span>1</span></span>
            </div>
            <div>
                <p>Grand Total</p>
                <span>$ <span>599</span></span>
            </div>
        </div>
        <a href="">back to home</a>
    </div>
@endsection