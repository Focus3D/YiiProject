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
		maxFileSize: 5000000 // 5 MB

	});
});