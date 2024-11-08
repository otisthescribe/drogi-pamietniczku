@extends('layouts.app')

@section('content')
<div class="container w-50">
    <h2 class="text-center my-3">Edytuj wydarzenie</h2>
    <form action="{{ route('admin.events.update', [$event->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch') <!-- This method will be used to indicate that this is an update request -->
        
        <div class="mb-3">
            <label for="title" class="form-label">Tytuł</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', htmlspecialchars($event->title)) }}" required>
        </div>

        <div class="row">
            <div class="mb-3 col">
                <label for="start_date" class="form-label">Data początkowa</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', htmlspecialchars($event->start_date)) }}" required>
            </div>

            <div class="mb-3 col">
                <label for="end_date" class="form-label">Data końcowa</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', htmlspecialchars($event->end_date)) }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Opis</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', htmlspecialchars($event->description)) }}</textarea>
        </div>

        <div class="row">
            <div class="mb-3 col">
                <label for="category_id" class="form-label">Kategoria</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="">Wybierz kategorię</option>
                    @foreach ($categories as $category)
                        <option value="{{ htmlspecialchars($category->id) }}" {{ htmlspecialchars($event->category_id) == $category->id ? 'selected' : '' }}>
                            {{ htmlspecialchars($category->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col">
                <label for="image_path" class="form-label">Zdjęcie</label>
                <input type="file" class="form-control" id="image_path" name="image_path" accept="image/*">
            </div>

            <div class="row">
                <div class="col">
                    <p class="form-label">Obecne zdjęcie</p>
                    @if($event->image_path)
                    <div>
                        <img src="{{ asset('storage/' . htmlspecialchars($event->image_path)) }}" style="display: block; width:100%; height:100%">
                    </div>
                    @else
                    <div>
                        <p class="text-danger font-weight-bold ">Brak</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-custom my-4">Zaktualizuj</button>
        <button type="button" class="btn btn-danger my-4" onclick="window.history.back();">Anuluj</button>
    </form>
</div>
@endsection
