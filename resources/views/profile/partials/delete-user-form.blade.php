<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">Usuń konto</h2>
        <p class="mt-1 text-sm text-gray-600"> Wszystkie Twoje dane zostaną usunięte. Zastanów się czy na pewno chcesz to zrobić.</p>
    </header>
    <form method="post" action="{{ route('profile.destroy') }}">
        @csrf
        @method('delete')
        <div class="row">
            <div class="col-8">
                <input id="password" class="form-control" type="password" name="password" placeholder="Potwierdź hasło" required autocomplete="current-password" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>
            <div class="col-4">
                <button class="btn btn-danger">Usuń konto</button>
            </div>
        </div>
    </form>
</section>