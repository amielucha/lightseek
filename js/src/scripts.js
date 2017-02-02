jQuery(document).ready( ($) => {
	// initialize FitVids
	// documentation: https://github.com/davatron5000/FitVids.js
	$(".front-page, .hentry").fitVids();
	$('.custom-logo').click(function (e) {
		e.preventDefault();
		alert('bop');
	});
});

WebFont.load({
  google: {
    families: ['Open+Sans:400,400italic,600,600italic,700,700italic:latin'],
    //text: 'abcdedfghijklmopqrstuvwxyz!'
  }
});
