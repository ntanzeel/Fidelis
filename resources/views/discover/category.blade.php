@extends('discover.layout', compact('categories', 'category', 'posts'))


@section('banner')
    {{ $category }}
    @if(Auth::user() && !$isRoot)
        <a role="button" class="btn btn-default pull-right btn-subscribe-toggle" href="#"
           data-api="{{ url('/api/subscription/')  }}"
           data-id="{{ $tag->id }}" data-status="{{ $subscribed ? 1 : 0 }}">
            {{ $subscribed ? 'Unsubscribe' : 'Subscribe' }}
        </a>
    @endif
@stop