<div class="post-view-footer">
    <ul class="list-inline list-unstyled action-list">
        <li>
            <a role="button" class="action action-like"><i class="fa fa-thumbs-up"></i></a>
        </li>
        <li>
            <a role="button" class="action action-dislike"><i class="fa fa-thumbs-down"></i></a>
        </li>
        <li>
            {{ $post->created_at->diffForHumans() }}
        </li>
    </ul>
</div>