    <div class='flex flex-col w-full bg-(--broken_white) text-xs gap-5 p-5'>
        <h2 class='uppercase font-semibold text-2xl'>administrateur</h2>
        <p class='text-(--mid_gray) sm:pr-5'>Personalisez cet espace à votre image</p>
            
        <div class='flex flex-row w-full gap-5'>

            <section class='flex items-center flex-col gap-3 bg-(--white_color) py-5 px-10 rounded-lg shadow-sm'>
                
                <div class='flex items-center justify-center size-30 bg-(--black_color) text-(--white_color) text-4xl rounded-full uppercase'>{{ collect(explode(' ', $admin->name))->map(fn($w) => mb_substr($w, 0, 1))->join('') }}</div>
                <p>Admin</p>
                <p class='font-medium text-base capitalize'>{{ $admin->name }}</p>
            </section>
            <section class='w-full flex flex-col gap-3'>
                <div class='bg-(--white_color) flex flex-col gap-3 p-5 rounded-lg shadow-sm'>
                    <div class='flex flex-col gap-3'>
                        <p class='uppercase text-(--mid_gray) font-medium'>informations personnelles</p>
                        <div class='flex gap-5 w-full'>
                            <div class='w-full flex flex-col'>
                                <label for="surname" class='font-medium'>Nom</label>
                                <input type="text" id="surname" name="surname" value="{{ collect(explode(' ', $admin->name))->get(1) }}" class='capitalize mt-2 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
                            </div>
                            <div class='w-full flex flex-col'>
                                <label for="name" class='font-medium'>Prénom</label>
                                <input type="text" id="name" name="name" value="{{ collect(explode(' ', $admin->name))->first() }}" class='capitalize mt-2 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
                            </div>
                        </div>
                        <div>
                            <label for="mail" class='font-medium'>Adresse e-mail</label>
                            <input type="mail" id="mail" name="mail" value="{{ $admin->email }}" class='mt-2 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
                        </div>
                        <div>
                            <label for="telephone" class='font-medium'>Téléphone</label>
                            <input type="text" id="telephone" name="telephone" value="{{ $admin->telephone }}" class='mt-2 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
                        </div>
                        <p class='uppercase' class='uppercase text-(--mid_gray) font-medium'>Mot de passe</p>
                        <div>
                            <label for="password" class='font-medium'>Mot de passe</label>
                            <input type="password" id="password" name="password" value="{{ $admin->password }}" class='mt-2 border-1 border-(--mid_gray)/50 hover:border-(--orange_hover) focus:outline-none focus:border-(--orange_hover) rounded-lg px-4 py-1 w-full bg-(--white_color) placeholder:text-(--mid_gray)'>
                        </div>
                    <div>
                </div>    
                <div class='flex w-full justify-end gap-5 p-5'>
                    <a href=""  class='flex justify-center items-center h-10 text-(--white_color) bg-(--orange_principal) px-3 uppercase font-semibold hover:bg-(--orange_hover) rounded-lg'>Enregistrer</a>
                </div>
            </section>    
        </div> 
    </div> 
    