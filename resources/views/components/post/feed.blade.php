@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('assets/css/' . str_replace('.', '/', config('view.layout')) . '/components/post/feed.css') }}">
@endpush

<ul class="media-list post-list">
    @foreach($posts as $post)
        <li class="media">
            @include('components.post.partials.post', compact('post'))
        </li>
    @endforeach
</ul>