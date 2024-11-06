@extends('layouts.app')

@section('content')
<div class="py-12 d-flex text-center align-items-center flex-column">
    <div class="w-75 p-4">
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="w-100 p-4">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="w-75 p-4">
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@stop
