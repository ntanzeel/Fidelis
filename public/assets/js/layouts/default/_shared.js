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

$('.content-panel').on('click', '.post', function (event) {
    window.location.href = $(this).data('url');
}).on('click', '.action-vote', function (event) {
    event.preventDefault();
    event.stopPropagation();

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
    event.stopPropagation();

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
    event.stopPropagation();

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
            var divId = 'recommendation-' + $btn.data('user');
            $('#' + divId).hide('slow');
            $type == 1 ? $('#following-value').html(parseInt($('#following-value').html(), 10) + 1) : '';

            var $emptyPanel = $('#recommendation-panel');

            if ($emptyPanel.children(':visible').length == 1) {
                setTimeout(function () {
                    $emptyPanel.append('You have no recommendations')
                }, 800);
            }
        },
        error: function (response) {
        }
    });
}

$('.anchor').on('click', '.edit-category', function (event) {
    event.preventDefault();

    var post = $(this).closest('.post').attr('id').split('-')[1];
    if ($(this).siblings().length == 0) {
        var category = "No category";
    }
    else {
        var category = $(this).siblings().first().html();
    }
    var tag = $(this).attr('id').split('-')[1];
    var modal = $('#category-modal');

    modal.find('.current').first().removeClass('current');
    modal.find(".category-item:contains('" + category + "')").first().find('a').addClass('current');
    modal.attr('data-post', post);
    modal.modal();
});

$('.category-item').click(function (e) {
    e.preventDefault();

    $('#category-modal').find('.current').first().removeClass('current');
    $(this).find('a').addClass('current');
});

$('.btn-save-category').click(function (e) {
    e.preventDefault();

    var modal = $('#category-modal');
    var api = modal.attr('data-api');
    var post = modal.attr('data-post');
    var category = modal.find('.current').first().parent().attr('id').split('-')[1];
    var discover = modal.attr('data-url');

    $.ajax({
        url: api,
        method: 'POST',
        data: {
            post: post,
            category: category
        },
        beforeSend: function (xhr) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        },
        success: function (response) {
            if (response['name'] == 'No category') {
                $('#post-' + post).find('.category-link').html("<a id='edit-0' class='edit-category' href='#'><i class='fa fa-pencil'></i></a>No category");
            }
            else {
                $('#post-' + post).find('.category-link').html("<a id='edit-" + category + "' class='edit-category' href='#'><i class='fa fa-pencil'></i></a><a href='" + discover + response['name'] + "'>" + response['name'] + "</a>");
            }
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
});
