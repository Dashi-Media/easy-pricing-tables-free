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