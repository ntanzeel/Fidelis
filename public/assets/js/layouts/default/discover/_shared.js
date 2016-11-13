/**
 * Created by jordan on 12/11/16.
 */

$(document).ready(function(){

    $('.btn-subscribe').click(function(){
        $(this).blur();
        if ($(this).html() == "Subscribe") {
            $(this).html("Unsubscribe");
        }
        else {
            $(this).html("Subscribe");
        }
    });

    $('.btn-unsubscribe').click(function(){
        if ($('.btn-unsubscribe').length == 1){
            $(this).parent().parent().prepend("You have no subscriptions");
        }
        $(this).parent().remove();
    });

});