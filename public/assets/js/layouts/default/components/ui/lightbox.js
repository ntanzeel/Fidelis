(function (window, undefined) {

    $(function () {

            $.fn.LightBox = function () {
                var $this = $(this);

                $this.on('click', '.lightbox', function (event) {
                    event.preventDefault();
                    return new LightBox($(this)).show();
                });
            };

            $('body').LightBox();

            function LightBox(image) {
                var $modal = $('#lightbox-modal');
                var input = {
                    image: image,
                    type: image.data('type') ? image.data('type').toLowerCase() : 'single',
                    source: !image.data('type') || image.data('type') == 'single' ? image.attr('src') : image.data('source'),
                    album: !image.data('type') || image.data('type') == 'single' ? null : image.data('album')
                };

                this.controls = {
                    next: $modal.find('.scroll-right'),
                    previous: $modal.find('.scroll-left')
                };


                this.requestImage = function (type, source, album) {
                    if (type == 'single') {
                        this.callback({
                            next: false,
                            previous: false,
                            source: source
                        });
                    } else {
                        var that = this;
                        $.get('api/' + type + '/' + album + '/image/' + source, function (response) {
                            if (response.hasOwnProperty('source')) {
                                that.callback(response);
                            }
                        }, 'json');
                    }
                };

                this.callback = function (response) {
                    console.log(response);
                    this.response = response;

                    if ((response.next != false && this.controls.next.hasClass('hidden'))
                        || (response.next == false && !this.controls.next.hasClass('hidden'))) {
                        this.controls.next.toggleClass('hidden');
                    }
                    if ((response.previous != false && this.controls.previous.hasClass('hidden'))
                        || (response.previous == false && !this.controls.previous.hasClass('hidden'))) {
                        this.controls.previous.toggleClass('hidden');
                    }

                    $modal.find('.img').first().css('background-image', 'url(' + response.source + ')');

                    $modal.modal('show');
                };

                this.init = function () {
                    var that = this;
                    $modal.on('click', '.scroll-left', function (event) {
                        event.preventDefault();

                        if (that.response.previous) {
                            that.requestImage(input.type, that.response.previous, input.album);
                        }
                    });

                    $modal.on('click', '.scroll-right', function (event) {
                        event.preventDefault();

                        if (that.response.next) {
                            that.requestImage(input.type, that.response.next, input.album);
                        }
                    });
                };

                this.show = function () {
                    this.init();
                    this.requestImage(input.type, input.source, input.album);
                }
            }
        }
    );
})(window);