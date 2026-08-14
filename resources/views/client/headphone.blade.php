@extends('layout.client_layout')

@section('acceuil-content')

    @php
        $products = [
            'xx99-mark-ii' => [
                'cartKey' => 'headphile1',
                'isNew'   => true,
                'name'    => 'XX99 Mark II',
                'image'   => 'page_autre/audiophile_black.jpg',
                'description' => "The new XX99 Mark II headphones is the pinnacle of pristine audio. It redefines your premium headphone experience by reproducing the balanced depth and precision of studio-quality sound.",
                'price'   => 2999,
                'features' => [
                    "Featuring a genuine leather head strap and premium earcups, these headphones deliver superior comfort for those who like to enjoy endless listening. It includes intuitive controls designed for any situation. Whether you're taking a business call or just in your own personal space, the auto on/off and pause features ensure that you'll never miss a beat.",
                    "The advanced Active Noise Cancellation with built-in equalizer allow you to experience your audio world on your terms. It lets you enjoy your audio in peace, but quickly interact with your surroundings when you need to. Combined with Bluetooth 5.0 compliant connectivity and 17 hour battery life, the XX99 Mark II headphones gives you superior sound, cutting-edge technology, and a modern design aesthetic.",
                ],
                'includes' => [
                    [1, 'Headphone unit'], [2, 'Replacement earcups'], [1, 'User manual'], [1, '3.5mm 5m audio cable'], [1, 'Travel bag'],
                ],
                'gallery' => ['page_autre/h1.jpg', 'page_autre/h2.jpg', 'page_autre/h3.jpg'],
            ],
            'xx99-mark-i' => [
                'cartKey' => 'headphile2',
                'isNew'   => false,
                'name'    => 'XX99 Mark I',
                'image'   => 'page_acceuil/audiophile2.jpg',
                'description' => "As the gold standard for headphones, the classic XX99 Mark I offers detailed and accurate audio reproduction for audiophiles, mixing engineers, and music aficionados alike in studios and on the go.",
                'price'   => 1750,
                'features' => [
                    "As the headphones all others are measured against, the XX99 Mark I demonstrates over five decades of audio expertise, redefining the critical listening experience. This pair of closed-back headphones are made of industrial, aerospace-grade materials to emphasize durability at a relatively light weight of 11 oz.",
                    "From the handcrafted microfiber ear cushions to the robust metal headband with inner damping element, the components work together to deliver comfort and uncompromising sound. Its closed-back design delivers up to 27 dB of passive noise cancellation, reducing resonance by reflecting sound to a dedicated absorber. For connectivity, a specially tuned cable is includes with a balanced gold connector.",
                ],
                'includes' => [
                    [1, 'Headphone unit'], [2, 'Replacement earcups'], [1, 'User manual'], [1, '3.5mm 5m audio cable'],
                ],
                'gallery' => ['page_autre/audiophile2-1.jpg', 'page_autre/audiophile2-2.jpg', 'page_autre/audiophile2-3.jpg'],
            ],
            'xx59' => [
                'cartKey' => 'headphile3',
                'isNew'   => false,
                'name'    => 'XX59',
                'image'   => 'page_autre/audiophile3.jpg',
                'description' => "Enjoy your audio almost anywhere and customize it to your specific tastes with the XX59 headphones. The stylish yet durable versatile wireless headset is a brilliant companion at home or on the move.",
                'price'   => 899,
                'features' => [
                    "These headphones have been created from durable, high-quality materials tough enough to take anywhere. Its compact folding design fuses comfort and minimalist style making it perfect for travel. Flawless transmission is assured by the latest wireless technology engineered for audio synchronization with videos.",
                    "More than a simple pair of headphones, this headset features a pair of built-in microphones for clear, hands-free calling when paired with a compatible smartphone. Controlling music and calls is also intuitive thanks to easy-access touch buttons on the earcups. Regardless of how you use the XX59 headphones, you can do so all day thanks to an impressive 30-hour battery life that can be rapidly recharged via USB-C.",
                ],
                'includes' => [
                    [1, 'Headphone unit'], [2, 'Replacement earcups'], [1, 'User manual'], [1, '3.5mm 5m audio cable'],
                ],
                'gallery' => ['page_autre/audiophile3_1.jpg', 'page_autre/audiophile3-2.jpg', 'page_autre/audiophile3-1.jpg'],
            ],
        ];

        $slug    = $slug ?? 'xx99-mark-ii';
        $product = $products[$slug] ?? abort(404);

        // "You may also like" = les 2 autres casques + le speaker (calculé automatiquement)
        $others = array_values(array_filter([
            ['slug' => 'xx99-mark-ii', 'name' => 'XX99 Mark II', 'image' => 'page_autre/audiophile_black.jpg'],
            ['slug' => 'xx99-mark-i',  'name' => 'XX99 Mark I',  'image' => 'page_acceuil/audiophile2.jpg'],
            ['slug' => 'xx59',         'name' => 'XX59',         'image' => 'page_autre/audiophile3.jpg'],
        ], fn ($o) => $o['slug'] !== $slug));
        $others[] = ['slug' => null, 'route' => 'speaker1', 'name' => 'ZX9 Speaker', 'image' => 'page_autre/speaker1.jpg'];
    @endphp

<div class="mx-auto w-full max-w-[1113px] px-6 sm:px-12 lg:px-8">

        <a href="{{ url()->previous() }}" class="mt-8 mb-6 inline-block text-sm text-[#808080] hover:text-[#D87D4A] md:mt-20 md:mb-14">
            Go Back
        </a>

        <section class="flex flex-col items-center gap-10 md:flex-row md:items-center md:gap-[8.65%]">
            <div class="w-full max-w-[540px] flex-shrink-0 overflow-hidden rounded-xl bg-[#F1F1F1] md:w-[540px]">
                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }} Headphones" class="h-full w-full object-cover">
            </div>

            <div class="flex w-full flex-col items-center text-center md:w-[445px] md:items-start md:text-left">
                @if ($product['isNew'])
                    <p class="mb-4 text-sm font-medium uppercase tracking-[0.5em] text-[#D87D4A]">New Product</p>
                @endif

                <h1 class="mb-6 text-3xl font-bold uppercase leading-tight text-[#101010] md:mb-8 md:text-4xl">
                    {{ $product['name'] }} <span class="block">Headphones</span>
                </h1>

                <p class="mb-8 leading-[1.8] text-[#808080]">{{ $product['description'] }}</p>

                <p class="mb-8 text-lg font-bold tracking-[0.1em] text-[#101010] md:mb-12">$ {{ $product['price'] }}</p>

                <div class="flex items-center gap-4">
                    <form action="{{ route('cart.add', $product['cartKey']) }}" method="POST" class="flex items-center gap-4">
                        @csrf
                        <input type="hidden" name="name"  value="{{ $product['name'] }} Headphones">
                        <input type="hidden" name="price" value="{{ $product['price'] }}">
                        <input type="hidden" name="image" value="{{ $product['image'] }}">

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
                @foreach ($others as $o)
                    <div class="flex w-full max-w-[350px] flex-col items-center text-center">
                        <div class="mb-8 w-full overflow-hidden rounded-xl bg-[#F1F1F1]">
                            <img src="{{ asset($o['image']) }}" alt="{{ $o['name'] }}" class="h-full w-full object-cover">
                        </div>
                        <h3 class="mb-8 text-xl font-bold uppercase text-[#101010]">{{ $o['name'] }}</h3>
                        <a href="{{ isset($o['route']) ? route($o['route']) : url('/product/' . $o['slug']) }}"
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