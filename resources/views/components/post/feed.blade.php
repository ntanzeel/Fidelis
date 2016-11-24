@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('assets/css/' . str_replace('.', '/', config('view.layout')) . '/components/post/feed.css') }}">
@endpush

@if($posts->count())
    <ul class="media-list post-list">
        @foreach($posts as $post)
            <li class="media">
                @include('components.post.partials.post', compact('post'))
            </li>
        @endforeach
    </ul>
@else
    <div class="empty-feed text-center">
        There are currently no posts on this feed...
    </div>
@endif