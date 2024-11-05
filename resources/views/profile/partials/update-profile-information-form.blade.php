<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Konto</h2>
        <p class="mt-1 text-sm text-gray-600">Tutaj możesz zaktualizować swoje konto.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="row">
            <div class="col">
                <label for="name">Imię</label>
                <input id="name" name="name" type="text" class="mt-1 block w-full form-control" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="col">
                <label for="email" >Adres email</label>
                <input id="email" name="email" type="email" class="mt-1 block w-full form-control" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button class="btn btn-custom mt-3">Zapisz</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >Uaktualniono profil!</p>
            @endif
        </div>
    </form>
</section>
