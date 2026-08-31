<div 
    x-data='{ 
        search: "",
        items: @json($users),
        get filteredItems() {
            let result = this.items;

            if (this.search){
                let query = this.search.toLowerCase();
                result = result.filter(item => {
                    let nameMatch = item.name ? item.name.toLowerCase().includes(query) : false;
                    let emailMatch = item.email ? item.email.toLowerCase().includes(query) : false;
                    return nameMatch || emailMatch;
                });
            }

            return result;
        }

    }' 
    class='bg-(--broken_white) flex flex-col gap-3 p-5'>
    <h2 class='uppercase font-semibold text-2xl'>utilisateurs</h2>
    <p class='text-(--mid_gray) text-base sm:pr-5'>Clients inscrits sur la boutique</p>
    <div class='flex gap-5'>
        <span>
            <input x-model="search" type="text" name="search_product" placeholder="Rechercher un utilisateur" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 min-w-50 bg-(--white_color) placeholder:text-(--mid_gray)'>
        </span>
    </div>
    <div class='w-full rounded-lg bg-(--white_color) overflow-hidden'>
        <table class='w-full border-separate border-spacing-2'>
            <thead>
                <tr class="uppercase bg-gray-300">
                    <th class="py-2">client</th>
                    <th class="py-2">e-mail</th>
                    <th class="py-2">telephone</th>
                    <th class="py-2">commandes</th>
                    <th class="py-2">total dépensé</th>
                    <th class="py-2">dernière commande</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="item in filteredItems" :key="item.id">
                    <tr :class="item.id % 2 == 0 ? 'text-center border border-gray-400 rounded-lg bg-gray-100' : 'text-center border border-gray-400 rounded-lg'">
                        <td class=' p-2 flex items-center gap-2 my-2 ml-2'>
                            <span class='bg-(--black_color) text-(--white_color) font-medium size-10 flex items-center justify-center rounded-full'>
                                <span x-text="item.name ? item.name.split(' ').map(w => w.charAt(0)).join('') : ''"></span>
                            </span>
                            <span class='font-medium capitalize' x-text="item.name"></span>
                        </td>
                        <td class='' x-text="item.email"></td>
                        <td class='' x-text="item.telephone"></td>
                        
                        <td x-text="item.orders ? item.orders.length : 0"></td>
                        
                        <td>$<span x-text="item.orders ? item.orders.reduce((sum, o) => sum + parseFloat(o.amount || 0), 0).toFixed(2) : '0.00'"></span></td>
                        
                        <td x-text="item.orders && item.orders.length ? new Date(item.orders[item.orders.length - 1].created_at).toLocaleDateString('fr-FR', {day: '2-digit', month: '2-digit', year: '2-digit'}) : '-'"></td>
                    </tr>
                </template>
                
                <tr x-show="filteredItems.length === 0">
                    <td colspan="6" class="text-center py-4 text-(--mid_gray)">
                        Il n'y a aucun élément dans ce tableau
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
