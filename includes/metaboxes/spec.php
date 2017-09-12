<?php

/**
 * Add the features meta box
 * @var [type]
 */
$features_metabox = new WPAlchemy_MetaBox(array
(
	'id' => '1_dh_ptp_settings',
	'title' => __('Pricing Table Settings', 'easy-pricing-tables'),
	'template' => PTP_PLUGIN_PATH . 'includes/metaboxes/features-metabox.php',
	'types' => array('easy-pricing-table', 'us_footer' ),
        'autosave' => TRUE,
        'priority' => 'high',
        'context' => 'normal'
));

$banner_metabox = new WPAlchemy_MetaBox(array
(
    'id' => 'dh_ptp_banner',
    'title' => __('Wanna Get More Sales?', 'easy-pricing-tables'),
    'template' => PTP_PLUGIN_PATH . 'includes/metaboxes/banner-metabox.php',
    'types' => array('easy-pricing-table'),
    'context' => 'side',
    'priority' => 'high',
    'skip_admin_head' => true
));

$tt_quick_links_metabox = new WPAlchemy_MetaBox(array
(
    'id' => 'dh_ptp_banner_quick_link',
    'title' => __('Quick Links', 'easy-pricing-tables'),
    'template' => PTP_PLUGIN_PATH . 'includes/metaboxes/quick-links-metabox.php',
    'types' => array('easy-pricing-table'),
    'context' => 'side',
    'priority' => 'high',
    'skip_admin_head' => true
));

$tt_review_metabox = new WPAlchemy_MetaBox(array
(
    'id' => 'dh_ptp_banner_review_box',
    'title' => __('Like this plugin?', 'easy-pricing-tables'),
    'template' => PTP_PLUGIN_PATH . 'includes/metaboxes/ptp-review-metabox.php',
    'types' => array('easy-pricing-table'),
    'context' => 'side',
    'priority' => 'high',
    'skip_admin_head' => true
));


?>