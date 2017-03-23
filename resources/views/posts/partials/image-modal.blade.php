@push('stylesheets')
<link href="{{ asset('assets/css/layouts/default/posts/partials/image-modal.css') }}" rel="stylesheet">
@endpush

<div class="modal" id="image-modal" tabindex="-1" aria-labelledby="image-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <a type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"
                                                                                          aria-hidden="true"></i></a>
                <div class="modal-image-container">
                    <a href="#" class="im-arrow scroll-left"><i class="fa fa-chevron-circle-left"></i></a>
                    <img id="modal-image" src="#" data-post="#" data-index="#"/>
                    <a href="#" class="im-arrow scroll-right"><i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>