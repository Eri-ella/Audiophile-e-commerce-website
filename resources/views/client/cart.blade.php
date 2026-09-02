@extends('layout.client_layout')

@section('acceuil-content')

@php
    $cart = $cart ?? session('cart', []);
    
    $total      = collect($cart)->sum(fn ($item) => $item['price'] * $item['qty']);
    $shipping   = count($cart) > 0 ? 50 : 0;         
    $vat        = round($total * 0.2, 2);             
    $grandTotal = $total + $shipping;
    
    // Conversion USD → FCFA pour FedaPay / KikiPay
    $usdToXof   = config('services.fedapay.usd_to_xof', 600);
    $grandTotalXof = (int) round($grandTotal * $usdToXof);
@endphp

<div class="min-h-screen w-full bg-[#F2F2F2] pb-24">
    <div class="mx-auto w-full max-w-[1110px] px-10 py-8 sm:px-16 md:py-14">

        <a href="{{ url()->previous() }}" class="mb-6 inline-block text-sm text-[#101010]/50 transition-colors hover:text-[#D87D4A] md:mb-10">
            Go Back
        </a>

        <form action="{{ route('payment.store') }}" method="POST" class="flex flex-col gap-6 md:flex-row md:items-start">
            @csrf

            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-100 p-4 text-sm font-bold text-red-700">
                    @foreach ($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- ===== Formulaire gauche ===== --}}
            <div class="w-full rounded-xl bg-white p-10 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.08)] md:flex-1 md:p-12">
                <h2 class="mb-8 text-2xl font-bold uppercase tracking-wide text-[#101010] md:mb-10 md:text-3xl">
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
                                   class="h-14 rounded-lg border border-black/15 px-[1.5em] text-sm text-[#101010] outline-none transition-colors focus:border-[#D87D4A] focus:ring-2 focus:ring-[#D87D4A]/10">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="email" class="text-xs font-bold text-[#101010]">Email Address</label>
                            <input required id="email" name="email" type="email" placeholder="alexei@mail.com"
                                   class="h-14 rounded-lg border border-black/15 px-[1.5em] text-sm text-[#101010] outline-none transition-colors focus:border-[#D87D4A] focus:ring-2 focus:ring-[#D87D4A]/10">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="phone" class="text-xs font-bold text-[#101010]">Phone Number</label>
                            <input required id="phone" name="phone" type="tel" placeholder="+1 202-555-0136"
                                   class="h-14 rounded-lg border border-black/15 px-[1.5em] text-sm text-[#101010] outline-none transition-colors focus:border-[#D87D4A] focus:ring-2 focus:ring-[#D87D4A]/10">
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
                                   class="h-14 rounded-lg border border-black/15 px-[1.5em] text-sm text-[#101010] outline-none transition-colors focus:border-[#D87D4A] focus:ring-2 focus:ring-[#D87D4A]/10 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="city" class="text-xs font-bold text-[#101010]">City</label>
                            <input required id="city" name="city" type="text" placeholder="New York"
                                   class="h-14 rounded-lg border border-black/15 px-[1.5em] text-sm text-[#101010] outline-none transition-colors focus:border-[#D87D4A] focus:ring-2 focus:ring-[#D87D4A]/10">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="country" class="text-xs font-bold text-[#101010]">Country</label>
                            <input required id="country" name="country" type="text" placeholder="United States"
                                   class="h-14 rounded-lg border border-black/15 px-[1.5em] text-sm text-[#101010] outline-none transition-colors focus:border-[#D87D4A] focus:ring-2 focus:ring-[#D87D4A]/10">
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

                    {{-- 🆕 Select pour choisir entre FedaPay et KikiPay (juste après les radios, avant le texte) --}}
                    <div id="payment-provider-container" class="mt-6">
                        <label for="payment_provider" class="text-xs font-bold text-[#101010] mb-2 block">Choisir le type</label>
                        <select name="payment_provider" id="payment_provider"
                                class="h-14 w-full rounded-lg border border-black/15 px-[1.5em] text-sm text-[#101010] outline-none transition-colors focus:border-[#D87D4A] focus:ring-2 focus:ring-[#D87D4A]/10 bg-white">
                            <option value="fedapay">FedaPay</option>
                            <option value="kkiapay">Kkiapay</option>
                            {{-- <option value="feexpay">Feexpay</option> Select FeexPay --}}
                            <option value="paydunya">Paydunya</option> {{-- Select Paydunya --}}
                        </select>
                    </div>

                    {{-- Textes explicatifs --}}
                    <div id="e-money-fields" class="mt-6 rounded-lg bg-[#FAFAFA] p-5 text-sm leading-[1.7] text-[#101010]/70">
                        <p class="mb-2 flex items-center gap-2 font-bold text-[#101010]">
                             Paiement sécurisé
                        </p>
                        <p>Après avoir cliqué sur "Continue & Pay", vous serez redirigé vers la page de paiement sécurisée de <span id="provider-name" class="font-bold text-[#D87D4A]">FedaPay</span> où vous pourrez choisir votre moyen de paiement (Mobile Money, carte bancaire, etc.).</p>
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

                @forelse ($cart as $item)
                    <div class="mb-4 flex items-center gap-4 last:mb-6">
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="h-16 w-16 rounded-lg object-cover">
                        <div class="flex flex-col">
                            <h6 class="text-sm font-bold text-[#101010]">{{ $item['name'] }}</h6>
                            <p class="text-lg font-bold text-[#000000]">$ {{ number_format($item['price'], 0, ',', ',') }}</p>
                        </div>
                        <p class="ml-auto text-sm font-bold text-[#101010]/50">x{{ $item['qty'] }}</p>
                    </div>
                @empty
                    <p class="mb-6 text-sm text-[#808080]">Your cart is empty.</p>
                @endforelse

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
                    
                    @if (count($cart) > 0)
                        <div class="flex items-center justify-between border-t border-black/10 pt-2">
                            <p class="text-sm uppercase text-[#000000]/40">≈ en FCFA</p>
                            <p class="text-sm font-bold text-[#808080]">
                                {{ number_format($grandTotalXof, 0, ',', ' ') }} F
                            </p>
                        </div>
                        <p class="text-xs text-[#000000]/40 italic">
                            Taux : 1 $ = {{ number_format($usdToXof, 0, ',', ' ') }} F
                        </p>
                    @endif
                </div>

                <button type="submit"
                        @disabled(count($cart) === 0)
                        class="mt-8 block w-full bg-[#D87D4A] py-4 text-center text-sm font-bold uppercase tracking-[0.1em] text-white transition-colors duration-300 hover:bg-[#FBAF85] disabled:cursor-not-allowed disabled:bg-[#808080]">
                    Continue &amp; Pay
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    const eMoney = document.getElementById('e-money');
    const cash = document.getElementById('cash');
    const cashFields = document.getElementById('cash-fields');
    const providerContainer = document.getElementById('payment-provider-container');
    const providerSelect = document.getElementById('payment_provider');
    const providerNameSpan = document.getElementById('provider-name');

    function toggleFields() {
        const isCash = cash.checked;
        
        // Afficher/masquer le select provider
        providerContainer.classList.toggle('hidden', isCash);
        
        // Afficher/masquer les blocs de texte
        document.getElementById('e-money-fields').classList.toggle('hidden', isCash);
        cashFields.classList.toggle('hidden', !isCash);
        cashFields.classList.toggle('flex', isCash);
        
        // Gérer l'attribut required du select (évite les erreurs de validation HTML5 quand caché)
        providerSelect.required = !isCash;
    }

    function updateProviderText() {
        const selectedProvider = providerSelect.options[providerSelect.selectedIndex].text;
        providerNameSpan.textContent = selectedProvider;
    }

    eMoney.addEventListener('change', toggleFields);
    cash.addEventListener('change', toggleFields);
    providerSelect.addEventListener('change', updateProviderText);
    
    // Initialisation au chargement
    toggleFields();
    updateProviderText();
</script>


{{-- MODALE RÉCAP APRÈS PAIEMENT (Design compact & centré)        --}}

@if (isset($commande) && $commande)
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4 py-8 backdrop-blur-md">

    <div class="w-full max-w-[480px] rounded-2xl bg-white p-8 shadow-2xl">

        {{-- Icône de succès --}}
        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-[#D87D4A]">
            <svg width="20" height="15" viewBox="0 0 14 11" xmlns="http://www.w3.org/2000/svg">
                <path fill="none" stroke="#FFF" stroke-width="2" d="m1 4.526 3.973 4.056L12.246 1"/>
            </svg>
        </div>

        {{-- Titre et sous-titre --}}
        <h1 class="mb-2 text-2xl font-bold uppercase leading-tight text-[#101010]">
            Thank you<br>for your order
        </h1>
        <p class="mb-6 text-sm text-[#808080]">
            Commande #{{ $commande->id }} — vous recevrez un email de confirmation sous peu.
        </p>

        {{-- Liste des produits --}}
        <div class="mb-6 rounded-xl bg-[#F2F2F2] p-5">
            @foreach ($commande->products as $product)
                <div class="flex items-center gap-4 py-3 first:pt-0 last:pb-0 border-b border-black/5 last:border-0">
                    <img src="{{ asset($product->image_1 ?? $product->image_description) }}"
                         alt="{{ $product->name }}"
                         class="h-16 w-16 flex-shrink-0 rounded-lg object-cover">
                    
                    <div class="flex flex-1 items-center justify-between">
                        <span class="text-sm font-bold text-[#101010] truncate pr-4">
                            {{ $product->name }}
                        </span>
                        <div class="text-right">
                            <span class="text-sm font-bold text-[#101010] block">
                                $ {{ number_format($product->price, 0, ',', ',') }}
                            </span>
                            <span class="text-xs text-[#808080]">
                                x{{ $product->pivot->quantity }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Total avec texte VISIBLE sur fond noir --}}
        <div class="mb-8 flex items-center justify-between rounded-xl bg-black p-5">
            <span class="text-sm uppercase tracking-wide text-white/60">Grand Total</span>
            <span class="text-2xl font-bold text-white">
                $ {{ number_format($commande->amount ?? 0, 0, ',', ',') }}
            </span>
        </div>

        {{-- Bouton de retour --}}
        <a href="{{ route('acceuil') }}"
           class="block w-full rounded-lg bg-[#D87D4A] py-4 text-center text-sm font-bold uppercase tracking-[0.15em] text-white transition-colors hover:bg-[#FBAF85]">
            Back to home
        </a>
    </div>
</div>
@endif

@endsection