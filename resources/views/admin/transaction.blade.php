<div class='bg-(--broken_white) flex flex-col gap-5 p-5'>
    <div class='flex justify-between'>
        <span>
            <h2 class='uppercase font-semibold text-2xl'>transactions</h2>
            <p class='text-(--mid_gray) text-base sm:pr-5'>Historique des paiements de tous les clients</p>
        </span>
        <span>
            <a href=""  class='flex justify-center items-center px-3 py-2 border-1 border-gray-200 uppercase font-semibold hover:bg-gray-100 rounded-lg'>Exporter en csv</a>
        </span>
    </div>
    <div class='flex gap-5 flex-wrap'>
        <span>
            <input type="text" name="search_product" placeholder="Rechercher une commande" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 min-w-60 bg-(--white_color) placeholder:text-(--mid_gray)'>
        </span>
        <span>
            <select name="all_categories" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                <option value="" disabled selected>Tous les statuts</option>
                <option value="" >Payée</option>
                <option value="" >En attente</option>
            </select>
        </span>
        <span>
            <select name="all_status"  class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-2 py-1 bg-(--white_color) placeholder:text-(--mid_gray)'>
                <option value="" disabled selected>Tous les moyens de paiement</option>
                <option value="">e-Money</option>
                <option value="">Cash on delivery</option>
            </select>
        </span>
    </div>
    <div class='w-full rounded-lg bg-(--white_color) border-1 border-gray-200'>
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
                @forelse ($orders as $order)
                    @if($order->id % 2 == 0)
                    <tr class='text-center border border-gray-400 rounded-lg bg-gray-100'>
                    @else
                    <tr class='text-center border border-gray-400 rounded-lg'>
                    @endif
                        <td class='p-2 '>
                            <span class='font-medium'>#<span>{{ $order->id }}</span>
                        </td>
                        <td class='capitalize'>{{ $order->client->email  }}</td>
                        <td>{{ $order->created_at->format('d/m/y') }}</td>
                        <td>$<span>{{ $order->amount }}</span></td>
                        <td>
                            <div class='flex items-center justify-center'>
                                @if($order->payment->type == 'cash')
                                <div class='flex items-center justify-center uppercase bg-blue-200 text-blue-400 w-fit h-fit rounded-lg py-1 px-2 text-xs font-semibold'>
                                @else
                                <div class='flex items-center justify-center uppercase bg-cyan-200 text-cyan-400 w-fit h-fit rounded-lg py-1 px-2 text-xs font-semibold'>
                                @endif
                                    <iconify-icon icon="icon-park-outline:dot"></iconify-icon>
                                    <span class="ml-1">{{ $order->payment->type }}</span>
                                </div>
                            </div>
                        </td>                        
                        <td>
                            <div class='flex items-center justify-center'>
                                @if($order->status == 'en attente')
                                <div class='flex items-center justify-center uppercase bg-orange-200 text-orange-400 w-fit h-fit rounded-lg py-1 px-2 text-xs font-semibold'>                                    
                                @else
                                <div class='flex items-center justify-center uppercase bg-green-200 text-green-400 w-fit h-fit rounded-lg py-1 px-2 text-xs font-semibold'>
                                @endif                                <iconify-icon icon="icon-park-outline:dot"></iconify-icon>
                                <span class="ml-1">{{ $order->status }}</span>
                                </div>
                            </div>
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
