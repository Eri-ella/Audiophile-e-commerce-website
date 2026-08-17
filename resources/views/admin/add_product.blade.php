@extends('layout.simple_layout')

@section('content')
<form method='POST' class='flex flex-col gap-2'>
    @csrf
    <div class='flex flex-row w-full bg-(--broken_white) text-xs gap-5 p-5'>
        <section class='w-full flex flex-col gap-3'>
            <p class='text-(--mid_gray) uppercase font-semibold text-xs'>Produit /<span class='text-(--orange_principal)'> Ajouter un appareil</span></p>
            <h2 class='uppercase font-semibold text-2xl'>ajouter un appareil</h2>
            <p class='text-(--mid_gray) text-base sm:pr-5'>Créez une nouvelle fiche produit visible sur la boutique</p>
            
            <div class='bg-(--white_color) flex flex-col gap-3 p-5 rounded-lg shadow-lg'>
                <div class='flex flex-col gap-3'>
                    <p class='uppercase text-(--mid_gray) font-medium'>informations générales</p>
                    <div>
                        <label for="name" class='font-medium'>Nom du produit</label>
                        <input type="text" id="name" name="name" placeholder="Créez une nouvelle fiche produit visible sur la boutique" class='mt-2 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
                    </div>
                    <div class='flex gap-5 w-full'>
                        <div class='w-full flex flex-col'>
                            <label for="category" class='font-medium'>Catégorie</label>
                            <select id="category" name="category" class='mt-2 w-full border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                                <option value="" >Headphones</option>
                                <option value="" >Speakers</option>
                                <option value="" >Earphones</option>
                            </select> 
                        </div>
                        <div class='w-full flex flex-col'>
                            <label for="status" class='font-medium'>Statut</label>
                            <select id="status" name="status" class='mt-2 w-full border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                                <option value="" >Active</option>
                                <option value="" >Inactive</option>
                            </select> 
                        </div>
                    </div>
                    <div class='flex gap-5 w-full'>
                        <div class='w-full flex flex-col'>
                            <label for="price" class='font-medium'>Prix</label>
                            <input type="number" id="price" name="price" placeholder="1800" class='mt-2 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
                        </div>
                        <div class='w-full flex flex-col'>
                            <label for="stock" class='font-medium'>Stock disponible</label>
                            <input type="number" id="stock" name="stock" placeholder="40" class='mt-2 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
                        </div>
                    </div>
                    <p class='uppercase' class='uppercase text-(--mid_gray) font-medium'>description</p>
                    <div>
                        <label for="description" class='font-medium'>Description courte</label>
                        <textarea type="text" id="description" name="description" placeholder="Créez une nouvelle fiche produit visible sur la boutique" class='mt-2 min-h-20 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'></textarea>
                    </div>
                    <div>
                        <label for="caracteristque" class='font-medium'>Caractéristiques détaillées</label>
                        <textarea type="text" id="caracteristque" name="caracteristque" placeholder="Créez une nouvelle fiche produit visible sur la boutique" class='mt-2 min-h-30 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'></textarea>
                    </div>
                    <p class='uppercase' class='uppercase text-(--mid_gray) font-medium'>contenu de la boîte</p>
                    <div>
                        <div class='flex items-center gap-3 mb-3'>
                            <input type="number" id="quantite" name="quantite" value="1" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-20 bg-(--white_color) placeholder:text-(--mid_gray)'>
                            <input type="text" id="caracteristque" name="caracteristque" placeholder="Créez une nouvelle fiche produit visible sur la boutique" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
                            <iconify-icon icon="tabler:trash" class='text-(--mid_gray)/75 text-xl'></iconify-icon>
                        </div>
                        <a href=""  class='text-(--orange_principal) uppercase font-semibold text-sm'>+ Ajouter une ligne</a>
                    </div>
                <div>
            </div>    
        </section>    
        <section class='w-full h-fit flex flex-col gap-3 bg-(--white_color) flex flex-col gap-3 p-5 rounded-lg shadow-lg'>
            <p  class='uppercase text-(--mid_gray) font-medium'>visuels du produit</p>
            <div class='flex gap-5'> 
                <div class='relative'>
                    <label for="couverture" class='font-medium'>Image de couverture</label>
                    <iconify-icon icon="pajamas:import" class='text-(--orange_principal) absolute top-15 left-[40%] text-6xl'></iconify-icon>
                    <input 
                        type="file" 
                        id="couverture"
                        name="couverture" 
                        value="Glissez vos images ici ou cliquez pour parcourir — PNG, JPG (fond transparent recommandé)" 
                        class='border-1 
                        border-(--mid_gray)/50 
                        hover:border-(--orange_hover) 
                        hover:border-dashed
                        hover:bg-(--orange_hover)/25
                        focus:bg-(--orange_hover)/25
                        focus:border-dashed
                        focus:outline-none 
                        focus:border-(--orange_hover) 
                        rounded-lg px-4 py-1 mt-2 w-full 
                        min-h-40 
                        bg-(--white_color) '>
                    
                </div>
                <div class='relative'>
                    <label for="couverture" class='font-medium'>Image 1</label>
                    <iconify-icon icon="pajamas:import" class='text-(--orange_principal) absolute top-15 left-[40%] text-6xl'></iconify-icon>
                    <input 
                        type="file" 
                        id="couverture"
                        name="couverture" 
                        value="Glissez vos images ici ou cliquez pour parcourir — PNG, JPG (fond transparent recommandé)" 
                        class='border-1 
                        border-(--mid_gray)/50 
                        hover:border-(--orange_hover) 
                        hover:border-dashed
                        hover:bg-(--orange_hover)/25
                        focus:bg-(--orange_hover)/25
                        focus:border-dashed
                        focus:outline-none 
                        focus:border-(--orange_hover) 
                        rounded-lg px-4 py-1 mt-2 w-full 
                        min-h-40 
                        bg-(--white_color) '>
                    
                </div> 
            </div>
                <div class='flex gap-5'> 
                <div class='relative'>
                    <label for="couverture" class='font-medium'>Image 2</label>
                    <iconify-icon icon="pajamas:import" class='text-(--orange_principal) absolute top-15 left-[40%] text-6xl'></iconify-icon>
                    <input 
                        type="file" 
                        id="couverture"
                        name="couverture" 
                        value="Glissez vos images ici ou cliquez pour parcourir — PNG, JPG (fond transparent recommandé)" 
                        class='border-1 
                        border-(--mid_gray)/50 
                        hover:border-(--orange_hover) 
                        hover:border-dashed
                        hover:bg-(--orange_hover)/25
                        focus:bg-(--orange_hover)/25
                        focus:border-dashed
                        focus:outline-none 
                        focus:border-(--orange_hover) 
                        rounded-lg px-4 py-1 mt-2 w-full 
                        min-h-40 
                        bg-(--white_color) '>
                    
                </div>
                <div class='relative'>
                    <label for="couverture" class='font-medium'>Image 3</label>
                    <iconify-icon icon="pajamas:import" class='text-(--orange_principal) absolute top-15 left-[40%] text-6xl'></iconify-icon>
                    <input 
                        type="file" 
                        id="couverture"
                        name="couverture" 
                        value="Glissez vos images ici ou cliquez pour parcourir — PNG, JPG (fond transparent recommandé)" 
                        class='border-1 
                        border-(--mid_gray)/50 
                        hover:border-(--orange_hover) 
                        hover:border-dashed
                        hover:bg-(--orange_hover)/25
                        focus:bg-(--orange_hover)/25
                        focus:border-dashed
                        focus:outline-none 
                        focus:border-(--orange_hover) 
                        rounded-lg px-4 py-1 mt-2 w-full 
                        min-h-40 
                        bg-(--white_color) '>
                    
                </div> 
            </div> 
    </section>
    </div> 
    <div class='bg-(--mid_gray)/50 w-[80%] h-[1px] self-center'> </div> 
    <div class='flex w-full justify-end gap-5 p-5'>
        <a href=""  class='flex justify-center items-center h-10 border-1 border-(--mid_gray)/50 px-3 uppercase font-semibold hover:border-(--black_color) rounded-lg'>Annuler</a>
        <a href=""  class='flex justify-center items-center h-10 text-(--white_color) bg-(--orange_principal) px-3 uppercase font-semibold hover:bg-(--orange_hover) rounded-lg'>Enregistrer le produit</a>

    </div>
</form>

@endsection