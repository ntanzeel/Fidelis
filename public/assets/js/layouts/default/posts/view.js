/**
 * Created by ishegambe on 25/11/2016.
 */
$(document).ready(function () {

    $('form.ajax').on('submit', function (e) {
        e.preventDefault();

        var form = $(this);
        var thread = $('.media');
        var comments = $('.comment-list').last();

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: new FormData(form[0]),
            processData: false,
            contentType: false,
            beforeSend: function (xhr) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            },
            success: function (response) {
                form.trigger('reset');

                comments.append('<li class="media">' + response + '</li>');
            },
            error: function (response) {}
        });
    });

    //Image modal
    $('.post-image').on('click', function(event){
        event.preventDefault();
        var $images = $(this).siblings();
        if ($images.length==1) {
            $(".im-arrow").hide();
        }
        else {
            $(".im-arrow").show();
        }
        $('#modal-image').attr('src',$(this).attr('src'));

        $('#image-modal').modal();
    });

    $('.im-arrow').click(function(event){
        event.preventDefault();
        var source = $(this).siblings('#modal-image').attr('src');
        var images = $(".post-image");
        var index = images.index($('img[src="'+source+'"]'));
        var newImage;

        if ($(this).hasClass('scroll-left')) {
            newImage = $(images.get(index - 1)).attr('src');
        }
        else {
            var i = (index+1) % images.length;
            newImage = $(images.get(i)).attr('src');
        }

        $('#modal-image').attr('src',newImage);

    });
});