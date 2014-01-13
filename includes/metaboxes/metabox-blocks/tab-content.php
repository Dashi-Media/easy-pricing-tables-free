<div id="dh_ptp_tabs_1" class="dh_ptp_tab">
    <h4>Pricing Table Columns</h4>
    <a href="#" style="float:right;" id="ptp-new-column" class="docopy-column button button-large ptp-icon-plus">New Column</a>
    <div style="clear: both; margin-bottom:10px;"></div>

    <div id="all-columns-wrap">
        <div class="column zero">
            <div class="ptp-title explaination-title">
                <strong>Plan Name</strong><i class="ptp-icon-help-circled" data-trigger="hover" data-html="true" data-placement="right" data-original-title="&lt;strong&gt;Plan Name&lt;/strong&gt;" data-content="
				            Enter your pricing plan - names here.
				            &lt;br/&gt;&lt;br/&gt; 
				            &lt;strong&gt;Best practice:&lt;/strong&gt;
				            &lt;br/&gt;
				            Avoid generic names such as &lt;em&gt;Bronze&lt;/em&gt;, &lt;em&gt;Silver&lt;/em&gt; and &lt;em&gt;Gold&lt;/em&gt;.&lt;br/&gt;
				            Instead, choose aspirational names like &lt;em&gt;Personal&lt;/em&gt;, &lt;em&gt;Small Business&lt;/em&gt; and &lt;em&gt;Enterprise&lt;/em&gt;.&lt;br/&gt;&lt;br/&gt;
				            Many people choose plans based on names, not features: A corporate buyer might choose &lt;em&gt;Enterprise&lt;/em&gt; even though &lt;em&gt;Personal&lt;/em&gt; might be sufficient for his use-case.
				            "></i>
            </div>
            <ul class="ptp-settings explaination-settings">
                <li class="explaination-desc">
                    <strong>Pricing</strong><i class="ptp-icon-help-circled" data-trigger="hover" data-html="true" data-placement="right" data-original-title="&lt;strong&gt;Pricing&lt;/strong&gt;" data-content="
					            Enter your pricing options here.
					            "></i>
                </li>
                <li class="features explaination-desc">
                    <strong>Plan Features</strong><i class="ptp-icon-help-circled" data-trigger="hover" data-html="true" data-placement="right" data-original-title="&lt;strong&gt;Features&lt;/strong&gt;" data-content="
					            Enter your features here (one per line).
					            &lt;br/&gt;&lt;br/&gt; 
					            &lt;strong&gt;Best practice:&lt;/strong&gt;
					            &lt;br/&gt;
					            Don't overwhelm users with too much content. Long pricing tables are confusing and difficult to read.
					            "></i>
                </li>
                <li class="explaination-desc">
                    <strong>Button Text</strong><i class="ptp-icon-help-circled" data-trigger="hover" data-html="true" data-placement="right" data-original-title="&lt;strong&gt;Call To Action Text&lt;/strong&gt;" data-content="
					            Enter your call to action text here.
					            &lt;br/&gt;&lt;br/&gt; 
					            &lt;strong&gt;Best practice:&lt;/strong&gt;
					            &lt;br/&gt;
					            Here are some of the highest converting variations:;&lt;br/&gt; 
					            * Add To Cart&lt;br/&gt; 
					            * Sign Up&lt;br/&gt; 
					            * Sign Up Free&lt;br/&gt; 
					            * Start Free Trial"></i>
                </li>
                <li class="explaination-desc">
                    <strong>Button URL</strong><i class="ptp-icon-help-circled" data-trigger="hover" data-html="true" data-placement="right" data-original-title="&lt;strong&gt;Call To Action URL&lt;/strong&gt;" data-content="
					            Enter your call to action URL here. This is usually either a payment link (e.g. PayPal) or a page where users can create an account.
					            "></i>
                </li>
            </ul>
        </div>

        <?php
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

                    <a onClick="buttonHandler(this)" class="button button-small feature-button <?php if($mb->get_the_value()=="featured"){echo "ptp-icon-star";}else {echo "ptp-icon-star-empty";}?>" data-trigger="hover" data-html="true" data-placement="right" data-original-title="&lt;strong&gt;Feature This Column&lt;/strong&gt;" data-content="Click this button to feature this column. A featured column appears bigger and includes the wording 'Most Popular'. You can only feature one column per table.">Feature</a>
                    <button class="button button-small dodelete ptp-icon-trash" id="delete-button" data-trigger="hover" data-html="true" data-placement="right" data-original-title="&lt;strong&gt;Delete This Column&lt;/strong&gt;" data-content="Click this button to delete this column.">Delete</button>

                    <?php $mb->the_field('planname');?>
                    <input id="plan-name" type="text" name="<?php $mb->the_name(); ?>" placeholder="e.g. Small Business" value="<?php echo $mb->the_value(); ?>" class="form-control">
                </div>

                <ul class="ptp-settings plan-settings">
                    <li>
                        <?php $mb->the_field('planprice'); ?>
                        <input type="text" name="<?php $mb->the_name(); ?>" placeholder="e.g. $49/mo" value="<?php echo $mb->the_value(); ?>" class="form-control">
                    </li>
                    <li class="features">
                        <?php $mb->the_field('planfeatures'); ?>
                        <textarea name="<?php $mb->the_name(); ?>" class="form-control" rows="7" placeholder="e.g. 1 Website                             30,000 Monthly Visits                             Unlimited Data Transfer                             5GB Storage""><?php echo $mb->the_value(); ?></textarea>
                    </li>

                    <li>
                        <?php $mb->the_field('buttontext'); ?>
                        <input type="text" pla name="<?php $mb->the_name(); ?>" placeholder="e.g. Start A Free Trial" value="<?php  $mb->the_value(); ?>" class="form-control">
                    </li>

                    <li>
                        <?php $mb->the_field('buttonurl'); ?>
                        <input type="text" placeholder="e.g. http://example.com/buy" name="<?php $mb->the_name(); ?>" value="<?php echo $mb->the_value();?>" class="form-control">
                    </li>
                </ul>
            </div>
            <?php $mb->the_group_close(); ?>
        <?php endwhile; ?>
		<div style="clear:both;"></div>
    </div>
</div>