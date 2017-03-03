$(document).ready(function () {
    $('.btn-search').on('click', function () {
        $('.btn-search').hide();
        $('.navbar-brand').hide();
        $('.txt-search').show();
        $('.txt-search').focus();
    });

    $('.txt-search').focusout(function () {
        if ($(this).val().length == 0) {
            $('.txt-search').hide();
            $('.navbar-brand').show();
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