@extends('layouts.app')

@section('content')
<div class="container w-50">
    <h2 class="text-center my-3">Nowa kategoria</h2>
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Nazwa</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="row">
            <div class="mb-3 col-1">
                <label for="color" class="form-label">Kolor</label>
                @php
                $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
                $color = strval('#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)]);
                @endphp
                <input type="color" class="form-control form-control-color" id="color" name="color" required value="{{ htmlspecialchars($color) }}">
            </div>

            <div class="mb-3 col-11">
                <label for="icon_path" class="form-label">Ikona</label>
                <input type="file" class="form-control" id="icon_path" name="icon_path" accept="image/*">
            </div>
        </div>

        <button type="submit" class="btn btn-custom my-4">Dodaj</button>
        <button type="button" class="btn btn-danger my-4" onclick="window.history.back();">Anuluj</button>
    </form>
</div>
@endsection
