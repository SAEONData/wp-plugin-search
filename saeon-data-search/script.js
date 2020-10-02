
jQuery(document).ready(function($) {
	
	/* search */
	$('body').on('submit', '.sn-ds-form', function(e){
		e.preventDefault();
		var searchterm = $('.ds-datasearch').val();
		var searchurl = 'https://catalogue.saeon.ac.za/render/';
		
		var theframe = $('#sn-ds-iframe');
		var resultsonly = $('#sn-ds-resultsonly');
		var allowsearch = $('#sn-ds-allowsearch');
		
		var theframesrc = searchurl+'render/records?text='+searchterm;

		var resultsshortcode = $('#saeon-data-search-resuts');

		if(resultsshortcode){
			$(resultsshortcode).append(theframe);
		}

		if(allowsearch){
			searchurl = 'https://catalogue.saeon.ac.za/';
		};
		if(resultsonly){
			var theframesrc = searchurl+'records?text='+searchterm+'&disableSidebar=true';
		};
		if(theframe){
			$(theframe).attr('src',theframesrc).fadeIn(600);	
		}
		if(theframe.length === 0){
			window.open(theframesrc,'_blank');
		}
	});
	

});