jQuery(function ($) {
	var $searchlink = $('#search-toggle i');
	var $searchbar  = $('#search-bar');
	var $searchfield = $('#search-text');
	
	$('#search-toggle').on('click', function(e){
		e.preventDefault();
	
	if($(this).attr('id') === 'search-toggle') {
		if(!$searchbar.is(":visible")) { 
			// if invisible we switch the icon to appear collapsable
			$searchlink.removeClass('fa-search').addClass('fa-search-minus');
		} else {
			// if visible we switch the icon to appear as a toggle
			$searchlink.removeClass('fa-search-minus').addClass('fa-search');
		}
		
		$searchbar.slideToggle(250, function(){
			// callback after search bar animation
			$searchfield.focus();
			});
		}
	});
	
	$('#searchform').submit(function(e){
		e.preventDefault(); // stop form submission
	});
	
	// External Link Pop-up with domains to whitelist

 	var domains = ['csd509j.net', 'csd509j.us2', 'https://teachcorvallis.org', 'https://www.parentsquare.com'];

	$('a[href^="http"]').on('click', function (e) {
		
		var link = $(this).attr('href');
		
		var external = domains.find( function (domain) {
			var reg = new RegExp( domain );
			return link.match(reg) !== null;		
		});

		if ( external === undefined ) {
			e.preventDefault();
			$('#externalLink').attr('href', $(this).attr('href'));
			$('#modalNotification').modal('show');
		}
				
	});

	
});
