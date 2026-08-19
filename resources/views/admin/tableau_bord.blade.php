@php
    $products = [
        "elt1" => [ 
            "numero" => 'AP-10482',
            "mail" => 'client@mail.com',
            "date" => '08 août 2026',
            "montant" => 2999,
            "status" => 'en attente',
        ],
        "elt2" => [ 
            "numero" => 'AP-10482',
            "mail" => 'client@mail.com',
            "date" => '07 août 2026',
            "montant" => 2999,
            "status" => 'en attente',
        ],
        "elt3" => [ 
            "numero" => 'AP-10482',
            "mail" => 'client@mail.com',
            "date" => '04 août 2026',
            "montant" => 2999,
            "status" => 'en attente',
        ],
    ]
@endphp

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
                <div class=' flex items-center text-green-700 text-sm'><iconify-icon icon="ant-design:rise-outlined"></iconify-icon>+<span>12.4</span>%</div>
            </div>
            <p class='font-medium text-3xl'>$<span>84,320</span></p>
            <p class='text-(--mid_gray)'>Revenu total (ce mois)</p>
        </div>                
        <div class='flex flex-col justify-between max-w-75 h-45 p-5 rounded-lg bg-(--white_color) shadow-sm'>                
            <div class='flex justify-between'>                
                <div class='flex justify-center items-center text-(--orange_principal) bg-(--orange_principal)/25 rounded-lg size-10 text-xl'><iconify-icon icon="boxicons:dollar-filled"></iconify-icon></div>
                <div class=' flex items-center text-green-700 text-sm'><iconify-icon icon="ant-design:rise-outlined"></iconify-icon>+<span>12.4</span>%</div>
            </div>
            <p class='font-medium text-3xl'>$<span>84,320</span></p>
            <p class='text-(--mid_gray)'>Revenu total (ce mois)</p>
        </div>   
        <div class='flex flex-col justify-between max-w-75 h-45 p-5 rounded-lg bg-(--white_color) shadow-sm'>                
            <div class='flex justify-between'>                
                <div class='flex justify-center items-center text-(--orange_principal) bg-(--orange_principal)/25 rounded-lg size-10 text-xl'><iconify-icon icon="boxicons:dollar-filled"></iconify-icon></div>
                <div class=' flex items-center text-green-700 text-sm'><iconify-icon icon="ant-design:rise-outlined"></iconify-icon>+<span>12.4</span>%</div>
            </div>
            <p class='font-medium text-3xl'>$<span>84,320</span></p>
            <p class='text-(--mid_gray)'>Revenu total (ce mois)</p>
        </div>   
        <div class='flex flex-col justify-between max-w-75 h-45 p-5 rounded-lg bg-(--white_color) shadow-sm'>                
            <div class='flex justify-between'>                
                <div class='flex justify-center items-center text-(--orange_principal) bg-(--orange_principal)/25 rounded-lg size-10 text-xl'><iconify-icon icon="boxicons:dollar-filled"></iconify-icon></div>
                <div class=' flex items-center text-green-700 text-sm'><iconify-icon icon="ant-design:rise-outlined"></iconify-icon>+<span>12.4</span>%</div>
            </div>
            <p class='font-medium text-3xl'>$<span>84,320</span></p>
            <p class='text-(--mid_gray)'>Revenu total (ce mois)</p>
        </div>   
    </div>
    <div class='flex max-[800px]:flex-col w-full gap-5'>
        <div class='flex flex-col justify-between min-[800px]:w-3/4 w-full h-100 bg-(--white_color) p-5 rounded-lg shadow-sm''>
            <div class='flex justify-between items-center'>
                <h3 class='flex items-center uppercase text-xl font-medium'><iconify-icon icon="icon-park-outline:dot" class='text-(--orange_principal)'></iconify-icon>aperçu des ventes</h3>
                <p class='text-(--orange_principal)'>12 derniers mois</p>
            </div>
            <div></div>
            <div></div>
        </div>
        <div class='min-[800px]:w-1/4 w-full bg-(--white_color) p-5 rounded-lg shadow-sm'>
            <h3 class='flex items-center uppercase text-xl font-medium'>meileures ventes</h3>
            <div class='flex flex-col'>
                <div class='flex items-center justify-between'>
                    <span class=' p-2 flex items-center gap-2 my-2 ml-2'>
                        <span class='bg-(--mid_gray)/25 size-10 flex items-center justify-center rounded-lg'>
                            <iconify-icon icon="ri:headphone-line"></iconify-icon>
                        </span>
                        <span class='flex flex-col text-xs'>
                            <span class='font-medium'>XX99 Mark II</span>
                            <span class='font-light'><span>128</span> unités vendues</span>
                        </span>
                    </span>
                    <span class='font-medium'>$<span>38,392</span></span>
                </div>
                <div class='bg-(--mid_gray)/50 w-[80%] h-[1px] self-center'></div>
            </div>
            <div class='flex flex-col'>
                <div class='flex items-center justify-between'>
                    <span class=' p-2 flex items-center gap-2 my-2 ml-2'>
                        <span class='bg-(--mid_gray)/25 size-10 flex items-center justify-center rounded-lg'>
                            <iconify-icon icon="ri:headphone-line"></iconify-icon>
                        </span>
                        <span class='flex flex-col text-xs'>
                            <span class='font-medium'>XX99 Mark II</span>
                            <span class='font-light'><span>128</span> unités vendues</span>
                        </span>
                    </span>
                    <span class='font-medium'>$<span>38,392</span></span>
                </div>
                <div class='bg-(--mid_gray)/50 w-[80%] h-[1px] self-center'></div>
            </div>
        </div>
    </div>
    <div class='flex flex-col gap-5 bg-(--white_color) p-5 rounded-lg shadow-sm'>
        <span class='flex justify-between items-center'>
            <h3 class='flex items-center uppercase text-xl font-medium'>transactions récentes</h3>
            <a href="" class='text-(--orange_principal)'>Voir tout</a>
        </span>
        <div class='w-full rounded-lg bg-(--white_color)'>
            <table class='p-2 text-sm w-full border-collapse'>
                <thead>
                    <tr class="text-left uppercase text-(--mid_gray) font-normal border border-gray-400 rounded-lg ">
                        <th class="pl-2 py-2">n° commande</th>
                        <th class="py-2">client</th>
                        <th class="py-2">montant</th>
                        <th class="py-2">statut</th>
                        <th class="py-2">date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class='border border-gray-400 rounded-lg'>
                            <td class='p-2 '>
                                <span class='font-medium'>#<span>{{ $product["numero"] }}</span>
                            </td>
                            <td class='capitalize'>{{ $product["mail"] }}</td>
                            <td>$<span>{{ $product["montant"] }}</span></td>                    
                            <td>
                                <div class='flex items-center justify-center uppercase bg-orange-200 text-orange-400 max-w-25 max-h-5 rounded-lg py-1 px-2 text-xs font-semibold'>
                                    <iconify-icon icon="icon-park-outline:dot"></iconify-icon>
                                    <span class="ml-1">{{ $product["status"] }}</span>
                                </div>
                            </td>
                            <td>{{ $product["date"] }}</td>
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

