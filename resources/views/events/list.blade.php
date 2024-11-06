@extends('layouts.app')

@section('content')
<div class="w-75">
    <div>
        <h1 class="text-center">Wydarzenia</h1>
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
            <thead >
                <tr class="py-3 px-4" style="background: #000;">
                    <th scope="col" class="py-3 px-4">#</th>
                    <th scope="col" class="py-3 px-4">Tytuł</th>
                    <th scope="col" class="py-3 px-4">Kategoria</th>
                    <th scope="col" class="py-3 px-4">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                <tr>
                    <th scope="row" class="px-4">{{ $loop->index + 1 }}</th>
                    <td class="px-4 w-50">{{ $event->title }}</td>
                    <td class="px-4">
                        <span class="badge rounded-pill d-inline px-3" style="background-color: {{ $event->category->color }};">{{ $event->category->name }}</span>
                    </td>
                    <td class="px-4 d-flex">
                        <a href="{{ route('admin.events.edit', [$event->id]) }}" class="btn btn-custom">EDYTUJ</a>
                        <form action="{{ route('admin.events.destroy', [$event->id]) }}" method="POST" class="mx-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć to wydarzenie?');">USUŃ</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>  
</div>
@endsection
