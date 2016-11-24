$(document).ready(function () {
    var $postForm = $('.post-form').first();

    $postForm.find('.image-upload').find('.toggle').on('click', function (event) {
        console.log('test');
        event.preventDefault();

        $postForm.find('#post-images').trigger('click');
    });

    $postForm.find('#post-images').on('change', function(event) {
        var $name = $postForm.find('.image-upload').find('.file-name');
        if (event.target.files.length > 1) {
            $name.text(event.target.files.length + ' Files');
        } else if (event.target.files.length == 1) {
            $name.text(event.target.files[0].name);
        } else {
            $name.text('');
        }
    });


    var $posts = $('.post-list').first();

    $('form.ajax').on('submit', function (e) {
        e.preventDefault();

        var $form = $(this);

        $.ajax({
            url: $form.attr('action'),
            method: $form.attr('method'),
            data: new FormData($form[0]),
            processData: false,
            contentType: false,
            beforeSend: function (xhr) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            },
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