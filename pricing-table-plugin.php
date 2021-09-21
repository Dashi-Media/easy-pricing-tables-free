<?php
/*
	Plugin Name: Easy Pricing Tables by Fatcat Apps
	Plugin URI: https://fatcatapps.com/easypricingtables
	Description: Create a Beautiful, Responsive and Highly Converting Pricing or Comparison Table in Less Than 5 Minutes with Easy Pricing Tables for WordPress. No Coding Required.
	Text Domain: easy-pricing-tables
	Domain Path: /languages
	Author: Fatcat Apps
	Version: 3.1.2
	Author URI: https://fatcatapps.com
*/

if( ! defined( 'PTP_PLUGIN_PATH' ) ) {

	// Define a constant to always include the absolute path
	define('PTP_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
	define('PTP_PLUGIN_PATH_FOR_SUBDIRS', plugins_url(str_replace(dirname(dirname(__FILE__)), '', dirname(__FILE__))));
	define('PTP_PLUGIN_URL', plugins_url( '', __FILE__ ));
	define('PTP_DEBUG', FALSE );

	if ( PTP_DEBUG ) {
		define( 'PTP_PLUGIN_VER', '3.1.' . time() );
	} else {
		define( 'PTP_PLUGIN_VER', '3.1.2' );
	}

	// Include post types
	include ( PTP_PLUGIN_PATH . 'includes/post-types.php');

	// Include EPT3 Gutenberg blocks
	include ( PTP_PLUGIN_PATH . 'includes/ept-block.php' );
	include ( PTP_PLUGIN_PATH . 'assets/blocks/layout1/fca-ept-layout1-block.php' );
	include ( PTP_PLUGIN_PATH . 'assets/blocks/layout2/fca-ept-layout2-block.php' );

	// Include EPT3 post list
	include ( PTP_PLUGIN_PATH . 'includes/post-list.php' );

	// Upgrade to Premium
	include ( PTP_PLUGIN_PATH . 'includes/upgrade.php');

	// Include settings page
	include ( PTP_PLUGIN_PATH . 'includes/settings.php');

	// only if legacy tables are available, include the rest
	if( dh_ptp_check_existing_install() ){

		// Include media button
		include ( PTP_PLUGIN_PATH . 'includes/media-button.php');

		// Include clone table
		include ( PTP_PLUGIN_PATH . 'includes/clone-table.php');

		// Include shortcodes
		include ( PTP_PLUGIN_PATH . 'includes/shortcodes.php');

		// Include pointer popups
		include ( PTP_PLUGIN_PATH . 'includes/pointer.php');

		// Include Gutenberg support
		include ( PTP_PLUGIN_PATH . 'includes/block.php');

		// Include WPAlchemy
		if(!class_exists('WPAlchemy_MetaBox')) {
			include_once ( PTP_PLUGIN_PATH . 'includes/libraries/wpalchemy/MetaBox.php');
		}

		include_once ( PTP_PLUGIN_PATH . 'includes/metaboxes/spec.php');

		if(is_admin()) {
			// include WPAlchemy scripts
			include_once ( PTP_PLUGIN_PATH . 'includes/metaboxes/setup.php');
		}

		// Footer text
		function dh_ptp_plugin_footer ($text) {
			echo
			$text . ' '.
			sprintf( __('Thank you for using <a href="%s" target="_blank">Easy Pricing Tables</a>.',  'easy-pricing-tables' ), 'https://fatcatapps.com/easypricingtables/?utm_source=free-plugin&utm_medium=link&utm_campaign=thank-you-for-using-easy-pricing-tables' ) . ' ' .
			sprintf( __('Please <a href="%s">rate us on WordPress.org</a>.',  'easy-pricing-tables' ), 'http://wordpress.org/support/view/plugin-reviews/easy-pricing-tables?filter=5#postform');
		}

		/* Localization */
		function fca_eoi_load_localization_easy_pricing_tables() {

			$locale = apply_filters( 'plugin_locale', get_locale(), 'easy-pricing-tables' );

			load_textdomain( 'easy-pricing-tables', trailingslashit( WP_LANG_DIR ) . 'easy-pricing-tables' . '/' . 'easy-pricing-tables' . '-' . $locale . '.mo' );

			load_plugin_textdomain( 'easy-pricing-tables', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
		}
		add_action( 'plugins_loaded', 'fca_eoi_load_localization_easy_pricing_tables' );

	}

	// Add settings link on plugin page
	function dh_ptp_plugin_settings_link($links) {
		// Remove Edit link
		unset($links['edit']);

		// Add Easy Pricing Tables links
		$add_new_link = '<a href=' . add_query_arg( 'dh_ptp_new_gutenberg_table', true ) . '>' . __('Add New', 'easy-pricing-tables') . '</a>'; 
		$forum_link   = '<a href="http://wordpress.org/support/plugin/easy-pricing-tables">' . __('Support', 'easy-pricing-tables' ) . '</a>';
		$premium_link = '<a href="https://fatcatapps.com/easypricingtables/?utm_campaign=Purchase%2BPremium%2Bin%2Bplugins.php&utm_source=Easy%2BPricing%2BTables%2BFree&utm_medium=plugin&utm_content=v1">' . __('Purchase Premium',  'easy-pricing-tables' ) . '</a>';

		array_push($links, $add_new_link);
		array_push($links, $forum_link);
		array_push($links, $premium_link);

		return $links; 
	}
	
	$plugin = plugin_basename(__FILE__); 
	add_filter("plugin_action_links_$plugin", 'dh_ptp_plugin_settings_link' );

	/**
	* Enqueue Admin Javascript in Pricing Tables edit page
	**/

	function dh_ptp_plugin_footer_enqueue($hook_suffix) {

		$screen = get_current_screen();

		wp_enqueue_script( 'editor-script-ept', plugins_url( '/assets/ui/js/editor-script.js', __FILE__ ) );

		$data = array( 
			'id' => $screen->id 
		);
		wp_localize_script( 'editor-script-ept', "fca_ept", $data );

		if ( $screen->id == 'easy-pricing-table' ) {
			wp_enqueue_style( 'jquery-ui-fresh-ept', PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/jquery-ui-fresh.min.css' );
			add_filter('admin_footer_text', 'dh_ptp_plugin_footer');
		} 

	}
	add_action('admin_enqueue_scripts', 'dh_ptp_plugin_footer_enqueue');

	function dh_ptp_admin_notices(){

		$plugin_name = 'easy-pricing-tables';
		$is_legacy_screen = empty( $_GET['post_type'] ) ? false : ( $_GET['post_type'] === 'easy-pricing-table' && empty( $_GET['page'] ) );
		$notice_dismissed = get_option( 'dh_ptp_show_gutenberg_notice', 'on' ) === 'off';
		$show_fullscreen_notice = $is_legacy_screen && ( !$notice_dismissed );
		$show_reminder = $is_legacy_screen && $notice_dismissed;
		$show_legacy_tables = ( empty( get_option( 'dh_ptp_show_legacy_tables') ) ? false : true );
		$legacy_reminder = empty( $_GET['page'] ) ? false : ( $_GET['page'] === 'ept3-list' );

		$try_gutenberg = add_query_arg( 'dh_ptp_new_gutenberg_table', true );
		$settings_page = add_query_arg( 'dh_ptp_settings_page', true );

		if ( $show_reminder ){
			echo '<div id="fca-ept-setup-notice" class="notice notice-info" style="padding-bottom: 8px; padding-top: 8px;">';
				echo '<p>' . __( "We’ve completely redesigned Easy Pricing Tables from scratch, with brand new designs and a slick new way to create tables using the Block Editor. We’ll eventually phase out support for this old interface.", $plugin_name ) . "</p>" ;
				echo "<a href='$try_gutenberg' class='button button-primary' style='margin-top: 2px;'>" . __( 'Try it', $plugin_name) . "</a> ";
				echo '<a href="https://youtu.be/iU3mC8vXKt8" target="_blank" style="margin-top: 2px;" class=button button-primary>See it in action</a>';
				echo '<br style="clear:both">';
			echo '</div>';
		}

		if ( !dh_ptp_check_existing_install() && !$show_legacy_tables && $legacy_reminder ){
			echo '<div id="fca-ept-legacy-notice" class="notice notice-info is-dismissible" style="padding-bottom: 8px; padding-top: 8px;">';
				echo '<p>' . __( "We recommend using the visual interface to build your new pricing tables. Still prefer the legacy experience?", $plugin_name ) . "</p>" ;
				echo "<a href='$settings_page' class='button button-primary' style='margin-top: 2px;'>" . __( 'Turn it back on', $plugin_name) . "</a> ";
				echo '<br style="clear:both">';
			echo '</div>';
		}	

		if ( $show_fullscreen_notice ){
			echo '<div id="fca-ept-fullscreen-notice" class="notice notice-info is-dismissible" style="display: none; text-align: center; padding-left: 250px; padding-right: 250px; padding-bottom: 8px; padding-top: 40px; position: fixed; top: 27px; left: 160px; right: 0; bottom: -15px; z-index: 999999;">';
				echo '<h1>' . __( "Try the brand new Easy Pricing Tables.", $plugin_name ) . "</h1>" ;
				echo '<p>' . __( "We’ve completely redesigned Easy Pricing Tables from scratch, with brand new designs and a slick new way to create tables using the Block Editor. We’ll eventually phase out support for this old interface.", $plugin_name ) . "</p>" ;
				echo "<a href='$try_gutenberg' class='button button-primary' style='margin-top: 15px;'>" . __( 'Try it', $plugin_name) . "</a> ";
				echo '<a id="fca-ept-hide-notice" style="display: block; position: relative; top: 10px;" href="#" style="margin-top: 15px;">' . __( 'Skip', $plugin_name) . '</a> ';
				echo '<br style="clear:both">';
			echo '</div>';
		}

		if ( isSet( $_GET['dh_ptp_leave_review'] ) ) {

			$review_url = 'https://wordpress.org/support/plugin/easy-pricing-tables/reviews/';
			update_option( 'dh_ptp_show_review_notice', false );
			wp_redirect($review_url);
			exit;

		}

		$show_review_option = get_option( 'dh_ptp_show_review_notice', 'not-set' );

		if ( $show_review_option === 'not-set' && !wp_next_scheduled( 'dh_ptp_schedule_review_notice' )  ) {

			wp_schedule_single_event( time() + 30 * DAY_IN_SECONDS, 'dh_ptp_schedule_review_notice' );

		}

		if ( isSet( $_GET['dh_ptp_postpone_review_notice'] ) ) {

			$show_review_option = false;
			update_option( 'dh_ptp_show_review_notice', $show_review_option );
			wp_schedule_single_event( time() + 30 * DAY_IN_SECONDS, 'dh_ptp_schedule_review_notice' );

		}

		if ( isSet( $_GET['dh_ptp_forever_dismiss_notice'] ) ) {

			$show_review_option = false;
			update_option( 'dh_ptp_show_review_notice', $show_review_option );

		}

		$leave_review = add_query_arg( 'dh_ptp_leave_review', true );
		$postpone_url = add_query_arg( 'dh_ptp_postpone_review_notice', true );
		$forever_dismiss_url = add_query_arg( 'dh_ptp_forever_dismiss_notice', true );

		if ( $show_review_option && $show_review_option !== 'not-set' ){

			$plugin_name = 'easy-pricing-tables';

			echo '<div id="fca-ept-review-notice" class="notice notice-success is-dismissible" style="padding-bottom: 8px; padding-top: 8px;">';
				echo '<p>' . __( "Hi! You've been using Easy Pricing Tables Free for a while now, so who better to ask for a review than you? Would you please mind leaving us one? It really helps us a lot!", $plugin_name ) . '</p>';
				echo "<a href='$leave_review' class='button button-primary' style='margin-top: 2px;'>" . __( 'Leave review', $plugin_name) . "</a> ";
				echo "<a style='position: relative; top: 10px; left: 7px;' href='$postpone_url' >" . __( 'Maybe later', $plugin_name) . "</a> ";
				echo "<a style='position: relative; top: 10px; left: 16px;' href='$forever_dismiss_url' >" . __( 'No thank you', $plugin_name) . "</a> ";
				echo '<br style="clear:both">';
			echo '</div>';

		}

	}

	add_action( 'admin_notices', 'dh_ptp_admin_notices' );

	function dh_ptp_enable_review_notice(){
		update_option( 'dh_ptp_show_review_notice', true );
		wp_clear_scheduled_hook( 'dh_ptp_schedule_review_notice' );
	}

	add_action ( 'dh_ptp_schedule_review_notice', 'dh_ptp_enable_review_notice' );


	function dh_ptp_try_gutenberg_tables (){

		if ( isSet( $_GET['dh_ptp_settings_page'] ) ){

			wp_redirect( admin_url( "edit.php?post_type=easy-pricing-table&page=easy-pricing-tables-settings" ) );
			exit;

		}

		if ( isSet( $_GET['dh_ptp_new_gutenberg_table'] ) ) {

			if( class_exists( 'DisableGutenberg' ) ){

				echo '<script>';
				echo 'alert("Easy Pricing Tables relies on Gutenberg components. \nTo build tables with the new editor, please deactivate the \"Disable Gutenberg\" plugin.")';
				echo '</script>';

			} else {

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
				wp_redirect( admin_url( "post.php?post=" . $post_ID . "&action=edit" ) );
				exit;
				
			}

		}

		if ( isSet( $_GET['dh_ptp_forever_dismiss_notice'] ) ) {
			update_option( 'dh_ptp_show_gutenberg_notice', 'off' );
		}
	}

 	add_action( 'init', 'dh_ptp_try_gutenberg_tables' );


	function fca_ept_override_gutenberg_css() {

		global $_wp_theme_features;

		$post_id = empty( $_GET['post'] ) ? '' : intval( $_GET['post'] );
		$screen = get_current_screen();

		$post_type = empty( $screen->post_type ) ? '' : $screen->post_type;
		$base = empty( $screen->base ) ? '' : $screen->base;

		if ( $post_type === 'wp_block' && $base === 'post' ) {

			$post_meta = get_post_meta( $post_id, '1_dh_ptp_settings', true );

			if( !empty( $post_meta ) ){

				unset( $_wp_theme_features[ 'editor-styles' ] );
			
			}
			

		} 

	}
	add_action( 'current_screen', 'fca_ept_override_gutenberg_css' );


	//DEACTIVATION SURVEY 
	function fca_ptp_admin_deactivation_survey( $hook ) {
		if ( $hook === 'plugins.php' ) {

			ob_start(); ?>
			
			<div id="fca-deactivate" style="position: fixed; left: 232px; top: 191px; border: 1px solid #979797; background-color: white; z-index: 9999; padding: 12px; max-width: 669px;">
				<h3 style="font-size: 14px; border-bottom: 1px solid #979797; padding-bottom: 8px; margin-top: 0;"><?php _e( 'Sorry to see you go', 'easy-pricing-tables' ) ?></h3>
				<p><?php _e( 'Hi, this is David, the creator of Easy Pricing Tables. Thanks so much for giving my plugin a try. I’m sorry that you didn’t love it.', 'easy-pricing-tables' ) ?>
				</p>
				<p><?php _e( 'I have a quick question that I hope you’ll answer to help us make Easy Pricing Tables better: what made you deactivate?', 'easy-pricing-tables' ) ?>
				</p>
				<p><?php _e( 'You can leave me a message below. I’d really appreciate it.', 'easy-pricing-tables' ) ?>
				</p>
				
				<p><textarea style='width: 100%;' id='fca-ept-deactivate-textarea' placeholder='<?php _e( 'What made you deactivate?', 'easy-pricing-tables' ) ?>'></textarea></p>
				
				<div style='float: right;' id='fca-deactivate-nav'>
					<button style='margin-right: 5px;' type='button' class='button button-secondary' id='fca-ept-deactivate-skip'><?php _e( 'Skip', 'easy-pricing-tables' ) ?></button>
					<button type='button' class='button button-primary' id='fca-ept-deactivate-send'><?php _e( 'Send Feedback', 'easy-pricing-tables' ) ?></button>
				</div>
			
			</div>
			
			<?php
				
			$html = ob_get_clean();
			
			$data = array(
				'html' => $html,
				'nonce' => wp_create_nonce( 'fca_ptp_uninstall_nonce' ),
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			);						
			wp_enqueue_script('fca_ptp_deactivation_js', PTP_PLUGIN_URL . '/includes/deactivation.min.js', false, PTP_PLUGIN_VER, true );
			wp_localize_script( 'fca_ptp_deactivation_js', "fca_ptp", $data );
		
		}
		
	}	
	add_action( 'admin_enqueue_scripts', 'fca_ptp_admin_deactivation_survey' );

}

//UNINSTALL ENDPOINT
function fca_ptp_uninstall_ajax() {
	
	$msg = sanitize_text_field( $_REQUEST['msg'] );
	$nonce = sanitize_text_field( $_REQUEST['nonce'] );
	$nonceVerified = wp_verify_nonce( $nonce, 'fca_ptp_uninstall_nonce') == 1;

	if ( $nonceVerified && !empty( $msg ) ) {
		
		$url =  "https://api.fatcatapps.com/api/feedback.php";
				
		$body = array(
			'product' => 'pricingtables',
			'msg' => $msg,		
		);
		
		$args = array(
			'timeout'     => 15,
			'redirection' => 15,
			'body' => json_encode( $body ),	
			'blocking'    => true,
			'sslverify'   => false
		); 		
		
		$return = wp_remote_post( $url, $args );
		
		wp_send_json_success( $msg );

	}
	wp_send_json_error( $msg );

}
add_action( 'wp_ajax_fca_ptp_uninstall', 'fca_ptp_uninstall_ajax' );