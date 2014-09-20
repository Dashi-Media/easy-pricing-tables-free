<div id="dh_ptp_banner_container">
    <p class="tt-banner-headline tt-centered">
	<?php _e( 'Upgrade to Easy Pricing Tables Premium and get the following:', PTP_LOC ); ?>
    </p>
    
    <ul>
					<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Four additional table designs', PTP_LOC ); ?></li>
					<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Pricing toggles', PTP_LOC ); ?></li>
					<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Tooltips', PTP_LOC ); ?></li>
					<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Icons', PTP_LOC ); ?></li>
					<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Full customization options', PTP_LOC ); ?></li>
                                        <li><div class="dashicons dashicons-yes"></div> <?php _e( 'Priority support', PTP_LOC ); ?></li>
    </ul>
    
   <p style="text-align: center;">
        <a href="http://fatcatapps.com/easypricingtables/?utm_campaign=ept-ui-sidebar&utm_source=free-plugin&utm_medium=link&utm_content=v3" target="_blank" class="button button-primary button-large"><?php _e('Upgrade Now', PTP_LOC); ?></a>
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
