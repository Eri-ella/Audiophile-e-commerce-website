@extends('layout.client_layout')

@section('acceuil-content')

@php
    $products = [
        'zx9-speaker' => [
            'cartKey' => 'speaker1',
            'isNew'   => true,
            'name'    => 'ZX9',
            'image'   => 'page_autre/speaker1.jpg',
            'description' => "Upgrade your sound system with the all new ZX9 active speaker. It's a bookshelf speaker system that offers truly wireless connectivity -- creating new possibilities for more pleasing and practical audio setups.",
            'price'   => 4500,
            'features' => [
                "Connect via Bluetooth or nearly any wired source. This speaker features optical, digital coaxial, USB Type-B, stereo RCA, and stereo XLR inputs, allowing you to have up to five wired source devices connected for easy switching. Improved bluetooth technology offers near lossless audio quality at up to 328ft (100m).",
                "Discover clear, more natural sounding highs than the competition with ZX9's signature planar diaphragm tweeter. Equally important is its powerful room-shaking bass courtesy of a 6.5\" aluminum alloy bass unit. You'll be able to enjoy equal sound quality whether in a large room or small den. Furthermore, you will experience new sensations from old songs since it can respond to even the subtle waveforms.",
            ],
            'includes' => [
                [2, 'Speaker unit'], [2, 'Speaker cloth panel'], [1, 'User manual'], [1, '3.5mm 10m audio cable'], [1, '10m optical cable'],
            ],
            'gallery' => ['page_autre/speaker1-1.jpg', 'page_autre/speaker1-2.jpg', 'page_autre/speaker1-3.jpg'],
            'others' => [
                ['name' => 'ZX7 Speaker', 'image' => 'page_autre/speaker2.jpg', 'link' => route('speaker2')],
                ['name' => 'XX99 Mark I', 'image' => 'page_acceuil/audiophile2.jpg', 'link' => route('headphile2')],
                ['name' => 'XX59', 'image' => 'page_autre/audiophile3.jpg', 'link' => route('headphile3')],
            ],
        ],
        'zx7-speaker' => [
            'cartKey' => 'speaker2',
            'isNew'   => false,
            'name'    => 'ZX7',
            'image'   => 'page_autre/speaker2.jpg',
            'description' => "Stream high quality sound wirelessly with minimal to no loss. The ZX7 speaker uses high-end audiophile components that represents the top of the line powered speakers for home or studio use.",
            'price'   => 3500,
            'features' => [
                "Reap the advantages of a flat diaphragm tweeter cone. This provides a fast response rate and excellent high frequencies that lower tiered bookshelf speakers cannot provide. The woofers are made from aluminum that produces a unique and clear sound. XLR inputs allow you to connect to a mixer for more advanced usage.",
                "The ZX7 speaker is the perfect blend of stylish design and high performance. It houses an encased MDF wooden enclosure which minimises acoustic resonance. Dual connectivity allows pairing through bluetooth or traditional optical and RCA input. Switch input sources and control volume at your finger tips with the included wireless remote. This versatile speaker is equipped to deliver an authentic listening experience.",
            ],
            'includes' => [
                [2, 'Speaker unit'], [2, 'Speaker cloth panel'], [1, 'User manual'], [1, '3.5mm 10m audio cable'], [1, '7.5m optical cable'],
            ],
            'gallery' => ['page_autre/speaker2-1.jpg', 'page_autre/speaker2-2.jpg', 'page_autre/speaker2-3.jpg'],
            'others' => [
                ['name' => 'ZX9 Speaker', 'image' => 'page_autre/speaker1.jpg', 'link' => route('speaker1')],
                ['name' => 'XX99 Mark I', 'image' => 'page_acceuil/audiophile2.jpg', 'link' => route('headphile2')],
                ['name' => 'XX59', 'image' => 'page_autre/audiophile3.jpg', 'link' => route('headphile3')],
            ],
        ],
    ];

    $slug    = $slug ?? 'zx9-speaker';
    $product = $products[$slug] ?? abort(404);
@endphp

<div class="mx-auto w-full max-w-[1113px] px-6 sm:px-12 lg:px-8">

    <a href="{{ url()->previous() }}" class="mt-8 mb-6 inline-block text-sm text-[#808080] hover:text-[#D87D4A] md:mt-20 md:mb-14">
        Go Back
    </a>

    <section class="flex flex-col items-center gap-10 md:flex-row md:items-center md:gap-[8.65%]">
        <div class="w-full max-w-[540px] flex-shrink-0 overflow-hidden rounded-xl bg-[#F1F1F1] md:w-[540px]">
            <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }} Speaker" class="h-full w-full object-cover">
        </div>

        <div class="flex w-full flex-col items-center text-center md:w-[445px] md:items-start md:text-left">
            @if ($product['isNew'])
                <p class="mb-4 text-sm font-medium uppercase tracking-[0.5em] text-[#D87D4A]">New Product</p>
            @endif

            <h1 class="mb-6 text-3xl font-bold uppercase leading-tight text-[#101010] md:mb-8 md:text-4xl">
                {{ $product['name'] }} <span class="block">Speakers</span>
            </h1>

            <p class="mb-8 leading-[1.8] text-[#808080]">{{ $product['description'] }}</p>

            <p class="mb-8 text-lg font-bold tracking-[0.1em] text-[#101010] md:mb-12">$ {{ $product['price'] }}</p>

            <div class="flex items-center gap-4">
                <form action="{{ route('cart.add', $product['cartKey']) }}" method="POST" class="flex items-center gap-4">
                    @csrf
                    <input type="hidden" name="name"  value="{{ $product['name'] }} Speaker">
                    <input type="hidden" name="price" value="{{ $product['price'] }}">
                    <input type="hidden" name="image" value="{{ $product['image'] }}">

                    <div class="flex h-12 items-center bg-[#F1F1F1]">
                        <button type="button" onclick="updateQty(-1)" class="h-full w-10 text-sm font-bold text-[#808080] transition-colors hover:text-[#D87D4A]">-</button>
                        <input type="number" name="qty" id="qty-select" value="1" min="1" readonly
                               class="w-10 border-none bg-transparent px-1 text-center text-sm font-bold text-[#101010] focus:outline-none [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
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
            @foreach ($product['features'] as $para)
                <p class="{{ $loop->last ? '' : 'mb-6' }} leading-[1.8] text-[#808080]">{{ $para }}</p>
            @endforeach
        </div>

        <div class="md:w-[350px]">
            <h2 class="mb-6 text-2xl font-bold uppercase text-[#101010] md:mb-8 md:text-3xl">In the box</h2>
            <ul class="space-y-2">
                @foreach ($product['includes'] as $item)
                    <li class="flex gap-6">
                        <span class="font-bold text-[#D87D4A]">{{ $item[0] }}x</span>
                        <span class="text-[#808080]">{{ $item[1] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="mt-24 grid grid-cols-1 gap-8 md:mt-40 md:grid-cols-[38%_58.5%] md:grid-rows-2 md:gap-x-8 md:gap-y-8">
        @foreach ($product['gallery'] as $i => $img)
            <div class="overflow-hidden rounded-xl {{ $i === 0 ? 'md:col-start-1 md:row-start-1' : ($i === 1 ? 'md:col-start-1 md:row-start-2' : 'md:col-start-2 md:row-span-2 md:row-start-1') }}">
                <img src="{{ asset($img) }}" alt="" class="h-full w-full object-cover">
            </div>
        @endforeach
    </section>

    <section class="mt-24 mb-24 md:mt-32 md:mb-32">
        <h2 class="mb-14 text-center text-2xl font-bold uppercase text-[#101010] md:text-3xl">You may also like</h2>

        <div class="flex flex-col items-center gap-14 md:flex-row md:items-start md:justify-center md:gap-8">
            @foreach ($product['others'] as $o)
                <div class="flex w-full max-w-[350px] flex-col items-center text-center">
                    <div class="mb-8 w-full overflow-hidden rounded-xl bg-[#F1F1F1]">
                        <img src="{{ asset($o['image']) }}" alt="{{ $o['name'] }}" class="h-full w-full object-cover">
                    </div>
                    <h3 class="mb-8 text-xl font-bold uppercase text-[#101010]">{{ $o['name'] }}</h3>
                    <a href="{{ $o['link'] }}"
                       class="inline-block bg-[#D87D4A] px-8 py-3.5 text-sm font-bold uppercase tracking-[0.1em] text-white transition-colors duration-300 hover:bg-[#FBAF85]">
                        See Product
                    </a>
                </div>
            @endforeach
        </div>
    </section>

</div>

<div class='hidden menu justify-center md:hidden'>@include('layout.product_layout')</div>
<div class='justify-center'>@include('layout.description_layout')</div>

@endsection

<script>
    function updateQty(delta) {
        const el = document.getElementById('qty-select');
        let val = parseInt(el.value) + delta;
        if (delta < 0 && val < 1) val = 1;
        el.value = val;
    }
</script>