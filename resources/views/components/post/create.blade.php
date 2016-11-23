<form class="ajax post-form" method="post" action="{{ route('api.post.store') }}" enctype="multipart/form-data" >
    {{ csrf_field() }}

    <div class="form-group">
        <label class="sr-only" for="text">What are you thinking?</label>
        <textarea class="form-control" id="text" name="text" placeholder="What are you thinking?"></textarea>
    </div>
    <div class="form-group">
        <label class="sr-only" for="images">Images</label>
        <input type="file" multiple name="images[]" id="images" />
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-orange">Submit</button>
    </div>
</form>