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

    $('#fileupload').fileupload({
        url: '/file/save',
        dataType: 'json',
        data: user_id,
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo(document.body);
            });
        }
    });
});