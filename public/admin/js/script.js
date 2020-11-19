$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

function showMessage(status, message) {
	var content = '<div class="alert alert-'+ status +' alert-block">' +
			'<button type="button" class="close" data-dismiss="alert">×</button>' +
			'<strong>'+ message +'</strong>' +
			'</div>';

	$('#flash-message-container').html(content);
	NProgress.done();
}


function searchTag(inputSelector, callback) {
	//setup before functions
	var typingTimer;                //timer identifier
	var doneTypingInterval = 700;  //time in ms, 3 second for example
	var $input = $(inputSelector);

//on keyup, start the countdown
	$input.on('keyup', function () {
		clearTimeout(typingTimer);
		typingTimer = setTimeout(callback, doneTypingInterval);
	});

//on keydown, clear the countdown
	$input.on('keydown', function () {
		clearTimeout(typingTimer);
	});

	$input.on('search', function () {
		clearTimeout(typingTimer);
		callback();
	});
}

$(document).ready(function () {
	$('.options-toggle-button').click(function () {
		$('.options-container').toggleClass('open');
		$('.overlay').toggle();
	})

	$('.overlay').click(function () {
		$('.overlay-close').removeClass('open');
		$(this).toggle();
	});

	$('.language-container-switcher').click(function () {
		$('.language-container-switcher').removeClass('btn-primary');
		$(this).addClass('btn-primary');

		var lang = $(this).data('lang');
		$('.post-language-container').attr('data-lang', lang)
	})
});