$ = jQuery
$( document ).ready( function(){

	$( '.trash a' ).on( 'click', function( event ){

		if ( confirm( 'Are you sure?' ) ){
			// continue
		} else{
			event.preventDefault()
		}

	})

} )