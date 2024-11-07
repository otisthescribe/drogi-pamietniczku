@extends('layouts.app')

@section('content')
<div class="w-75">
    <div>
        <h1 class="text-center my-4">Kategorie</h1>
        @if ($errors->any())
        <div class="alert alert-danger text-danger fw-bold my-3">
            🚫 {{ $errors->first() }} 🚫
        </div>
        @endif 
        @if(session('success'))
        <div class="alert alert-success text-success fw-bold my-3">
            🎉 {{ session('success') }} 🎉
        </div>
        @endif 
        <div>
            <a href="{{ route('admin.categories.add') }}">
                <button type="submit" class="btn btn-custom">Dodaj kategorię</button>
            </a>
        </div>
        <table class="table table-striped rounded-3 overflow-hidden my-3">
            <thead>
                <tr>
                    <th scope="col" class="py-3 px-4">#</th>
                    <th scope="col" class="py-3 px-4">Nazwa</th>
                    <th scope="col" class="py-3 px-4">Color</th>
                    <th scope="col" class="py-3 px-4">Ikona</th>
                    <th scope="col" class="py-3 px-4">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <th scope="row" class="px-4 align-middle">
                        <span>{{ $loop->index + 1 }}</span>
                    </th>
                    <td class="px-4 w-50 align-middle">
                        <span>{{ htmlspecialchars($category->name) }}</span>
                    </td>
                    <td class="px-4 align-middle">
                        <span class="badge rounded-pill d-inline" style="background-color: {{ htmlspecialchars($category->color) }};">{{ htmlspecialchars($category->color) }}</span>
                    </td>
                    <td class="px-4 align-middle">
                        <div class="align-middle">
                            @if($category->icon_path)
                            <img src="{{ asset('storage/' . htmlspecialchars($category->icon_path)) }}" style="display: block; width: 100%; height: 100%; max-height:50px; max-width:50px;">
                            @else
                            Brak
                            @endif
                        </div>
                    </td>
                    <td class="px-4 align-middle">
                        <div class="d-flex align-middle">
                            <a href="{{ route('admin.categories.edit', [$category->id]) }}" class="btn btn-custom">Edytuj</a>
                            <form action="{{ route('admin.categories.destroy', [$category->id]) }}" method="POST" class="mx-2">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć tę kategorię?');">Usuń</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> 
</div>
@endsection