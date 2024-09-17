@extends('layouts.admin')

@section('title', '| Send announcement')
@section('content')
<div class="u-body">
    <h1 class="h2 font-weight-semibold mb-4"> <i class="fa fa-align-justify"></i> {{ __('Send announcement to user') }}</h1>
    <div class="card">
        <livewire:send-notifications>
    </div>
</div>
@endsection
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"  crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .size11{
        font-size: 11px;
    }
</style>
@endpush 