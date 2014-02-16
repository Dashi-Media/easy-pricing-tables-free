<div id="simple-flat-advanced-design-settings">
<table>
    <tr class="table-headline"><td><br/><?php _e('Design Settings', PTP_LOC); ?></td></tr>
    <tr>
        <td><?php _e('Border Radius', PTP_LOC); ?></td>
        <?php $mb->the_field('rounded-corners'); ?>
        <td><select class="form-control" name="<?php $metabox->the_name(); ?>">
                <option value="0px" <?php
                if(!is_null($mb->get_the_value())) {
                    if($mb->get_the_value() == '0px') {
                        echo 'selected';
                    }
                } else {
                    echo 'selected';
                }
                ?> ><?php _e('No Rounded Corners', PTP_LOC); ?></option>
                <?php
                    for($i=1;$i<=20;++$i){
                        if($mb->get_the_value() == $i . 'px') {
                            echo '<option value="' . $i . 'px" selected>' . $i . 'px</option>';
                        } else {
                            echo '<option value="' . $i . 'px" >' . $i . 'px</option>';
                        }
                    }
                ?>
            </select></td>
    </tr>
    <tr>
        <td><?php _e('Featured Label Text', PTP_LOC); ?></td>
        <?php $mb->the_field('most-popular-label-text'); ?>
        <td>
            <?php $value = (!is_null($mb->get_the_value()))?$metabox->get_the_value():__('Most Popular', PTP_LOC); ?>
            <input type="text" name="<?php $metabox->the_name(); ?>" id="<?php $metabox->the_name(); ?>" value="<?php echo $value;?>" />
        </td>
    </tr>

<tr class="table-headline"><td><br/><?php _e('Font Sizes', PTP_LOC); ?></td></tr>
<tr>
    <td><?php _e('Featured Label Font Size', PTP_LOC); ?></td>
    <td>
        <?php $mb->the_field('most-popular-font-size'); ?>
        <input class="form-control float-input" type="text" name="<?php $metabox->the_name(); ?>" value="<?php if(!is_null($mb->get_the_value())) echo $metabox->the_value(); else echo "0.9"; ?>"/>
    </td>
    <td>
        <?php $mb->the_field('most-popular-font-size-type'); ?>
        <select  name="<?php $metabox->the_name(); ?>">
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
    <td><?php _e('Plan Name Font Size', PTP_LOC); ?></td>
    <td>
        <?php $mb->the_field('plan-name-font-size'); ?>
        <input class="form-control float-input" type="text" name="<?php $metabox->the_name(); ?>" value="<?php if(!is_null($mb->get_the_value())) echo $metabox->the_value(); else echo "1"; ?>"/>
    </td>
    <td>
        <?php $mb->the_field('plan-name-font-size-type'); ?>
        <select  name="<?php $metabox->the_name(); ?>">
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
    <td><?php _e('Price Font Size', PTP_LOC); ?></td>
    <td>
        <?php $mb->the_field('price-font-size'); ?>
        <input class="form-control float-input" type="text" name="<?php $metabox->the_name(); ?>" value="<?php if(!is_null($mb->get_the_value())) echo $metabox->the_value(); else echo "1.25"; ?>"/>
    </td>
    <td>
        <?php $mb->the_field('price-font-size-type'); ?>
        <select  name="<?php $metabox->the_name(); ?>">
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
    <td><?php _e('Bullet Item Font Size', PTP_LOC); ?></td>
    <td>
        <?php $mb->the_field('bullet-item-font-size'); ?>
        <input class="form-control float-input" type="text" name="<?php $metabox->the_name(); ?>" value="<?php if(!is_null($mb->get_the_value())) echo $metabox->the_value(); else echo "0.875"; ?>"/>
    </td>
    <td>
        <?php $mb->the_field('bullet-item-font-size-type'); ?>
        <select  name="<?php $metabox->the_name(); ?>">
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
    <td><?php _e('Button Font Size', PTP_LOC); ?></td>
    <td>
        <?php $mb->the_field('button-font-size'); ?>
        <input class="form-control float-input" type="text" name="<?php $metabox->the_name(); ?>" value="<?php if(!is_null($mb->get_the_value())) echo $metabox->the_value(); else echo "1"; ?>"/>
    </td>
    <td>
        <?php $mb->the_field('button-font-size-type'); ?>
        <select  name="<?php $metabox->the_name(); ?>">
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

<!-- Normal Buttons -->
<tr class="table-headline"><td><br/><?php _e('Button Color', PTP_LOC); ?></td></tr>
<tr>
    <td><?php _e('Button Color', PTP_LOC); ?></td>
    <?php $mb->the_field('button-color'); ?>
    <?php $value = (!is_null($mb->get_the_value()))?$mb->get_the_value():'#3498db'; ?>
    <td><input type="text" name="<?php $mb->the_name(); ?>" class="button-color" value="<?php echo $value; ?>" class="my-color-field form-control" data-default-color="#3498db" /></td>
</tr>

<tr>
    <td><?php _e('Button Border Color', PTP_LOC); ?></td>
    <?php $mb->the_field('button-border-color'); ?>
    <?php $value = (!is_null($mb->get_the_value()))?$mb->get_the_value():'#2980b9'; ?>
    <td><input type="text" name="<?php $mb->the_name(); ?>" class="button-border-color" value="<?php echo $value; ?>" class="my-color-field" data-default-color="#2980b9" /></td>
</tr>

<tr>
    <td><?php _e('Button Hover Color', PTP_LOC); ?></td>
    <?php $mb->the_field('button-hover-color'); ?>
    <?php $value = (!is_null($mb->get_the_value()))?$mb->get_the_value():'#2980b9'; ?>
    <td><input type="text" name="<?php $mb->the_name(); ?>" class="button-border-color" value="<?php echo $value; ?>" class="my-color-field" data-default-color="#2980b9" /></td>
</tr>

<tr>
    <td><?php _e('Button Font Color', PTP_LOC); ?></td>
    <?php $mb->the_field('button-font-color'); ?>
    <?php $value = (!is_null($mb->get_the_value()))?$mb->get_the_value():'#ffffff'; ?>
    <td><input type="text" name="<?php $mb->the_name(); ?>" class="colorpicker-no-palettes" value="<?php echo $value; ?>" class="my-color-field" data-default-color="#ffffff" /></td>
</tr>

<!-- Featured Buttons -->
<tr class="table-headline"><td><br/><?php _e('Button Color (Featured Column)', PTP_LOC); ?></td></tr>
<tr>
    <td><?php _e('Featured-Button Color', PTP_LOC); ?></td>
    <?php $mb->the_field('featured-button-color'); ?>
    <?php $value = (!is_null($mb->get_the_value()))?$mb->get_the_value():'#e74c3c'; ?>
    <td><input type="text" name="<?php $mb->the_name(); ?>" class="button-color" value="<?php echo $value; ?>" class="my-color-field form-control" data-default-color="#e74c3c" /></td>
</tr>

<tr>
    <td><?php _e('Featured-Button Border Color', PTP_LOC); ?></td>
    <?php $mb->the_field('featured-button-border-color'); ?>
    <?php $value = (!is_null($mb->get_the_value()))?$mb->get_the_value():'#c0392b'; ?>
    <td><input type="text" name="<?php $mb->the_name(); ?>" class="button-border-color" value="<?php echo $value; ?>" class="my-color-field" data-default-color="#c0392b" /></td>
</tr>

<tr>
    <td><?php _e('Featured-Button Hover Color', PTP_LOC); ?></td>
    <?php $mb->the_field('featured-button-hover-color'); ?>
    <?php $value = (!is_null($mb->get_the_value()))?$mb->get_the_value():'#c0392b'; ?>
    <td><input type="text" name="<?php $mb->the_name(); ?>" class="button-border-color" value="<?php echo $value; ?>" class="my-color-field" data-default-color="#c0392b" /></td>
</tr>

<tr>
    <td><?php _e('Featured-Button Font Color', PTP_LOC); ?></td>
    <?php $mb->the_field('featured-button-font-color'); ?>
    <?php $value = (!is_null($mb->get_the_value()))?$mb->get_the_value():'#ffffff'; ?>
    <td><input type="text" name="<?php $mb->the_name(); ?>" class="colorpicker-no-palettes" value="<?php echo $value; ?>" class="my-color-field" data-default-color="#ffffff" /></td>
</tr>
</table>
</div>
