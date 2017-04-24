$(document).ready(function () {
    var $postForm = $('.post-form').first();

    $postForm.find('.image-upload').find('.toggle').on('click', function (event) {
        event.preventDefault();

        $postForm.find('#post-images').trigger('click');
    });

    $postForm.find('#post-images').on('change', function (event) {
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
        var discover = $form.attr('data-discover');

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

                if ($posts.data('empty') == 1) {
                    $posts.empty();
                    $posts.data('empty', '0');
                }
                $posts.prepend('<li class="media">' + response + '</li>');

                var id = $(response).attr('id').split('-')[1];
                $('#post-'+id).find('.category-link').first().html('Loading category...');

                var $name = $form.find('.image-upload').find('.file-name');
                $name.text('');

                var tot = parseInt($('#posts-value').html());
                $('#posts-value').html(tot+1);

                predictPost($form.attr('action')+'/categorise/', id, discover);
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

function predictPost(url, id, discover) {
    $.ajax({
        url: url + id,
        method: 'get',
        processData: false,
        contentType: false,
        beforeSend: function (xhr) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        },
        success: function (response) {
            var categoryDiv = $('#post-'+id).find('.category-link').first();
            if (response['id'] == 0) {
                categoryDiv.html("<a id='edit-0' class='edit-category' href='#'><i class='fa fa-pencil'></i></a>No category");
            }
            else {
                categoryDiv.html("<a id='edit-"+response['id']+"' class='edit-category' href='#'><i class='fa fa-pencil'></i></a><a href='"+discover+response['name']+"'>"+response['name']+"</a>");
            }
        },
        error: function (response) {
            var errors = response.responseJSON;
        }
    });
}
