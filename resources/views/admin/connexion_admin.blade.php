@extends('layout.simple_layout')

@section('content')
    <div class='flex flex-col md:flex-row w-full'>
        <div class='flex flex-col w-full h-screen bg-radial-[at_0%_0%] from-[#222222] to-(--hard_black) justify-center gap-5 px-35 relative overflow-hidden'>
            <svg height="630" width="700" xmlns="" class='absolute z-10 top-0 left-0'>
                <circle r="330" cx="350" cy="300" fill="none" stroke="#de93671a" stroke-width="2" />
                <circle r="230" cx="350" cy="300" fill="none" stroke="#de936735" stroke-width="2" />
                <circle r="160" cx="350" cy="300" fill="none" stroke="#de93674e" stroke-width="2" />
                <circle r="90" cx="350" cy="300" fill="none" stroke="#de93676b" stroke-width="2" />
            </svg>
            <p class='uppercase text-(--orange_principal) font-medium tracking-[.3rem] z-10'>espace administrateur</p>
            <h2 class='uppercase text-(--white_color) text-4xl font-bold z-10'>pilotez la boutique audiophile</h2>
            <p class=' text-(--mid_gray) z-10'>Gérez le catalogue d'appareils, suivez chaque commande et gardez un œil sur l'activité de la boutique — tout depuis un seul endroit.</p>
        </div>
        <div class='flex flex-col w-full h-screen justify-center gap-5 px-40'>
            <p class='text-3xl font-bold'>audio<span class=' text-(--orange_principal)'>file</span></p>
            <h3 class='uppercase font-medium text-xl'>connexion</h3>
            <p class=' text-(--mid_gray)'>Accédez à votre tableau de bord administrateur.</p>
            <form action="{{ route('connexion-admin.login') }}" method="POST" class='flex flex-col gap-5'>
                @csrf
                <p class='uppercase font-medium'>adresse e-mail</p>
                <input type="email" name="mail" value="{{ old('email') }}" required placeholder="admin@audiophile.com" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full'>
                @error('email')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
                <p class='uppercase font-medium'>mot de passe</p>
                <div class='relative w-full'>
                    <input type="password" name="passe" placeholder="●●●●●●" class='input-pass border-1 border-(--mid_gray)/50  hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full'>
                    <iconify-icon icon="iconoir:eye" class='eye text-(--mid_gray) text-2xl absolute right-3 top-1 block'></iconify-icon>
                    <iconify-icon icon="iconoir:eye-closed" class='eye-closed text-(--mid_gray) text-2xl absolute right-3 top-1 hidden'></iconify-icon>
                <div>
                <input type="submit" value="se connecter" required class='flex mt-5 justify-center items-center w-full h-13 text-(--white_color) bg-(--orange_principal) uppercase font-semibold hover:bg-(--orange_hover) rounded-lg'>
            </form>
        </div>
    </div>
    <script>
        const input_pass = document.querySelector('.input-pass');
        const eye = document.querySelector('.eye');
        const eye_closed = document.querySelector('.eye-closed');

        eye.addEventListener('click', () => {
            input_pass.setAttribute('type', 'text');
            eye_closed.classList.replace('hidden', 'block');
            eye.classList.replace('block', 'hidden');
        });

        eye_closed.addEventListener('click', () => {
            input_pass.setAttribute('type', 'password');
            eye_closed.classList.replace('block', 'hidden');
            eye.classList.replace('hidden', 'block');
        });
    </script>
@endsection