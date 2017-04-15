@push('stylesheets')
    <link href="{{ asset('assets/css/' . str_replace('.', '/', config('view.layout')) . '/posts/feed.css') }}"  rel="stylesheet">
@endpush

<ul class="media-list post-list anchor" data-empty="{{ $posts->count() == 0 }}">
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

<div class="modal" id="category-modal" tabindex="-1" aria-labelledby="category-modal" aria-hidden="true" data-post="#" data-api="#" data-url="{{ url('discover') }}/">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></a>
                <h4 class="modal-title edit-cat-title">Edit category</h4>
            </div>
            <div class="modal-body">
                <ul class="categories-container">
                    @foreach($categories as $category)
                        <li id="cat-{{ $category->id }}" class="category-item"><a class="" href="#">{{ $category->name }}</a></li>
                    @endforeach
                    <li id="cat-14" class="category-item"><a class="" href="#">No category</a></li>
                </ul>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-orange btn-save-category" data-dismiss="modal">Save</button></div>
        </div>
    </div>
</div>
