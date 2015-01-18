/**
 * Created by admin on 18.01.15.
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
		},

		done: function (e, data) {
			var form = $('#files-form');
			form.find('.help-block').text('Файлы успешно загруженны.');
			setTimeout(function () {
				$('#files-form-progress .progress-bar').css('width', '0%');
				form.find('[type=reset]').click();
				form.find('.help-block').text('');
			}, 3000);
		}
	});
});