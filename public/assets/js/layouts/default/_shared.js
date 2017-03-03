$('.btn-toggle-block').on('click', function () {
    event.preventDefault();

    var $btn = $(this);

    $.ajax({
        url: $btn.data('api') + '/' + ($btn.data('status') == 1 ? $btn.data('id') : ''),
        type: 'POST',
        data: {
            _token: window.Laravel.csrfToken,
            _method: $btn.data('status') == 1 ? 'DELETE' : 'POST',
            user: $btn.data('id')
        },
        success: function (response) {
            if ($btn.hasClass('btn-unblock')) {
                $btn.parents('.blocked-user').remove();
            } else {
                $btn.data('status', $btn.data('status') == 1 ? 0 : 1);
                $btn.text($btn.data('status') == 1 ? 'Unblock' : 'Block');
            }
        },
        error: function (response) {}
    });
});