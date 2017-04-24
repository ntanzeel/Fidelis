$(document).ready(function () {
    $('.btn-pending').on('click', function (event) {
        event.preventDefault();

        var $btn = $(this);
        var $method = $btn.hasClass('btn-accept-follow') ? 'POST' : 'DELETE';

        $.ajax({
            url: $btn.attr('href'),
            method: $method,
            data: {
                user: $btn.data('user')
            },
            beforeSend: function (xhr) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            },
            success: function (response) {
                var divId = 'pending-' + $btn.data('user');
                $('#' + divId).hide('slow');
            },
            error: function (response) {
            }
        })
    });
});