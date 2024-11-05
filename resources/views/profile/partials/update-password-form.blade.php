<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Zmień hasło</h2>
        <p class="mt-1 text-sm text-gray-600">Proszę nie ustawiaj słabego hasła typu iloveyou.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="row">
            <div class="form-group col">
                <label for="update_password_current_password">Aktualne hasło</label>
                <input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full form-control" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div class="form-group col">
                <label for="update_password_password">Nowe hasło</label>
                <input id="update_password_password" name="password" type="password" class="mt-1 block w-full form-control" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div class="form-group col">
                <label for="update_password_password_confirmation">Powtórz hasło</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full form-control" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button class="btn btn-custom mt-3">Zapisz</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >Hasło zmienione!</p>
            @endif
        </div>
    </form>
</section>
