<div id="simple-flat-advanced-design-settings">
    <div class="dh_ptp_accordion widget-title ui-sortable-handle">
        <h4><?php _e('General Settings', 'easy-pricing-tables'); ?></h4>
        <div class="widget-inside widget">
            <table>
                <tr>
                    <td class="settings-title"><?php _e('Featured Label Text', 'easy-pricing-tables'); ?></td>
                    <?php $mb->the_field('most-popular-label-text'); ?>
                    <td>
                        <?php $value = (!is_null($mb->get_the_value()))?$metabox->get_the_value():__('Most Popular', 'easy-pricing-tables'); ?>
                        <input type="text" name="<?php esc_attr( $metabox->the_name() ); ?>" id="<?php $metabox->the_name(); ?>" value="<?php echo esc_attr( $value ); ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="settings-title"><?php _e('Border Radius', 'easy-pricing-tables'); ?></td>
                    <?php $mb->the_field('rounded-corners'); ?>
                    <td><select class="form-control" name="<?php esc_attr( $metabox->the_name() ); ?>">
                            <option value="0px" <?php
                            if(!is_null($mb->get_the_value())) {
                                if($mb->get_the_value() == '0px') {
                                    echo 'selected';
                                }
                            } else {
                                echo 'selected';
                            }
                            ?> ><?php _e('No Rounded Corners', 'easy-pricing-tables'); ?></option>
                            <?php
                                for($i=1;$i<=20;++$i){
                                    if($mb->get_the_value() == $i . 'px') {
                                        echo '<option value="' . $i . 'px" selected>' . $i . 'px</option>';
                                    } else {
                                        echo '<option value="' . $i . 'px" >' . $i . 'px</option>';
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                
                
                   <!--  Automatically match Row Height  -->
                  <tr>
                    <td class="settings-title">
                        <label for="match-column-height-dg1" style="margin: 0; font-weight: normal;"><?php _e('Automatically match Row Height', 'easy-pricing-tables'); ?></label>
                    </td>
                    <td>
                        <?php esc_attr( $mb->the_field('match-column-height-dg1') ); ?>
                        <input type="checkbox" onchange="return consistent_match_column_height(this) " class="tt-match-column-height-checkbox" name="<?php esc_attr( $metabox->the_name() ); ?>" id="match-column-height-dg1" value="1" <?php      if (!$meta) { echo 'checked="checked"'; } else  if ($metabox->get_the_value()) echo 'checked="checked"'; ?>/>
                    </td>
                </tr>
            </table>
        </div>
        <h4><?php _e('Font Sizes', 'easy-pricing-tables'); ?></h4>
        <div>
            <table>
                <tr>
                    <td class="settings-title"><?php _e('Featured Label Font Size', 'easy-pricing-tables'); ?></td>
                    <td>
                        <?php $mb->the_field('most-popular-font-size'); ?>
                        <input class="form-control float-input" type="text" name="<?php esc_attr( $metabox->the_name() ); ?>" value="<?php if(!is_null($mb->get_the_value())) echo esc_attr( $metabox->the_value() ); else echo "0.9"; ?>"/>
                    </td>
                    <td>
                        <?php $mb->the_field('most-popular-font-size-type'); ?>
                        <select  name="<?php esc_attr( $metabox->the_name() ); ?>">
                            <option value="em" <?php
                            if(!is_null($mb->get_the_value())) {
                                if($mb->get_the_value() == 'em') {
                                    echo 'selected';
                                }
                            } else {
                                echo 'selected';
                            }
                            ?> >em</option>
                            <option value="px" <?php
                            if(!is_null($mb->get_the_value())) {
                                if($mb->get_the_value() == 'px') {
                                    echo 'selected';
                                }
                            }
                            ?>>px</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="settings-title"><?php _e('Plan Name Font Size', 'easy-pricing-tables'); ?></td>
                    <td>
                        <?php $mb->the_field('plan-name-font-size'); ?>
                        <input class="form-control float-input" type="text" name="<?php esc_attr( $metabox->the_name() ); ?>" value="<?php if(!is_null($mb->get_the_value())) echo esc_attr( $metabox->the_value() ); else echo "1"; ?>"/>
                    </td>
                    <td>
                        <?php $mb->the_field('plan-name-font-size-type'); ?>
                        <select  name="<?php esc_attr( $metabox->the_name() ); ?>">
                            <option value="em" <?php
                            if(!is_null($mb->get_the_value())) {
                                if($mb->get_the_value() == 'em') {
                                    echo 'selected';
                                }
                            } else {
                                echo 'selected';
                            }
                            ?> >em</option>
                            <option value="px" <?php
                            if(!is_null($mb->get_the_value())) {
                                if($mb->get_the_value() == 'px') {
                                    echo 'selected';
                                }
                            }
                            ?>>px</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="settings-title"><?php _e('Price Font Size', 'easy-pricing-tables'); ?></td>
                    <td>
                        <?php $mb->the_field('price-font-size'); ?>
                        <input class="form-control float-input" type="text" name="<?php esc_attr( $metabox->the_name() ); ?>" value="<?php if(!is_null($mb->get_the_value())) echo esc_attr( $metabox->the_value() ); else echo "1.25"; ?>"/>
                    </td>
                    <td>
                        <?php $mb->the_field('price-font-size-type'); ?>
                        <select  name="<?php esc_attr( $metabox->the_name() ); ?>">
                            <option value="em" <?php
                            if(!is_null($mb->get_the_value())) {
                                if($mb->get_the_value() == 'em') {
                                    echo 'selected';
                                }
                            } else {
                                echo 'selected';
                            }
                            ?> >em</option>
                            <option value="px" <?php
                            if(!is_null($mb->get_the_value())) {
                                if($mb->get_the_value() == 'px') {
                                    echo 'selected';
                                }
                            }
                            ?>>px</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="settings-title"><?php _e('Bullet Item Font Size', 'easy-pricing-tables'); ?></td>
                    <td>
                        <?php $mb->the_field('bullet-item-font-size'); ?>
                        <input class="form-control float-input" type="text" name="<?php esc_attr( $metabox->the_name() ); ?>" value="<?php if(!is_null($mb->get_the_value())) echo esc_attr( $metabox->the_value() ); else echo "0.875"; ?>"/>
                    </td>
                    <td>
                        <?php $mb->the_field('bullet-item-font-size-type'); ?>
                        <select  name="<?php esc_attr( $metabox->the_name() ); ?>">
                            <option value="em" <?php
                            if(!is_null($mb->get_the_value())) {
                                if($mb->get_the_value() == 'em') {
                                    echo 'selected';
                                }
                            } else {
                                echo 'selected';
                            }
                            ?> >em</option>
                            <option value="px" <?php
                            if(!is_null($mb->get_the_value())) {
                                if($mb->get_the_value() == 'px') {
                                    echo 'selected';
                                }
                            }
                            ?>>px</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="settings-title"><?php _e('Button Font Size', 'easy-pricing-tables'); ?></td>
                    <td>
                        <?php $mb->the_field('button-font-size'); ?>
                        <input class="form-control float-input" type="text" name="<?php esc_attr( $metabox->the_name() ); ?>" value="<?php if(!is_null($mb->get_the_value())) echo esc_attr( $metabox->the_value() ); else echo "1"; ?>"/>
                    </td>
                    <td>
                        <?php $mb->the_field('button-font-size-type'); ?>
                        <select  name="<?php esc_attr( $metabox->the_name() ); ?>">
                            <option value="em" <?php
                            if(!is_null($mb->get_the_value())) {
                                if($mb->get_the_value() == 'em') {
                                    echo 'selected';
                                }
                            } else {
                                echo 'selected';
                            }
                            ?> >em</option>
                            <option value="px" <?php
                            if(!is_null($mb->get_the_value())) {
                                if($mb->get_the_value() == 'px') {
                                    echo 'selected';
                                }
                            }
                            ?>>px</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
        
        <h4><?php _e("Button Colors", 'easy-pricing-tables'); ?></h4>
        <div>
            <table>
               <!-- Headline -->
                <tr class="table-headline"><td><br/><?php _e('Button Color (Unfeatured Columns)', 'easy-pricing-tables'); ?></td></tr>
                <tr>
                    <td class="settings-title"><?php _e('Button Color', 'easy-pricing-tables'); ?></td>
                    <?php $mb->the_field('button-color'); ?>
                    <?php $value = (!is_null($mb->get_the_value()))?$mb->get_the_value():'#3498db'; ?>
                    <td><input type="text" name="<?php esc_attr( $mb->the_name() ); ?>" class="button-color" value="<?php echo esc_attr( $value ); ?>" class="my-color-field form-control" data-default-color="#3498db" /></td>
                </tr>
                <tr>
                    <td class="settings-title"><?php _e('Button Border Color', 'easy-pricing-tables'); ?></td>
                    <?php $mb->the_field('button-border-color'); ?>
                    <?php $value = (!is_null($mb->get_the_value()))?$mb->get_the_value():'#2980b9'; ?>
                    <td><input type="text" name="<?php esc_attr( $mb->the_name() ); ?>" class="button-border-color" value="<?php echo esc_attr( $value ); ?>" class="my-color-field" data-default-color="#2980b9" /></td>
                </tr>
                <tr>
                    <td class="settings-title"><?php _e('Button Hover Color', 'easy-pricing-tables'); ?></td>
                    <?php $mb->the_field('button-hover-color'); ?>
                    <?php $value = (!is_null($mb->get_the_value()))?$mb->get_the_value():'#2980b9'; ?>
                    <td><input type="text" name="<?php esc_attr( $mb->the_name() ); ?>" class="button-border-color" value="<?php echo esc_attr( $value ); ?>" class="my-color-field" data-default-color="#2980b9" /></td>
                </tr>
                <tr>
                    <td class="settings-title"><?php _e('Button Font Color', 'easy-pricing-tables'); ?></td>
                    <?php $mb->the_field('button-font-color'); ?>
                    <?php $value = (!is_null($mb->get_the_value()))?$mb->get_the_value():'#ffffff'; ?>
                    <td><input type="text" name="<?php esc_attr( $mb->the_name() ); ?>" class="colorpicker-no-palettes" value="<?php echo esc_attr( $value ); ?>" class="my-color-field" data-default-color="#ffffff" /></td>
                </tr>
                
                <!-- Headline -->
                <tr class="table-headline"><td><br/><?php _e('Button Color (Featured Column)', 'easy-pricing-tables'); ?></td></tr>
                <tr>
                    <td class="settings-title"><?php _e('Featured-Button Color', 'easy-pricing-tables'); ?></td>
                    <?php $mb->the_field('featured-button-color'); ?>
                    <?php $value = (!is_null($mb->get_the_value()))?$mb->get_the_value():'#e74c3c'; ?>
                    <td><input type="text" name="<?php esc_attr( $mb->the_name() ); ?>" class="button-color" value="<?php echo esc_attr( $value ); ?>" class="my-color-field form-control" data-default-color="#e74c3c" /></td>
                </tr>
                <tr>
                    <td class="settings-title"><?php _e('Featured-Button Border Color', 'easy-pricing-tables'); ?></td>
                    <?php $mb->the_field('featured-button-border-color'); ?>
                    <?php $value = (!is_null($mb->get_the_value()))?$mb->get_the_value():'#c0392b'; ?>
                    <td><input type="text" name="<?php esc_attr( $mb->the_name() ); ?>" class="button-border-color" value="<?php echo esc_attr( $value ); ?>" class="my-color-field" data-default-color="#c0392b" /></td>
                </tr>
                <tr>
                    <td class="settings-title"><?php _e('Featured-Button Hover Color', 'easy-pricing-tables'); ?></td>
                    <?php $mb->the_field('featured-button-hover-color'); ?>
                    <?php $value = (!is_null($mb->get_the_value()))?$mb->get_the_value():'#c0392b'; ?>
                    <td><input type="text" name="<?php esc_attr( $mb->the_name() ); ?>" class="button-border-color" value="<?php echo esc_attr( $value ); ?>" class="my-color-field" data-default-color="#c0392b" /></td>
                </tr>
                <tr>
                    <td class="settings-title"><?php _e('Featured-Button Font Color', 'easy-pricing-tables'); ?></td>
                    <?php $mb->the_field('featured-button-font-color'); ?>
                    <?php $value = (!is_null($mb->get_the_value()))?$mb->get_the_value():'#ffffff'; ?>
                    <td><input type="text" name="<?php esc_attr( $mb->the_name() ); ?>" class="colorpicker-no-palettes" value="<?php echo esc_attr( $value ); ?>" class="my-color-field" data-default-color="#ffffff" /></td>
                </tr>
                
            </table>
        </div>
        
     <!-- ept-custom-css-setting -->
        <h4><?php _e('Custom CSS', 'easy-pricing-tables'); ?></h4>
        <div >
 
            <table>
                <tr>
                    <?php $mb->the_field('ept-custom-css-setting-dg1'); ?>
                    <td class="settings-title">
                        <label for="custom-css-setting" style="margin: 0; font-weight: bold;"><?php _e('Custom Pricing Table CSS', 'easy-pricing-tables'); ?></label>
                    </td>
                    <td class="custom-css-setting-td">
                        
                        <textarea  class="custom-css-setting-textbox" name="<?php esc_attr( $metabox->the_name() ); ?>"  rows="10" cols="60" <?php if (!$metabox->get_the_value()) echo  'placeholder=" Type your custom css here"' ?> ><?php if ($metabox->get_the_value()) echo " " . esc_attr( $metabox->get_the_value() ); else {
                         echo " ";
                     } ?></textarea>
                        </td>
                </tr>
           
            </table>
        
           </div>
    </div>

</div>
