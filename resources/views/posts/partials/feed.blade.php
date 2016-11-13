<ul class="media-list post-list">
    @foreach($posts as $post)
        <li class="media">
            @include('posts.partials.post', compact('post'))
        </li>
    @endforeach
</ul>