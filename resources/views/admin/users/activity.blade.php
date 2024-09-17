@extends('layouts.admin')

@section('title', '| Users')

@section('content')
    <div class="u-body">
        <h1 class="h2 font-weight-semibold mb-4">{{ __('Users activities') }}</h1>

        <div class="card mb-4">

            <div class="card-body">
                <livewire:alluser-activity />
            </div>
        </div>
    </div>
@endsection