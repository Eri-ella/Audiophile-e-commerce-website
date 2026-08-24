
    <div class='flex flex-col w-full bg-(--broken_white) text-xs gap-5 p-5'>
        <h2 class='uppercase font-semibold text-2xl'>ajouter une catégorie</h2>
        <p class='text-(--mid_gray) text-base sm:pr-5'>Créez une nouvelle catégorie pour les produits de la boutique</p>
        <form method='POST'action={{  }} id="add-category" class='bg-(--white_color) flex flex-col gap-3 p-5 rounded-lg shadow-lg'>
            @csrf
            <div>
                <label for="name" class='font-medium'>Nom de la catégorie</label>
                <input type="text" id="name" name="name" placeholder="Créez une nouvelle catégorie" class='mt-2 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
            </div>
            <div class='w-full flex flex-col'>
                <label for="status" class='font-medium'>Statut</label>
                <select id="status" name="status" class='mt-2 w-full border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                    <option value="" >Active</option>
                    <option value="" >Inactive</option>
                </select> 
            </div>
            <div class='bg-(--mid_gray)/50 w-[80%] h-[1px] my-3 self-center'> </div> 
            <div class='flex w-full justify-end gap-5'>
                <a href=""  class='flex justify-center items-center h-10 border-1 border-(--mid_gray)/50 px-3 uppercase font-semibold hover:border-(--black_color) rounded-lg'>Annuler</a>
                <a href=""  class='flex justify-center items-center h-10 text-(--white_color) bg-(--orange_principal) px-3 uppercase font-semibold hover:bg-(--orange_hover) rounded-lg'>Enregistrer le produit</a>
            </div>
        </form>
    </div> 