
jQuery(document).ready(function($) {
	
	/* search */
	$('body').on('submit', '.sn-ds-form', function(e){
		e.preventDefault();
		var searchterm = $('.ds-datasearch').val();
		var searchurl = 'https://catalogue.saeon.ac.za/render/';
		
		var theframe = $('#sn-ds-iframe');
		var resultsonly = $('#sn-ds-resultsonly');
		var allowsearch = $('#sn-ds-allowsearch');
		var origin_id = window.location.origin; 
		//var origin_id = encodeURIComponent(origin_uri);
		console.log(origin_id);
		
		var theframesrc = searchurl+'render/records?text='+searchterm+'&origin_id='+origin_id;

		var resultsshortcode = $('#saeon-data-search-resuts');

		if(resultsshortcode){
			$(resultsshortcode).append(theframe);
		}

		if(allowsearch){
			searchurl = 'https://catalogue.saeon.ac.za/';
		};
		if(resultsonly){
			var theframesrc = searchurl+'render/records?text='+searchterm+'&disableSidebar=true'+'&origin_id='+origin_id;;
		};
		if(theframe){
			$(theframe).attr('src',theframesrc).fadeIn(600);	
			console.log('open in framer');
		}
		if(theframe.length === 0){
			window.open(theframesrc,'_blank');
		}
	});
	

});