$(document).ready(function () {
    $('[data-tooltip="true"]').tooltip();

    var $searchForm = $('.navbar-search');

    $searchForm.on('keyup focus', 'input', function () {
        var query = encodeURIComponent($(this).val());

        if ($(window).width() >= 768 && query.length > 0) {
            $.ajax({
                url: '/api/search/' + query,
                method: 'GET',
                dataType: "json",
                success: function (data) {
                    $searchForm.find('.search-results').empty();

                    appendResults(data.tags, 'Categories');
                    appendResults(data.users, 'Users');

                    if (data.users.length > 0 || data.tags.length > 0) {
                        $searchForm.addClass('open');
                    } else {
                        $searchForm.removeClass('open')
                    }
                }
            });
        } else {
            $searchForm.removeClass('open').find('.search-results').empty();
        }
    }).on('blur', 'input', function () {
        $searchForm.removeClass('open').find('.search-results').empty();
    });

    function appendResults(results, label) {
        var isUser = label == 'Users';

        if (results.length > 0) {
            var $label = $('<li class="dropdown-header">' + label + '</li>');
            $searchForm.find('.search-results').append($label);

            for (var i = results.length - 1; i >= 0; i--) {
                var template = '';
                if (isUser) {
                    template = '<a href="/@' + results[i].username + '">' +
                        '<img src="' + results[i].photo + '" />' +
                        '<span class="user-info">' +
                        '<span class="full-name">' + results[i].name + '</span>' +
                        '<span class="username">@' + results[i].username + '</span>' +
                        '</span>' +
                        '</a>';
                } else {
                    template = '<a href="/discover/' + results[i].text + '">' +
                        results[i].text +
                        '</a>';
                }

                $label.after('<li>' + template + '</li>');
            }
        }
    }
});