
jQuery(document).ready(function($) {
	
	/* search */
	$('body').on('submit', '.sn-ds-form', function(e){
		e.preventDefault();
		var searchterm = $('.ds-datasearch').val();
		var searchurl = 'https://catalogue.saeon.ac.za/';
		
		var theframe = $('#sn-ds-iframe');
		
		if(theframe){
			//var theframesrc = $(searchurl + searchterm);
			$(theframe).attr('src',searchurl + 'render/records?text=' + searchterm);
			$(theframe).fadeIn(600);
			
		}else{
			console.log('iframe false');
		// var searchterm = $('.ds-datasearch').val();
		// var searchurl = 'https://catalogue.saeon.ac.za/records?text='
		// //console.log(searchurl + searchterm);
		// window.open(searchurl + searchterm,'_blank');
		}
	});
	

});