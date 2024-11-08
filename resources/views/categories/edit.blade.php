@extends('layouts.app')

@section('content')
<div class="container w-50">
    <h2 class="text-center my-3">Edytuj kategorię</h2>
    <form action="{{ route('admin.categories.update', [$category->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">Nazwa</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name', htmlspecialchars($category->name)) }}">
        </div>

        <div class="row">
            <div class="mb-3 col-1">
                <label for="color" class="form-label">Kolor</label>
                <input type="color" class="form-control form-control-color" id="color" name="color" required value="{{ old('color', htmlspecialchars($category->color)) }}">
            </div>

            <div class="mb-3 col-11">
                <label for="icon_path" class="form-label">Nowa ikona</label>
                <input type="file" class="form-control" id="icon_path" name="icon_path" accept="image/*" value="{{ old('icon_path', htmlspecialchars($category->icon_path)) }}">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <p class="form-label">Obecna ikona</p>
                @if($category->icon_path)
                <div>
                    <img src="{{ asset('storage/' . htmlspecialchars($category->icon_path)) }}" style="width: 50px; height: 50px;">
                </div>
                @else
                <div>
                    <p class="text-danger font-weight-bold ">Brak</p>
                </div>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-custom my-4">Zaktualizuj</button>
        <button type="button" class="btn btn-danger my-4" onclick="window.history.back();">Anuluj</button>
    </form>
</div>
@endsection
