@props([
    'title',
    'name', 
    'required' => true,
    'preview' => null,  
])

@php
    $id = $name . '_' . uniqid();
@endphp

<div class='flex flex-col gap-5' x-data="{ fileName: 'Aucun fichier choisi' }"> 
    <p class='font-medium text-gray-700'>{{ $title }}</p>

    @if($preview)
        <img x-show="{{ $preview }}" :src="'{{ asset('storage') }}/' + {{ $preview }}" 
             class='w-20 h-20 object-cover rounded-lg border' alt="Image actuelle">
    @endif

    <div class='grid grid-cols-2 items-center'>
        <div class='relative min-h-[40px]'>
            <label for="{{ $id }}" class='flex bg-(--orange_principal) text-white p-2 font-medium absolute uppercase rounded-lg cursor-pointer hover:opacity-90 transition'>
                <iconify-icon icon="material-symbols:upload" class='text-xl mr-2'></iconify-icon>
                importer un fichier
            </label>
            <input 
                type="file" 
                id="{{ $id }}"
                name="{{ $name }}" 
                class='hidden'
                @if($required) 
                    required 
                @endif
                accept="image/*"
                @change="fileName = $event.target.files[0] ? $event.target.files[0].name : 'Aucun fichier choisi'">
        </div>
        <span class='place-self-end text-sm text-gray-500' x-text="fileName"></span>
    </div>
    <div class='bg-gray-400 h-[1px] w-[90%] self-center'></div>
</div>