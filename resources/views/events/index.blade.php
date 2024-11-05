@extends('layouts.app')

@section('content')
<div class="align-items-center">
    <section id="timeline">
        <h1>Historia tej strony</h1>
        <p class="leader">Od zeszłego tygodnia do dzisiaj...</p>
        <div class="demo-card-wrapper">
            @foreach ($events as $event)
            <div class="demo-card demo-card--step{{ $loop->index + 1 }} {{ $loop->index % 2 == 0 ? 'left' : 'right' }}">
                <div class="card-head">
                    <div class="number-box" style="background-color: {{ $event->category->color }};">
                        <span>{{ $loop->index + 1 }}</span>
                    </div>
                    <div class="title-box">
                        <h3>{{ $event->title }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <small>OD {{ $event->start_date }} DO {{ $event->end_date }}</small>
                    <p>{{ $event->description }}</p>
                    @if ($event->media)
                    <img src="http://placehold.it/1000x500" alt="Graphic">
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </section>  
</div>
@endsection
