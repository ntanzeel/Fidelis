@extends(config('view.layout', 'layouts.default') . '.app')

@push('stylesheets')
    <link href="{{ asset('assets/css/layouts/default/pages/index.css') }}" rel="stylesheet">
@endpush

@section('header')
@stop

@section('container')
    <div class="home-nav">
        @if (Auth::guest())
            <a class="btn-link" href="{{ route('auth.login') }}">Log in</a>
            <a class="btn-link" href="{{ route('auth.register') }}">Sign up</a>
        @else
            <a href="{{ url('/home') }}">Home</a>
        @endif
    </div>
    <div class="welcome flex-center full-height position-ref"
         style="background-image: url({!! asset($wallpaper->path) !!})">
        <div class="content">
            <div class="title">
                {{ config('app.name') }}
            </div>
            <blockquote class="quote">
                {{ $quote->text }}
                <cite>{{ $quote->by }}</cite>
            </blockquote>
        </div>
    </div>
@stop

@section('footer')
@stop