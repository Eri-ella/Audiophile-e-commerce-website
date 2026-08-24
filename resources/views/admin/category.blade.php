<div class='bg-(--broken_white) flex flex-col gap-5 p-5'>
    <h2 class='uppercase font-semibold text-2xl'>catégories</h2>
    <p class='text-(--mid_gray) text-base sm:pr-5'>Gérez les catégories des appareils audio de la boutique</p>
    <div class='flex max-[500px]:flex-col items-center justify-between gap-5'>
        <span class='flex max-[700px]:flex-col items-center gap-5'>
            <input type="text" name="search_product" placeholder="Rechercher une catégorie" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 min-w-50 bg-(--white_color) placeholder:text-(--mid_gray)'>
            <select name="all_status"  class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                <option value="" disabled selected>Tous les statuts</option>
                <option value="">Actif</option>
                <option value="">Inactif</option>
            </select>
        </span>
        <span class='flex self-end'>
            <a href=""  class='text-(--white_color) bg-(--orange_principal) uppercase font-semibold hover:bg-(--orange_hover) rounded-lg p-2'>+ Ajouter une catégorie</a>
        </span>
    </div>
    <div class='w-full overflow-hidden rounded-lg bg-(--white_color) border-1 border-gray-400'>
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
                @forelse ($categories as $category)
                    @if($category->id % 2 == 0)
                    <tr class='text-center border border-gray-400 rounded-lg bg-gray-100'>
                    @else
                    <tr class='text-center border border-gray-400 rounded-lg'>
                    @endif
                        <td class='capitalize p-2'>{{ $category->name }}</td>
                        <td>
                            <div class='flex items-center justify-center'>
                                @if($category->status == 'inactive')
                                <div class='flex items-center justify-center uppercase bg-red-200 text-red-400 max-w-25 px-2 rounded-lg'>
                                @else
                                <div class='flex items-center justify-center uppercase bg-green-200 text-green-400 max-w-25 px-2 rounded-lg'>
                                @endif
                                    <iconify-icon icon="icon-park-outline:dot"></iconify-icon>
                                    <span>{{ $category->status }}</span>
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
                        <td colspan="7" class="text-center py-4 text-gray-500">
                            Il n'y a aucun élément dans ce tableau
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>