$(document).ready(function () {
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

    /*
     *   Showing posts for notification modal
     */
    var notification = $('#notification');

    if (notification.hasClass('show-post')) {
        var id = notification.attr('data-post');
        id = id.replace(/['"]+/g, '');

        var profile = $('.post-user');

        $.ajax({
            url: 'api/post/' + id,
            method: 'GET',
            success: function (response) {
                profile.attr('href', userProfile.replace('username', response.user['username']));
                console.log(profile.attr('href'));
                profile.append(response.user['name']);

                // for(var key in response.comments) {
                //     console.log(response.comments[key]['text']);
                // }
            },
            error: function (response) {
                console.log(response.responseText);
            }
        });
    }
});