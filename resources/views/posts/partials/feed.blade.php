@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('assets/css/' . str_replace('.', '/', config('view.layout')) . '/posts/feed.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/layouts/default/posts/partials/feed.js') }}"></script>
@endpush

<ul class="media-list post-list" data-empty="{{ $posts->count() == 0 }}">
    @forelse($posts as $post)
        <li class="media">
            @include('posts.partials.feed-post', compact('post'))
        </li>
    @empty
        <li class="empty-feed text-center">
            There are currently no posts on this feed...
        </li>
    @endforelse
</ul>

@include('posts.partials.image-modal')