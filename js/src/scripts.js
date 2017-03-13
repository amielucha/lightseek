jQuery(document).ready( ($) => {
	// initialize FitVids
	// documentation: https://github.com/davatron5000/FitVids.js
	// $(".front-page, .hentry").fitVids();

	$('#primary-menu').on('click', function(event) {
		if(event.target == this){ // only if the target itself has been clicked
			event.preventDefault();
			$('#menu-toggle').prop('checked', false);
		}
	});
});

WebFont.load({
	google: {
		families: ['Open+Sans:400,400italic,600,600italic,700,700italic:latin'],
		//text: 'abcdedfghijklmopqrstuvwxyz!'
	}
});
