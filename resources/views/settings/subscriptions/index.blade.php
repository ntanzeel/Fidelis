@extends('settings.layout', ['title' => 'Manage Subscriptions'])

@push('stylesheets')
    <link href="{{ asset('assets/css/layouts/default/discover/_shared.css') }}" rel="stylesheet">
@endpush

@section('content')
    <ul class="list-subscription">
        @foreach($subscriptions as $subscription)
            <li class='item-subscription'>
                {{ $subscription->text }} <a id='{{ $subscription->id }}' class='btn-unsubscribe' href="#">Unsubscribe</a>
            </li>
        @endforeach
    </ul>
@stop

@push('scripts')
    <script>
        var token = "{{ csrf_token() }}";
        var unsubscribeUrl = "{{ route('settings.subscriptions.unsubscribe') }}";
    </script>
@endpush