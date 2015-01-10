navigator.getUserMedia = (navigator.getUserMedia ||
	navigator.webkitGetUserMedia ||
	navigator.mozGetUserMedia ||
	navigator.msGetUserMedia);

if (navigator.getUserMedia) {
	navigator.getUserMedia({audio: true, video: false}, function (stream) {
		var audio = document.querySelector('audio');
		audio.src = window.URL.createObjectURL(stream);
		audio.play(); //important!!
	}, function (err) {
		console.log('Some error occurred: ' + err);
	});
}
else {
	//some fallback
}

if (navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(function (position) {
		console.log(position);

	}, function (error) {
		alert("Error occurred. Error code: " + error.code);
		// error.code can be:
		//   0: unknown error
		//   1: permission denied
		//   2: position unavailable (error response from location provider)
		//   3: timed out
	});
}