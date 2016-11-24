$(document).ready(function () {
    $('.btn-subscribe-toggle').on('click', function () {
        event.preventDefault();

        var $btn = $(this);

        $.ajax({
            url: $btn.data('api') + '/' + ($btn.data('status') == 1 ? $btn.data('id') : ''),
            type: 'POST',
            data: {
                _token : window.Laravel.csrfToken,
                _method: $btn.data('status') == 1 ? 'DELETE' : 'POST',
                tag: $btn.data('id')
            },
            success: function (response) {
                $btn.data('status', $btn.data('status') == 1 ? 0 : 1);
                $btn.text($btn.data('status') == 1 ? 'Unsubscribe' : 'Subscribe')
            },
            error: function (response) {
                console.log(response);
            }
        });
    });
});