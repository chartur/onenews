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

function translatePost() {
	NProgress.start();
	var hy_content = tinymce.get('hy_content').getContent({ format: "text" }).trim();
	var hy_title = $('input[name=hy_title]').val().trim();
	var hy_desc = $('textarea[name=hy_description]').val().trim();

	$.ajax({
		url: '/cabinet/posts/translate',
		type: 'post',
		data: {
			hy_content,
			hy_title,
			hy_description: hy_desc
		},
		dataType: 'json',
		complete: NProgress.done,
		success: function(res) {
			tinymce.get('ru_content').setContent(res.data.content);
			$('input[name=ru_title]').val(res.data.title);
			if(res.data.description) {
				$('textarea[name=ru_description]').val(res.data.description);
			}

			$('.language-container-switcher[data-lang="ru"]').trigger('click')

			showMessage(res.status, res.message)
		},
		error: function (err) {
			showMessage(err.responseJSON.status, err.responseJSON.message);
		}
	})
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


function loadOptionsContentCreatorTemplate(optionId) {
	$('#options-content-cretor-container')
            .contentLoader('small')
            .load('/cabinet/options/content-creator/' + optionId);

}