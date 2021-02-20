$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$.fn.contentLoader = function (size) {
    const sizes = ['small', 'medium', 'large'];

    if(!size) {
        size = 'medium'
    }

    if(sizes.indexOf(size) == -1) {
        size = 'medium'
    }

    this.html(
        `<div class="card my-loader-card ${size}">
            <div class="loader"></div>
        </div>`
    );

    return this;
}

function showMessage(status, message) {
	var content = '<div class="alert alert-'+ status +' alert-block">' +
			'<button type="button" class="close" data-dismiss="alert">×</button>' +
			'<strong>'+ message +'</strong>' +
			'</div>';

	$('#flash-message-container').html(content);
	NProgress.done();
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
