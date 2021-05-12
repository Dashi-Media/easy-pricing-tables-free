$ = jQuery
$(document).ready(function(){

	if( fca_ept.id == 'edit-easy-pricing-table' ){

		// hide notice until loaded
		$('#fca-ept-fullscreen-notice').css('display', 'block')

		// set 'skip for now' to close screen
		$('#fca-ept-hide-notice').click( function(){
			// never show again and close this
			$forever_dismiss = window.location.href + '&dh_ptp_forever_dismiss_notice'
			window.location = $forever_dismiss
			$('.notice-dismiss').click()
		})

		// editor page Add New url
		$('.page-title-action').click( function( event ){
			event.preventDefault()
			$try_gutenberg = window.location.href + '&dh_ptp_try_gutenberg'
			window.location = $try_gutenberg
		})
	}

	// Change EPT sidebar Add New url
	$add_new = $('a[href="post-new.php?post_type=easy-pricing-table"]')
	$add_new.attr('href', $add_new.attr('href') + '&dh_ptp_try_gutenberg' )

})