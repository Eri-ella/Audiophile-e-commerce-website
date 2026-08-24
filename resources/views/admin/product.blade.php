<div class='bg-(--broken_white) flex flex-col gap-5 p-5'>
    <h2 class='uppercase font-semibold text-2xl'>Produits</h2>
    <p class='text-(--mid_gray) text-base sm:pr-5'>Gérez le catalogue d'appareils audio de la boutique</p> 
    <div class='w-full grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-5'>
        <span>
            <input type="text" name="search_product" placeholder="Rechercher un produit" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 min-w-50 bg-(--white_color) placeholder:text-(--mid_gray)'>
        </span>
        <span>
            <select name="all_categories" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                <option value="" disabled selected>Toutes les catégories</option>
                @foreach ($categories as $category)
                    <option value="" class='capitalize' >{{ $category->name }}</option>
                @endforeach
            </select>
        </span>
        <span>
            <select name="all_status"  class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                <option value="" disabled selected>Tous les statuts</option>
                <option value="">En stock</option>
                <option value="">En rupture</option>
            </select>
        </span>
        <span class='place-self-end'>
            <p class='product-clicker p-2 text-(--white_color) bg-(--orange_principal) uppercase font-semibold hover:bg-(--orange_hover) rounded-lg cursor-pointer'>+ Ajouter un appareil</p>
        </span>
    </div>
    <div class='w-full rounded-lg bg-(--white_color) overflow-hidden'>
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
                @forelse ($products as $product)
                    @if($product->id % 2 == 0)
                    <tr class='text-center border border-gray-400 rounded-lg bg-gray-100'>
                    @else
                    <tr class='text-center border border-gray-400 rounded-lg'>
                    @endif
                        <td class='p-2 flex items-center gap-2 my-2 ml-2'>
                            <span class='bg-(--mid_gray)/25 size-10 flex items-center justify-center rounded-lg'>
                                <iconify-icon icon="ri:headphone-line"></iconify-icon>
                            </span>
                            <span class='flex flex-col text-xs'>
                                <span class='font-medium'>{{ $product->name }}</span>
                                <span class='font-light'>RÉF. <span>{{ $product->id }}</span></span>
                            </span>
                        </td>
                        <td class='capitalize'>{{ $product->categories->name }}</td>
                        <td>$<span>{{ $product->price }}</span></td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <div class='flex items-center justify-center'>
                                @if($product->status == 'en attente')
                                <div class='flex items-center justify-center uppercase bg-red-200 text-red-400 max-w-25 rounded-lg'>
                                @else
                                <div class='flex items-center justify-center uppercase bg-green-200 text-green-400 max-w-25 rounded-lg'>
                                @endif
                                    <iconify-icon icon="icon-park-outline:dot"></iconify-icon>
                                    <span>{{ $product->status }}</span>
                                </div>
                            </div>
                        </td>
                        <td class='text-(--mid_gray)'>
                            <iconify-icon icon="streamline-ultimate:pen-write" class=''></iconify-icon>
                        </td>
                        <td class='text-(--mid_gray)'>
                            <iconify-icon icon="tabler:trash" class=''></iconify-icon>
                        </td>
                    </tr>
                @empty
                    <tr>
                        Il n'y aucun element dans ce tableau
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>