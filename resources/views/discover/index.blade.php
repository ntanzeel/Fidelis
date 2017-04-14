@extends('discover.layout', ['categories' => $categories, 'category' => 'Subscribed', 'posts' => $posts])

@section('banner')
    Subscribed
    <a role="button" class="btn btn-default pull-right"
       href={{ route('settings.subscriptions.index') }}>Manage</a>
@stop