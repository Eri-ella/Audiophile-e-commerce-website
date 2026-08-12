<script src="https://cdn.tailwindcss.com"></script>

<div class="mx-auto w-full max-w-[1113px] px-6 sm:px-12 lg:px-8">

    <a href="{{ url()->previous() }}" class="mt-8 mb-6 inline-block text-sm text-[#808080] hover:text-[#D87D4A] md:mt-20 md:mb-14">
        Go Back
    </a>

    <section class="flex flex-col items-center gap-10 md:flex-row md:items-center md:gap-[8.65%]">
        <div class="w-full max-w-[540px] flex-shrink-0 rounded-xl overflow-hidden bg-[#F1F1F1] md:w-[540px]">
            <img src="{{ asset('page_autre/audiophile3.jpg') }}"
                 alt="XX59"
                 class="h-full w-full object-cover">
        </div>

        <div class="flex w-full flex-col items-center text-center md:w-[445px] md:items-start md:text-left">

            <h1 class="mb-6 text-3xl font-bold uppercase leading-tight text-[#101010] md:mb-8 md:text-4xl">
                XX59 <span class="block">Headphones</span>
            </h1>

            <p class="mb-8 leading-[1.8] text-[#808080]">
                Enjoy your audio almost anywhere and customize it to your specific tastes with the XX59 headphones. The stylish yet durable versatile wireless headset is a brilliant companion at home or on the move.
            </p>

            <p class="mb-8 text-lg font-bold tracking-[0.1em] text-[#101010] md:mb-12">
                $ 899
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
                These headphones have been created from durable, high-quality materials tough enough to take anywhere. Its compact folding design fuses comfort and minimalist style making it perfect for travel. Flawless transmission is assured by the latest wireless technology engineered for audio synchronization with videos.
            </p>
            <p class="leading-[1.8] text-[#808080]">
                More than a simple pair of headphones, this headset features a pair of built-in microphones for clear, hands-free calling when paired with a compatible smartphone. Controlling music and calls is also intuitive thanks to easy-access touch buttons on the earcups. Regardless of how you use the XX59 headphones, you can do so all day thanks to an impressive 30-hour battery life that can be rapidly recharged via USB-C.
            </p>
        </div>

        <div class="md:w-[350px]">
            <h2 class="mb-6 text-2xl font-bold uppercase text-[#101010] md:mb-8 md:text-3xl">In the box</h2>
            <ul class="space-y-2">
                <li class="flex gap-6"><span class="font-bold text-[#D87D4A]">1x</span><span class="text-[#808080]">Headphone unit</span></li>
                <li class="flex gap-6"><span class="font-bold text-[#D87D4A]">2x</span><span class="text-[#808080]">Replacement earcups</span></li>
                <li class="flex gap-6"><span class="font-bold text-[#D87D4A]">1x</span><span class="text-[#808080]">User manual</span></li>
                <li class="flex gap-6"><span class="font-bold text-[#D87D4A]">1x</span><span class="text-[#808080]">3.5mm 5m audio cable</span></li>
            </ul>
        </div>
    </section>

    <section class="mt-24 grid grid-cols-1 gap-8 md:mt-40 md:grid-cols-[38%_58.5%] md:grid-rows-2 md:gap-x-8 md:gap-y-8">
        <div class="overflow-hidden rounded-xl md:col-start-1 md:row-start-1">
            <img src="{{ asset('page_autre/audiophile3_1.jpg') }}" alt="" class="h-full w-full object-cover">
        </div>
        <div class="overflow-hidden rounded-xl md:col-start-1 md:row-start-2">
            <img src="{{ asset('page_autre/audiophile3-2.jpg') }}" alt="" class="h-full w-full object-cover">
        </div>
        <div class="overflow-hidden rounded-xl md:col-start-2 md:row-span-2 md:row-start-1">
            <img src="{{ asset('page_autre/audiophile3-1.jpg') }}" alt="" class="h-full w-full object-cover">
        </div>
    </section>

    <section class="mt-24 mb-24 md:mt-32 md:mb-32">
        <h2 class="mb-14 text-center text-2xl font-bold uppercase text-[#101010] md:text-3xl">You may also like</h2>

        <div class="flex flex-col items-center gap-14 md:flex-row md:items-start md:justify-center md:gap-8">
            <div class="flex w-full max-w-[350px] flex-col items-center text-center">
                <div class="mb-8 w-full overflow-hidden rounded-xl bg-[#F1F1F1]">
                    <img src="{{ asset('page_autre/audiophile_black.jpg') }}" alt="XX99 Mark I" class="h-full w-full object-cover">
                </div>
                <h3 class="mb-8 text-xl font-bold uppercase text-[#101010]">XX99 Mark I</h3>
                <a href="{{ route('headphile1') }}" class="inline-block bg-[#D87D4A] px-8 py-3.5 text-sm font-bold uppercase tracking-[0.1em] text-white transition-colors duration-300 hover:bg-[#FBAF85]">
                    See Product
                </a>
            </div>

            <div class="flex w-full max-w-[350px] flex-col items-center text-center">
                <div class="mb-8 w-full overflow-hidden rounded-xl bg-[#F1F1F1]">
                    <img src="{{ asset('page_acceuil/audiophile2.jpg') }}" alt="XX59" class="h-full w-full object-cover">
                </div>
                <h3 class="mb-8 text-xl font-bold uppercase text-[#101010]">XX59</h3>
                <a href="{{ route('headphile2') }}" class="inline-block bg-[#D87D4A] px-8 py-3.5 text-sm font-bold uppercase tracking-[0.1em] text-white transition-colors duration-300 hover:bg-[#FBAF85]">
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