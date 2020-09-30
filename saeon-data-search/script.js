
jQuery(document).ready(function($) {
	
	/* search */
	$('body').on('submit', '.sn-ds-form', function(e){
		e.preventDefault();
		var searchterm = $('.ds-datasearch').val();
		var searchurl = 'https://catalogue.saeon.ac.za/';
		
		var theframe = $('#sn-ds-iframe');
		var resultsonly = $('#sn-ds-resultsonly');
		var allowsearch = $('#sn-ds-allowsearch');
		
		var theframesrc = searchurl+'render/records?text='+searchterm;
			if(allowsearch){
				var searchurl = 'https://catalogue.saeon.ac.za/render/';
			};
			if(resultsonly){
				var theframesrc = searchurl+'render/records?text='+searchterm+'&disableSidebar=true';
			};
		if(theframe){
			
			$(theframe).attr('src',theframesrc).fadeIn(600);
			//$(theframe)
			
		}else{
		//	console.log('iframe false');
		// var searchterm = $('.ds-datasearch').val();
		// var searchurl = 'https://catalogue.saeon.ac.za/records?text='
		// //console.log(searchurl + searchterm);
		 window.open(searchurl + theframesrc,'_blank');
		}
	});
	

});