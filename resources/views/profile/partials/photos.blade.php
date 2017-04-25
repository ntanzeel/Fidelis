@if ($images->isNotEmpty())
    <div class="panel panel-default">
        <div class="panel-heading">
            Photos
        </div>
        <div class="panel-body anchor">
            @foreach($images as $key => $image)
                <img src="{{ asset('storage/' . $image->path) }}"
                     class="lightbox user-image img-responsive img-thumbnail"
                     data-type="user"
                     data-source="{{ $image->id }}"
                     data-album="{{ $user->username }}"
                     width="45%" />
            @endforeach
        </div>
    </div>
@endif