<div 
    x-data='{ 
        open: false, 
        editOpen: false, 
        editId: null, 
        editName: "", 
        editStatus: "",
        search: "",
        searchStatus: "",
        items: @json($categories),
        get filteredItems() {
            let result = this.items;

            if (this.search){
                result = result.filter(
                    item => item.name.toLowerCase().includes(this.search.toLowerCase())
                );
            }

            if (this.searchStatus !== ""){
                result = result.filter(
                    item => item.status.toLowerCase() === this.searchStatus.toLowerCase()
                );
            }
            return result;
        }
        
    }' 
    class="bg-(--broken_white) flex flex-col gap-5 p-5">

    <h2 class='uppercase font-semibold text-2xl'>catégories</h2>
    <p class='text-(--mid_gray) text-base sm:pr-5'>Gérez les catégories des appareils audio de la boutique</p>

    <div class='flex max-[500px]:flex-col items-center justify-between gap-5'>
        <span class='flex max-[700px]:flex-col items-center gap-5'>
            <input type="text" name="search_product" x-model="search" placeholder="Rechercher une catégorie" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 min-w-50 bg-(--white_color) placeholder:text-(--mid_gray)'>
            <select name="all_status" x-model="searchStatus" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                <option value="">Tous les statuts</option>
                <option value="active">Actif</option>
                <option value="inactive">Inactif</option>
            </select>
        </span>
        <span class='flex self-end'>
            <button @click="open = true" class='text-(--white_color) bg-(--orange_principal) uppercase font-semibold hover:bg-(--orange_hover) rounded-lg p-2'>+ Ajouter une catégorie</button>
        </span>
    </div>

    <div class='w-full overflow-hidden rounded-lg bg-(--white_color) border-1 border-gray-400 shadow-sm'>
        <table class='w-full border-separate border-spacing-2'>
            <thead>
                <tr class="uppercase bg-gray-300">
                    <th class="py-2">catégorie</th>
                    <th class="py-2">statut</th>
                    <th class="py-2"></th>
                    <th class="py-2"></th>
                </tr>
            </thead>
            <tbody>
                <template x-for="item in filteredItems" :key="item.id">
                    <tr :class="item.id % 2 == 0 ? 'text-center border border-gray-400 rounded-lg bg-gray-100' : 'text-center border border-gray-400 rounded-lg'">
                        <td class='capitalize p-2' x-text="item.name"></td>
                        <td>
                            <div class='flex items-center justify-center'>
                                <div class='flex items-center justify-center uppercase w-fit h-fit rounded-lg py-1 px-2 text-xs font-semibold'
                                     :class="item.status === 'inactive' ? 'bg-red-200 text-red-600' : 'bg-green-200 text-green-600'">
                                    <iconify-icon icon="icon-park-outline:dot"></iconify-icon>
                                    <span x-text="item.status"></span>
                                </div>
                            </div>
                        </td>
                        <td class='text-(--mid_gray)'>
                            <button @click="editOpen = true; editId = item.id; editName = item.name; editStatus = item.status" class="cursor-pointer hover:text-blue-500">
                                <iconify-icon icon="streamline-ultimate:pen-write"></iconify-icon>
                            </button>
                        </td>
                        <td class='text-(--mid_gray)'>
                            <form method="POST" :action="'{{ url('category') }}/' + item.id" @submit.prevent="confirm('Êtes-vous sûr ?') && $el.submit()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cursor-pointer hover:text-red-500">
                                    <iconify-icon icon="tabler:trash"></iconify-icon>
                                </button>
                            </form>
                        </td>
                    </tr>
                </template>
                <tr x-show="filteredItems.length === 0">
                    <td colspan="4" class="text-center py-4 text-gray-500">
                        Il n'y a aucun élément dans ce tableau
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div x-show="open" 
        x-transition
        class='fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 rounded-lg'
        style="display: none;"> 
        <div @click.away="open = false" class='flex flex-col bg-(--broken_white) gap-5 p-5 rounded-lg'>
            <div>
                <h2 class='uppercase font-semibold text-2xl'>ajouter une catégorie</h2>
                <p class='text-(--mid_gray) text-base sm:pr-5'>Créez une nouvelle catégorie pour les produits de la boutique</p>
            </div>
            <form method='POST' action={{ route('admin.add-category') }} id="add-category" class='bg-(--white_color) flex flex-col gap-3 p-5 rounded-lg shadow-sm'>
                @csrf
                <div>
                    <label for="name" class='font-medium'>Nom de la catégorie</label>
                    <input type="text" id="name" name="name" placeholder="Créez une nouvelle catégorie" class='mt-2 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
                </div>
                <div class='w-full flex flex-col'>
                    <label for="status" class='font-medium'>Statut</label>
                    <select id="status" name="status" class='mt-2 w-full border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                        <option value="active" >Active</option>
                        <option value="inactive" >Inactive</option>
                    </select> 
                </div>
                <div class='bg-(--mid_gray)/50 w-[80%] h-[1px] my-3 self-center'> </div> 
                <div class='flex w-full justify-end gap-5'>
                    <input type="button" x-on:click="open = false" class='flex justify-center items-center h-10 border-1 border-(--mid_gray)/50 px-3 uppercase font-semibold hover:border-(--black_color) rounded-lg cursor-pointer' value='Annuler'>
                    <input type="submit" class='flex justify-center items-center h-10 text-(--white_color) bg-(--orange_principal) px-3 uppercase font-semibold hover:bg-(--orange_hover) rounded-lg cursor-pointer' value='Enregistrer la categorie'>
                </div>
            </form>
        </div> 
    </div>

    <div x-show="editOpen" 
        x-transition
        class='fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 rounded-lg'
        style="display: none;"> 
        <div @click.away="editOpen = false" class='flex flex-col bg-(--broken_white) gap-5 p-5 rounded-lg'>
            <div>
                <h2 class='uppercase font-semibold text-2xl'>Modifier la catégorie</h2>
                <p class='text-(--mid_gray) text-base sm:pr-5'>Modifier cette catégorie pour qu'elle corresponde à la vision de la boutique</p>
            </div>
            <form method='POST' :action="'/category/' + editId" id="edit-category" class='bg-(--white_color) flex flex-col gap-3 p-5 rounded-lg shadow-sm'>
                @csrf
                @method('PUT')
                <div>
                    <label for="edit_name" class='font-medium'>Nom de la catégorie</label>
                    <input type="text" id="edit_name" name="name" x-model="editName" class='mt-2 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
                </div>
                <div class='w-full flex flex-col'>
                    <label for="edit_status" class='font-medium'>Statut</label>
                    <select id="edit_status" name="status" x-model="editStatus" class='mt-2 w-full border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                        <option value="active" >Active</option>
                        <option value="inactive" >Inactive</option>
                    </select> 
                </div>
                <div class='bg-(--mid_gray)/50 w-[80%] h-[1px] my-3 self-center'></div> 
                <div class='flex w-full justify-end gap-5'>
                    <input type="button" x-on:click="editOpen = false" class='flex justify-center items-center h-10 border-1 border-(--mid_gray)/50 px-3 uppercase font-semibold hover:border-black rounded-lg cursor-pointer' value='Annuler'>
                    <input type="submit" class='flex justify-center items-center h-10 text-(--white_color) bg-(--orange_principal) px-3 uppercase font-semibold hover:bg-(--orange_hover) rounded-lg' value='Enregistrer le produit'>
                </div>
            </form>
        </div> 
    </div>

    @if(session('success'))
    <div x-data="{ show: false }" 
        x-init="setTimeout(() => show = true, 50); setTimeout(() => show = false, 4000)" 
        x-show="show" 
        x-transition:enter="transition ease-out duration-500 transform"
        x-transition:enter-start="translate-x-full opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transition ease-in duration-300 transform"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="translate-x-full opacity-0"
        class="fixed top-18 right-5 z-50"
        style="display: none;"> 

        <div class='flex justify-between items-center max-w-85 gap-2 bg-white rounded-lg shadow-sm overflow-hidden'>
            <div class='w-3 h-20 bg-(--orange_principal)'></div>
            <div>
                <div class='bg-(--orange_principal) text-(--white_color) p-2 flex items-center justify-center rounded-full'>
                    <iconify-icon icon="fluent-mdl2:accept-medium" class='text-sm'></iconify-icon>
                </div>
            </div>
            <div class='py-2'>
                <h4 class='font-semibold'>Succès</h4>
                <p class='text-(--mid_gray) text-sm sm:pr-5'>{{ session('success') }}</p>
            </div>
            <div class='self-start py-2 pr-2'>
                <iconify-icon icon="akar-icons:cross" class='text-sm cursor-pointer' @click="show = false"></iconify-icon>
            
            </div>
        </div>
    </div>
    @endif
</div>
