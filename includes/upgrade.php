<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function dh_ptp_upgrade_to_premium_menu()
{
    $page_hook = add_submenu_page('edit.php?post_type=easy-pricing-table', 'Upgrade to Premium', 'Upgrade to Premium', 'manage_options', 'easy-pricing-tables-upgrade', 'dh_ptp_upgrade_to_premium');
    add_action('load-' . $page_hook , 'dh_ptp_upgrade_ob_start');
}
add_action('admin_menu', 'dh_ptp_upgrade_to_premium_menu');

function dh_ptp_upgrade_ob_start() {
    ob_start();
}

function dh_ptp_upgrade_to_premium()
{
    wp_redirect('http://easypricingtables.com/?utm_source=free-plugin&utm_medium=link&utm_campaign=link-in-left-menu', 301);
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
    <?php 
}

add_action( 'admin_footer', 'dh_ptp_upgrade_to_premium_menu_js');
?>