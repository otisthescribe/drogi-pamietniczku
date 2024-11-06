@extends('layouts.app')

@section('content')
<div class="align-items-center text-center">
    <section id="timeline">
        <h1>Historia tej strony</h1>
        <p class="leader">Od zeszłego tygodnia do dzisiaj...</p>
        <div class="events">
            @foreach ($events as $event)
            <div class="event-card row">
                <div class="event-head col-3 " style="background-color: {{ $event->category->color }};">
                    <div class="event-date">
                        <div>{{ $event->start_date }}</div>
                    </div>
                </div>
                <div class="event-body col-9">
                    <div class="event-title" style="color: {{ $event->category->color }};">
                        {{ $event->title }}
                    </div>
                    <div class="event-dates">
                        {{ $event->start_date }} &rarr; {{ $event->end_date }}
                    </div>
                    <div class="event-description">
                        <p>{{ $event->description }}</p>
                    </div>
                    <div>
                        <button type="button" class="btn event-button" style="background-color: {{ $event->category->color }};">
                            Szczegóły
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>  
</div>
@endsection
