<?php

/*********************/
/* EPT FOR GUTENBERG */
/*********************/
function fca_ept_render( $attributes ) {
	
	$selectedLayout = empty( $attributes['selectedLayout'] ) ? '' : $attributes['selectedLayout'];
	if( $selectedLayout ) {
		include_once( PTP_PLUGIN_PATH . "assets/blocks/$selectedLayout/fca-ept-$selectedLayout-block.php" );
		$renderLayout = 'fca_ept_render_' . $selectedLayout;
		
		if ( function_exists( $renderLayout ) ) {
			
			if( DH_PTP_LICENSE_PACKAGE !== 'Free' ) {
				wp_enqueue_style( 'fca-ept-font-awesome' );
				
				$fontFamily = empty( $attributes['fontFamily'] ) ? false : trim( $attributes['fontFamily'] );
				
				if( $fontFamily && $fontFamily !== 'sans-serif' ) {
					$font_url = add_query_arg( array(
						"family" => $fontFamily,
						"subset" => "latin" 
					), 'https://fonts.googleapis.com/css' );
				
					wp_enqueue_style( 'fca-ept-google-font', $font_url );
				
				}
			}
			
			return call_user_func( $renderLayout, $attributes );
		}
		
	}
	
	return;
}

function fca_ept_register_block() {

	// MAIN
	wp_register_script( 'fca_ept_editor_common_script', PTP_PLUGIN_URL . '/assets/blocks/editor/fca-ept-editor-common.js', array( 'jquery', 'wp-blocks', 'wp-element' ), PTP_PLUGIN_VER );
	wp_register_script( 'fca_ept_sidebar_script', PTP_PLUGIN_URL . '/assets/blocks/editor/fca-ept-sidebar.js', array( 'fca_ept_editor_common_script' ), PTP_PLUGIN_VER );
	wp_register_script( 'fca_ept_toolbar_script', PTP_PLUGIN_URL . '/assets/blocks/editor/fca-ept-toolbar.js', array( 'fca_ept_editor_common_script' ), PTP_PLUGIN_VER );
	wp_register_style( 'fca-ept-editor-style', PTP_PLUGIN_URL . '/assets/blocks/editor/fca-ept-editor.min.css', PTP_PLUGIN_VER );
	wp_register_style( 'fca-ept-reusable-block-style', PTP_PLUGIN_URL . '/assets/blocks/editor/fca-ept-reusable-block.css', PTP_PLUGIN_VER );
	wp_register_script( 'fca_ept_editor_script', PTP_PLUGIN_URL . '/assets/blocks/editor/fca-ept-editor.js', array( 'fca_ept_sidebar_script', 'fca_ept_toolbar_script' ), PTP_PLUGIN_VER );
	
	wp_register_script( 'fca_ept_layout1_script', PTP_PLUGIN_URL . '/assets/blocks/layout1/fca-ept-layout1.min.js', array( 'fca_ept_editor_script' ), PTP_PLUGIN_VER );
	wp_register_style( 'fca-ept-layout1-style', PTP_PLUGIN_URL . '/assets/blocks/layout1/fca-ept-layout1.min.css', PTP_PLUGIN_VER );

	wp_register_script( 'fca_ept_layout2_script', PTP_PLUGIN_URL . '/assets/blocks/layout2/fca-ept-layout2.min.js', array( 'fca_ept_editor_script' ), PTP_PLUGIN_VER );
	wp_register_style( 'fca-ept-layout2-style', PTP_PLUGIN_URL . '/assets/blocks/layout2/fca-ept-layout2.min.css', PTP_PLUGIN_VER );
	
	if ( DH_PTP_LICENSE_PACKAGE !== 'Free' ) {
		
		wp_register_script( 'fca_ept_layout3_script', PTP_PLUGIN_URL . '/assets/blocks/layout3/fca-ept-layout3.min.js', array( 'fca_ept_editor_script' ), PTP_PLUGIN_VER );
		wp_register_style( 'fca-ept-layout3-style', PTP_PLUGIN_URL . '/assets/blocks/layout3/fca-ept-layout3.min.css', PTP_PLUGIN_VER );

		wp_register_script( 'fca_ept_layout4_script', PTP_PLUGIN_URL . '/assets/blocks/layout4/fca-ept-layout4.min.js', array( 'fca_ept_editor_script' ), PTP_PLUGIN_VER );
		wp_register_style( 'fca-ept-layout4-style', PTP_PLUGIN_URL . '/assets/blocks/layout4/fca-ept-layout4.min.css', PTP_PLUGIN_VER );

		wp_register_script( 'fca_ept_layout5_script', PTP_PLUGIN_URL . '/assets/blocks/layout5/fca-ept-layout5.min.js', array( 'fca_ept_editor_script' ), PTP_PLUGIN_VER );
		wp_register_style( 'fca-ept-layout5-style', PTP_PLUGIN_URL . '/assets/blocks/layout5/fca-ept-layout5.min.css', PTP_PLUGIN_VER );

		wp_register_script( 'fca_ept_layout6_script', PTP_PLUGIN_URL . '/assets/blocks/layout6/fca-ept-layout6.min.js', array( 'fca_ept_editor_script' ), PTP_PLUGIN_VER );
		wp_register_style( 'fca-ept-layout6-style', PTP_PLUGIN_URL . '/assets/blocks/layout6/fca-ept-layout6.min.css', PTP_PLUGIN_VER );

		wp_register_script( 'fca_ept_layout7_script', PTP_PLUGIN_URL . '/assets/blocks/layout7/fca-ept-layout7.min.js', array( 'fca_ept_editor_script' ), PTP_PLUGIN_VER );
		wp_register_style( 'fca-ept-layout7-style', PTP_PLUGIN_URL . '/assets/blocks/layout7/fca-ept-layout7.min.css', PTP_PLUGIN_VER );

		wp_register_script( 'fca_ept_layout8_script', PTP_PLUGIN_URL . '/assets/blocks/layout8/fca-ept-layout8.min.js', array( 'fca_ept_editor_script' ), PTP_PLUGIN_VER );
		wp_register_style( 'fca-ept-layout8-style', PTP_PLUGIN_URL . '/assets/blocks/layout8/fca-ept-layout8.min.css', PTP_PLUGIN_VER );
		
		wp_register_script( 'fca_ept_layout9_script', PTP_PLUGIN_URL . '/assets/blocks/layout9/fca-ept-layout9.min.js', array( 'fca_ept_editor_script' ), PTP_PLUGIN_VER );
		wp_register_style( 'fca-ept-layout9-style', PTP_PLUGIN_URL . '/assets/blocks/layout9/fca-ept-layout9.min.css', PTP_PLUGIN_VER );

		// FONTS
		$fonts = array(
			"Roboto:400",
			"Open Sans:400",
			"Lato:400",
			"Oswald:400",
			"Source Sans Pro:400",
			"Montserrat:400",
			"Merriweather:400",
			"Raleway:400",
			"PT Sans:400",
			"Lora:400",
			"Noto Sans:400",
			"Nunito Sans:400",
			"Concert One:400",
			"Prompt:400",
			"Work Sans:400",
		);

		$fonts_collection_url = add_query_arg( array(
			"family" => urlencode( implode( "|", $fonts ) ),
			"subset" => "latin" 
		), 'https://fonts.googleapis.com/css' );
		
		wp_register_style( 'fca-ept-google-fonts', $fonts_collection_url );
		

		// FONTAWESOME
		wp_register_style( 'fca-ept-font-awesome', PTP_PLUGIN_URL . '/assets/pricing-tables/font-awesome/css/font-awesome.min.css', PTP_PLUGIN_VER );
	}
	
	if( !in_array( DH_PTP_LICENSE_PACKAGE, array( 'Free', 'Personal' ) ) ) {
		wp_register_script(	'fca_ept_premium_script', PTP_PLUGIN_URL . '/assets/blocks/editor/fca-ept-premium.min.js', array( 'jquery', 'fca_ept_editor_script' ), PTP_PLUGIN_VER );
		wp_register_script(	'fca_ept_toggle', PTP_PLUGIN_URL . '/assets/blocks/toggle/fca-ept-toggle.min.js', array( 'jquery' ), PTP_PLUGIN_VER );
		wp_register_style( 'fca-ept-toggle-style', PTP_PLUGIN_URL . '/assets/blocks/toggle/fca-ept-toggle.min.css', PTP_PLUGIN_VER );
	}
	
	if ( function_exists( 'register_block_type' ) ) {
		register_block_type( 'fatcatapps/easy-pricing-tables', array( 'render_callback' => 'fca_ept_render' ) );
	}

}
add_action( 'init', 'fca_ept_register_block' );

//LISTEN FOR OUR URL PARAMS FOR CUSTOM ACTIONS
function fca_ept_add_block_listener(){
		
	if ( isSet( $_GET['fca_ept_new_block'] ) ){
		$nonce = empty( $_GET['ept_nonce'] ) ? '' : sanitize_text_field( $_GET['ept_nonce'] );
		
		if( wp_verify_nonce( $nonce, 'ept_new' ) == false ){
			wp_die( 'Authorization failed, please try logging in again' );
		}
		$args = array(
			'post_type'      => 'wp_block',
			'meta_key' 		 => '1_dh_ptp_settings',
			'posts_per_page' => '-1'
		);

		$count = count( get_posts ( $args ) ) + 1;
		
		$args = array(
			'post_title'     => 'Pricing Table ' . $count,
			'post_type'      => 'wp_block',
			'post_author'    => get_current_user_id(),
			'post_status'    => 'publish',
			'post_content'   => '<!-- wp:fatcatapps\/easy-pricing-tables \/-->',
			'meta_input' 	 => array( '1_dh_ptp_settings' => [ 'ept3' => '' ] )
		);

		$post_ID = wp_insert_post( $args );
		wp_redirect( admin_url( "post.php?post=" . $post_ID . "&action=edit&block-editor=1" ) );
		exit;
	}
	
	//USED FOR LEGACY TABLE CLONING
	if ( isSet( $_GET['fca_ept_clone_table'] ) ){
		$postID = empty( $_GET['fca_ept_clone_table'] ) ? '' : intval( $_GET['fca_ept_clone_table'] );
		$nonce = empty( $_GET['ept_nonce'] ) ? '' : sanitize_text_field( $_GET['ept_nonce'] );
		if( wp_verify_nonce( $nonce, 'ept_clone' ) && $postID ){
			fca_ept_clone_table( $postID );
		} else {
			wp_die( 'Authorization failed, please try logging in again' );
		}
	}

}
add_action( 'init', 'fca_ept_add_block_listener' );

function fca_ept_block_enqueue() {
	// enqueue editor styles
	wp_enqueue_style( 'fca-ept-editor-style' );
	wp_enqueue_style( 'fca-ept-layout1-style' );
	wp_enqueue_style( 'fca-ept-layout2-style' );
	
	if ( DH_PTP_LICENSE_PACKAGE !== 'Free' ) {
		
		wp_enqueue_style( 'fca-ept-font-awesome' );
		wp_enqueue_style( 'fca-ept-google-fonts' );
		
		wp_enqueue_style( 'fca-ept-layout3-style' );
		wp_enqueue_style( 'fca-ept-layout4-style' );
		wp_enqueue_style( 'fca-ept-layout5-style' );
		wp_enqueue_style( 'fca-ept-layout6-style' );
		wp_enqueue_style( 'fca-ept-layout7-style' );
		wp_enqueue_style( 'fca-ept-layout8-style' );
		wp_enqueue_style( 'fca-ept-layout9-style' );
		wp_enqueue_script( 'fca_ept_layout3_script' );
		wp_enqueue_script( 'fca_ept_layout4_script' );
		wp_enqueue_script( 'fca_ept_layout5_script' );
		wp_enqueue_script( 'fca_ept_layout6_script' );
		wp_enqueue_script( 'fca_ept_layout7_script' );
		wp_enqueue_script( 'fca_ept_layout8_script' );
		wp_enqueue_script( 'fca_ept_layout9_script' );
	}
	
	// enqueue layout scripts for editor
	wp_enqueue_script( 'fca_ept_layout1_script' );
	wp_enqueue_script( 'fca_ept_layout2_script' );

	if( !in_array( DH_PTP_LICENSE_PACKAGE, array( 'Free', 'Personal' ) ) ) {
		wp_enqueue_script( 'fca_ept_premium_script' );		
		wp_enqueue_style( 'fca-ept-toggle-style' );
	}
	
	if(  get_post_type() === 'wp_block' ) {
		wp_enqueue_style( 'fca-ept-reusable-block-style' );
	}
	
	wp_localize_script( 'fca_ept_editor_script', 'fcaEptEditorData', array( 
		'edition' => DH_PTP_LICENSE_PACKAGE,
		'directory' => PTP_PLUGIN_URL,
		'woo_integration' => function_exists( 'fca_ept_get_woo_products' ),
		'toggle_integration' => function_exists( 'fca_ept_render_toggle' ),
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'edit_url' => admin_url( 'edit.php' ),
		'fa_classes' => function_exists( 'fca_ept_get_fa_classes' ) ? fca_ept_get_fa_classes() : false,
		'debug' => PTP_DEBUG,
		'theme_support' => array(
			'wide' => get_theme_support( 'align-wide' ),
			'block_styles' => get_theme_support( 'wp-block-styles' ),			
		),
		'post_type' => get_post_type(),
	));
	
}
add_action( 'enqueue_block_editor_assets', 'fca_ept_block_enqueue' );

// ADD OUR MENU, MAYBE REMOVE LEGACY WP ADMIN MENU ITEMS
function fca_ept_admin_menu() {

	add_submenu_page( 'edit.php?post_type=easy-pricing-table', __('Easy Pricing Tables', 'easy-pricing-tables'), __('All Pricing Tables', 'easy-pricing-tables'), 'manage_options', 'ept3-list', 'fca_ept_render_post_list', 0 );
	
	// hide legacy tables submenu if this is a fresh install OR if it's disabled through settings menu
	$show_legacy_tables = get_option( 'dh_ptp_show_legacy_tables' );
	
	if( !$show_legacy_tables ){

		global $submenu;
		unset($submenu['edit.php?post_type=easy-pricing-table'][1]);
		unset($submenu['edit.php?post_type=easy-pricing-table'][2]);

	} 

}
add_action( 'admin_menu', 'fca_ept_admin_menu' );


function fca_ept_render_post_list(){

	if ( ! class_exists( 'WP_List_Table' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
	}
	
	include ( PTP_PLUGIN_PATH . 'includes/post-list-table.php' );
	$add_new_link = add_query_arg( array(
		'fca_ept_new_block' => true,
		'ept_nonce' => wp_create_nonce( 'ept_new' ),
	));
	
	?>
	<div class="wrap"><h2>Pricing Tables <a href="<?php echo $add_new_link ?>" class="page-title-action">Add New</a></h2>
	<form method="post">
		<?php
		$listTable = new EPT3_List_Table();
		$listTable->prepare_items();
		$listTable->display();
		?>
	</form></div>
<?php	
}

function fca_ept_get_woo_products_ajax(){

	if( function_exists( 'fca_ept_get_woo_products' ) ){
		wp_send_json_success( fca_ept_get_woo_products() );
	}
}
add_action( 'wp_ajax_fca_ept_get_woo_products_ajax', 'fca_ept_get_woo_products_ajax' );

//USED TO HELP RENDER FINAL TABLES
function fca_ept_get_product_data( $column, $toggle, $prop ){

	// if we have woo integration and the current column is linked to a product
	$wooproduct = function_exists( 'fca_ept_get_woo_products' ) && !empty( $column['wooProductID' . $toggle] ) ? $column['wooProductID' . $toggle] : '';

	switch ( $prop ){

		case 'plan':
			if ( $wooproduct ){
				return $column['useCustomWooTitle' . $toggle] ? $column['useCustomWooTitle' . $toggle] : fca_ept_get_woo_products( $wooproduct )['title'];
			}
			return empty( $column['planText' . $toggle] ) ? '' : $column['planText' . $toggle];
		case 'image':
			if ( $wooproduct ){
				return empty( fca_ept_get_woo_products( $wooproduct )['image'] ) ? '' : fca_ept_get_woo_products( $wooproduct )['image'];
			}
			if ( $column['planImage'] ){
				return $column['planImage'];
			}
			return null;
		case 'price':
			if ( $wooproduct ){
				return fca_ept_get_woo_products( $wooproduct )['price'];
			}
			return empty( $column['priceText' . $toggle] ) ? '' : $column['priceText' . $toggle];
		case 'url':
			if ( $wooproduct ){
				return fca_ept_get_woo_products( $wooproduct )['url'];
			}
			return empty( $column['buttonURL' . $toggle] ) ? '' : $column['buttonURL' . $toggle];
	}

}

function fca_ept_block_shortcode( $atts ){

	$table_ID = empty( $atts['id'] ) ? 0 : $atts['id'];
	$table = get_post( $table_ID );

	return apply_filters( 'the_content', $table->post_content );

}
add_shortcode( 'ept3-block', 'fca_ept_block_shortcode' );

function fca_ept_clone_table( $to_duplicate ) {
			
	$post = get_post( $to_duplicate );	
		
	if (isset( $post ) && $post != null ) {
		
		global $wpdb;
		
		$args = array(
			'post_content'   => $post->post_type === 'wp_block' ? wp_slash( $post->post_content ) : $post->post_content,
			'post_name'      => '',
			'post_status'    => 'publish',
			'post_title'     => $post->post_title . ' copy',
			'post_type'      => $post->post_type,
		);
		$new_post_id = wp_insert_post( $args );

		$post_meta_infos = $wpdb->get_results( $wpdb->prepare("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id = %d", $to_duplicate ) );
		
		if ( count( $post_meta_infos ) ) {
			
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			
			foreach ($post_meta_infos as $meta_info) {
				
				$meta_key = $meta_info->meta_key;
				if ( $meta_key == '_wp_old_slug' ) continue;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			
			$wpdb->query( $sql_query );
		}
		
		echo "<script>window.location='" . admin_url( 'post.php' ) . "?post=$new_post_id&action=edit&block-editor=1" . "'</script>";
		exit;		
	}

}

function fca_ept_block_admin_notice() {
	$current_page = empty( $_GET['page'] ) ? '' : $_GET['page'];
	$action = empty( $_GET['action'] ) ? false : $_GET['action'];
	
	if ( $current_page === 'ept3-list' && $action === 'trash'  ){
		echo '<div id="fca-ept-setup-notice" class="notice notice-success is-dismissible">';
			echo '<p>' . esc_attr__( "Pricing table deleted successfully.", 'easy-pricing-tables' ) . "</p>" ;
		echo '</div>';
	}

}
add_action( 'admin_notices', 'fca_ept_block_admin_notice' );

