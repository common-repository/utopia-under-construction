jQuery(document).ready(function(){
	/* CARTOON */
	jQuery('#Utopia_cartoon').change(function() {
	  jQuery('#Utopia_cartoon_preview').html('<img src="'+ JSParams.utopia_url + '_images/' + jQuery(this).val() +'" alt="">');
	});	
	jQuery('#Utopia_cartoon_preview').html('<img src="'+ JSParams.utopia_url + '_images/' + jQuery('#Utopia_cartoon').val() +'" alt="">');
	
});
