
jQuery(document).ready(function($) {
	
	/* search */
	$('body').on('submit', '.sn-ds-form', function(e){
		e.preventDefault();
		
		var searchterm = $('.ds-datasearch').val();
		var searchurl = 'https://catalogue.saeon.ac.za/records?text='
		//console.log(searchurl + searchterm);
		window.open(searchurl + searchterm,'_blank');
	});
	

});