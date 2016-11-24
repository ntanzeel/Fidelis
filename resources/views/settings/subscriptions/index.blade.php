@extends('settings.layout', ['title' => 'Manage Subscriptions'])

@section('content')
    <ul class="subscription-list list-unstyled">
        @forelse($subscriptions as $subscription)
            <li class="subscription-item">
                <a href="{{ route('discover.category', [$subscription->text]) }}">{{ $subscription->text }}</a>
                <a role="button" href="{{ route('api.subscription.delete', [$subscription->id]) }}"
                   data-id="{{ $subscription->id }}"
                   class="btn btn-danger btn-unsubscribe pull-right">Unsubscribe</a>
            </li>
        @empty
            <li class="text-center">
                You aren't subscribed to any categories. Checkout the <a href="{{ route('discover.index') }}">discover</a> page to get started.
            </li>
        @endforelse
    </ul>
@stop