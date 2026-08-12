@php
    $elements = [
        "elt1" => [ 
            "url" => 'page_acceuil/headphones.png', 
            "name" => 'headphones',
            "route" => 'headphones'
        ],
        "elt2" => [ 
            "url" => 'page_acceuil/speakers.png', 
            "name" => 'speakers',
            "route" => 'speakers'
        ],
        "elt3" => [ 
            "url" => 'page_acceuil/earphones.png', 
            "name" => 'earphones',
            "route" => 'earphones'
        ],
    ]
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Layout</title>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    @vite(['public/js/client.js'])
</head>
    <section class='grid grid-cols-[repeat(3,minmax(150px,1fr))] max-[460px]:grid-cols-[repeat(1,minmax(100px,200px))] py-20 gap-5 max-[460px]:gap-25 items-center justify-center'>
        @foreach ($elements as $element)
            <div class='size-full pt-25 pb-5 flex flex-col bg-(--soft_gray) rounded-lg uppercase justify-center items-center relative gap-3 text-(--mid_gray) hover:text-(--orange_principal)'>
                <img src="{{ asset($element["url"]) }}" alt="{{ $element["name"] }}" class='absolute bottom-15 z-10 max-h-50'>
                <h3 class='font-medium text-(--black_color)'>{{ $element["name"] }}</h3>
                <a href={{ route($element["route"]) }} class='flex gap-2'>
                    <p class='text-sm'>shop</p>
                    <iconify-icon icon="weui:arrow-filled" class='text-2xl text-(--orange_principal)'></iconify-icon>
                </a> 
            </div>
        @endforeach
        
    </section>
</html>