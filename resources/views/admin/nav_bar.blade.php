@php
    $admin = Auth::user();
@endphp
<div class='flex h-15 w-full items-center justify-end px-5 gap-5 bg-(--white_color) text-(--hard_black) text-sm'>
    <div class='flex gap-3'>
        @if($admin->profil)
            <a 
                href="{{ route('admin.setting') }}"
                class='flex items-center justify-center size-10 bg-(--black_color) rounded-full overflow-hidden'>
                <img src="{{ asset('storage/' . $admin->profil) }}" alt="Profil" class="size-10 rounded-full"/>
            </a>
        @else
            <a
                href="{{ route('admin.setting') }}"
                class='flex items-center justify-center size-10 bg-(--black_color) text-(--white_color) text-xl rounded-full uppercase'>
                {{ collect(explode(' ', $admin->name))->map(fn($w) => mb_substr($w, 0, 1))->join('') }}
            </a>
        @endif
        <div>
            <p class='capitalize'>{{ $admin->name }}</p>
            <p class='uppercase text-(--mid_gray) text-xs'>Administrateur</p>
        </div>
    </div>
</div>
