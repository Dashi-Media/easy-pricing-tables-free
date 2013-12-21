<div id="dh_ptp_tabs_container" class="my_meta_control">
    <ul id="dh_ptp_metabox_tabs">
        <li class="dh_ptp_tab_header"><a href="#dh_ptp_tabs_1">Content</a></li>
        <li class="dh_ptp_tab_header"><a href="#dh_ptp_tabs_2">Design</a></li>
    </ul>
    <!-- clear our floats -->
    <div class="clear"></div>

    <?php include ( PTP_PLUGIN_PATH . '/includes/metaboxes/metabox-blocks/tab-content.php');?>
    <?php include ( PTP_PLUGIN_PATH . '/includes/metaboxes/metabox-blocks/tab-advanced-settings.php');?>

    <div id="ptp-save-buttons">
        <div style="margin-left:10px;margin-right:10px;">
            <input type="hidden" name="dh_ptp_tab" id="dh_ptp_tab" value="#dh_ptp_tabs_1"/>
            <input style="float:left; " name="save" type="submit" class="button button-large " id="publish" accesskey="p" value="Save Settings">
            <a  style="float:left; margin-left:10px;" class="button button-large " href="<?php echo esc_url( get_permalink($post->ID) ); ?>" target="_blank" >Preview</a>
            <a  style="float:left; margin-left:10px;" class="button button-large inline-lightbox" href="#deploy" >Deploy</a>
            <div class="clear"></div>
       </div>
    </div>

    <!-- This contains the lightbox content for the deploy-button -->
    <div style='display:none'>
        <div id='deploy' style='padding:10px; background:#fff;'>
            <p>Copy the shortcode below and paste it wherever you want your pricing table to appear.</p>
            <input type="text" readonly="readonly" onclick="this.select()" value="[easy-pricing-table id=&quot;<?php the_ID(); ?>&quot;]"/><br/>
        </div>
    </div>

    <?php if (isset($_COOKIE['dh_ptp_current_tab'])) : ?>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('a[href=<?php echo $_COOKIE['dh_ptp_current_tab'];?>]').click();
            });
        </script>
    <?php endif; ?>
</div>
