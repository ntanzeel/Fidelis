/**
 * Created by jordan on 12/11/16.
 */

$(document).ready(function () {

    function unsubscribe(id) {
        $.ajax({
            url: unsubscribeUrl,
            type: 'post',
            data: {
                tag: id,
                _token: token
            }
        })
            .done(function (data) {
                console.log(data);
            })
            .fail(function (data) {
                console.log(data.responseText);
            });
    }

    function subscribe(id) {
        $.ajax({
            url: subscribeUrl,
            type: 'post',
            data: {
                tag: id,
                _token: token
            }
        })
            .done(function (data) {
                console.log(data);
            })
            .fail(function (data) {
                console.log(data.responseText);
            });
    }

    $('.btn-subscribe').click(function () {
        if ($(this).html().trim() === "Subscribe") {
            $(this).html("Unsubscribe");
            subscribe($(this).attr('id'));
        }
        else {
            $(this).html("Subscribe");
            unsubscribe($(this).attr('id'));
        }
        $(this).blur();
    });

    $('.btn-unsubscribe').click(function () {
        if ($('.btn-unsubscribe').length == 1) {
            $(this).parent().parent().prepend("You have no subscriptions");
        }
        unsubscribe($(this).attr('id'));
        $(this).parent().remove();
    });

});