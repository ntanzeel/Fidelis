$(document).ready(function () {
    $('.profile-photo-container').hover(function () {
        $('.btn-upload').css('visibility', 'visible');
    });

    $('.profile-photo-container').mouseleave(function () {
        $('.btn-upload').css('visibility', 'hidden');
    });

    $('.profile-cover').hover(function () {
        $('.btn-cover-upload').css('visibility', 'visible');
    });

    $('.profile-cover').mouseleave(function () {
        $('.btn-cover-upload').css('visibility', 'hidden');
    });

    $('.btn-upload').click(function (event) {
        $('#profile-upload').trigger('click');
        return false;
    });

    $('.btn-cover-upload').click(function (event) {
        $('#cover-upload').trigger('click');
        return false;
    });

    $('#profile-upload').change(function () {
        $('#submit-profile-pic').submit();
    });

    $('#cover-upload').change(function () {
        $('#submit-cover-pic').submit();
    });

    //Image modal
    //If photo is from sidebar
    $('.user-image').click(function(event) {

        event.preventDefault();
        if (userImgs.length == 1) {
            $(".im-arrow").hide();
        }
        else {
            $(".im-arrow").show();
        }

        var image = $('#modal-image');
        image.attr('src', $(this).attr('src'));
        image.attr('data-post', "sidebar");
        image.attr('data-index', $(this).attr('id').split('-')[1]);

        $('#image-modal').modal();
    });

});