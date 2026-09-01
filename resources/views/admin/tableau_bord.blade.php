@vite(['public/js/admin.js'])

<div class='bg-(--broken_white) flex flex-col gap-3 p-5 bg-(--broken_white)'>
    <div>
        <h2 class='uppercase font-semibold text-2xl'>tableau de bord</h2>
        <p class='text-(--mid_gray) text-base sm:pr-5'>Vue d'ensemble de l'activité d'audiophile</p>
    </div>
    <div class='grid grid-cols-[repeat(auto-fit,minmax(240px,1fr))] gap-5'>
        <div class='flex flex-col justify-between max-w-75 h-45 p-5 rounded-lg bg-(--white_color) shadow-sm'>                
            <div class='flex justify-between'>                
                <div class='flex justify-center items-center text-(--orange_principal) bg-(--orange_principal)/25 rounded-lg size-10 text-xl'><iconify-icon icon="boxicons:dollar-filled"></iconify-icon></div>
                @if ($increase_percent > 0)
                    <div class=' flex items-center text-green-700 text-sm'><iconify-icon icon="ant-design:rise-outlined"></iconify-icon>&nbsp +<span>{{ $increase_percent }}</span>%</div>
                @else
                    <div class=' flex items-center text-red-700 text-sm'><iconify-icon icon="streamline:graph-arrow-decrease-remix"></iconify-icon>&nbsp<span>{{ $increase_percent }}</span>%</div>
                @endif
            </div>
            <p class='font-medium text-3xl'>$<span>{{ $total_amount }}</span></p>
            <p class='text-(--mid_gray)'>Revenu total (ce mois)</p>
        </div>                
        <div class='flex flex-col justify-between max-w-75 h-45 p-5 rounded-lg bg-(--white_color) shadow-sm'>                
            <div class='flex justify-between'>                
                <div class='flex justify-center items-center text-(--orange_principal) bg-(--orange_principal)/25 rounded-lg size-10 text-xl'><iconify-icon icon="weui:shop-outlined"></iconify-icon></div>
                @if ($increase_order > 0)
                    <div class=' flex items-center text-green-700 text-sm'><iconify-icon icon="ant-design:rise-outlined"></iconify-icon>&nbsp<span>{{ $increase_order }}</span></div>
                @else
                    <div class=' flex items-center text-red-700 text-sm'><iconify-icon icon="streamline:graph-arrow-decrease-remix"></iconify-icon>&nbsp<span>{{ $increase_order }}</span></div>
                @endif
            </div>
            <p class='font-medium text-3xl'>{{ $total_order }}</p>
            <p class='text-(--mid_gray)'>Commandes ce mois-ci</p>
        </div>   
        <div class='flex flex-col justify-between max-w-75 h-45 p-5 rounded-lg bg-(--white_color) shadow-sm'>                
            <div class='flex justify-between'>                
                <div class='flex justify-center items-center text-(--orange_principal) bg-(--orange_principal)/25 rounded-lg size-10 text-xl'><iconify-icon icon="mdi:cube-outline"></iconify-icon></div>
                @if ($out_of_stock_product == 0)
                    <div class=' flex items-center text-green-700 text-sm'><iconify-icon icon="ant-design:rise-outlined"></iconify-icon>&nbsp<span>{{ $out_of_stock_product }}</span>&nbsp en rupture</div>
                @else
                    <div class=' flex items-center text-orange-700 text-sm'><iconify-icon icon="streamline:graph-arrow-decrease-remix"></iconify-icon>&nbsp<span>{{ $out_of_stock_product }}</span>&nbsp en rupture</div>
                @endif
            </div>
            <p class='font-medium text-3xl'>{{ $stock_product }}</p>
            <p class='text-(--mid_gray)'>Produits actifs</p>
        </div>   
        <div class='flex flex-col justify-between max-w-75 h-45 p-5 rounded-lg bg-(--white_color) shadow-sm'>                
            <div class='flex justify-between'>                
                <div class='flex justify-center items-center text-(--orange_principal) bg-(--orange_principal)/25 rounded-lg size-10 text-xl'><iconify-icon icon="mynaui:users"></iconify-icon></div>
                @if ($increase_user > 0)
                    <div class=' flex items-center text-green-700 text-sm'><iconify-icon icon="ant-design:rise-outlined"></iconify-icon>&nbsp<span>{{ $increase_user }}</span></div>
                @else
                    <div class=' flex items-center text-red-700 text-sm'><iconify-icon icon="streamline:graph-arrow-decrease-remix"></iconify-icon>&nbsp<span>{{ $increase_user }}</span></div>
                @endif
            </div>
            <p class='font-medium text-3xl'><span>{{ $total_user }}</span></p>
            <p class='text-(--mid_gray)'>Clients</p>
        </div>   
    </div>
    <div class='flex max-[1000px]:flex-col w-full gap-5'>
        <div class='flex flex-col justify-between min-[1000px]:grow-2 w-full h-100 bg-(--white_color) p-5 rounded-lg shadow-sm overflow-hidden'>
            <div class='flex justify-between items-center'>
                <h3 class='flex items-center uppercase text-xl font-medium'><iconify-icon icon="icon-park-outline:dot" class='text-(--orange_principal)'></iconify-icon>aperçu des ventes</h3>
                <p class='text-(--orange_principal)'>12 derniers mois</p>
            </div>
            <div id="sales-chart" class='w-full'></div>
            <div></div>
        </div>
        <div class='min-w-75 bg-(--white_color) p-5 rounded-lg shadow-sm'>
            <h3 class='flex items-center uppercase text-xl font-medium'>meileures ventes</h3>
            <div class='flex flex-col'>
                @foreach ($details as $detail)
                <div class='flex items-center justify-between'>
                    <span class=' p-2 flex items-center gap-2 my-2 ml-2'>
                        <span class='bg-gray-300 size-10 flex items-center justify-center rounded-lg'>
                            @if($detail->product->category_id == 1)
                                <iconify-icon icon="ri:headphone-line"></iconify-icon>
                            @elseif($detail->product->category_id == 2)
                                <iconify-icon icon="tabler:earphone-bluetooth"></iconify-icon>
                            @elseif($detail->product->category_id == 3)
                                <iconify-icon icon="material-symbols:speaker-outline-sharp"></iconify-icon>
                            @endif
                        </span>
                        <span class='flex flex-col text-xs'>
                            <span class='font-medium'>{{ $detail->product->name }}</span>
                            <span class='font-light'><span>{{ $detail->quantity }}</span> unités vendues</span>
                        </span>
                    </span>
                    <span class='font-medium'>$<span>{{ $detail->quantity * $detail->product->price }}</span></span>
                </div>
                <div class='bg-(--mid_gray)/50 w-[80%] h-[1px] self-center'></div>
                @endforeach
            </div>
        </div>
    </div>
    <div class='flex flex-col gap-5 bg-(--white_color) p-5 rounded-lg shadow-sm'>
        <span class='flex justify-between items-center'>
            <h3 class='flex items-center uppercase text-xl font-medium'>transactions récentes</h3>
            <a href={{ route('admin.transaction') }} class='text-(--orange_principal) cursor-pointer hover:underline'>Voir tout</a>
        </span>
        <div class='w-full rounded-lg bg-(--white_color) overflow-hidden shadow-sm'>
            <table class='w-full border-separate border-spacing-2'>
                <thead>
                    <tr class="uppercase bg-gray-300">
                        <th class="py-2">n° commande</th>
                        <th class="py-2">client</th>
                        <th class="py-2">montant</th>
                        <th class="py-2">statut</th>
                        <th class="py-2">date</th>
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
                            <td class='capitalize'>{{ $order->client->email }}</td>
                            <td>$<span>{{ $order->amount }}</span></td>                    
                            <td>
                                <div class='flex items-center justify-center'>
                                    @if($order->status == 'pending')
                                    <div class='flex items-center justify-center uppercase bg-orange-200 text-orange-600 w-fit h-fit rounded-lg py-1 px-2 text-xs font-semibold'>                                    
                                    @elseif($order->status == 'paid')
                                    <div class='flex items-center justify-center uppercase bg-green-200 text-green-600 w-fit h-fit rounded-lg py-1 px-2 text-xs font-semibold'>
                                    @else
                                    <div class='flex items-center justify-center uppercase bg-red-200 text-red-600 w-fit h-fit rounded-lg py-1 px-2 text-xs font-semibold'>
                                    @endif
                                        <iconify-icon icon="icon-park-outline:dot"></iconify-icon>
                                        <span class="ml-1">{{ $order->status }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $order->created_at->format('d/m/y') }}</td>
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
</div>