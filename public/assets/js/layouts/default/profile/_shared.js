$(document).ready(function(){

    $('.btn-toggle-block').on('click', function () {
        event.preventDefault();

        var $btn = $(this);

        $.ajax({
            url: $btn.data('api') + '/' + ($btn.data('status') == 1 ? $btn.data('id') : ''),
            type: 'POST',
            data: {
                _token : window.Laravel.csrfToken,
                _method: $btn.data('status') == 1 ? 'DELETE' : 'POST',
                user: $btn.data('id')
            },
            success: function (response) {
                $btn.data('status', $btn.data('status') == 1 ? 0 : 1);
                $btn.text($btn.data('status') == 1 ? 'Unblock' : 'Block');
            },
            error: function (response) {

            }
        });
    });

    $('.profile-photo-container').hover(function(){
        $('.btn-upload').css('visibility', 'visible');
    });

    $('.profile-photo-container').mouseleave(function(){
        $('.btn-upload').css('visibility', 'hidden');
    });

    $('.profile-cover').hover(function(){
        $('.btn-cover-upload').css('visibility', 'visible');
    });

    $('.profile-cover').mouseleave(function(){
        $('.btn-cover-upload').css('visibility', 'hidden');
    });

    $('.btn-upload').click(function(event){
        $('#profile-upload').trigger('click');
        return false;
    });

    $('.btn-cover-upload').click(function(event){
        $('#cover-upload').trigger('click');
        return false;
    });

    $('#profile-upload').change(function(){
        $('#submit-profile-pic').submit();
    });

    $('#cover-upload').change(function(){
        $('#submit-cover-pic').submit();
    });

});