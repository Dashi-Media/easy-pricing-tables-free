<div id="simple-flat-advanced-design-settings">
<table>
    <tr class="table-headline"><td><br/>Design Settings</td></tr>
    <tr>
        <td>Border Radius</td>
        <?php $mb->the_field('rounded-corners'); ?>
        <td><select class="form-control" name="<?php $metabox->the_name(); ?>">
                <option value="0px" <?php
                if(!is_null($mb->get_the_value()))
                {
                    if($mb->get_the_value() == '0px')
                    {
                        echo 'selected';
                    }
                }
                else {
                    echo 'selected';
                }
                ?> >No Rounded Corners</option>
                <?php
                for($i=1;$i<=20;++$i){
    
                    if($mb->get_the_value() == $i . 'px')
                    {
                        echo '<option value="' . $i . 'px" selected>' . $i . 'px</option>';
                    }
                    else
                        echo '<option value="' . $i . 'px" >' . $i . 'px</option>';
    
                }
                ?>
            </select></td>
    </tr>
    <tr>
        <td>Featured Label Text</td>
        <?php $mb->the_field('most-popular-label-text'); ?>
        <td>
            <?php $value = (!is_null($mb->get_the_value()))?$metabox->get_the_value():'Most Popular'; ?>
            <input type="text" name="<?php $metabox->the_name(); ?>" id="<?php $metabox->the_name(); ?>" value="<?php echo $value;?>" />
        </td>
    </tr>

<tr class="table-headline"><td><br/>Font Sizes</td></tr>
<tr>
    <td>Featured Label Font Size</td>
    <td>
        <?php $mb->the_field('most-popular-font-size'); ?>
        <input class="form-control float-input" type="text" name="<?php $metabox->the_name(); ?>" value="<?php if(!is_null($mb->get_the_value())) echo $metabox->the_value(); else echo "0.9"; ?>"/>
    </td>
    <td>
        <?php $mb->the_field('most-popular-font-size-type'); ?>
        <select  name="<?php $metabox->the_name(); ?>">
            <option value="em" <?php
            if(!is_null($mb->get_the_value()))
            {
                if($mb->get_the_value() == 'em')
                {
                    echo 'selected';
                }
            }
            else {
                echo 'selected';
            }
            ?> >em</option>
            <option value="px" <?php
            if(!is_null($mb->get_the_value()))
            {
                if($mb->get_the_value() == 'px')
                {
                    echo 'selected';
                }
            }
            ?>>px</option>
        </select>
    </td>
</tr>
<tr>
    <td>Plan Name Font Size</td>
    <td>
        <?php $mb->the_field('plan-name-font-size'); ?>
        <input class="form-control float-input" type="text" name="<?php $metabox->the_name(); ?>" value="<?php if(!is_null($mb->get_the_value())) echo $metabox->the_value(); else echo "1"; ?>"/>
    </td>
    <td>
        <?php $mb->the_field('plan-name-font-size-type'); ?>
        <select  name="<?php $metabox->the_name(); ?>">
            <option value="em" <?php
            if(!is_null($mb->get_the_value()))
            {
                if($mb->get_the_value() == 'em')
                {
                    echo 'selected';
                }
            }
            else {
                echo 'selected';
            }
            ?> >em</option>
            <option value="px" <?php
            if(!is_null($mb->get_the_value()))
            {
                if($mb->get_the_value() == 'px')
                {
                    echo 'selected';
                }
            }
            ?>>px</option>
        </select>
    </td>
</tr>
<tr>
    <td>Price Font Size</td>
    <td>
        <?php $mb->the_field('price-font-size'); ?>
        <input class="form-control float-input" type="text" name="<?php $metabox->the_name(); ?>" value="<?php if(!is_null($mb->get_the_value())) echo $metabox->the_value(); else echo "1.25"; ?>"/>
    </td>
    <td>
        <?php $mb->the_field('price-font-size-type'); ?>
        <select  name="<?php $metabox->the_name(); ?>">
            <option value="em" <?php
            if(!is_null($mb->get_the_value()))
            {
                if($mb->get_the_value() == 'em')
                {
                    echo 'selected';
                }
            }
            else {
                echo 'selected';
            }
            ?> >em</option>
            <option value="px" <?php
            if(!is_null($mb->get_the_value()))
            {
                if($mb->get_the_value() == 'px')
                {
                    echo 'selected';
                }
            }
            ?>>px</option>
        </select>
    </td>
</tr>
<tr>
    <td>Bullet Item Font Size</td>
    <td>
        <?php $mb->the_field('bullet-item-font-size'); ?>
        <input class="form-control float-input" type="text" name="<?php $metabox->the_name(); ?>" value="<?php if(!is_null($mb->get_the_value())) echo $metabox->the_value(); else echo "0.875"; ?>"/>
    </td>
    <td>
        <?php $mb->the_field('bullet-item-font-size-type'); ?>
        <select  name="<?php $metabox->the_name(); ?>">
            <option value="em" <?php
            if(!is_null($mb->get_the_value()))
            {
                if($mb->get_the_value() == 'em')
                {
                    echo 'selected';
                }
            }
            else {
                echo 'selected';
            }
            ?> >em</option>
            <option value="px" <?php
            if(!is_null($mb->get_the_value()))
            {
                if($mb->get_the_value() == 'px')
                {
                    echo 'selected';
                }
            }
            ?>>px</option>
        </select>
    </td>
</tr>
<tr>
    <td>Button Font Size</td>
    <td>
        <?php $mb->the_field('button-font-size'); ?>
        <input class="form-control float-input" type="text" name="<?php $metabox->the_name(); ?>" value="<?php if(!is_null($mb->get_the_value())) echo $metabox->the_value(); else echo "1"; ?>"/>
    </td>
    <td>
        <?php $mb->the_field('button-font-size-type'); ?>
        <select  name="<?php $metabox->the_name(); ?>">
            <option value="em" <?php
            if(!is_null($mb->get_the_value()))
            {
                if($mb->get_the_value() == 'em')
                {
                    echo 'selected';
                }
            }
            else {
                echo 'selected';
            }
            ?> >em</option>
            <option value="px" <?php
            if(!is_null($mb->get_the_value()))
            {
                if($mb->get_the_value() == 'px')
                {
                    echo 'selected';
                }
            }
            ?>>px</option>
        </select>
    </td>
</tr>

<!-- Normal Buttons -->
<tr class="table-headline"><td><br/>Button Color</td></tr>
<tr>
    <td>Button Color</td>
    <?php $mb->the_field('button-color'); ?>
    <td><input type="text" name="<?php $mb->the_name(); ?>" class="button-color" value="<?php
        if(!is_null($mb->get_the_value()))
            echo $mb->the_value();
        else
            echo "#3498db";
        ?>
                                    " class="my-color-field form-control" data-default-color="#3498db" /></td>
</tr>

<tr>
    <td>Button Border Color</td>
    <?php $mb->the_field('button-border-color'); ?>
    <td><input type="text" name="<?php $mb->the_name(); ?>" class="button-border-color" value="<?php
        if(!is_null($mb->get_the_value()))
            echo $mb->the_value();
        else
            echo "#2980b9";
        ?>
                                    " class="my-color-field" data-default-color="#2980b9" /></td>
</tr>

<tr>
    <td>Button Hover Color</td>
    <?php $mb->the_field('button-hover-color'); ?>
    <td><input type="text" name="<?php $mb->the_name(); ?>" class="button-border-color" value="<?php
        if(!is_null($mb->get_the_value()))
            echo $mb->the_value();
        else
            echo "#2980b9";
        ?>
                                    " class="my-color-field" data-default-color="#2980b9" /></td>
</tr>

<tr>
    <td>Button Font Color</td>
    <?php $mb->the_field('button-font-color'); ?>
    <td><input type="text" name="<?php $mb->the_name(); ?>" class="colorpicker-no-palettes" value="<?php
        if(!is_null($mb->get_the_value()))
            echo $mb->the_value();
        else
            echo "#ffffff";
        ?>
                                    " class="my-color-field" data-default-color="#ffffff" /></td>
</tr>

<!-- Featured Buttons -->
<tr class="table-headline"><td><br/>Button Color (Featured Column)</td></tr>
<tr>
    <td>Featured-Button Color</td>
    <?php $mb->the_field('featured-button-color'); ?>
    <td><input type="text" name="<?php $mb->the_name(); ?>" class="button-color" value="<?php
        if(!is_null($mb->get_the_value()))
            echo $mb->the_value();
        else
            echo "#e74c3c";
        ?>
                                    " class="my-color-field form-control" data-default-color="#e74c3c" /></td>
</tr>

<tr>
    <td>Featured-Button Border Color</td>
    <?php $mb->the_field('featured-button-border-color'); ?>
    <td><input type="text" name="<?php $mb->the_name(); ?>" class="button-border-color" value="<?php
        if(!is_null($mb->get_the_value()))
            echo $mb->the_value();
        else
            echo "#c0392b";
        ?>
                                    " class="my-color-field" data-default-color="#c0392b" /></td>
</tr>

<tr>
    <td>Featured-Button Hover Color</td>
    <?php $mb->the_field('featured-button-hover-color'); ?>
    <td><input type="text" name="<?php $mb->the_name(); ?>" class="button-border-color" value="<?php
        if(!is_null($mb->get_the_value()))
            echo $mb->the_value();
        else
            echo "#c0392b";
        ?>
                                    " class="my-color-field" data-default-color="#c0392b" /></td>
</tr>

<tr>
    <td>Featured-Button Font Color</td>
    <?php $mb->the_field('featured-button-font-color'); ?>
    <td><input type="text" name="<?php $mb->the_name(); ?>" class="colorpicker-no-palettes" value="<?php
        if(!is_null($mb->get_the_value()))
            echo $mb->the_value();
        else
            echo "#ffffff";
        ?>
                                    " class="my-color-field" data-default-color="#ffffff" /></td>
</tr>
</table>
</div>
