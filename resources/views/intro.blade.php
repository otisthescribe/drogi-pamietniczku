@extends('layouts.app')

@section('content')
<div class="align-items-center">
    <h1>Drogi Pamiętniczku</h1>
    <p>to system pamiętnikowy, który pozwala notować ważne wydarzenia na osi czasu.</p>
    <a href="{{ route('events.show') }}" class="btn btn-custom mt-3">Wchodzę!</a>
</div>
@stop