<div id="dh_ptp_tabs_3" class="dh_ptp_tab">

    <?php $mb->the_field('dh-ptp-simple-flat-template'); ?>
    <div id="simple-flat-selector" class="template-selector  template-selected">
        <input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php if (!is_null($metabox->get_the_value())) {
        $mb->the_value();
    } elseif (!$mb->is_last()) {
        echo "selected";
    } ?>" class="form-control template-hidden-input" />
        <img src="<?php echo PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/img/simple-flat.png'; ?>" class="template-image"></img>
        <p class="template-headline"><?php _e('Design 1', 'easy-pricing-tables'); ?></p>
        <ul class="template-feature">
            <li><?php _e('Ideal For Responsive Sites', 'easy-pricing-tables'); ?></li>
            <li><?php _e('Supports Up To 10 Columns', 'easy-pricing-tables'); ?></li>
        </ul>
        <a onClick="" class="button template-button"><?php _e('Use This Template', 'easy-pricing-tables'); ?></a>
    </div>

<?php $mb->the_field('dh-ptp-fancy-flat-template'); ?>
    <div id="fancy-flat-selector" class="template-selector " onClick="templateSelectorRequireUpgradeClickedHandler(this)" >
        <input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php if (!is_null($metabox->get_the_value())) {
    $mb->the_value();
} elseif (!$mb->is_last()) {
    echo "not-selected";
} ?>" class="form-control template-hidden-input" />
        <img src="<?php echo PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/img/fancy-flat.png'; ?>" class="template-image"></img>
        <p class="template-headline"><?php _e('Design 2', 'easy-pricing-tables'); ?></p>
        <ul class="template-feature">
            <li><?php _e('Ideal For Responsive Sites', 'easy-pricing-tables'); ?></li>
            <li><?php _e('Supports Up To 8 Columns', 'easy-pricing-tables'); ?></li>
        </ul>
        <a onClick="" class="button template-button"><?php _e('Use This Template', 'easy-pricing-tables'); ?></a>
    </div>

<?php $mb->the_field('dh-ptp-stylish-flat-template'); ?>
    <div id="stylish-flat-selector" class="template-selector " onClick="templateSelectorRequireUpgradeClickedHandler(this)" >
        <input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php if (!is_null($metabox->get_the_value())) {
    $mb->the_value();
} elseif (!$mb->is_last()) {
    echo "not-selected";
} ?>" class="form-control template-hidden-input" />
        <img src="<?php echo PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/img/stylish-flat.png'; ?>" class="template-image"></img>
        <p class="template-headline"><?php _e('Design 3', 'easy-pricing-tables'); ?></p>
        <ul class="template-feature">
            <li><?php _e('Ideal For Responsive Sites', 'easy-pricing-tables'); ?></li>
            <li><?php _e('Supports Up To 5 Columns', 'easy-pricing-tables'); ?></li>
        </ul>
        <a  class="button template-button"><?php _e('Use This Template', 'easy-pricing-tables'); ?></a>
    </div>

    <!-- Design 4 -->
    <?php $mb->the_field('dh-ptp-design4-template'); ?>
    <div id="design4-selector" class="template-selector " onClick="templateSelectorRequireUpgradeClickedHandler(this)" >
        <input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php if (!is_null($metabox->get_the_value())) {
        $mb->the_value();
    } elseif (!$mb->is_last()) {
        echo "not-selected";
    } ?>" class="form-control template-hidden-input" />
        <img src="<?php echo PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/img/design4.png'; ?>" class="template-image"></img>
        <p class="template-headline"><?php _e('Design 4', 'easy-pricing-tables'); ?></p>
        <ul class="template-feature">
            <li><?php _e('Ideal For Responsive Sites', 'easy-pricing-tables'); ?></li>
            <li><?php _e('Supports Unlimited Columns', 'easy-pricing-tables'); ?></li>
            <li><?php _e('Hover Effects (ideal for non-touch devices)', 'easy-pricing-tables'); ?></li>
        </ul>
        <a  class="button template-button"><?php _e('Use This Template', 'easy-pricing-tables'); ?></a>
    </div>

<?php $mb->the_field('dh-ptp-design5-template'); ?>
    <div id="design5-selector" class="template-selector " onClick="templateSelectorRequireUpgradeClickedHandler(this)" >
        <input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php if (!is_null($metabox->get_the_value())) {
    $mb->the_value();
} elseif (!$mb->is_last()) {
    echo "not-selected";
} ?>" class="form-control template-hidden-input" />
        <img src="<?php echo PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/img/design5.png'; ?>" class="template-image"></img>
        <p class="template-headline"><?php _e('Design 5', 'easy-pricing-tables'); ?></p>
        <ul class="template-feature">
            <li><?php _e('Ideal For Unresponsive Sites', 'easy-pricing-tables'); ?></li>
            <li><?php _e('Supports Up To 10 Columns', 'easy-pricing-tables'); ?></li>
        </ul>
        <a  class="button template-button"><?php _e('Use This Template', 'easy-pricing-tables'); ?></a>
    </div>

    <!-- clear our floats -->
    <div class="clear"></div>
</div>


<script type="text/javascript">
   
    // handle clicks on use template button
    function templateSelectorRequireUpgradeClickedHandler(el)
    {
	
        var alert_text = "<?php _e("Please upgrade to Easy Pricing Tables Premium to use this design.", 'easy-pricing-tables'); ?>";
        alert(alert_text);

        return false;
    }

        
</script>