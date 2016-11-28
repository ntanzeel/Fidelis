$(document).ready(function () {
    $('.action-vote').on('click', function (event) {
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
    })
});