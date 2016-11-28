/**
 * Created by ishegambe on 25/11/2016.
 */
$(document).ready(function () {

    $('form.ajax').on('submit', function (e) {
        e.preventDefault();

        var form = $(this);
        var thread = $('#thread ul').last();
        var text = $('textarea#text').val();
        console.log('Text: ' + text);


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
                console.log('Success!');
                form.trigger('reset');
                // thread.append('<li class="media">'+response+'</li>');

                console.log(response);
            },
            error: function (response) {
                console.log('Error :(');
                console.log(response.responseJSON);
            }
        });
    });
});