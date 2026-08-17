@extends('layout.client_layout')

@section('acceuil-content')

@php
    // Récupère le vrai panier depuis la session
    $cart = $cart ?? session('cart', []);
    
    $total      = collect($cart)->sum(fn ($item) => $item['price'] * $item['qty']);
    $shipping   = count($cart) > 0 ? 50 : 0;         
    $vat        = round($total * 0.2, 2);             
    $grandTotal = $total + $shipping;
    $count      = collect($cart)->sum('qty');
@endphp

<div class="min-h-screen w-full bg-[#F2F2F2] pb-24">
    <div class="mx-auto w-full max-w-[1110px] px-10 py-8 sm:px-16 md:py-14">

        <a href="{{ url()->previous() }}" class="mb-6 inline-block text-sm text-[#101010]/50 transition-colors hover:text-{--orange_principal} md:mb-10">
            Go Back
        </a>

        <form action="{{ route('cart') }}" method="POST" class="flex flex-col gap-6 md:flex-row md:items-start">
            @csrf

            {{-- ===== Formulaire gauche ===== --}}
            <div class="w-full rounded-xl bg-white p-10 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.08)] md:flex-1 md:p-12">
                <h2 class="mb-8 text-2xl font-bold uppercase tracking-wide text-{--black_color} md:mb-10 md:text-3xl">
                    Checkout
                </h2>

                {{-- Billing --}}
                <div class="mb-8">
                    <h5 class="mb-4 text-[13px] font-medium uppercase tracking-[0.15em] text-[#D87D4A]">
                        Billing details
                    </h5>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="flex flex-col gap-1.5">
                            <label for="name" class="text-xs font-bold text-[#101010]">Name</label>
                            <input required id="name" name="name" type="text" placeholder="Alexei Ward"
                                   class="w-1/2 h-14 rounded-lg border border-black/15 px-[1.5em] text-sm text-[#101010] outline-none transition-colors focus:border-[#D87D4A] focus:ring-2 focus:ring-[#D87D4A]/10">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="email" class="text-xs font-bold text-[#101010]">Email Address</label>
                            <input required id="email" name="email" type="email" placeholder="alexei@mail.com"
                                   class="w-1/2 h-14 rounded-lg border border-black/15 px-[1.5em] text-sm text-[#101010] outline-none transition-colors focus:border-[#D87D4A] focus:ring-2 focus:ring-[#D87D4A]/10">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="phone" class="text-xs font-bold text-[#101010]">Phone Number</label>
                            <input required id="phone" name="phone" type="tel" placeholder="+1 202-555-0136"
                                   class="w-1/2 h-14 rounded-lg border border-black/15 px-[1.5em] text-sm text-[#101010] outline-none transition-colors focus:border-[#D87D4A] focus:ring-2 focus:ring-[#D87D4A]/10">
                        </div>
                    </div>
                </div>

                {{-- Shipping --}}
                <div class="mb-8">
                    <h5 class="mb-4 text-[13px] font-medium uppercase tracking-[0.15em] text-[#D87D4A]">Shipping info</h5>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="flex flex-col gap-1.5">
                            <label for="address" class="text-xs font-bold text-[#101010]">Your Address</label>
                            <input required id="address" name="address" type="text" placeholder="1137 Williams Avenue"
                                   class="h-14 rounded-lg border border-black/15 px-[1.5em] text-sm text-[#101010] outline-none transition-colors focus:border-[#D87D4A] focus:ring-2 focus:ring-[#D87D4A]/10">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="zip" class="text-xs font-bold text-[#101010]">ZIP Code</label>
                            <input required id="zip" name="zip" type="number" placeholder="10001"
                                   class="w-1/2 h-14 rounded-lg border border-black/15 px-[1.5em] text-sm text-[#101010] outline-none transition-colors focus:border-[#D87D4A] focus:ring-2 focus:ring-[#D87D4A]/10 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="city" class="text-xs font-bold text-[#101010]">City</label>
                            <input required id="city" name="city" type="text" placeholder="New York"
                                   class="w-1/2 h-14 rounded-lg border border-black/15 px-[1.5em] text-sm text-[#101010] outline-none transition-colors focus:border-[#D87D4A] focus:ring-2 focus:ring-[#D87D4A]/10">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="country" class="text-xs font-bold text-[#101010]">Country</label>
                            <input required id="country" name="country" type="text" placeholder="United States"
                                   class="w-1/2 h-14 rounded-lg border border-black/15 px-[1.5em] text-sm text-[#101010] outline-none transition-colors focus:border-[#D87D4A] focus:ring-2 focus:ring-[#D87D4A]/10">
                        </div>
                    </div>
                </div>

                {{-- Payment --}}
                <div>
                    <h5 class="mb-4 text-sm font-bold uppercase tracking-wide text-[#D87D4A]">Payment details</h5>

                    <div class="grid grid-cols-1 items-start gap-4 sm:grid-cols-2">
                        <label class="pt-3.5 text-xs font-bold text-[#101010]">Payment Method</label>

                        <div class="flex flex-col gap-4">
                            <label for="e-money" class="flex h-14 cursor-pointer items-center gap-4 rounded-lg border border-black/15 px-4 transition-colors hover:border-[#D87D4A] has-[:checked]:border-[#D87D4A]">
                                <input required id="e-money" name="payment_method" type="radio" value="e-money" checked
                                       class="peer relative h-5 w-5 shrink-0 appearance-none rounded-full border border-black/20 checked:border-[#D87D4A] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-2.5 checked:after:w-2.5 checked:after:-translate-x-1/2 checked:after:-translate-y-1/2 checked:after:rounded-full checked:after:bg-[#D87D4A]">
                                <span class="text-sm font-bold text-[#101010]">e-Money</span>
                            </label>

                            <label for="cash" class="flex h-14 cursor-pointer items-center gap-4 rounded-lg border border-black/15 px-4 transition-colors hover:border-[#D87D4A] has-[:checked]:border-[#D87D4A]">
                                <input required id="cash" name="payment_method" type="radio" value="cash"
                                       class="peer relative h-5 w-5 shrink-0 appearance-none rounded-full border border-black/20 checked:border-[#D87D4A] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-2.5 checked:after:w-2.5 checked:after:-translate-x-1/2 checked:after:-translate-y-1/2 checked:after:rounded-full checked:after:bg-[#D87D4A]">
                                <span class="text-sm font-bold text-[#101010]">Cash on Delivery</span>
                            </label>
                        </div>
                    </div>

                    <div id="e-money-fields" class="mt-6 grid grid-cols-1 gap-6">
                        <div class="flex flex-col gap-1.5">
                            <label for="e-money-number" class="text-xs font-bold text-[#101010]">e-Money Number</label>
                            <input id="e-money-number" name="e_money_number" type="number" placeholder="238521993"
                                   class="w-1/2 h-14 rounded-lg border border-black/15 px-[1.5em] text-sm text-[#101010] outline-none transition-colors focus:border-[#D87D4A] focus:ring-2 focus:ring-[#D87D4A]/10 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="e-money-pin" class="text-xs font-bold text-[#101010]">e-Money PIN</label>
                            <input id="e-money-pin" name="e_money_pin" type="number" placeholder="6891"
                                   class="w-1/2 h-14 rounded-lg border border-black/15 px-[1.5em] text-sm text-[#101010] outline-none transition-colors focus:border-[#D87D4A] focus:ring-2 focus:ring-[#D87D4A]/10 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                        </div>
                    </div>

                    <div id="cash-fields" class="mt-6 hidden flex-col gap-6 text-base leading-[1.8] text-[#101010]/50">
                        <img src="{{ asset('page_autre/icone.png') }}" alt="icon" class="h-16 w-16">
                        <p>The 'Cash on Delivery' option enables you to pay in cash when our delivery courier arrives at your residence. Just make sure your address is correct so that your order will not be cancelled.</p>
                    </div>
                </div>
            </div>

            {{-- ===== Résumé (droite) ===== --}}
            <div class="w-full rounded-xl bg-white p-6 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.08)] md:w-[350px] md:flex-shrink-0 md:p-8">
                <h5 class="mb-8 text-lg font-medium uppercase tracking-[0.15em] text-[#000000]">Summary</h5>

                {{--  Liste des articles du panier --}}
                @forelse ($cart as $item)
                    <div class="mb-4 flex items-center gap-4 last:mb-6">
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="h-16 w-16 rounded-lg object-cover">
                        <div class="flex flex-col">
                            <h6 class="text-sm font-bold text-[#101010]">{{ $item['name'] }}</h6>
                            <p class="text-lg font-bold text-[#000000]">$ {{ number_format($shipping, 0, ',', '') }}</p>
                        </div>
                        <p class="ml-auto text-sm font-bold text-[#101010]/50">x{{ $item['qty'] }}</p>
                    </div>
                @empty
                    <p class="mb-6 text-sm text-[#808080]">Your cart is empty.</p>
                @endforelse

                {{--  Totaux calculés dynamiquement --}}
                <div class="space-y-2 border-t border-black/10 pt-4">
                    <div class="flex items-start justify-between">
                        <p class="text-lg uppercase text-[#000000]/50">Total</p>
                        <p class="text-lg font-bold text-[#000000]">$ {{ number_format($total, 0, ',', ',') }}</p>
                    </div>
                    <div class="flex items-start justify-between">
                        <p class="text-lg uppercase text-[#000000]/50">Shipping</p>
                        <p class="text-lg font-bold text-[#000000]">$ {{ number_format($shipping, 0, ',', ',') }}</p>
                    </div>
                    <div class="flex items-start justify-between">
                        <p class="text-lg uppercase text-[#000000]/50">VAT (Included)</p>
                        <p class="text-lg font-bold text-[#000000]">$ {{ number_format($vat, 2) }}</p>
                    </div>
                    <div class="flex items-start justify-between pt-4">
                        <p class="text-lg uppercase text-[#000000]/50">Grand Total</p>
                        <p class="text-lg font-bold text-[#D87D4A]">$ {{ number_format($grandTotal, 0, ',', ',') }}</p>
                    </div>
                </div>

                <button type="submit"
                        @disabled(count($cart) === 0)
                        class="mt-8 block w-full bg-[#D87D4A] py-4 text-center text-sm font-bold uppercase tracking-[0.1em] text-white transition-colors duration-300 hover:bg-[#FBAF85] disabled:opacity-50 disabled:cursor-not-allowed">
                    Continue &amp; Pay
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    const eMoney = document.getElementById('e-money');
    const cash = document.getElementById('cash');
    const eMoneyFields = document.getElementById('e-money-fields');
    const cashFields = document.getElementById('cash-fields');

    function toggleFields() {
        const isEMoney = eMoney.checked;
        eMoneyFields.classList.toggle('hidden', !isEMoney);
        eMoneyFields.classList.toggle('grid', isEMoney);
        cashFields.classList.toggle('hidden', isEMoney);
        cashFields.classList.toggle('flex', !isEMoney);
    }

    eMoney.addEventListener('change', toggleFields);
    cash.addEventListener('change', toggleFields);
</script>

@endsection