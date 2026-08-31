<div 
    x-data='{ 
        search: "",
        searchStatus: "",
        searchPayment: "",
        items: @json($orders),
        
        get filteredItems() {
            let result = this.items;

            if (this.search){
                let query = this.search.toLowerCase();
                result = result.filter(item => {
                    let clientName = item.user && item.user.name ? item.user.name.toLowerCase() : "";
                    let clientEmail = item.user && item.user.email ? item.user.email.toLowerCase() : "";
                    return clientName.includes(query) || clientEmail.includes(query);
                });
            }

            if (this.searchStatus) {
                result = result.filter(item => item.status === this.searchStatus);
            }

            if (this.searchPayment) {
                result = result.filter(item => item.payment && item.payment.type === this.searchPayment);
            }

            return result;
        }
    }' 
    class='bg-(--broken_white) flex flex-col gap-3 p-5'>
    
    <div class='flex justify-between'>
        <span>
            <h2 class='uppercase font-semibold text-2xl'>transactions</h2>
            <p class='text-(--mid_gray) text-base sm:pr-5'>Historique des paiements de tous les clients</p>
        </span>
        <span>
            <a href="" class='flex justify-center items-center px-3 py-2 border-1 border-gray-200 uppercase font-semibold hover:bg-gray-100 rounded-lg'>Exporter en csv</a>
        </span>
    </div>

    <div class='flex gap-5 flex-wrap'>
        <span>
            <input x-model="search" type="text" placeholder="Rechercher un utilisateur" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 min-w-50 bg-(--white_color) placeholder:text-(--mid_gray)'>
        </span>
        <span>
            <select x-model="searchStatus" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color)'>
                <option value="">Tous les statuts</option>
                <option value="confirmé">Confirmé</option>
                <option value="en attente">En attente</option>
            </select>
        </span>
        <span>
            <select x-model="searchPayment" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color)'>
                <option value="">Tous les moyens de paiement</option>
                <option value="e-money">e-Money</option>
                <option value="cash">Cash on delivery</option>
            </select>
        </span>
    </div>

    <div class='w-full rounded-lg bg-(--white_color) border-1 border-gray-200 shadow-sm'>
        <table class='w-full border-separate border-spacing-2'>
            <thead>
                <tr class="uppercase bg-gray-300">
                    <th class="py-2">n° commande</th>
                    <th class="py-2">client</th>
                    <th class="py-2">date</th>
                    <th class="py-2">montant</th>
                    <th class="py-2">paiement</th>
                    <th class="py-2">statut</th>
                    <th class="py-2"></th>
                </tr>
            </thead>
            <tbody>
                <template x-for="item in filteredItems" :key="item.id">
                    <tr :class="item.id % 2 == 0 ? 'text-center border border-gray-400 rounded-lg bg-gray-100' : 'text-center border border-gray-400 rounded-lg'">
                        <td class='p-2 '>
                            <span class='font-medium'>#<span x-text="item.id"></span></span>
                        </td>
                        <td class='capitalize'>
                            <span x-text="item.client ? item.client.email : '-'"></span>
                            <div class='text-xs text-gray-400 normal-case' x-text="item.user ? item.user.email : ''"></div>
                        </td>
                        <td x-text="new Date(item.created_at).toLocaleDateString('fr-FR', {day: '2-digit', month: '2-digit', year: '2-digit'})"></td>
                        <td>$<span x-text="parseFloat(item.amount).toFixed(2)"></span></td>
                        <td>
                            <div class='flex items-center justify-center'>
                                <div class='flex items-center justify-center uppercase w-fit h-fit rounded-lg py-1 px-2 text-xs font-semibold'
                                     :class="item.payment && item.payment.type === 'cash' ? 'bg-blue-200 text-blue-600' : 'bg-cyan-200 text-cyan-600'">
                                    <iconify-icon icon="icon-park-outline:dot"></iconify-icon>
                                    <span class="ml-1" x-text="item.payment ? item.payment.type : 'N/A'"></span>
                                </div>
                            </div>
                        </td>                        
                        <td>
                            <div class='flex items-center justify-center'>
                                <div class='flex items-center justify-center uppercase w-fit h-fit rounded-lg py-1 px-2 text-xs font-semibold'
                                     :class="item.status === 'en attente' ? 'bg-orange-200 text-orange-600' : 'bg-green-200 text-green-600'">                                    
                                    <iconify-icon icon="icon-park-outline:dot"></iconify-icon>
                                    <span class="ml-1" x-text="item.status"></span>
                                </div>
                            </div>
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
</div>
