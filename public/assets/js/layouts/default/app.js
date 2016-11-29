$(document).ready(function () {
    $('.content-panel').on('click', '.action-vote', function (event) {
        event.preventDefault();

        var isLike = $(this).hasClass('action-like');

        var $button = $(this);
        var $opposite = $button.parents('.action-list')
            .find('.action-' + (isLike ? 'dislike' : 'like'));

        $.ajax({
            url: $button.attr('href'),
            method: 'POST',
            data: {
                type: $button.data('type')
            },
            beforeSend: function (xhr) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            },
            success: function (response) {
                $button.toggleClass('active');
                $opposite.removeClass('active');

                $button.find('.text').text(isLike ? response.likes : response.dislikes);
                $opposite.find('.text').text(isLike ? response.dislikes : response.likes);
            },
            error: function (response) {}
        });
    });

    $('.btn-follow-toggle').on('click', function () {
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
                $btn.text($btn.data('status') == 1 ? 'Unfollow' : 'Follow');
                $btn.toggleClass('btn-danger btn-primary');
            },
            error: function (response) {
            }
        });
    });
});