<?php

/**
 * Add the features meta box
 * @var [type]
 */
$features_metabox = new WPAlchemy_MetaBox(array
(
	'id' => '1_dh_ptp_settings',
	'title' => 'Pricing Table Settings',
	'template' => PTP_PLUGIN_PATH . 'includes/metaboxes/features-metabox.php',
	'types' => array('easy-pricing-table'),
    'autosave' => TRUE,
    'priority' => 'high',
    'context' => 'normal'
));

$banner_metabox = new WPAlchemy_MetaBox(array
(
    'id' => 'dh_ptp_banner',
    'title' => 'Premium Version',
    'template' => PTP_PLUGIN_PATH . 'includes/metaboxes/banner-metabox.php',
    'types' => array('easy-pricing-table'),
    'context' => 'side',
    'priority' => 'high',
    'skip_admin_head' => true
));

/**
 * Add the preview meta box. Deactivated since it's not working properly.
 * @var [type]
 *
$preview_metabox = new WPAlchemy_MetaBox(array
(
	'id' => '_preview',
	'title' => 'Preview',
	'template' => PTP_PLUGIN_PATH . 'assets/metaboxes/preview-meta.php',
	'types' => array('easy-pricing-table'),
    'autosave' => TRUE
));
*/



/* eof */