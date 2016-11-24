@push('stylesheets')
<link rel="stylesheet" href="{{ asset('assets/css/' . str_replace('.', '/', config('view.layout')) . '/components/post/view.css') }}">
@endpush

<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><a class="post-user" href=""></a></h4>
            </div>
            <div class="modal-body">
                @include('components.post.view')
            </div>
        </div>
    </div>
</div>