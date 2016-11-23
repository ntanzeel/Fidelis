$(document).ready(function () {
    var $posts = $('.post-list').first();

    $('form.ajax').on('submit', function (e) {
        e.preventDefault();

        var $form = $(this);

        $.ajax({
            url: $form.attr('action'),
            method: $form.attr('method'),
            data: $form.serialize(),
            success: function (response) {
                $form.trigger('reset');
                $posts.prepend('<li class="media">' + response + '</li>');
            },
            error: function (response) {
                var errors = response.responseJSON;

                for (var key in errors) {
                    $form.find('[name="' + key + '"]').parent('.form-group').addClass('has-error');
                }
            }
        });
    });
});