$(document).ready(function() {

    //Image modal
    $('.media-body').on('click', '.post-image', function (event) {
        event.preventDefault();
        var $images = $(this).parent().children();
        if ($images.length == 1) {
            $(".im-arrow").hide();
        }
        else {
            $(".im-arrow").show();
        }

        var image = $('#modal-image');
        image.attr('src', $(this).attr('src'));
        image.attr('data-post', $(this).parent().parent().attr('id'));

        $('#image-modal').modal();
    });

    $('.im-arrow').click(function (event) {
        event.preventDefault();
        var source = $(this).siblings('#modal-image').attr('src');
        var images = $("#" + $(this).siblings('#modal-image').attr('data-post')).children().children();
        var index = images.index($('img[src="' + source + '"]'));
        var newImage;

        if ($(this).hasClass('scroll-left')) {
            newImage = $(images.get(index - 1)).attr('src');
        }
        else {
            var i = (index + 1) % images.length;
            newImage = $(images.get(i)).attr('src');
        }

        $('#modal-image').attr('src', newImage);

    });

});

$(document).keydown(function(event) {
    if ($('#image-modal').hasClass('in')) {
        event.preventDefault();
        switch (event.which) {
            case 37: $('.scroll-left').click(); break;
            case 39: $('.scroll-right').click(); break;
            default: return;
        }
    }
});
