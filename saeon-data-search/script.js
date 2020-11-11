
jQuery(document).ready(function($) {
	
	/* search */

	// Run functions if the search is on the page
	if($('.sn-ds-form')[0]){

	$('body').on('submit', '.sn-ds-form', function(e){
		// prevent standard submit
		e.preventDefault();

		// get the input search term
		var searchterm = $('.ds-datasearch').val();

		var searchurl = 'https://catalogue.saeon.ac.za/render/'; // SAEON search system
		var theframe = $('#sn-ds-iframe'); // Iframe rendering element
		var resultsonly = $('#sn-ds-resultsonly'); // Hidden input choose only show results
		var allowsearch = $('#sn-ds-allowsearch'); // Hidden input to allow search in results
		var referrer = window.location.origin; // The URL of the website

		// Create iframe url src		
		var theframesrc = searchurl+'render/records?text='+searchterm+'&referrer='+referrer;
		// Element A where results will list if not directly under search input
		var resultsshortcode = $('#saeon-data-search-resuts');

		// If resultsshortcode is used, load iframe for result listing instead of pop out
		if(resultsshortcode){
			$(resultsshortcode).append(theframe);
		}

		// If allowsearch is selected use base url which allows search inside of results
		if(allowsearch){
			searchurl = 'https://catalogue.saeon.ac.za/';
		};
		// If resultsonly is selected hide result listing sidebar
		if(resultsonly){
			var theframesrc = searchurl+'render/records?text='+searchterm+'&disableSidebar=true'+'&referrer='+referrer;;
		};
		// Create the iframe if theframe exists
		if(theframe){
			$(theframe).attr('src',theframesrc).fadeIn(600);	
			console.log('open in framer');
		}
		// If theframe does not exist, open results in new window
		if(theframe.length === 0){
			window.open(theframesrc,'_blank');
		}
	});
	
}

});