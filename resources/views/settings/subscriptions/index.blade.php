@extends('settings.layout', ['title' => 'Manage Subscriptions'])

@push('stylesheets')
    <link href="{{ asset('assets/css/layouts/default/discover/_shared.css') }}" rel="stylesheet">
@endpush

@section('content')
    <ul class="list-subscription">
        @foreach($subscriptions as $subscription)
            <li class='item-subscription'>
                <a href="{{ route('discover.category',$subscription->text) }}">{{ $subscription->text }}</a> <a id='{{ $subscription->id }}' class='btn-unsubscribe' href="#">Unsubscribe</a>
            </li>
        @endforeach
    </ul>
@stop

@push('scripts')
    <script>
        var unsubscribeUrl = "{{ url('/api/subscription/{id}') }}";
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/layouts/default/discover/_shared.js') }}"></script>
@endpush