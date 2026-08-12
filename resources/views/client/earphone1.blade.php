<script src="https://cdn.tailwindcss.com"></script>

<div class="mx-auto w-full max-w-[1113px] px-6 sm:px-12 lg:px-8">

    <a href="{{ url()->previous() }}" class="mt-8 mb-6 inline-block text-sm text-[#808080] hover:text-[#D87D4A] md:mt-20 md:mb-14">
        Go Back
    </a>

    <section class="flex flex-col items-center gap-10 md:flex-row md:items-center md:gap-[8.65%]">
        <div class="w-full max-w-[540px] flex-shrink-0 rounded-xl overflow-hidden bg-[#F1F1F1] md:w-[540px]">
            <img src="{{ asset('page_autre/earphone.jpg') }}"
                 alt="YX1"
                 class="h-full w-full object-cover">
        </div>

        <div class="flex w-full flex-col items-center text-center md:w-[445px] md:items-start md:text-left">
            <p class="mb-4 text-sm font-medium uppercase tracking-[0.5em] text-[#D87D4A]">New Product</p>

            <h1 class="mb-6 text-3xl font-bold uppercase leading-tight text-[#101010] md:mb-8 md:text-4xl">
                YX1 wireless <span class="block">earphones</span>
            </h1>

            <p class="mb-8 leading-[1.8] text-[#808080]">
                Tailor your listening experience with bespoke dynamic drivers from the new YX1 Wireless Earphones. Enjoy incredible high-fidelity sound even in noisy environments with its active noise cancellation feature.
            </p>

            <p class="mb-8 text-lg font-bold tracking-[0.1em] text-[#101010] md:mb-12">
                $ 599
            </p>

            <div class="flex items-center gap-4">
                <div class="flex h-12 items-center bg-[#F1F1F1]">
                    <button type="button" onclick="updateQty(-1)" class="h-full w-10 text-sm font-bold text-[#808080] transition-colors hover:text-[#D87D4A]">-</button>
                    <span id="qty" class="w-6 text-center text-sm font-bold text-[#101010]">0</span>
                    <button type="button" onclick="updateQty(1)" class="h-full w-10 text-sm font-bold text-[#808080] transition-colors hover:text-[#D87D4A]">+</button>
                </div>

                <button type="button" class="inline-block bg-[#D87D4A] px-8 py-3.5 text-sm font-bold uppercase tracking-[0.1em] text-white transition-colors duration-300 hover:bg-[#FBAF85]">
                    Add to cart
                </button>
            </div>
        </div>
    </section>

    <section class="mt-24 flex flex-col gap-16 md:mt-40 md:flex-row md:items-start md:justify-between md:gap-[125px]">
        <div class="md:w-[635px]">
            <h2 class="mb-6 text-2xl font-bold uppercase text-[#101010] md:text-3xl">Features</h2>
            <p class="mb-6 leading-[1.8] text-[#808080]">
                Experience unrivalled stereo sound thanks to innovative acoustic technology. With improved ergonomics designed for full day wearing, these revolutionary earphones have been finely crafted to provide you with the perfect fit, delivering complete comfort all day long while enjoying exceptional noise isolation and truly immersive sound.
            </p>
            <p class="leading-[1.8] text-[#808080]">
                The YX1 Wireless Earphones features customizable controls for volume, music, calls, and voice assistants built into both earbuds. The new 7-hour battery life can be extended up to 28 hours with the charging case, giving you uninterrupted play time. Exquisite craftsmanship with a splash resistant design now available in an all new white and grey color scheme as well as the popular classic black.
            </p>
        </div>

        <div class="md:w-[350px]">
            <h2 class="mb-6 text-2xl font-bold uppercase text-[#101010] md:mb-8 md:text-3xl">In the box</h2>
            <ul class="space-y-2">
                <li class="flex gap-6"><span class="font-bold text-[#D87D4A]">2x</span><span class="text-[#808080]">Earphone unit</span></li>
                <li class="flex gap-6"><span class="font-bold text-[#D87D4A]">6x</span><span class="text-[#808080]">Multi-size earplugs</span></li>
                <li class="flex gap-6"><span class="font-bold text-[#D87D4A]">1x</span><span class="text-[#808080]">User manual</span></li>
                <li class="flex gap-6"><span class="font-bold text-[#D87D4A]">1x</span><span class="text-[#808080]">USB-C charging cable</span></li>
                <li class="flex gap-6"><span class="font-bold text-[#D87D4A]">1x</span><span class="text-[#808080]">Travel pouch</span></li>
            </ul>
        </div>
    </section>

    <section class="mt-24 grid grid-cols-1 gap-8 md:mt-40 md:grid-cols-[38%_58.5%] md:grid-rows-2 md:gap-x-8 md:gap-y-8">
        <div class="overflow-hidden rounded-xl md:col-start-1 md:row-start-1">
            <img src="{{ asset('page_autre/earphone1-1.jpg') }}" alt="" class="h-full w-full object-cover">
        </div>
        <div class="overflow-hidden rounded-xl md:col-start-1 md:row-start-2">
            <img src="{{ asset('page_autre/earphone2-2.jpg') }}" alt="" class="h-full w-full object-cover">
        </div>
        <div class="overflow-hidden rounded-xl md:col-start-2 md:row-span-2 md:row-start-1">
            <img src="{{ asset('page_autre/earphone1-3.jpg') }}" alt="" class="h-full w-full object-cover">
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

<script>
    function updateQty(delta) {
        const el = document.getElementById('qty');
        let val = parseInt(el.textContent) + delta;
        if (val < 0) val = 0;
        el.textContent = val;
    }
</script>