$(document).ready(function () {

    $('.anchor').on('click', '.exp', function (event) {
        event.preventDefault();

        var $images = $(this).parent().children();
        var $modal = $('#image-modal');

        if ($images.length == 1) {
            $(".im-arrow").hide();
        } else {
            $(".im-arrow").show();
        }

        var image = $modal.find('.img').first();
        image.css('background-image', 'url(' + $(this).attr('src') + ')');
        image.attr('data-image', $(this).attr('id').split('-')[1]);
        if ($(this).hasClass('post-image')) {
            image.attr('data-type','post');
        }
        else {
            image.attr('data-type','user');
        }

        $modal.modal();
    });


    $('.im-arrow').click(function (event) {
        event.preventDefault();
        var image = $('#image-modal').find('.img').first();
        var id = image.attr('data-image');
        var type = image.attr('data-type');

        if (type == 'post') {
            if ($(this).hasClass('scroll-left')){
                changeImage('post_prev', id);
            }
            else {
                changeImage('post_next', id);
            }
        }
        else {
            if ($(this).hasClass('scroll-left')){
                changeImage('user_prev', id);
            }
            else {
                changeImage('user_next', id);
            }
        }

    });

});

$(document).keydown(function (event) {
    if ($('#image-modal').hasClass('in')) {
        event.preventDefault();
        switch (event.which) {
            case 37:
                $('.scroll-left').click();
                break;
            case 39:
                $('.scroll-right').click();
                break;
            default:
                return;
        }
    }
});

function changeImage (method, id){
    var image = $('#image-modal').find('.img').first();
    var url = 'image'; //Need to change url depending on method

    $.ajax({
        url: url,
        method: 'get',
        data: {'id': id},
        processData: false,
        contentType: false,
        beforeSend: function (xhr) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        },
        success: function (response) {
            image.css('background-image', 'url(' + response['source'] + ')');
            image.attr('data-image', response[id]);
        },
        error: function (response) {}
    });
}
