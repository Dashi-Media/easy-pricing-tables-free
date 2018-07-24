<div id="dh_ptp_loading">
	<center style="margin: 50px;">Loading...</center>
</div>
<div id="dh_ptp_tabs_container" style="display: none;">
    <ul id="dh_ptp_metabox_tabs" class="nav-tab-wrapper">
        <li class="dh_ptp_tab_header nav-tab"><a href="#dh_ptp_tabs_1"><?php _e('Content', 'easy-pricing-tables'); ?></a></li>
        <li class="dh_ptp_tab_header nav-tab"><a href="#dh_ptp_tabs_2"><?php _e('Design', 'easy-pricing-tables'); ?></a></li>
       <!-- <li class="dh_ptp_tab_header"><a href="#dh_ptp_tabs_3"><?php // _e('Template', 'easy-pricing-tables'); ?></a></li>  -->
    </ul>
    <!-- clear our floats -->
    <div class="clear"></div>

    <?php include ( PTP_PLUGIN_PATH . '/includes/metaboxes/metabox-blocks/tab-content.php');?>
    <?php include ( PTP_PLUGIN_PATH . '/includes/metaboxes/metabox-blocks/tab-advanced-settings.php');?>
    <?php //include ( PTP_PLUGIN_PATH . '/includes/metaboxes/metabox-blocks/tab-template.php'); ?>

    <div id="ptp-save-buttons">
        <div style="margin-left:10px;margin-right:10px;">
            <input type="hidden" name="publish" id="publish" value="1"/>
            <input type="hidden" name="dh_ptp_tab" id="dh_ptp_tab" value="#dh_ptp_tabs_1"/>
            <a style="float:left;" class="button button-large" id="dh_ptp_save_preview" data-url="<?php echo esc_url( get_permalink($post->ID) ); ?>"><?php _e('Save & Preview', 'easy-pricing-tables'); ?></a>
            <input style="float:left; margin-left:10px;" name="save" id="dh_ptp_save" type="submit" class="button button-large" accesskey="p" value="<?php _e('Save', 'easy-pricing-tables'); ?>" />
            <a style="float:left; margin-left:10px;" class="button button-large inline-lightbox button-deploy" href="#deploy" data-id="<?php the_ID(); ?>"><?php _e('Deploy (Get Shortcode)', 'easy-pricing-tables'); ?></a>
            <div class="clear"></div>
       </div>
    </div>

    <!-- This contains the lightbox content for the deploy-button -->
    <div style='display:none'>
        <div id='deploy' style='padding:10px; background:#fff;'>
            <p><?php _e('Copy the shortcode below and paste it wherever you want your pricing table to appear.'); ?></p>
            <input type="text" style="width: 300px;" readonly="readonly" onclick="this.select()" value="[easy-pricing-table id=&quot;<?php the_ID(); ?>&quot;]"/><br/>
        </div>
    </div>
    
    <script type="text/javascript">
			// call the codemirror for custom css textbox
           var cusid_ele = document.getElementsByClassName('custom-css-setting-textbox');
            for (var i = 0; i < cusid_ele.length; ++i) {
                var item = cusid_ele[i];  
                  
                var editor = CodeMirror.fromTextArea(item, {
                    mode: "text/css",                    
                    lineNumbers: true,
                    lineWrapping: true,
                    foldGutter: true,
                    gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"]
                });
                  
            }

    </script>
</div>
