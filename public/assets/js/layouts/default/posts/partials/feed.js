$(document).ready(function () {

    /** Image modal **/

    //If photo is from feed
    $('.media-list').on('click', '.post-image', function (event) {
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

        $modal.modal();
    });


    $('.im-arrow').click(function (event) {
        event.preventDefault();
        var source = $(this).siblings('#modal-image').attr('src');
        var container = $(this).siblings('#modal-image').attr('data-post')
        var newImage, index;

        if (container != "sidebar") { //Photos are from a post on the feed
            var post = $("#" + container);
            var images = post.children('.post-images').children();
            index = images.index($('#' + container + ' img[src="' + source + '"]'));

            if ($(this).hasClass('scroll-left')) {
                newImage = $(images.get(index - 1)).attr('src');
            }
            else {
                index = (index + 1) % images.length;
                newImage = $(images.get(index)).attr('src');
            }
        }
        else { //Photos are from a user
            index = $(this).siblings('#modal-image').attr('data-index');


            if ($(this).hasClass('scroll-left')) {
                index = parseInt(index) - 1;
                if (index < 0) {
                    index = userImgs.length - 1;
                }

                $(this).siblings('#modal-image').attr('data-index', index);
                newImage = src + '/' + userImgs[index];
            }
            else {
                index = (parseInt(index) + 1) % userImgs.length;
                $(this).siblings('#modal-image').attr('data-index', index);
                newImage = src + '/' + userImgs[index];
            }
        }

        $('#modal-image').attr('src', newImage);

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
