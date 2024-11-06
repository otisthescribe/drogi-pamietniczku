@extends('layouts.app')

@section('content')
<div class="w-50">
    <div>
        <h1 class="text-center">Kategorie</h1>
        @if ($errors->any())
        <div class="alert alert-danger text-danger fw-bold">
            🚫 {{ $errors->first() }} 🚫
        </div>
        @endif 
        @if(session('success'))
        <div class="alert alert-success text-success fw-bold">
            🎉 {{ session('success') }} 🎉
        </div>
        @endif  
        <table class="table table-striped rounded-3 overflow-hidden my-4">
            <thead>
                <tr>
                    <th scope="col" class="py-3 px-4">#</th>
                    <th scope="col" class="py-3 px-4">Nazwa</th>
                    <th scope="col" class="py-3 px-4">Color</th>
                    <th scope="col" class="py-3 px-4">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <th scope="row" class="px-4">
                        <span>{{ $loop->index + 1 }}</span>
                    </th>
                    <td class="px-4 w-50">
                        <span>{{ $category->name }}</span>
                    </td>
                    <td class="px-4">
                        <span class="badge rounded-pill d-inline" style="background-color: {{ $category->color }};">{{ $category->color }}</span>
                    </td>
                    <td class="px-4 d-flex">
                        <a href="{{ route('admin.categories.edit', [$category->id]) }}" class="btn btn-custom">EDYTUJ</a>
                        <form action="{{ route('admin.categories.destroy', [$category->id]) }}" method="POST" class="mx-2">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć tę kategorię?');">USUŃ</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> 
</div>
@endsection