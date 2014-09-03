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
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB

    });
});