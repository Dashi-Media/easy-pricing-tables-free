$ = jQuery
$( document ).ready( function(){

	if( fca_ept.id == 'edit-easy-pricing-table' ){

		// hide notice until loaded
		$( '#fca-ept-fullscreen-notice' ).css( 'display', 'block')

		// set 'skip for now' to close screen
		$( '#fca-ept-hide-notice' ).click( function(){
			// never show again and close this
			$forever_dismiss = window.location.href + '&dh_ptp_forever_dismiss_notice'
			window.location = $forever_dismiss
			$( '.notice-dismiss' ).click()
		} )

	}

	// Change EPT sidebar Add New url
	$add_new = $( 'a[href="post-new.php?post_type=easy-pricing-table"]' )
	$add_new.attr( 'href', $add_new.attr( 'href' ) + '&dh_ptp_new_gutenberg_table' )

	// Change main plugin url to All Pricing Tables
	$main_plugin = $( 'a[href="admin.php?page=ept3-list"]' )
	$main_plugin.attr( 'href', 'edit.php?post_type=easy-pricing-table&page=ept3-list' )

} )