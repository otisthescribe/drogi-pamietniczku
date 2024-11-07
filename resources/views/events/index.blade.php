@extends('layouts.app')

@section('content')
<div class="align-items-center text-center">
    <section id="timeline">
        <h1>Wydarzenia w naszej firmie</h1>
        <p class="leader">Zobacz co ciekawego robiliśmy!</p>
        <div class="events">
            @foreach ($events as $event)
            <div class="event-card row">
                <div class="event-head col-3 align-items-center d-flex justify-content-center" style="background-color: {{ htmlspecialchars($event->category->color) }};">
                    @if($event->category->icon_path)
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('storage/' . htmlspecialchars($event->category->icon_path)) }}" style="display: block; width:75%; height:75%">
                    </div>
                    @endif
                </div>
                <div class="event-body col-9">
                    <div class="event-title" style="color: {{ htmlspecialchars($event->category->color) }};">
                        {{ htmlspecialchars($event->title) }}
                    </div>
                    <div class="event-dates">
                        {{ htmlspecialchars($event->start_date) }} &rarr; {{ htmlspecialchars($event->end_date) }}
                    </div>
                    <div class="event-description">
                        <p>{{ htmlspecialchars($event->description) }}</p>
                    </div>
                    <div>
                        <!-- Button trigger modal -->
                        <button type="button" 
                                class="btn event-button" 
                                style="background-color: {{ htmlspecialchars($event->category->color) }};" 
                                data-toggle="modal" 
                                data-target="#event{{ $event->id }}">
                            Szczegóły
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade event-modal text-start " id="event{{ $event->id }}" aria-labelledby="event{{ $event->id }}" aria-hidden="true" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg align-items-start">
                    <div class="modal-content">
                        <div class="modal-header d-flex flex-column align-items-start">
                            <div class="modal-title" style="color: {{ $event->category->color }};">
                                {{ htmlspecialchars($event->title) }}
                            </div>
                            <div class="badge badge-pill mt-2" style="background-color: {{ $event->category->color }};">
                                {{ htmlspecialchars($event->category->name) }}
                            </div>
                        </div>
                        <div class="modal-body text-start">
                            <div>
                                <h6 class="modal-body-header">DATA</h6>
                                <p>{{ htmlspecialchars($event->start_date) }} &rarr; {{ htmlspecialchars($event->end_date) }}</p>
                            </div>
                            <div>
                                <h6 class="modal-body-header">OPIS</h6>
                                <p>{{ htmlspecialchars($event->description) }}</p>
                            </div>
                            <div>
                                <h6 class="modal-body-header">ZDJĘCIE Z WYDARZENIA</h6>
                                @if($event->image_path)
                                <div>
                                    <img src="{{ asset('storage/' . htmlspecialchars($event->image_path)) }}" style="display: block; width:100%; height:100%" class="pb-3">
                                </div>
                                @else
                                <div>
                                    <p class="text-danger font-weight-bold">Nie dodano zdjęcia do wydarzenia.</p>
                                </div>
                                @endif
                            </div>
                            <div>
                                <h6 class="modal-body-header">DODANO PRZEZ</h6>
                                <p>{{ htmlspecialchars($event->user->name) }} &lt;{{ htmlspecialchars($event->user->email) }}&gt;</p>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </section>  
</div>
@endsection
