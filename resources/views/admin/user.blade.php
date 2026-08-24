<div class='bg-(--broken_white) flex flex-col gap-3 p-5'>
    <h2 class='uppercase font-semibold text-2xl'>utilisateurs</h2>
    <p class='text-(--mid_gray) text-base sm:pr-5'>Clients inscrits sur la boutique</p>
    <div class='flex gap-5'>
        <span>
            <input type="text" name="search_product" placeholder="Rechercher un utilisateur" class='border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 min-w-50 bg-(--white_color) placeholder:text-(--mid_gray)'>
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
                @forelse ($users as $user)
                    @if($user->id % 2 == 0)
                    <tr class='text-center border border-gray-400 rounded-lg bg-gray-100'>
                    @else
                    <tr class='text-center border border-gray-400 rounded-lg'>
                    @endif
                        <td class=' p-2 flex items-center gap-2 my-2 ml-2'>
                            <span class='bg-(--black_color) text-(--white_color) font-medium size-10 flex items-center justify-center rounded-full'>
                                {{ collect(explode(' ', $user->name))->map(fn($w) => mb_substr($w, 0, 1))->join('') }}
                            </span>
                            <span class='font-medium capitalize'>{{ $user->name }}</span>
                        </td>
                        <td class=''>{{ $user->email }}</td>
                        <td class=''>{{ $user->telephone }}</td>
                        <td>{{ $user->orders->count() }}</td>
                        <td>$<span>{{ $user->orders->sum('amount') }}</span></td>
                        <td>{{ $user->orders->last()?->created_at?->format('d/m/y') }} </td>
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
