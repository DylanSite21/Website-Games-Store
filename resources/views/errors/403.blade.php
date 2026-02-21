@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __('Hanya developer yang bisa akses'))


@section('button')
    <div class="mt-8 text-center sm:text-left">
        <a href="{{ url('/home') }}">
            <button class="btn">

                ← Back to home
            </button>
        </a>
    </div>
    <!-- From Uiverse.io by Mike11jr -->
@endsection
