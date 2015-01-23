$(document).ready(function() { 
	$(".fancy").fancybox({
		openEffect	: 'elastic',
		closeEffect	: 'elastic',
		allowfullscreen   : 'true',
		allowscriptaccess : 'always',
		helpers : {
			media : {},
			overlay: {locked: false}
		}
	}); 
});