<?php


// global styles for the meta boxes
if (is_admin()){
	add_action('admin_print_scripts-post-new.php', 'dh_ptp_metabox_styles_and_scripts');
	add_action('admin_print_scripts-post.php', 'dh_ptp_metabox_styles_and_scripts');
}

//DEQUEUE CONFLICTING PLUGINS
add_action( 'admin_enqueue_scripts', 'dh_ptp_metabox_dequeue', 99999999 );
function dh_ptp_metabox_dequeue() {
	global $post_type;
	if( 'easy-pricing-table' == $post_type ) {
		if ( class_exists ( 'RichSnippets' ) ) {
			wp_dequeue_script( 'bsf_jquery_star' );
			wp_dequeue_script( 'bsf_toggle' );
			wp_dequeue_style( 'star_style' );
			wp_dequeue_script( 'bsf-scripts' );
			wp_dequeue_script( 'bsf-scripts-media' );
			wp_dequeue_style('jquery-style');
			wp_dequeue_style( 'meta_style');
			wp_dequeue_style( 'bsf-styles');
		}
		
		if ( class_exists ( 'Easy_Digital_Downloads' ) ) {
			wp_dequeue_style( 'jquery-chosen' );
			wp_dequeue_script( 'jquery-chosen' );
			wp_dequeue_script( 'jquery-form' );
			wp_dequeue_script( 'edd-admin-scripts' );
			wp_dequeue_script( 'wp-color-picker' );
			wp_dequeue_style( 'colorbox' );
			wp_dequeue_script( 'colorbox' );
			wp_dequeue_script( 'jquery-flot' );
			wp_dequeue_script( 'jquery-ui-datepicker' );
			wp_dequeue_script( 'jquery-ui-dialog' );
			wp_dequeue_script( 'jquery-ui-tooltip' );
			wp_dequeue_style( 'jquery-ui-css' );
			wp_dequeue_script( 'media-upload' );
			wp_dequeue_script( 'thickbox' );
			wp_dequeue_style( 'thickbox' );
			wp_dequeue_style( 'edd-admin' );
		}
		
		if ( class_exists ( 'PostSnippets' ) ) {
			wp_dequeue_script('jquery-ui-dialog');
			wp_dequeue_script('jquery-ui-tabs');
			wp_dequeue_style('wp-jquery-ui-dialog');
			wp_dequeue_style('post-snippets');
			wp_dequeue_script('post-snippets');
		}
		
		if ( class_exists ( 'Sensei_Main' ) ) {
			wp_dequeue_script( 'sensei-core-select2' );
			wp_dequeue_style( 'sensei-core-select2' );
		}

	}
}

//FIX CONFLICT WITH CALL TO ACTIONS PLUGIN
 function dh_ptp_exclude_ept_cta( $exclude ) {
	$exclude[] = 'easy-pricing-table';
 	return $exclude;
}
 
add_filter( 'cta_excluded_post_types', 'dh_ptp_exclude_ept_cta', 10, 1 );

function dh_ptp_metabox_styles_and_scripts() {
	global $post_type;

    if( 'easy-pricing-table' == $post_type ) {
	    //UI styles - includes all styles necessary for the UI
	    wp_enqueue_style('wpalchemy-metabox', PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/ui-styles.min.css' );

	    // Color Picker JS
	    wp_enqueue_style('wp-color-picker');
		
	    // Jquery UI Tabs
	    wp_enqueue_script('jquery-ui-tabs');

        // Jquery lighbox - colorbox
        wp_enqueue_script( 'dh-ptp-colorbox', PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/ui-components/colorbox/jquery.colorbox-min.js', array('jquery') );


        //ui scripts - this file contains all Javascript necessary for the GUI
	 	wp_enqueue_script( 'ept-ui-script', PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/ui-scripts.min.js', array('jquery', 'jquery-ui-tabs', 'wp-color-picker', 'dh-ptp-colorbox') );

		/** UI Components **/
		//add bootstrap css for popover help boxes
		wp_enqueue_style('bootstrap-popover', PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/ui-components/bootstrap/css/bootstrap.min.css' );
		//add bootstrap js for popovers
		wp_enqueue_script( 'bootstrap-popover', PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/ui-components/bootstrap/js/bootstrap.min.js' );
		// fontello icons
		wp_enqueue_style('fontello-icon', PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/ui-components/fontello/fontello.min.css' );               
        }

}

?>