<?php
/*
	Plugin Name: Easy Pricing Tables by Fatcat Apps
	Plugin URI: https://fatcatapps.com/easypricingtables
	Description: Create a Beautiful, Responsive and Highly Converting Pricing or Comparison Table in Less Than 5 Minutes with Easy Pricing Tables for WordPress. No Coding Required.
	Text Domain: easy-pricing-tables
	Domain Path: /languages
	Author: Fatcat Apps
	Version: 2.3.8
	Author URI: https://fatcatapps.com
*/

if( ! defined( 'PTP_PLUGIN_PATH' ) ) {

  // Define a constant to always include the absolute path
  define('PTP_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
  define('PTP_PLUGIN_PATH_FOR_SUBDIRS', plugins_url(str_replace(dirname(dirname(__FILE__)), '', dirname(__FILE__))));

  // Analytics
  include_once PTP_PLUGIN_PATH . 'includes/analytics.php';
  include_once PTP_PLUGIN_PATH . 'includes/tracking.php';

  // Include post types
  include ( PTP_PLUGIN_PATH . 'includes/post-types.php');

  // Include media button
  include ( PTP_PLUGIN_PATH . 'includes/media-button.php');

  // Include clone table
  include ( PTP_PLUGIN_PATH . 'includes/clone-table.php');

  // Include shortcodes
  include ( PTP_PLUGIN_PATH . 'includes/shortcodes.php');

  // Include pointer popups
  include ( PTP_PLUGIN_PATH . 'includes/pointer.php');

  // Upgrade to Premium
  include ( PTP_PLUGIN_PATH . 'includes/upgrade.php');

  // Include WPAlchemy
  if(!class_exists('WPAlchemy_MetaBox')) {
    include_once ( PTP_PLUGIN_PATH . 'includes/libraries/wpalchemy/MetaBox.php');
  }

  include_once ( PTP_PLUGIN_PATH . 'includes/metaboxes/spec.php');

  if(is_admin()) {
  	// include WPAlchemy scripts
  	include_once ( PTP_PLUGIN_PATH . 'includes/metaboxes/setup.php');
  }

  // Add settings link on plugin page
  function dh_ptp_plugin_settings_link($links) {
    // Remove Edit link
    unset($links['edit']);
    
    // Add Easy Pricing Tables links
    $add_new_link = '<a href="post-new.php?post_type=easy-pricing-table">' . __('Add New', 'easy-pricing-tables') . '</a>'; 
    $forum_link   = '<a href="http://wordpress.org/support/plugin/easy-pricing-tables">' . __('Support', 'easy-pricing-tables' ) . '</a>';
    $premium_link = '<a href="https://fatcatapps.com/easypricingtables/?utm_campaign=Purchase%2BPremium%2Bin%2Bplugins.php&utm_source=Easy%2BPricing%2BTables%2BFree&utm_medium=plugin&utm_content=v1">' . __('Purchase Premium',  'easy-pricing-tables' ) . '</a>';
    
    array_push($links, $add_new_link);
    array_push($links, $forum_link);
    array_push($links, $premium_link);
    
    return $links; 
  }

  $plugin = plugin_basename(__FILE__); 
  add_filter("plugin_action_links_$plugin", 'dh_ptp_plugin_settings_link' );

  // Footer text
  function dh_ptp_plugin_footer ($text) {
    echo
  	$text . ' '.
  	sprintf( __('Thank you for using <a href="%s" target="_blank">Easy Pricing Tables</a>.',  'easy-pricing-tables' ), 'https://fatcatapps.com/easypricingtables/?utm_source=free-plugin&utm_medium=link&utm_campaign=thank-you-for-using-easy-pricing-tables' ) . ' ' .
  	sprintf( __('Please <a href="%s">rate us on WordPress.org</a>.',  'easy-pricing-tables' ), 'http://wordpress.org/support/view/plugin-reviews/easy-pricing-tables?filter=5#postform');
  }

  function dh_ptp_plugin_footer_enqueue($hook_suffix) {
    global $post;
    
    if ($post && $post->post_type == 'easy-pricing-table') {
        wp_enqueue_script( 'codemirror-ept', PTP_PLUGIN_PATH_FOR_SUBDIRS.'/assets/ui/ui-components/codemirror/codemirror.min.js' );
        wp_enqueue_script( 'codemirror-css-ept', PTP_PLUGIN_PATH_FOR_SUBDIRS.'/assets/ui/ui-components/codemirror/addon-codemirror/css.min.js' );
        wp_enqueue_style( 'codemirror-style-ept', PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/ui-components/codemirror/codemirror.min.css' );
        wp_enqueue_style( 'jquery-ui-fresh-ept', PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/jquery-ui-fresh.min.css' );
        add_filter('admin_footer_text', 'dh_ptp_plugin_footer');
    }
  }
  add_action('admin_enqueue_scripts', 'dh_ptp_plugin_footer_enqueue');

  /* Localization */
  function fca_eoi_load_localization_easy_pricing_tables() {
	
    $locale = apply_filters( 'plugin_locale', get_locale(), 'easy-pricing-tables' );
    
    load_textdomain( 'easy-pricing-tables', trailingslashit( WP_LANG_DIR ) . 'easy-pricing-tables' . '/' . 'easy-pricing-tables' . '-' . $locale . '.mo' );
  
	load_plugin_textdomain( 'easy-pricing-tables', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
  }
  add_action( 'plugins_loaded', 'fca_eoi_load_localization_easy_pricing_tables' );
  	
	//DEACTIVATION SURVEY 
	function fca_ptp_admin_deactivation_survey( $hook ) {
		if ( $hook === 'plugins.php' ) {
			
			ob_start(); ?>
			
			<div id="fca-deactivate" style="position: fixed; left: 232px; top: 191px; border: 1px solid #979797; background-color: white; z-index: 9999; padding: 12px; max-width: 669px;">
				<h3 style="font-size: 14px; border-bottom: 1px solid #979797; padding-bottom: 8px; margin-top: 0;"><?php _e( 'Sorry to see you go', 'landing-page-cat' ) ?></h3>
				<p><?php _e( 'Hi, this is David, the creator of Easy Pricing Tables. Thanks so much for giving my plugin a try. I’m sorry that you didn’t love it.', 'landing-page-cat' ) ?>
				</p>
				<p><?php _e( 'I have a quick question that I hope you’ll answer to help us make Easy Pricing Tables better: what made you deactivate?', 'landing-page-cat' ) ?>
				</p>
				<p><?php _e( 'You can leave me a message below. I’d really appreciate it.', 'landing-page-cat' ) ?>
				</p>
				
				<p><textarea style='width: 100%;' id='fca-ept-deactivate-textarea' placeholder='<?php _e( 'What made you deactivate?', 'landing-page-cat' ) ?>'></textarea></p>
				
				<div style='float: right;' id='fca-deactivate-nav'>
					<button style='margin-right: 5px;' type='button' class='button button-secondary' id='fca-ept-deactivate-skip'><?php _e( 'Skip', 'landing-page-cat' ) ?></button>
					<button type='button' class='button button-primary' id='fca-ept-deactivate-send'><?php _e( 'Send Feedback', 'landing-page-cat' ) ?></button>
				</div>
			
			</div>
			
			<?php
				
			$html = ob_get_clean();
			
			$data = array(
				'html' => $html,
				'nonce' => wp_create_nonce( 'fca_ptp_uninstall_nonce' ),
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			);
						
			wp_enqueue_script('fca_ptp_deactivation_js', plugins_url( '', __FILE__ ) . '/includes/deactivation.min.js' );
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