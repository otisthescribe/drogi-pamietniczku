@extends('layouts.app')

@section('content')
<div class="container w-50">
    <h2 class="text-center my-3">Nowe wydarzenie</h2>
    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="title" class="form-label">Tytuł</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="row">
            <div class="mb-3 col">
                <label for="start_date" class="form-label">Data początkowa</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>

            <div class="mb-3 col">
                <label for="end_date" class="form-label">Data końcowa</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Opis</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="row">
            <div class="mb-3 col">
                <label for="category_id" class="form-label">Kategoria</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="">Wybierz kategorię</option>
                    @foreach ($categories as $category)
                        <option value="{{ htmlspecialchars($category->id) }}">{{ htmlspecialchars($category->name) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col">
                <label for="image_path" class="form-label">Zdjęcie</label>
                <input type="file" class="form-control" id="image_path" name="image_path" accept="image/*">
            </div>
        </div>

        <button type="submit" class="btn btn-custom my-4">Dodaj</button>
    </form>
</div>
@endsection
