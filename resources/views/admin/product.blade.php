<div 
    x-data='{ 
        open: false, 
        editOpen: false, 
        editId: null, 
        editName: "", 
        editStatus: "",
        editPrice: "",
        editStock: "",
        editCategory: "",
        editDescription: "",
        editFeatures: "",
        editImageCouverture: "",
        editImage1: "",
        editImage2: "",
        editImage3: "",
        editContents: [],
        newContents: [{ content: "", quantity: 1 }],
        search: "",
        searchStatus: "",
        searchCategory: "",
        items: @json($products),
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

            if (this.searchCategory !== ""){
                result = result.filter(
                    item => item.categories.id == this.searchCategory
                );
            }
            return result;
        }
    }' 
    class="bg-(--broken_white) flex flex-col gap-5 p-5">
    <h2 class='uppercase font-semibold text-2xl'>Produits</h2>
    <p class='text-(--mid_gray) text-base sm:pr-5'>Gérez le catalogue d'appareils audio de la boutique</p> 
    <div class='w-full grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-5'>
        <span>
            <input type="text" name="search_product" x-model="search" placeholder="Rechercher un produit" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
        </span>
        <span>
            <select name="all_categories" x-model="searchCategory" class='w-full border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                <option value="" selected>Toutes les catégories</option>
                @foreach ($categories as $category)
                    <option value={{ $category->id }} class='capitalize' >{{ $category->name }}</option>
                @endforeach
            </select>
        </span>
        <span>
            <select name="all_status" x-model="searchStatus"  class='w-full border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                <option value="" selected>Tous les statuts</option>
                <option value="active" >Active</option>
                <option value="inactive" >Inactive</option>
            </select>
        </span>
        <span class='place-self-end'>
            <p @click="open = true" class='product-clicker p-2 text-(--white_color) bg-(--orange_principal) uppercase font-semibold hover:bg-(--orange_hover) rounded-lg cursor-pointer'>+ Ajouter un appareil</p>
        </span>
    </div>
    <div class='w-full rounded-lg bg-(--white_color) overflow-hidden shadow-sm'>
        <table class='w-full border-separate border-spacing-2'>
            <thead>
                <tr class="uppercase bg-gray-300">
                    <th class="py-2">produit</th>
                    <th class="py-2">catégorie</th>
                    <th class="py-2">prix</th>
                    <th class="py-2">stock</th>
                    <th class="py-2">statut</th>
                    <th class="py-2"></th>
                    <th class="py-2"></th>
                </tr>
            </thead>
            <tbody>
               <template x-for="item in filteredItems" :key="item.id">
                    <tr :class="item.id % 2 == 0 ? 'text-center border border-gray-400 rounded-lg bg-gray-100' : 'text-center border border-gray-400 rounded-lg'">
                        <td class='p-2 flex items-center gap-2 my-2 ml-2'>
                            <span class='bg-(--mid_gray)/25 size-10 flex items-center justify-center rounded-lg'>
                                <iconify-icon icon="ri:headphone-line"></iconify-icon>
                            </span>
                            <span class='flex flex-col text-xs text-start capitalize'>
                                <span class='font-medium' x-text="item.name"></span>
                                <span class='font-light'>RÉF. <span x-text="item.id"></span></span>
                            </span>
                        </td>
                        <td class='capitalize' x-text="item.categories.name"></td>
                        <td>$<span x-text="item.price"></span></td>
                        <td x-text="item.stock"></td>
                        <td>
                            <div class='flex items-center justify-center'>
                                <div class='flex items-center justify-center uppercase w-fit h-fit rounded-lg py-1 px-2 text-xs font-semibold' 
                                     :class="item.status == 'inactive' ? 'bg-red-200 text-red-600' : 'bg-green-200 text-green-600'">
                                    <iconify-icon icon="icon-park-outline:dot"></iconify-icon>
                                    <span x-text="item.status"></span>
                                </div>
                            </div>
                        </td>
                        <td class='text-(--mid_gray)'>
                            <button 
                                @click="editOpen = true; 
                                editId = item.id; 
                                editName = item.name; 
                                editStatus = item.status
                                editPrice = item.price;
                                editStock = item.stock;
                                editCategory = item.categories.id;
                                editDescription = item.description;
                                editFeatures = item.features;
                                editImageCouverture = item.image_description;
                                editImage1 = item.image_1;
                                editImage2 = item.image_2;
                                editImage3 = item.image_3;
                                editContents = item.contents.map(c => ({ content: c.name, quantity: c.pivot.value }));"                                
                                class="cursor-pointer hover:text-blue-500">                                
                                <iconify-icon icon="streamline-ultimate:pen-write"></iconify-icon>
                            </button>
                        </td>
                        <td class='text-(--mid_gray)'>
                            <form method="POST" :action="'{{ url('product') }}/' + item.id + '/toggle'" @submit.prevent="$el.submit()">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="cursor-pointer hover:text-orange-500">
                                    <iconify-icon icon="material-symbols:settings-outline"></iconify-icon>
                                </button>
                            </form>
                        </td>
                    </tr>
                </template>
                 <tr x-show="filteredItems.length === 0">
                    <td colspan="7" class="text-center py-4 text-gray-500">
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
        <div @click.away="open = false" class='flex flex-col bg-(--broken_white) gap-5 p-5 h-100 overflow-y-scroll rounded-lg'>
            <div>
                <p class='text-(--mid_gray) uppercase font-semibold text-xs'>Produit /<span class='text-(--orange_principal)'> Ajouter un appareil</span></p>
                <h2 class='uppercase font-semibold text-2xl'>ajouter un appareil</h2>
                <p class='text-(--mid_gray) text-base sm:pr-5'>Créez une nouvelle fiche produit visible sur la boutique</p>
            </div>
            <form method='POST' action={{ route('admin.add-product') }} class='flex flex-col gap-2' enctype="multipart/form-data">
                @csrf
                <div class='flex flex-col w-full bg-(--broken_white) gap-3 p-5'>
                    <section class='w-full grow-2 flex flex-col gap-3'>
                        <div class='bg-(--white_color) flex flex-col gap-3 p-5 rounded-lg shadow-sm'>
                            <div class='flex flex-col gap-3'>
                                <p class='uppercase text-(--mid_gray) font-medium'>informations générales</p>
                                <div>
                                    <label for="name" class='font-medium'>Nom du produit</label>
                                    <input type="text" id="name" name="name" required placeholder="Créez une nouvelle fiche produit visible sur la boutique" class='mt-2 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
                                </div>
                                <div class='flex gap-5 w-full'>
                                    <div class='w-full flex flex-col'>
                                        <label for="category" class='font-medium'>Catégorie</label>
                                        <select id="category" name="category" class='mt-2 w-full border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                                            @foreach ($categories as $category)
                                                <option value={{ $category->id }} class='capitalize' >{{ $category->name }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                    <div class='w-full flex flex-col'>
                                        <label for="status" class='font-medium'>Statut</label>
                                        <select id="status" name="status" class='mt-2 w-full border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                                            <option value="active" >Active</option>
                                            <option value="inactive" >Inactive</option>
                                        </select> 
                                    </div>
                                </div>
                                <div class='flex gap-5 w-full'>
                                    <div class='w-full flex flex-col'>
                                        <label for="price" class='font-medium'>Prix</label>
                                        <input type="number" id="price" required name="price" placeholder="1800" class='mt-2 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
                                    </div>
                                    <div class='w-full flex flex-col'>
                                        <label for="stock" class='font-medium'>Stock disponible</label>
                                        <input type="number" id="stock" required name="stock" placeholder="40" class='mt-2 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
                                    </div>
                                </div>
                                <p class='uppercase' class='uppercase text-(--mid_gray) font-medium'>description</p>
                                <div>
                                    <label for="description" class='font-medium'>Description courte</label>
                                    <textarea type="text" id="description" required name="description" placeholder="Créez une nouvelle fiche produit visible sur la boutique" class='mt-2 min-h-20 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'></textarea>
                                </div>
                                <div>
                                    <label for="caracteristque" class='font-medium'>Caractéristiques détaillées</label>
                                    <textarea type="text" id="caracteristque" required name="caracteristque" placeholder="Créez une nouvelle fiche produit visible sur la boutique" class='mt-2 min-h-30 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'></textarea>
                                </div>
                                <p class='uppercase' class='uppercase text-(--mid_gray) font-medium'>contenu de la boîte</p>
                                <div>
                                    <div>
                                        <template x-for="(box, index) in newContents" :key="index">
                                            <div class='flex items-center gap-3 mb-3'>
                                                <input type="number" name="quantities[]" x-model="box.quantity" min="1"
                                                    class='border-1 border-(--mid_gray)/50 rounded-lg px-4 py-1 w-20 bg-(--white_color)'>
                                                <input type="text" name="contents[]" x-model="box.content" placeholder="Ex. Manuel d'utilisation"
                                                    class='border-1 border-(--mid_gray)/50 rounded-lg px-4 py-1 w-full bg-(--white_color)'>
                                                <iconify-icon icon="tabler:trash" @click="newContents.splice(index, 1)"
                                                            class='text-(--mid_gray)/75 text-xl hover:text-red-500 cursor-pointer'></iconify-icon>
                                            </div>
                                        </template>
                                        <p @click="newContents.push({ content: '', quantity: 1 })" 
                                        class='text-(--orange_principal) uppercase font-semibold cursor-pointer'>+ Ajouter une ligne</p>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </section>    
                    <section class='w-full h-fit flex flex-col gap-3 bg-(--white_color) flex flex-col gap-3 p-5 rounded-lg shadow-sm'>
                        <p  class='uppercase text-(--mid_gray) font-medium'>visuels du produit</p>
                        <x-image-upload title="Image de couverture" name="couverture" />
                        <x-image-upload title="Image 1" name="image1" />
                        <x-image-upload title="Image 2" name="image2" />
                        <x-image-upload title="Image 3" name="image3" />
                    </section>
                </div> 
                <div class='flex w-full justify-end gap-5 p-5'>
                    <input type="button" x-on:click="open = false" class='flex justify-center items-center h-10 border-1 border-(--mid_gray)/50 px-3 uppercase font-semibold hover:border-(--black_color) rounded-lg cursor-pointer' value='Annuler'>
                    <input type="submit" class='flex justify-center items-center h-10 text-(--white_color) bg-(--orange_principal) px-3 uppercase font-semibold hover:bg-(--orange_hover) rounded-lg cursor-pointer' value='Enregistrer le produit'>
                </div>
            </form>
            <script>
                // const inputFichier = document.getElementById('couverture');
                // const nomFichier = document.getElementById('nom-fichier');

                // inputFichier.addEventListener('change', function() {
                // if (inputFichier.files.length > 0) {
                //     nomFichier.textContent = inputFichier.files[0].name;
                // } else {
                //     nomFichier.textContent = 'Aucun fichier choisi';
                // }
                // });

                // function addContentBox() {
                //     const box = document.querySelector('.box');
                    
                //     const clone = box.cloneNode(true);
                    
                //     clone.querySelector('input[type="number"]').value = 1;
                //     clone.querySelector('input[type="text"]').value = '';
                //     const trash = clone.querySelector('iconify-icon');
                //     trash.addEventListener('click', function()  {
                //         this.closest('.box').remove();
                //     })
                //     box.parentNode.insertBefore(clone, box.nextSibling);
                //     // box.insertAdjacentHTML('afterend', clone);
                // }
            </script>
        </div>
    </div>

    <div x-show="editOpen" 
        x-transition
        class='fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 rounded-lg'
        style="display: none;"> 
        <div @click.away="editOpen = false" class='flex flex-col bg-(--broken_white) gap-5 p-5 h-100 overflow-y-scroll rounded-lg'>
            <div>
                <p class='text-(--mid_gray) uppercase font-semibold text-xs'>Produit /<span class='text-(--orange_principal)'> Ajouter un appareil</span></p>
                <h2 class='uppercase font-semibold text-2xl'>ajouter un appareil</h2>
                <p class='text-(--mid_gray) text-base sm:pr-5'>Créez une nouvelle fiche produit visible sur la boutique</p>
            </div>
            <form method='POST' :action="'/product/' + editId" id="edit-product" enctype="multipart/form-data" class='bg-(--white_color) flex flex-col gap-3 p-5 rounded-lg shadow-sm'>
                @csrf
                @method('PUT')
                <div class='flex flex-col w-full bg-(--broken_white) gap-3 p-5'>
                    <section class='w-full grow-2 flex flex-col gap-3'>
                        <div class='bg-(--white_color) flex flex-col gap-3 p-5 rounded-lg shadow-sm'>
                            <div class='flex flex-col gap-3'>
                                <p class='uppercase text-(--mid_gray) font-medium'>informations générales</p>
                                <div>
                                    <label for="name" class='font-medium'>Nom du produit</label>
                                    <input type="text" id="name" name="name" x-model="editName" required placeholder="Créez une nouvelle fiche produit visible sur la boutique" class='mt-2 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
                                </div>
                                <div class='flex gap-5 w-full'>
                                    <div class='w-full flex flex-col'>
                                        <label for="category" class='font-medium'>Catégorie</label>
                                        <select id="category" name="category" x-model="editCategory" class='mt-2 w-full border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                                            @foreach ($categories as $category)
                                                <option value={{ $category->id }} class='capitalize' >{{ $category->name }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                    <div class='w-full flex flex-col'>
                                        <label for="status" class='font-medium'>Statut</label>
                                        <select id="status" name="status" x-model="editStatus" class='mt-2 w-full border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                                            <option value="active" >Active</option>
                                            <option value="inactive" >Inactive</option>
                                        </select> 
                                    </div>
                                </div>
                                <div class='flex gap-5 w-full'>
                                    <div class='w-full flex flex-col'>
                                        <label for="price" class='font-medium'>Prix</label>
                                        <input type="number" id="price" x-model="editPrice" required name="price" placeholder="1800" class='mt-2 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
                                    </div>
                                    <div class='w-full flex flex-col'>
                                        <label for="stock" class='font-medium'>Stock disponible</label>
                                        <input type="number" id="stock" x-model="editStock" required name="stock" placeholder="40" class='mt-2 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
                                    </div>
                                </div>
                                <p class='uppercase' class='uppercase text-(--mid_gray) font-medium'>description</p>
                                <div>
                                    <label for="description" class='font-medium'>Description courte</label>
                                    <textarea type="text" id="description" x-model="editDescription" required name="description" placeholder="Créez une nouvelle fiche produit visible sur la boutique" class='mt-2 min-h-20 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'></textarea>
                                </div>
                                <div>
                                    <label for="caracteristque" class='font-medium'>Caractéristiques détaillées</label>
                                    <textarea type="text" id="caracteristque" x-model="editFeatures" required name="caracteristque" placeholder="Créez une nouvelle fiche produit visible sur la boutique" class='mt-2 min-h-30 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'></textarea>
                                </div>
                                <p class='uppercase' class='uppercase text-(--mid_gray) font-medium'>contenu de la boîte</p>
                                <div>
                                    <div>
                                        <template x-for="(box, index) in editContents" :key="index">
                                            <div class='flex items-center gap-3 mb-3'>
                                                <input type="number" name="quantities[]" x-model="box.quantity" min="1"
                                                    class='border-1 border-(--mid_gray)/50 rounded-lg px-4 py-1 w-20 bg-(--white_color)'>
                                                <input type="text" name="contents[]" x-model="box.content" placeholder="Ex. Manuel d'utilisation"
                                                    class='border-1 border-(--mid_gray)/50 rounded-lg px-4 py-1 w-full bg-(--white_color)'>
                                                <iconify-icon icon="tabler:trash" @click="editContents.splice(index, 1)"
                                                            class='text-(--mid_gray)/75 text-xl hover:text-red-500 cursor-pointer'></iconify-icon>
                                            </div>
                                        </template>
                                        <p @click="editContents.push({ content: '', quantity: 1 })" 
                                        class='text-(--orange_principal) uppercase font-semibold cursor-pointer'>+ Ajouter une ligne</p>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </section>    
                    <section class='w-full h-fit flex flex-col gap-3 bg-(--white_color) flex flex-col gap-3 p-5 rounded-lg shadow-sm'>
                        <p  class='uppercase text-(--mid_gray) font-medium'>visuels du produit</p>
                        <x-image-upload title="Image de couverture" name="couverture" :required="false" preview="editCouverture" />
                        <x-image-upload title="Image 1" name="image1" :required="false" preview="editImage1" />
                        <x-image-upload title="Image 2" name="image2" :required="false" preview="editImage2" />
                        <x-image-upload title="Image 3" name="image3" :required="false" preview="editImage3" />
                    </section>
                </div> 
                <div class='flex w-full justify-end gap-5 p-5'>
                    <input type="button" x-on:click="editOpen = false" class='flex justify-center items-center h-10 border-1 border-(--mid_gray)/50 px-3 uppercase font-semibold hover:border-(--black_color) rounded-lg cursor-pointer' value='Annuler'>
                    <input type="submit" class='flex justify-center items-center h-10 text-(--white_color) bg-(--orange_principal) px-3 uppercase font-semibold hover:bg-(--orange_hover) rounded-lg cursor-pointer' value='Enregistrer le produit'>
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
