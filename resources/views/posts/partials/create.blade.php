<form class="ajax post-form" method="post" action="{{ route('api.post.store') }}" enctype="multipart/form-data" >
    {{ csrf_field() }}

    <div class="form-group">
        <label class="sr-only" for="text">What are you thinking?</label>
        <textarea class="form-control" id="text" name="text" placeholder="What are you thinking?"></textarea>
    </div>
    <div class="text-right form-footer">
        <div class="image-upload">
            <label class="sr-only" for="images">Images</label>
            <a class="toggle" href="#"><i class="fa fa-camera fa-2x" aria-hidden="true"></i> <span class="file-name"></span></a>
            <input type="file" multiple name="images[]" id="post-images" style="display: none" accept="image/*" />
        </div>
        <button type="submit" id="new-post" class="btn btn-orange">Submit</button>
    </div>
</form>

<div class="modal" id="category-modal" tabindex="-1" aria-labelledby="category-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
