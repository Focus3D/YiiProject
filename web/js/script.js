/**
 * Created by maksimtrunov on 20.07.14.
 */
$(function () {
    "use strict";
    $('.bxslider').bxSlider({
        slideWidth: 300,
        slideMargin: 10,
        minSlides: 3,
        maxSlides: 3
    });

    var url = $('input:file').data('url');

    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        add: function (e, data) {
            console.log(e);
        },
        change: function (e, data) {
            $.each(data.files, function (index, file) {
                console.log(file);
            });
        },
        done: function (e, data) {
            console.log(data);
        }
    });
});