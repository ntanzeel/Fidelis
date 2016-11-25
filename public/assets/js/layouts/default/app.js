$(document).ready(function () {
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