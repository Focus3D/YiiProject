/**
 * Created by maksimtrunov on 20.07.14.
 */
$(function () {
	"use strict";

	$('.bxslider').bxSlider({
		slideWidth: 600,
		minSlides: 1,
		maxSlides: 1,
		autoStart: true,
		pause: 200
	});

	$('#fileupload').fileupload({
		dataType: 'json',
		autoUpload: false,
		acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
		maxFileSize: 5000000, // 5 MB
		progress: function (e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10),
				bar = $('.progress-bar');
			bar.css('width', progress + '%');
			bar.text(progress + '%');
		},
		add: function (e, data) {
			var jqXHR = data.submit()
				.success(function (result, textStatus, jqXHR) {
					if(textStatus == 'success') {
						alert('Загрузка файла прошла успешно.');
					}
				})
				.error(function (jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
					console.log(textStatus);
				});
		}
	});
});