@extends('layout.client_layout')

@section('acceuil-content')

<div class="mx-auto w-full max-w-[1113px] px-6 sm:px-12 lg:px-8">

    <a href="{{ url()->previous() }}" class="mt-8 mb-6 inline-block text-sm text-[#808080] hover:text-[#D87D4A] md:mt-20 md:mb-14">
        Go Back
    </a>

    <section class="flex flex-col items-center gap-10 md:flex-row md:items-center md:gap-[8.65%]">
        <div class="w-full max-w-[540px] flex-shrink-0 overflow-hidden rounded-xl bg-[#F1F1F1] md:w-[540px]">
            <img src="{{ asset($product->image_description) }}" alt="{{ $product->name }} Headphones" class="h-full w-full object-cover">
        </div>

        <div class="flex w-full flex-col items-center text-center md:w-[445px] md:items-start md:text-left">
            @if ($product->status === 'en_ligne' && $product->stock > 0)
                <p class="mb-4 text-sm font-medium uppercase tracking-[0.5em] text-[#D87D4A]">New Product</p>
            @endif

            <h1 class="mb-6 text-3xl font-bold uppercase leading-tight text-[#101010] md:mb-8 md:text-4xl">
                {{ $product->name }} <span class="block">Headphones</span>
            </h1>

            <p class="mb-8 leading-[1.8] text-[#808080]">{{ $product->description }}</p>

            <p class="mb-8 text-lg font-bold tracking-[0.1em] text-[#101010] md:mb-12">$ {{ number_format($product->price, 0, ',', ',') }}</p>

            <div class="flex items-center gap-4">
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex items-center gap-4">
                    @csrf
                    <input type="hidden" name="name"  value="{{ $product->name }} Headphones">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="image" value="{{ $product->image_description }}">

                    <div class="flex h-12 items-center bg-[#F1F1F1]">
                        <button type="button" onclick="updateQty(-1)" class="h-full w-10 text-sm font-bold text-[#808080] transition-colors hover:text-[#D87D4A]">-</button>
                        <input type="number" name="qty" id="qty-select" value="1" min="1" readonly
                            class="w-10 border-none bg-transparent text-center text-sm font-bold text-[#101010] focus:outline-none
                                    [&::-webkit-inner-spin-button]:appearance-none
                                    [&::-webkit-outer-spin-button]:appearance-none">
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
            @php
                $features = is_array($product->features)
                    ? $product->features
                    : preg_split('/\R{2,}/', trim($product->features));
            @endphp
            @foreach ($features as $para)
                <p class="{{ $loop->last ? '' : 'mb-6' }} leading-[1.8] text-[#808080]">{{ $para }}</p>
            @endforeach
        </div>

        <div class="md:w-[350px]">
            <h2 class="mb-6 text-2xl font-bold uppercase text-[#101010] md:mb-8 md:text-3xl">In the box</h2>
            <ul class="space-y-2">
                @foreach ($product->contents as $content)
                    <li class="flex gap-6">
                        <span class="font-bold text-[#D87D4A]">{{ $content->pivot->value }}x</span>
                        <span class="text-[#808080]">{{ $content->name }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="mt-24 grid grid-cols-1 gap-8 md:mt-40 md:grid-cols-[38%_58.5%] md:grid-rows-2 md:gap-x-8 md:gap-y-8">
        @php
            $gallery = array_values(array_filter([$product->image_1, $product->image_2, $product->image_3]));
        @endphp
        @foreach ($gallery as $i => $img)
            <div class="overflow-hidden rounded-xl {{ $i === 0 ? 'md:col-start-1 md:row-start-1' : ($i === 1 ? 'md:col-start-1 md:row-start-2' : 'md:col-start-2 md:row-span-2 md:row-start-1') }}">
                <img src="{{ asset($img) }}" alt="" class="h-full w-full object-cover">
            </div>
        @endforeach
    </section>

    <section class="mt-24 mb-24 md:mt-32 md:mb-32">
        <h2 class="mb-14 text-center text-2xl font-bold uppercase text-[#101010] md:text-3xl">You may also like</h2>

        <div class="flex flex-col items-center gap-14 md:flex-row md:items-start md:justify-center md:gap-8">
            @foreach ($others as $o)
                <div class="flex w-full max-w-[350px] flex-col items-center text-center">
                    <div class="mb-8 w-full overflow-hidden rounded-xl bg-[#F1F1F1]">
                        <img src="{{ asset($o->image_description) }}" alt="{{ $o->name }}" class="h-full w-full object-cover">
                    </div>
                    <h3 class="mb-8 text-xl font-bold uppercase text-[#101010]">{{ $o->name }}</h3>
                    <a href="{{ url('/product/' . $o->id) }}"
                    class="inline-block bg-[#D87D4A] px-8 py-3.5 text-sm font-bold uppercase tracking-[0.1em] text-white transition-colors duration-300 hover:bg-[#FBAF85]">
                        See Product
                    </a>
                </div>
            @endforeach
        </div>
    </section>

</div>

@endsection

<script>
    function updateQty(delta) {
        const el = document.getElementById('qty-select');
        let val = parseInt(el.value) + delta;
        if (delta < 0 && val < 1) val = 1;
        el.value = val;
    }
</script>