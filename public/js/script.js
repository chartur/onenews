function breakingNewsAnimationDuration() {
	var width = $('.moving-line').width();
	var el = document.getElementById('moving-line');
	el.style["-webkit-animation-duration"] = width * 0.2 + 's';
}

$(document).ready(function () {

	$(document).click(function(){
		$('.hamburger-menu-toggle').removeClass('main-active-background-color active');
		$('.mobile-menu').removeClass('d-block')
	});

	$('.hamburger-menu-toggle').click(function (e) {
		e.stopPropagation();
		$(this).toggleClass('main-active-background-color active');
		$('.mobile-menu').toggleClass('d-block')
	});

	var nav = $('nav');
	var nav_top = nav.offset().top;
	console.log(nav_top);
	$(window).scroll(function() {
		var scroll = $(window).scrollTop();

		if (scroll >= nav_top){
			nav.addClass('fixed-menu');
		} else {
			nav.removeClass('fixed-menu');
		}
	});
});

function loadPostsByPlaces() {
	$('div.data-loader').each(function () {
		var place = $(this).data('place');
		$(this).load('/loader/place-loader/'+place);
	})
}
function loadGeneralPost() {
	$('.general-post').load('/loader/main-post');
}

function openSearchInput(el) {
	$('.search-form').toggleClass('d-block d-none');
	$('.switch-search-input').toggleClass('main-active-border-color')
}