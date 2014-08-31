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
        add: function (e, data) {
            $.each(data.files, function (index, file) {
                console.log('Added file: ' + file.name);
            });
            var jqXHR = data.submit()
                .success(function (result, textStatus, jqXHR) {console.log(result); })
                .error(function (jqXHR, textStatus, errorThrown) {console.log(jqXHR); })
                .complete(function (result, textStatus, jqXHR) {console.log(result); });
        },
        change: function (e, data) {
            $.each(data.files, function (index, file) {
                console.log(file);
            });
        },
        done: function (e, data) {
            console.log(data);
        },
        start: function (e) {
            console.log('Uploads started');
        }
    });
});