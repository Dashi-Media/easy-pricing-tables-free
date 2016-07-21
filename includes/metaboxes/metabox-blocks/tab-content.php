<div id="dh_ptp_tabs_1" class="dh_ptp_tab">
    <h4><?php _e('Pricing Table Columns', 'easy-pricing-tables'); ?></h4>
    <a href="#" style="float:right;" id="ptp-new-column" class="docopy-column button button-large ptp-icon-plus"><?php _e('New Column', 'easy-pricing-tables'); ?></a>
    <div style="clear: both; margin-bottom:10px;"></div>

    <div id="all-columns-wrap">
        <div class="column zero">
            <div class="ptp-title explaination-title">
                <strong><?php _e('Name', 'easy-pricing-tables'); ?></strong><i class="ptp-icon-help-circled" data-trigger="hover" data-html="true" data-placement="right" data-original-title="&lt;strong&gt;<?php _e('Product or Plan Name', 'easy-pricing-tables');?>&lt;/strong&gt;" data-content="
				            <?php _e('Enter your product name or plan name here.', 'easy-pricing-tables'); ?>
				            &lt;br/&gt;&lt;br/&gt; 
				            &lt;strong&gt;<?php _e('Best practice:', 'easy-pricing-tables'); ?>&lt;/strong&gt;
				            &lt;br/&gt;
				            <?php echo htmlspecialchars( __('Avoid generic names such as <em>Bronze</em>, <em>Silver</em> and <em>Gold</em>.<br/>', 'easy-pricing-tables')); ?>
				            <?php echo htmlspecialchars( __('Instead, choose aspirational names like <em>Personal</em>, <em>Small Business</em> and <em>Enterprise</em>.<br/><br/>', 'easy-pricing-tables')); ?>
				            <?php echo htmlspecialchars( __('Many people choose plans based on names, not features: A corporate buyer might choose <em>Enterprise</em> even though <em>Personal</em> might be sufficient for his use-case.', 'easy-pricing-tables')); ?>
				            "></i>
            </div>
            <ul class="ptp-settings explaination-settings">
                <li class="explaination-desc">
                    <strong><?php _e('Pricing', 'easy-pricing-tables'); ?></strong><i class="ptp-icon-help-circled" data-trigger="hover" data-html="true" data-placement="right" data-original-title="&lt;strong&gt;<?php _e('Pricing', 'easy-pricing-tables'); ?>&lt;/strong&gt;" data-content="
					            <?php _e('Enter your pricing options here.', 'easy-pricing-tables'); ?>
					            "></i>
                </li>
                <li class="features explaination-desc">
                    <strong><?php _e('Features', 'easy-pricing-tables'); ?></strong><i class="ptp-icon-help-circled" data-trigger="hover" data-html="true" data-placement="right" data-original-title="&lt;strong&gt;<?php _e('Features', 'easy-pricing-tables'); ?>&lt;/strong&gt;" data-content="
					            <?php _e('Enter your features here (one per line).', 'easy-pricing-tables'); ?>
					            &lt;br/&gt;&lt;br/&gt; 
					            &lt;strong&gt;<?php _e('Best practice:', 'easy-pricing-tables'); ?>&lt;/strong&gt;
					            &lt;br/&gt;
					            <?php _e("Don't overwhelm users with too much content. Long pricing tables are confusing and difficult to read.", 'easy-pricing-tables'); ?>
					            "></i>
                </li>
                <li class="explaination-desc">
                    <strong><?php _e('Button Text', 'easy-pricing-tables'); ?></strong><i class="ptp-icon-help-circled" data-trigger="hover" data-html="true" data-placement="right" data-original-title="&lt;strong&gt;<?php _e('Call To Action Text'); ?>&lt;/strong&gt;" data-content="
					            <?php _e('Enter your call to action text here.', 'easy-pricing-tables'); ?>
					            &lt;br/&gt;&lt;br/&gt; 
					            &lt;strong&gt;<?php _e('Best practice:', 'easy-pricing-tables'); ?>&lt;/strong&gt;
					            &lt;br/&gt;
					            <?php _e('Here are some of the highest converting variations:', 'easy-pricing-tables'); ?>;&lt;br/&gt; 
					            * <?php _e('Add To Cart', 'easy-pricing-tables'); ?>&lt;br/&gt; 
					            * <?php _e('Sign Up', 'easy-pricing-tables'); ?>&lt;br/&gt; 
					            * <?php _e('Sign Up Free', 'easy-pricing-tables'); ?>&lt;br/&gt; 
					            * <?php _e('Start Free Trial', 'easy-pricing-tables'); ?>"></i>
                </li>
                <li class="explaination-desc">
                    <strong><?php _e('Button URL', 'easy-pricing-tables'); ?></strong><i class="ptp-icon-help-circled" data-trigger="hover" data-html="true" data-placement="right" data-original-title="&lt;strong&gt;<?php _e('Call To Action URL', 'easy-pricing-tables'); ?>&lt;/strong&gt;" data-content="
					            <?php _e('Enter your call to action URL here. This is usually either a payment link (e.g. PayPal) or a page where users can create an account.', 'easy-pricing-tables'); ?>
					            "></i>
                </li>
            </ul>
        </div>

        <?php
          /*
        * check if this pricing table is already exist will return number of column as user did setting
        * otherwise if not exist yet, will initialize 2 columns  
        */ 
//        $checkIsExistMeta = get_post_meta(get_the_ID(), $id, TRUE);
        if ($meta) {
                         $options = array();
               
        } else {
            $options = array('length' => 2);
        }
        /**
         * the loop used to display our tables
         */
        while($mb->have_fields_and_multi('column',array('length' => 2))):
            ?>
            <?php $mb->the_group_open(); ?>
            <div class="column">

                <div class="ptp-title plan-title">

                    <?php $mb->the_field('feature');?>
                    <input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php if(!is_null($metabox->get_the_value())){$mb->the_value();} elseif(!$mb->is_last()){ echo "unfeatured"; }?>" class="form-control" />

                    <a onClick="buttonHandler(this)" class="button button-small feature-button <?php if($mb->get_the_value()=="featured"){echo "ptp-icon-star";}else {echo "ptp-icon-star-empty";}?>" data-trigger="hover" data-html="true" data-placement="right" data-original-title="&lt;strong&gt;<?php _e('Feature This Column', 'easy-pricing-tables'); ?>&lt;/strong&gt;" data-content="<?php _e("Click this button to feature this column. A featured column appears bigger and includes the wording 'Most Popular'. You can only feature one column per table.", 'easy-pricing-tables'); ?>"><?php _e('Feature', 'easy-pricing-tables'); ?></a>
                    <button class="button button-small dodelete ptp-icon-trash" id="delete-button" data-trigger="hover" data-html="true" data-placement="right" data-original-title="&lt;strong&gt;<?php _e('Delete This Column', 'easy-pricing-tables'); ?>&lt;/strong&gt;" data-content="<?php _e('Click this button to delete this column.', 'easy-pricing-tables'); ?>"><?php _e('Delete', 'easy-pricing-tables'); ?></button>

                    <?php $mb->the_field('planname');?>
                    <input id="plan-name" type="text" name="<?php $mb->the_name(); ?>" placeholder="<?php _e('e.g. Small Business', 'easy-pricing-tables'); ?>" value="<?php echo $mb->the_value(); ?>" class="form-control">
                </div>

                <ul class="ptp-settings plan-settings">
                    <li>
                        <?php $mb->the_field('planprice'); ?>
                        <input type="text" name="<?php $mb->the_name(); ?>" placeholder="<?php _e('e.g. $49/mo', 'easy-pricing-tables'); ?>" value="<?php echo $mb->the_value(); ?>" class="form-control">
                    </li>
                    <li class="features">
                        <?php $mb->the_field('planfeatures'); ?>
						<?php
							$placeholder = array(
								str_pad(__('e.g. 1 Website', 'easy-pricing-tables'), 40),
								str_pad(__('30,000 Monthly Visits', 'easy-pricing-tables'), 40),
								str_pad(__('Unlimited Data Transfer', 'easy-pricing-tables'), 40),
								str_pad(__('5GB Storage', 'easy-pricing-tables'), 40),
							);
						?>
                        <textarea name="<?php $mb->the_name(); ?>" class="form-control" rows="7" placeholder="<?php echo implode('', $placeholder); ?>"><?php echo $mb->the_value(); ?></textarea>
                    </li>

                    <li>
                        <?php $mb->the_field('buttontext'); ?>
                        <input type="text" pla name="<?php $mb->the_name(); ?>" placeholder="<?php _e('e.g. Add to Cart', 'easy-pricing-tables'); ?>" value="<?php  $mb->the_value(); ?>" class="form-control">
                    </li>

                    <li>
                        <?php $mb->the_field('buttonurl'); ?>
                        <input type="text" placeholder="<?php _e('e.g. http://example.com/buy', 'easy-pricing-tables'); ?>" name="<?php $mb->the_name(); ?>" value="<?php echo $mb->the_value();?>" class="form-control">
                    </li>
                </ul>
            </div>
            <?php $mb->the_group_close(); ?>
        <?php endwhile; ?>
		<div style="clear:both;"></div>
    </div>
</div>