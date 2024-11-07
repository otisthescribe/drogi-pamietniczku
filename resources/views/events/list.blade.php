@extends('layouts.app')

@section('content')
<div class="w-75">
    <div>
        <h1 class="text-center my-4">Wydarzenia</h1>
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
        <div class="">
            <a href="{{ route('admin.events.add') }}">
                <button type="submit" class="btn btn-custom">Dodaj wydarzenie</button>
            </a>
        </div>
        <table class="table table-striped rounded-3 overflow-hidden my-3">
            <thead >
                <tr class="py-3 px-4">
                    <th scope="col" class="py-3 px-4">#</th>
                    <th scope="col" class="py-3 px-4">Tytuł</th>
                    <th scope="col" class="py-3 px-4">Opis</th>
                    <th scope="col" class="py-3 px-4">Data początkowa</th>
                    <th scope="col" class="py-3 px-4">Data końcowa</th>
                    <th scope="col" class="py-3 px-4">Kategoria</th>
                    <th scope="col" class="py-3 px-4">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                <tr>
                    <th scope="row" class="px-4 align-middle">
                        <span>{{ $loop->index + 1 }}</span>
                    </th>
                    <td class="px-4 align-middle">
                        <span>{{ htmlspecialchars($event->title) }}</span>
                    </td>
                    <td class="px-4 w-25 align-middle">
                        <span>{{ htmlspecialchars($event->description) }}</span>
                    </td>
                    <td class="px-4 align-middle">
                        <span>{{ htmlspecialchars($event->start_date) }}</span>
                    </td>
                    <td class="px-4 align-middle">
                        <span>{{ htmlspecialchars($event->end_date) }}</span>
                    </td>
                    <td class="px-4 align-middle">
                        <span class="badge rounded-pill d-inline px-3" style="background-color: {{ htmlspecialchars($event->category->color) }};">{{ htmlspecialchars($event->category->name) }}</span>
                    </td>
                    <td class="px-4 align-middle">
                        <div class="d-flex align-middle">
                            <a href="{{ route('admin.events.edit', [$event->id]) }}" class="btn btn-custom">Edytuj</a>
                            <form action="{{ route('admin.events.destroy', [$event->id]) }}" method="POST" class="mx-2">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć to wydarzenie?');">Usuń</button>
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
