@php
    $admin = Auth::user();
@endphp
<div class='flex h-15 w-full items-center justify-between px-5 gap-5 bg-(--white_color) text-(--hard_black) text-sm'>
    <div class='relative'>
        <input type="text" name="search" placeholder="rechercher un produit, une commande, un client..." class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 min-w-100 bg-(--soft_gray)/50 placeholder:text-(--mid_gray)'>
        <iconify-icon icon="material-symbols:search" class='absolute right-2 top-1 text-xl text-(--mid_gray)/50 cursor-pointer'></iconify-icon>
    </div>
    <div class='flex gap-3'>
        @if($admin->profil)
            <div class='flex items-center justify-center size-10 bg-(--black_color) rounded-full overflow-hidden'>
                <img src="{{ asset('storage/' . $admin->profil) }}" alt="Profil" class="size-30 rounded-full"/>
            </div>
        @else
            <div class='flex items-center justify-center size-10 bg-(--black_color) text-(--white_color) text-4xl rounded-full uppercase'>
                {{ collect(explode(' ', $admin->name))->map(fn($w) => mb_substr($w, 0, 1))->join('') }}
            </div>
        @endif
        <div>
            <p class='capitalize'>{{ $admin->name }}</p>
            <p class='uppercase text-(--mid_gray) text-xs'>Administrateur</p>
        </div>
    </div>
</div>
