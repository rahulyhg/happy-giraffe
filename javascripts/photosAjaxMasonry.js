var photosAjaxMasonry = {

    init:function (containerSelector, itemSelector, columnWidth) {
        var container = $(containerSelector);
        container.imagesLoaded(function () {
            container.masonry({
                itemSelector:itemSelector,
                columnWidth:parseInt(columnWidth),
                isAnimated: true,
                animationOptions: {
                    duration: 300,
                    easing: 'linear',
                    queue: false
                }
            });
        });
    },

    load:function (element, event) {
        var button = $(element);
        if (button.attr('data-loading') == '1')
            return false;
        button.attr('data-loading', '1').text('Загрузка фотографий');

        var url = button.attr('href');
        var container = $(button.attr('data-masonry-selector'));

        $.post(url, function (data) {
            var html = data.html;
            var newItems = $(html).find(button.attr('data-masonry-selector') + ' ' + button.attr('data-masonry-item'));

            var nextUrl = $(html).find('#more-btn').attr('href');

            if (nextUrl) {
                button.attr('href', nextUrl);
            } else {
                button.hide();
            }

            container.append(newItems);
            container.imagesLoaded(function () {
                container.masonry('appended', newItems, true);
                //container.masonry('reload');
                button.attr('data-loading', '0').text(' Показать еще фотографии ');

                $(button.attr('data-gallery-selector')).pGallery({
                    'singlePhoto':false,
                    'entity':button.attr('data-gallery-entity'),
                    'entity_id':button.attr('data-gallery-entity-id')
                });
            });


        }, 'json');

        return false;
    }
}