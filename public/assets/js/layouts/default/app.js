$(document).ready(function () {
    $('.btn-search').on('click', function () {
        $('.btn-search').hide();
        $('.txt-search').show();
        $('.txt-search').focus();
    });

    $('.txt-search').focusout(function () {
        if ($(this).val().length == 0) {
            $('.txt-search').hide();
            $('.btn-search').show()
        }
    });

    var lightbox = $('#lightbox');

    $('[data-target="#lightbox"]').on('click', function (event) {
        var $img = $(this).find('img'),
            src = $img.attr('src'),
            alt = $img.attr('alt'),
            css = {
                'maxWidth': $(window).width() - 100,
                'maxHeight': $(window).height() - 100
            };
        lightbox.find('.close').addClass('hidden');
        lightbox.find('img').attr('src', src);
        lightbox.find('img').attr('alt', alt);
        lightbox.find('img').css(css);
    });

    lightbox.on('shown.bs.modal', function (e) {
        var $img = lightbox.find('img');

        lightbox.find('.modal-dialog').css({'width': $img.width()});
        lightbox.find('.close').removeClass('hidden');
    });
});

function showResult(str) {
    if (str.length == 0) {
        document.getElementById("livesearch").innerHTML="";
        document.getElementById("livesearch").style.border="0px";
        return;
    }

    $.ajax({
        url: 'display',
        method: 'get',
        data: {'str': str},
        processData: false,
        contentType: false,
        beforeSend: function (xhr) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        },
        success: function (response) {
            //For now just want to list out the names of Users/Tsgs returned from the SearchController
            //Not sure exactly how to do so...
            document.getElementById("livesearch").innerHTML = response[];
            document.getElementById("livesearch").style.border = "1px solid #A5ACB2";        },
        error: function (response) {
            console.log(this.responseText);
        }
    });
};