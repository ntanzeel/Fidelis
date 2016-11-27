<form class="ajax post-form" method="post" action="{{ route('api.post.comment.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
        <textarea placeholder="What are your thoughts on this?" class="form-control" name="text" id="text" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-orange">Submit</button>
</form>