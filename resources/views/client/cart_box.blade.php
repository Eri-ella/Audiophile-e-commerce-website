@php
    $cart = $cart ?? session('cart', []);
    $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['qty']);
    $count = collect($cart)->sum('qty');
@endphp

<div class="w-[380px] max-w-[90vw] rounded-lg bg-white p-7 shadow-[0_20px_50px_rgba(0,0,0,0.15)]">

    <div class="mb-6 flex items-center justify-between">
        <h4 class="text-xl font-medium uppercase text-[#101010]">Cart (<span>{{ $count }}</span>)</h4>

        @if (count($cart) > 0)
            <form action="{{ route('cart.removeAll') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm text-[#808080] underline hover:text-[#D87D4A]">Remove all</button>
            </form>
        @else
            <a href="#" class="text-sm text-[#808080] underline hover:text-[#D87D4A]">Remove all</a>
        @endif
    </div>

    <div class="mb-6 h-px w-full bg-black/10"></div>

    @forelse ($cart as $slug => $item)
        <div class="mb-6 flex items-center gap-4 last:mb-0">
            <img src="{{ asset($item['image']) }}"
                 alt="{{ $item['name'] }}"
                 class="h-16 w-16 flex-shrink-0 rounded-lg bg-[#F1F1F1] object-cover">

            <div class="flex flex-col">
                <h6 class="text-sm font-bold uppercase text-[#101010]">{{ $item['name'] }}</h6>
                <p class="text-sm font-bold text-[#808080]">$ {{ number_format($item['price'], 0, ',', ',') }}</p>
            </div>

            <form action="{{ route('cart.update', $slug) }}" method="POST" class="ml-auto flex h-8 items-center bg-[#F1F1F1]">
                @csrf
                <button type="submit" name="delta" value="-1" id="qty-dec-{{ $slug }}" class="h-full w-8 text-sm font-bold text-[#808080] hover:text-[#D87D4A]">-</button>
                <span id="qty-{{ $slug }}" class="w-6 text-center text-sm font-bold text-[#101010]">{{ $item['qty'] }}</span>
                <button type="submit" name="delta" value="1" id="qty-inc-{{ $slug }}" class="h-full w-8 text-sm font-bold text-[#808080] hover:text-[#D87D4A]">+</button>
            </form>
        </div>
    @empty
        <div class="mb-6">
            <p class="mb-6 text-2xl text-[#101010]">Your Cart is empty.</p>
            <p class="text-sm text-[#808080]">
                Continue shopping on the audiophile website
                <a href="{{ route('acceuil') }}" class="text-[#D87D4A] hover:underline">homepage</a>.
            </p>
        </div>
    @endforelse

    <div class="flex items-center justify-between border-t border-black/10 pt-6">
        <p class="text-sm uppercase text-[#808080]">Total</p>
        <p class="text-lg font-bold text-[#101010]">$ {{ number_format($total, 0, ',', ',') }}</p>
    </div>

    <a href="{{ route('cart') }}"
       class="mt-6 block w-full bg-(--orange_principal) py-3.5 text-center text-sm font-bold uppercase tracking-[0.1em] text-white transition-colors duration-300 hover:bg-[#101010]">
        Checkout
    </a>

</div>