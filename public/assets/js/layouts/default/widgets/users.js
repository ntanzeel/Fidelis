$(document).ready(function () {
    $('.action-accept').on('click', function () {
        event.preventDefault();
        ajaxPost($(this));
    });

    $('.action-reject').on('click', function () {
        event.preventDefault();
        ajaxPost($(this));
    });

    function ajaxPost($btn) {
        $.ajax({
            url: $btn.attr('href'),
            method: 'POST',
            data: {
                user: $btn.data('user')
            },
            beforeSend: function (xhr) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            },
            success: function (response) {
                $btn.toggleClass('active');
            },
            error: function (response) {
            }
        });
    }
});