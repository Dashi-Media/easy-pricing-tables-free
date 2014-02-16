<?php
/*
	Plugin Name: Easy Pricing Tables
	Plugin URI: http://easypricingtables.com/
	Description: Create a Beautiful, Responsive and Highly Converting Pricing Table in Less Than 5 Minutes with Easy Pricing Tables for WordPress. No Coding Required.
	Author: David Hehenberger
	Version: 1.4.4
	Author URI: http://davidhehenberger.com
*/

// define plugin version for update nag
define('PTP_PLUGIN_VERSION', '1.4.4');

// Define a constant to always include the absolute path
define('PTP_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define('PTP_PLUGIN_PATH_FOR_SUBDIRS', plugins_url(str_replace(dirname(dirname(__FILE__)), '', dirname(__FILE__))));

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

// Include presstrends analytics if user agreed upon usage tracking
$dh_ptp_usage_tracking = get_option('dh_ptp_allow_tracking');
if ($dh_ptp_usage_tracking == 'yes') {
  include ( PTP_PLUGIN_PATH . 'includes/analytics.php');
}

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
function dh_ptp_plugin_settings_link($links)
{
  // Remove Edit link
  unset($links['edit']);
  
  // Add Easy Pricing Tables links
  $add_new_link = '<a href="post-new.php?post_type=easy-pricing-table">Add New</a>'; 
  $forum_link   = '<a href="http://wordpress.org/support/plugin/easy-pricing-tables">Forum</a>';
  $premium_link = '<a href="http://easypricingtables.com/?utm_source=free-plugin&utm_medium=link&utm_campaign=link-in-installed-plugins">Purchase Premium</a>';
  
  array_push($links, $add_new_link);
  array_push($links, $forum_link);
  array_push($links, $premium_link);
  
  return $links; 
}

$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'dh_ptp_plugin_settings_link' );

// Footer text
function dh_ptp_plugin_footer ($text) {
  echo $text . ' Thank you for using <a href="http://easypricingtables.com/?utm_source=free-plugin&utm_medium=link&utm_campaign=thank-you-for-using-easy-pricing-tables" target="_blank">Easy Pricing Tables</a>. Please <a href="http://wordpress.org/support/view/plugin-reviews/easy-pricing-tables?filter=5#postform">rate us on WordPress.org</a>.';
}

function dh_ptp_plugin_footer_enqueu($hook_suffix)
{
  global $post;
  
  if ($post && $post->post_type == 'easy-pricing-table') {
	add_filter('admin_footer_text', 'dh_ptp_plugin_footer');
  }
}
add_action('admin_enqueue_scripts', 'dh_ptp_plugin_footer_enqueu');

?>