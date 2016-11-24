$(document).ready(function () {
    $('.btn-unsubscribe').on('click', function (event) {
        event.preventDefault();
        var $btn = $(this);
        var $list = $('.subscription-list');

        $.ajax({
            url: $btn.attr('href'),
            method: 'POST',
            data: {
                _token: window.Laravel.csrfToken,
                _method: 'DELETE'
            },
            success: function (response) {
                $btn.parent('li').remove();

                if ($list.children().length == 0) {
                    $list.append(
                        '<li class="text-center">' +
                        'You aren\'t subscribed to any categories. Checkout the <a href="/discover">discover</a> page to get started.' +
                        '</li>'
                    );
                }
            },
            error: function (response) {
                console.log(response)
            }
        });
    });
});