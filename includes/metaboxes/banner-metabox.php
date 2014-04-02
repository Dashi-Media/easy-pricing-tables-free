<div id="dh_ptp_banner_container">
    <p><?php _e('Do you like this plugin?', PTP_LOC); ?> <a href="http://easypricingtables.com/?utm_source=free-plugin&utm_medium=banner&utm_campaign=banner-in-plugin-sidebar" target="_blank"><?php _e('You will love Easy Pricing Tables Premium.', PTP_LOC); ?></a></p>
    <p><?php _e('It comes with 4 additional table designs, tooltips, icons, tons of customization options and much more. 60-day money back guarantee.', PTP_LOC); ?></p>
    <p style="text-align: center;">
        <a href="http://easypricingtables.com/?utm_source=free-plugin&utm_medium=banner&utm_campaign=banner-in-plugin-sidebar" target="_blank" class="button button-primary button-large"><?php _e('Learn More', PTP_LOC); ?></a>
    </p>
    
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#dh_ptp_banner_container a').click(function(){
                track_banner();
            });
            
            // tracking function
            var track_banner = function() {
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo admin_url('admin-ajax.php'); ?>",
                    data: {
                        action: "dh_ptp_tracking_banner"
                    }
                });
            };
        });
    </script>
</div>
