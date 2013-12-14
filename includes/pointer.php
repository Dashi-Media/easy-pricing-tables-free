<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Load pointers 
function dh_ptp_pointer_load($hook_suffix)
{
    // Sanity checks
    if ((!current_user_can('manage_options') || !is_super_admin()) || (get_bloginfo( 'version' ) < '3.3')) {
		return;
    }
  
    // Load usage tracking pointer popup
    $usage_tracking = get_option('dh_ptp_allow_tracking');
    if (!in_array($usage_tracking, array('yes', 'no'))) {
        // Load CSS and JS elements for pointer popup
        wp_enqueue_style('wp-pointer');
        wp_enqueue_script('wp-pointer');
        
        // Add action hook
        add_action('admin_print_footer_scripts', 'dh_ptp_usage_tracking_pointer');
    }
    
    // Load mailing list pointer popup
    global $current_screen;
    global $pagenow;
    
    // Show mailing list pointer popup once
    $mailing_list = get_option('dh_ptp_mailing_list');
    if ( 'easy-pricing-table' == $current_screen->post_type &&
           (( isset($_REQUEST['action']) && 'edit' == $_REQUEST['action']) || 'post-new.php' == $pagenow) && 
           in_array($usage_tracking, array('yes', 'no')) &&
           !in_array($mailing_list, array('yes', 'no'))) {
        
        wp_enqueue_style('wp-pointer');
        wp_enqueue_script('wp-pointer');
        add_action('admin_print_footer_scripts', 'dh_ptp_mailing_list_pointer');        
    }
}
add_action('admin_enqueue_scripts', 'dh_ptp_pointer_load');

// Usage Tracking
function dh_ptp_usage_tracking_pointer() 
{
    // Ajax request template    
    $ajax = '
        jQuery.ajax({
            type: "POST",
            url:  "'.admin_url('admin-ajax.php').'",
            data: {action: "dh_ptp_usage_tracking", nonce: "'.wp_create_nonce('dh_ptp_activate_tracking').'", allow_tracking: "%s" }
        });
    ';
    
    // Target
    $id = '#wpadminbar';
    
    // Buttons
    $button_1_title = 'Do not allow tracking';
    $button_1_fn    = sprintf($ajax, 'no');
    $button_2_title = 'Allow tracking';
    $button_2_fn    = sprintf($ajax, 'yes');
    
    // Content
    $content  = '<h3>'.'Help Improve Easy Pricing Tables'.'</h3>';
    $content .= '<p>'.'Thanks for installing Easy Pricing Tables. Please help us improve this plugin by gathering usage stats so we know which features to improve and which plugins and themes to test with.'.'</p>';
    
    // Options
    $options = array(
        'content' => $content,
        'position' => array('edge' => 'top', 'align' => 'center')
    );
    
    dh_ptp_print_script($id, $options, $button_1_title, $button_2_title, $button_1_fn, $button_2_fn);
}

function dh_ptp_usage_tracking_pointer_ajax()
{
    if(!wp_verify_nonce($_POST['nonce'], 'dh_ptp_activate_tracking')) {
        die ('No tricky business!');
    }
    
    $result = ($_POST['allow_tracking'] == 'yes')?'yes':'no';
    
    update_option('dh_ptp_allow_tracking', $result);
    exit();
}
add_action( 'wp_ajax_dh_ptp_usage_tracking', 'dh_ptp_usage_tracking_pointer_ajax');

// Add mailing list subscription
function dh_ptp_mailing_list_pointer() 
{
    // Ajax request template    
    $ajax = '
        jQuery.ajax({
            type: "POST",
            url:  "'.admin_url('admin-ajax.php').'",
            data: {action: "dh_ptp_mailing_list", nonce: "'.wp_create_nonce('dh_ptp_mailing_list').'", subscribe: "%s" }
        });
    ';
    
    // Target
    $id = '#wpadminbar';
    
    // Buttons
    $button_1_title = 'No, thanks';
    $button_1_fn    = sprintf($ajax, 'no');
    $button_2_title = "Let&#39;s do it!";
    $button_2_fn    = sprintf($ajax, 'yes');
    
    // Content
    $content  = '<h3>'.'Pricing Table Crash Course'.'</h3>';
    $content .= '<p>'."Instead of watching 99% of your visitors bounce, imagine you could increase your pricing table&#39;s conversion rate and make more money. Find out how in this ridiculously actionable (and totally free) 5-part email course.".'</p>';
    
    // Options
    $options = array(
        'content' => $content,
        'position' => array('edge' => 'top', 'align' => 'center')
    );
    
    dh_ptp_print_script($id, $options, $button_1_title, $button_2_title, $button_1_fn, $button_2_fn);
}

function dh_ptp_mailing_list_pointer_ajax()
{
    global $current_user;
    
    // Config
    $api_key  = '35730c4540f59d2db0ec715ef1cb3f90';
    $api_list = '34598307ceb27689b52a4da12f5a0ee6';
    
    // Verify nonce
    if(!wp_verify_nonce($_POST['nonce'], 'dh_ptp_mailing_list')) {
        die ('No tricky business!');
    }
    
    // Check status
    $result = ($_POST['subscribe'] == 'yes')?'yes':'no';
    if ($result == 'no') {
        update_option('dh_ptp_mailing_list', 'no');
        exit();
    }
    
    // Get current user info
    get_currentuserinfo();
    
    // Subscribe
    require_once PTP_PLUGIN_PATH.'includes/libraries/campaignmonitor/csrest_subscribers.php';
    
    $auth = array('api_key' => $api_key);
    $wrap = new CS_REST_Subscribers($api_list, $auth);
    $result = $wrap->add(array(
        'EmailAddress' => $current_user->user_email,
        'Name' => $current_user->display_name,
        'CustomFields' => array(
            array(
                'Key' => 'URL',
                'Value' => get_bloginfo('url'),
            )
        ),
    ));
    
    if($result->was_successful()) {
        update_option('dh_ptp_mailing_list', 'yes');
    } else {
        update_option('dh_ptp_mailing_list', 'no');
    }
    
    exit();
}
add_action( 'wp_ajax_dh_ptp_mailing_list', 'dh_ptp_mailing_list_pointer_ajax');

// Print JS Content
function dh_ptp_print_script($selector, $options, $button1, $button2 = false, $button1_fn = '', $button2_fn = '')
{
    ?>
    <script type="text/javascript">
		//<![CDATA[
            (function ($) {
                var dh_ptp_pointer_options = <?php echo json_encode( $options ); ?>, setup;
     
                dh_ptp_pointer_options = $.extend(dh_ptp_pointer_options, {
                    buttons:function (event, t) {
                        button = jQuery('<a id="pointer-close" style="margin-left:5px" class="button-secondary">' + '<?php echo $button1; ?>' + '</a>');
                        button.bind('click.pointer', function () {
                            t.element.pointer('close');
                        });
                        return button;
                    },
                    close:function () {
                    }
                });
     
                setup = function () {
                    $('<?php echo $selector; ?>').pointer(dh_ptp_pointer_options).pointer('open');
                    <?php if ( $button2 ) : ?>
                        jQuery('#pointer-close').after('<a id="pointer-primary" class="button-primary">' + '<?php echo $button2; ?>' + '</a>');
                        jQuery('#pointer-primary').click(function () {
                            <?php echo $button2_fn; ?>
                            $('<?php echo $selector; ?>').pointer('close');
                        });
                        jQuery('#pointer-close').click(function () {
                            <?php echo $button1_fn; ?>
                            $('<?php echo $selector; ?>').pointer('close');
                        });
                    <?php endif; ?>
                };
 
                $(document).ready(setup);
            })(jQuery);
        //]]>
	</script>
    <?php
}
?>