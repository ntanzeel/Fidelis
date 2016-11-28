@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('assets/css/' . str_replace('.', '/', config('view.layout')) . '/components/post/feed.css') }}">
@endpush

<ul class="media-list post-list" data-empty="{{ $posts->count() == 0 }}">
    @forelse($posts as $post)
        <li class="media">
            @include('components.post.partials.post', compact('post'))
        </li>
    @empty
        <li class="empty-feed text-center">
            There are currently no posts on this feed...
        </li>
    @endforelse
</ul>