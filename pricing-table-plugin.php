<?php
/*
	Plugin Name: Easy Pricing Tables
	Plugin URI: http://easypricingtables.com/
	Description: Create a Beautiful, Responsive and Highly Converting Pricing Table in Less Than 5 Minutes with Easy Pricing Tables for WordPress. No Coding Required.
	Author: David Hehenberger
	Version: 1.4.2.2
	Author URI: http://davidhehenberger.com
*/

// Define a constant to always include the absolute path
define('PTP_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define('PTP_PLUGIN_PATH_FOR_SUBDIRS', plugins_url(str_replace(dirname(dirname(__FILE__)), '', dirname(__FILE__))));

// Include post types
include ( PTP_PLUGIN_PATH . 'includes/post-types.php');

// Include media button
include ( PTP_PLUGIN_PATH . 'includes/media-button.php');

// Include shortcodes
include ( PTP_PLUGIN_PATH . 'includes/shortcodes.php');

// Include pointer popups
include ( PTP_PLUGIN_PATH . 'includes/pointer.php');

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
function dh_ptp_plugin_settings_link($links) { 
  $settings_link = '<a href="post-new.php?post_type=easy-pricing-table">Add New Pricing Table</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}

$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'dh_ptp_plugin_settings_link' );

?>