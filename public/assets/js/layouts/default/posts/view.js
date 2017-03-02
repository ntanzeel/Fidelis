/**
 * Created by ishegambe on 25/11/2016.
 */
$(document).ready(function () {

    $('form.ajax').on('submit', function (e) {
        e.preventDefault();

        var form = $(this);
        var thread = $('.media');
        var comments = $('.comment-list').last();

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: new FormData(form[0]),
            processData: false,
            contentType: false,
            beforeSend: function (xhr) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            },
            success: function (response) {
                form.trigger('reset');

                comments.append('<li class="media">' + response + '</li>');
            },
            error: function (response) {}
        });
    });
});