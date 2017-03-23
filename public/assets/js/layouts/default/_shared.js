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
        error: function (response) {
        }
    });
});

$('.content-panel').on('click', '.action-vote', function (event) {
    event.preventDefault();

    var isLike = $(this).hasClass('action-like');

    var $button = $(this);

    if ($button.parent().hasClass('disabled')) {
        return;
    }

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
        error: function (response) {
        }
    });
}).on('click', '.action-flag', function (event) {
    event.preventDefault();

    var $button = $(this);

    if ($button.parent().hasClass('disabled')) {
        return;
    }

    $.ajax({
        url: $button.attr('href'),
        method: 'POST',
        data: {},
        beforeSend: function (xhr) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        },
        success: function (response) {
            if (response.status) {
                $button.addClass('active');
            } else {
                $button.removeClass('active');
            }
        },
        error: function (response) {
        }
    });
}).on('click', '.action-delete', function (event) {
    event.preventDefault();

    var $button = $(this);

    $.ajax({
        url: $button.attr('href'),
        method: 'DELETE',
        data: {},
        beforeSend: function (xhr) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        },
        success: function (response) {
            var $media = $button.parents('.media');
            if ($media.length > 0) {
                $media.remove();
            } else {
                var $post = $button.parents('.post');
                if ($post.length > 0) {
                    window.location.href = '/home'
                }
            }
        },
        error: function (response) {
        }
    });
});

$('.btn-follow-toggle').on('click', function () {
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
            $btn.data('status', $btn.data('status') == 1 ? 0 : 1);
            $btn.text($btn.data('status') == 1 ? 'Unfollow' : 'Follow');
            $btn.toggleClass('btn-danger btn-primary');
        },
        error: function (response) {
        }
    });
});

$('.action-accept').on('click', function () {
    event.preventDefault();

    ajaxPost($(this), 1);
});

$('.action-reject').on('click', function () {
    event.preventDefault();

    ajaxPost($(this), 0);
});

function ajaxPost($btn, $type) {
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
            $type == 1 ? $('#following-value').html(parseInt($('#following-value').html(), 10) + 1) : '';
            var divId = 'recommendation-' + $btn.data('user');
            $('#' + divId).hide('slow');
        },
        error: function (response) {
        }
    });
}