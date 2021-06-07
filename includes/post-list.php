<?php


function fca_ept_post_list_menu() {

	add_submenu_page( 'edit.php?post_type=easy-pricing-table', __('Easy Pricing Tables', 'easy-pricing-tables'), __('All Pricing Tables', 'easy-pricing-tables'), 'manage_options', 'ept3-list', 'fca_ept_post_list', 0 );
	
	// hide legacy tables submenu if this is a fresh install
	if( !dh_ptp_check_existing_install() ){

   		global $submenu;
   		unset($submenu['edit.php?post_type=easy-pricing-table'][1]);

	} 

}
add_action('admin_menu', 'fca_ept_post_list_menu');


function fca_ept_post_list(){

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
	    <input type="hidden" name="page" value="ttest_list_table">
		<?php
	    $listTable->display();
	    echo '</form></div>';
	

}
