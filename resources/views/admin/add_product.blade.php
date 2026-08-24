<div class='flex flex-col w-full bg-(--broken_white) gap-5 p-5'>
    <p class='text-(--mid_gray) uppercase font-semibold text-xs'>Produit /<span class='text-(--orange_principal)'> Ajouter un appareil</span></p>
    <h2 class='uppercase font-semibold text-2xl'>ajouter un appareil</h2>
    <p class='text-(--mid_gray) text-base sm:pr-5'>Créez une nouvelle fiche produit visible sur la boutique</p>
</div>
<form method='POST' class='flex flex-col gap-2'>
    @csrf
    <div class='flex max-[1000px]:flex-col w-full bg-(--broken_white) gap-3 p-5'>
        <section class='w-full grow-2 flex flex-col gap-3'>
            <div class='bg-(--white_color) flex flex-col gap-3 p-5 rounded-lg shadow-sm'>
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
                        <a href=""  class='text-(--orange_principal) uppercase font-semibold '>+ Ajouter une ligne</a>
                    </div>
                </div>
            </div>    
        </section>    
        <section class='w-full h-fit flex flex-col gap-3 bg-(--white_color) flex flex-col gap-3 p-5 rounded-lg shadow-sm'>
            <p  class='uppercase text-(--mid_gray) font-medium'>visuels du produit</p>
            <div class='flex flex-col gap-5'> 
                <p  class=''>Image de couverture</p>
                <div class='grid grid-cols-2'>
                    <div class='relative mb-10'>
                        <label for="couverture" class='flex bg-(--orange_principal) text-white px-5 py-2 font-medium absolute uppercase rounded-lg'>
                            <iconify-icon icon="material-symbols:upload" class='text-xl mr-2'></iconify-icon>
                            Upload File</label>
                        <input 
                            type="file" 
                            id="couverture"
                            name="couverture" 
                            class='absolute z-10 hidden'>
                    </div>
                    <span id="nom-fichier">Aucun fichier choisi</span>
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
<script>
    const inputFichier = document.getElementById('couverture');
    const nomFichier = document.getElementById('nom-fichier');

    inputFichier.addEventListener('change', function() {
    if (inputFichier.files.length > 0) {
        nomFichier.textContent = inputFichier.files[0].name;
    } else {
        nomFichier.textContent = 'Aucun fichier choisi';
    }
    });
</script>
