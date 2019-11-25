<?php

// include our HTML generators for each table
include ( PTP_PLUGIN_PATH . '/includes/table-generation/design1.php');

/* CSS Styling */
function dh_ptp_easy_pricing_table_dynamic_css( $id, $meta )
{
	//FIX YOAST MUCKING THINGS UP
	if ( doing_action( 'wp_head' ) ) {
		return false;
	}
	
	ob_start();
    dh_ptp_simple_flat_css( $id, $meta );
    $css = ob_get_clean();
	
    // Minify
    $css = preg_replace( '/\s+/', ' ', $css );
    $css = preg_replace( '/;(?=\s*})/', '', $css );
    $css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );
    $css = preg_replace( '/ (,|;|\{|}|\(|\)|>)/', '$1', $css );
    $css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
    $css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
    $css = preg_replace( '/0 0 0 0/', '0', $css );
    $css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );
	
	$css = apply_filters( 'fca_ept_css_filter', $css);
	if ( empty ($css) ){
		return '';
	} else {
		return '<style type="text/css">' . $css . '</style>';
	}
	
}

/**
 * This function decides which table style we should create. It enqueue the appropriate CSS file and calls the appropriate function.
 *
 * @return string pricing table html
 */
function dh_ptp_generate_pricing_table( $id, $hide = false )
{
    global $wp_styles;

    $meta = get_post_meta( $id, '1_dh_ptp_settings', true );
	
	if ( !empty( $meta['hide_table'] ) ) {
		$hide = true;
	}
		
    // Enqueue IE Hacks
    wp_enqueue_style('ept-ie-style', PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/ui-ie.min.css');
    $wp_styles->add_data('ept-ie-style', 'conditional', 'lt IE 9');
    
    //include css
    wp_enqueue_style( 'dh-ptp-design1', PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/pricing-tables/design1/pricingtable.min.css' );
	//ADD A DUMMY STYLESHEET TO APPEND INLINE CSS LATER IF SET
	wp_register_style( 'dh-ptp-custom-css', PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/pricing-tables/ptp-custom.min.css'  );
	
	$return = '';
    
    // Print stylish enable match-column-height
	if(isset($meta['match-column-height-dg1'])) {   
		wp_enqueue_script( 'matchHeight', PTP_PLUGIN_PATH_FOR_SUBDIRS.'/assets/ui/jquery.matchHeight-min.js', array('jquery'));	 
		$return .= tt_ptp_enable_column_match_height_script_dg1();
	} 
	
    wp_enqueue_style( 'dh-ptp-custom-css' );
	$return .= dh_ptp_generate_simple_flat_pricing_table_html( $id, $hide );
	
	// ADD LOADED JS
	if( !empty( $meta['hide_table']) ) {   
		$return .= "<script>document.querySelector( '#ptp-$id' ).style.display='block'</script>";
	}
	
	//call appropriate function
    return $return;
}

