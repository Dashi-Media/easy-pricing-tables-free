<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function dh_ptp_upgrade_to_premium_menu()
{
    $page_hook = add_submenu_page('edit.php?post_type=easy-pricing-table', __('Upgrade to Premium', 'easy-pricing-tables'), __('Upgrade to Premium', 'easy-pricing-tables'), 'manage_options', 'easy-pricing-tables-upgrade', 'dh_ptp_upgrade_to_premium');
    add_action('load-' . $page_hook , 'dh_ptp_upgrade_ob_start');
}
add_action('admin_menu', 'dh_ptp_upgrade_to_premium_menu');

function dh_ptp_upgrade_ob_start() {
    ob_start();
}

function dh_ptp_upgrade_to_premium()
{
    wp_redirect('https://fatcatapps.com/easypricingtables/?utm_campaign=wp%2Bsubmenu&utm_source=Easy%2BPricing%2BTables%2BFree&utm_medium=plugin&utm_content=v1', 301);
    exit();
}

function dh_ptp_upgrade_to_premium_menu_js()
{
    ?>
    <script type="text/javascript">
    	jQuery(document).ready(function ($) {
            $('a[href="edit.php?post_type=easy-pricing-table&page=easy-pricing-tables-upgrade"]').on('click', function () {
        		$(this).attr('target', '_blank');
            });
        });
    </script>
    <style>
        a[href="edit.php?post_type=easy-pricing-table&page=easy-pricing-tables-upgrade"] {
            color: #6bbc5b !important;
        }
        a[href="edit.php?post_type=easy-pricing-table&page=easy-pricing-tables-upgrade"]:hover {
            color: #7ad368 !important;
        }
    </style>
    <?php 
}
add_action( 'admin_footer', 'dh_ptp_upgrade_to_premium_menu_js');


?>