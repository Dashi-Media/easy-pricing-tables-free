<?php


function fca_ept_post_list_menu() {

	add_submenu_page( 'edit.php?post_type=easy-pricing-table', __('Easy Pricing Tables', 'easy-pricing-tables'), __('All Pricing Tables', 'easy-pricing-tables'), 'manage_options', 'ept3-list', 'fca_ept_render_post_list', 0 );
	
	// hide legacy tables submenu if this is a fresh install OR if it's disabled through settings menu
	$show_legacy_tables = ( empty( get_option( 'dh_ptp_show_legacy_tables') ) ? false : true );

	if( !dh_ptp_check_existing_install() && !$show_legacy_tables ){

		global $submenu;
		unset($submenu['edit.php?post_type=easy-pricing-table'][1]);

	} 

}
add_action('admin_menu', 'fca_ept_post_list_menu');


function fca_ept_render_post_list(){

	wp_enqueue_script( 'post-list-table-script', PTP_PLUGIN_URL . '/assets/ui/js/post-list-table-script.js', array(), PTP_PLUGIN_VER  );

	if ( ! class_exists( 'WP_List_Table' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
	}
	// Include EPT post list table
	include ( PTP_PLUGIN_PATH . 'includes/post-list-table.php' );

	$listTable = new EPT3_List_Table( );

	echo '</pre><div class="wrap"><h2>Pricing Tables <a href="' . add_query_arg( 'dh_ptp_new_gutenberg_table', true ) . '" class="page-title-action">Add New</a></h2>';
	$listTable->prepare_items();
	?>
	<form method="post">
		<?php
		$listTable->display();
		echo '</form></div>';
	
}
