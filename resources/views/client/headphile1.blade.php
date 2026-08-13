@extends('layout.client_layout')

@section('acceuil-content')
<div class="mx-auto w-full max-w-[1113px] px-6 sm:px-12 lg:px-8">

    <a href="{{ url()->previous() }}" class="mt-8 mb-6 inline-block text-sm text-[#808080] hover:text-[#D87D4A] md:mt-20 md:mb-14">
        Go Back
    </a>

    <section class="flex flex-col items-center gap-10 md:flex-row md:items-center md:gap-[8.65%]">
        <div class="w-full max-w-[540px] flex-shrink-0 rounded-xl overflow-hidden bg-[#F1F1F1] md:w-[540px]">
            <img src="{{ asset('page_autre/audiophile_black.jpg') }}"
                 alt="XX99 Mark II Headphones"
                 class="h-full w-full object-cover">
        </div>

        <div class="flex w-full flex-col items-center text-center md:w-[445px] md:items-start md:text-left">
            <p class="mb-4 text-sm font-medium uppercase tracking-[0.5em] text-[#D87D4A]">New Product</p>

            <h1 class="mb-6 text-3xl font-bold uppercase leading-tight text-[#101010] md:mb-8 md:text-4xl">
                XX99 Mark II <span class="block">Headphones</span>
            </h1>

            <p class="mb-8 leading-[1.8] text-[#808080]">
                The new XX99 Mark II headphones is the pinnacle of pristine audio. It redefines your premium headphone experience by reproducing the balanced depth and precision of studio-quality sound.
            </p>

            <p class="mb-8 text-lg font-bold tracking-[0.1em] text-[#101010] md:mb-12">
                $ 2999
            </p>

            <div class="flex items-center gap-4">
                <form action="{{ route('cart.add', 'headphile1') }}" method="POST" class="flex items-center gap-4">
                    @csrf
                    <input type="hidden" name="name" value="XX99 Mark II Headphones">
                    <input type="hidden" name="price" value="2999">
                    <input type="hidden" name="image" value="page_autre/audiophile_black.jpg">

                    <div class="flex h-12 items-center bg-[#F1F1F1]">
                        <button type="button" onclick="updateQty(-1)" class="h-full w-10 text-sm font-bold text-[#808080] transition-colors hover:text-[#D87D4A]">-</button>
                        <input type="number" name="qty" id="qty-select" value="1" min="1" readonly class="w-6 border-none bg-transparent text-center text-sm font-bold text-[#101010] focus:outline-none">
                        <button type="button" onclick="updateQty(+1)" class="h-full w-10 text-sm font-bold text-[#808080] transition-colors hover:text-[#D87D4A]">+</button>
                    </div>

                    <button type="submit" class="inline-block bg-[#D87D4A] px-8 py-3.5 text-sm font-bold uppercase tracking-[0.1em] text-white transition-colors duration-300 hover:bg-[#FBAF85]">
                        Add to cart
                    </button>
                </form>
            </div>
        </div>
    </section>

    <section class="mt-24 flex flex-col gap-16 md:mt-40 md:flex-row md:items-start md:justify-between md:gap-[125px]">
        <div class="md:w-[635px]">
            <h2 class="mb-6 text-2xl font-bold uppercase text-[#101010] md:text-3xl">Features</h2>
            <p class="mb-6 leading-[1.8] text-[#808080]">
                Featuring a genuine leather head strap and premium earcups, these headphones deliver superior comfort for those who like to enjoy endless listening. It includes intuitive controls designed for any situation. Whether you're taking a business call or just in your own personal space, the auto on/off and pause features ensure that you'll never miss a beat.
            </p>
            <p class="leading-[1.8] text-[#808080]">
                The advanced Active Noise Cancellation with built-in equalizer allow you to experience your audio world on your terms. It lets you enjoy your audio in peace, but quickly interact with your surroundings when you need to. Combined with Bluetooth 5.0 compliant connectivity and 17 hour battery life, the XX99 Mark II headphones gives you superior sound, cutting-edge technology, and a modern design aesthetic.
            </p>
        </div>

        <div class="md:w-[350px]">
            <h2 class="mb-6 text-2xl font-bold uppercase text-[#101010] md:mb-8 md:text-3xl">In the box</h2>
            <ul class="space-y-2">
                <li class="flex gap-6"><span class="font-bold text-[#D87D4A]">1x</span><span class="text-[#808080]">Headphone unit</span></li>
                <li class="flex gap-6"><span class="font-bold text-[#D87D4A]">2x</span><span class="text-[#808080]">Replacement earcups</span></li>
                <li class="flex gap-6"><span class="font-bold text-[#D87D4A]">1x</span><span class="text-[#808080]">User manual</span></li>
                <li class="flex gap-6"><span class="font-bold text-[#D87D4A]">1x</span><span class="text-[#808080]">3.5mm 5m audio cable</span></li>
                <li class="flex gap-6"><span class="font-bold text-[#D87D4A]">1x</span><span class="text-[#808080]">Travel bag</span></li>
            </ul>
        </div>
    </section>

    <section class="mt-24 grid grid-cols-1 gap-8 md:mt-40 md:grid-cols-[38%_58.5%] md:grid-rows-2 md:gap-x-8 md:gap-y-8">
        <div class="overflow-hidden rounded-xl md:col-start-1 md:row-start-1">
            <img src="{{ asset('page_autre/h1.jpg') }}" alt="" class="h-full w-full object-cover">
        </div>
        <div class="overflow-hidden rounded-xl md:col-start-1 md:row-start-2">
            <img src="{{ asset('page_autre/h2.jpg') }}" alt="" class="h-full w-full object-cover">
        </div>
        <div class="overflow-hidden rounded-xl md:col-start-2 md:row-span-2 md:row-start-1">
            <img src="{{ asset('page_autre/h3.jpg') }}" alt="" class="h-full w-full object-cover">
        </div>
    </section>

    <section class="mt-24 mb-24 md:mt-32 md:mb-32">
        <h2 class="mb-14 text-center text-2xl font-bold uppercase text-[#101010] md:text-3xl">You may also like</h2>

        <div class="flex flex-col items-center gap-14 md:flex-row md:items-start md:justify-center md:gap-8">
            <div class="flex w-full max-w-[350px] flex-col items-center text-center">
                <div class="mb-8 w-full overflow-hidden rounded-xl bg-[#F1F1F1]">
                    <img src="{{ asset('page_acceuil/audiophile2.jpg') }}" alt="XX99 Mark I" class="h-full w-full object-cover">
                </div>
                <h3 class="mb-8 text-xl font-bold uppercase text-[#101010]">XX99 Mark I</h3>
                <a href="{{ route('headphile2') }}" class="inline-block bg-[#D87D4A] px-8 py-3.5 text-sm font-bold uppercase tracking-[0.1em] text-white transition-colors duration-300 hover:bg-[#FBAF85]">
                    See Product
                </a>
            </div>

            <div class="flex w-full max-w-[350px] flex-col items-center text-center">
                <div class="mb-8 w-full overflow-hidden rounded-xl bg-[#F1F1F1]">
                    <img src="{{ asset('page_autre/audiophile3.jpg') }}" alt="XX59" class="h-full w-full object-cover">
                </div>
                <h3 class="mb-8 text-xl font-bold uppercase text-[#101010]">XX59</h3>
                <a href="{{ route('headphile3') }}" class="inline-block bg-[#D87D4A] px-8 py-3.5 text-sm font-bold uppercase tracking-[0.1em] text-white transition-colors duration-300 hover:bg-[#FBAF85]">
                    See Product
                </a>
            </div>

            <div class="flex w-full max-w-[350px] flex-col items-center text-center">
                <div class="mb-8 w-full overflow-hidden rounded-xl bg-[#F1F1F1]">
                    <img src="{{ asset('page_autre/speaker1.jpg') }}" alt="ZX9 Speaker" class="h-full w-full object-cover">
                </div>
                <h3 class="mb-8 text-xl font-bold uppercase text-[#101010]">ZX9 Speaker</h3>
                <a href="{{ route('speaker1') }}" class="inline-block bg-[#D87D4A] px-8 py-3.5 text-sm font-bold uppercase tracking-[0.1em] text-white transition-colors duration-300 hover:bg-[#FBAF85]">
                    See Product
                </a>
            </div>
        </div>
    </section>

</div>
<div class='hidden menu justify-center md:hidden'>@include('layout.product_layout')</div>
<div class='justify-center'>@include('layout.description_layout')</div>

<script>
    function updateQty(delta) {
        const el = document.getElementById('qty-select');
        let val = parseInt(el.value) + delta;
        if (val < 1) val = 1;
        el.value = val;
    }
</script>
@endsection