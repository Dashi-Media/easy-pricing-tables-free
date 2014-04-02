<?php

/**
 * Add the features meta box
 * @var [type]
 */
$features_metabox = new WPAlchemy_MetaBox(array
(
	'id' => '1_dh_ptp_settings',
	'title' => __('Pricing Table Settings', PTP_LOC),
	'template' => PTP_PLUGIN_PATH . 'includes/metaboxes/features-metabox.php',
	'types' => array('easy-pricing-table'),
    'autosave' => TRUE,
    'priority' => 'high',
    'context' => 'normal'
));

$banner_metabox = new WPAlchemy_MetaBox(array
(
    'id' => 'dh_ptp_banner',
    'title' => __('Want More Design Options?', PTP_LOC),
    'template' => PTP_PLUGIN_PATH . 'includes/metaboxes/banner-metabox.php',
    'types' => array('easy-pricing-table'),
    'context' => 'side',
    'priority' => 'high',
    'skip_admin_head' => true
));

?>