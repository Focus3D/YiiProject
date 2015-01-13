/**
 * Created by maksimtrunov on 20.07.14.
 */

$(function () {
	$('#uploadform-files').fileupload({
		replaceFileInput: false,
		dataType: 'json',
		url: $('#files-form').attr('action'),

		add: function (e, data) {
			$('#files-form')
				.submit(function () {
					data.submit();
					return false;
				});
		},

		progressall: function (e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#files-form-progress .progress-bar').css('width', progress + '%');
		}
	});
});