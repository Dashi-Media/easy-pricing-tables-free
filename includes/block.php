<?php
/*
GUTENBERG BLOCK INTEGRATION
*/

/**************/
/* EPT LEGACY */
/**************/
function dh_ptp_gutenblock() {

	wp_register_script(
		'dh_ptp_gutenblock_script',
		PTP_PLUGIN_URL . '/includes/block.js',
		array( 'wp-blocks', 'wp-element', 'wp-editor' )
	);
	wp_register_style( 'dh-ptp-block-css', PTP_PLUGIN_URL . '/assets/ui/block.css' );
	wp_register_style( 'dh-ptp-design1', PTP_PLUGIN_URL . '/assets/pricing-tables/design1/pricingtable.min.css' );
		
	if ( function_exists( 'register_block_type' ) ) {
		register_block_type( 'easy-pricing-tables/gutenblock',
			array(
				'editor_script' => 'dh_ptp_gutenblock_script',
				'editor_style' => array( 'dh-ptp-block-css', 'dh-ptp-design1' ),
				'render_callback' => 'dh_ptp_gutenblock_render',
				'attributes' => array( 
					'post_id' => array( 
						'type' => 'string',
						'default' => '0'				
					),
				)
			)
		);
	}
}

add_action( 'init', 'dh_ptp_gutenblock' );

function dh_ptp_gutenblock_enqueue() {

	$posts = get_posts( array(
		'post_type' => 'easy-pricing-table',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'fields' => 'ids'
	));
	
	$table_list = array( 
		array(
			'value' => 0,
			'label' => 'Select a pricing table',
		) 
	);
	
	forEach ( $posts as $p ) {
		$title =  get_the_title( $p );
		if ( empty( $title ) ) {
			$title = __("(no title)", 'easy-pricing-tables' );
		}

		$table_list[] = array(
			'value' => $p,
			'label' => html_entity_decode( $title ),
		);
		
	}

	$existing_install = dh_ptp_check_existing_install();
	
	wp_localize_script( 'dh_ptp_gutenblock_script', 'dh_ptp_gutenblock_script_data', array( 'existing' => $existing_install, 'tables' => $table_list, 'editurl' => admin_url( 'post.php' ), 'newurl' => admin_url( 'post-new.php' )  ) );
	
}
add_action( 'enqueue_block_editor_assets', 'dh_ptp_gutenblock_enqueue' );


function dh_ptp_gutenblock_render( $attributes ) {

	$id = empty( $attributes['post_id'] ) ? 0 : $attributes['post_id'];
	if ( $id ) {		
		return do_shortcode( "[easy-pricing-table id='$id']" );
		//return ;
	}
	return '<p>' . __( 'Click here and select a pricing table from the menu above.', 'easy-pricing-tables' ) . '</p>';
	
}


/*********************/
/* EPT FOR GUTENBERG */
/*********************/

function fca_ept_block() {
	wp_register_script(
		'fca_ept_main_script',
		PTP_PLUGIN_URL . '/includes/blocks/fca-ept-main.js',
		array( 'wp-blocks', 'wp-element' ), PTP_PLUGIN_VER
	);
	wp_register_script(
		'fca_ept_layout2_script',
		PTP_PLUGIN_URL . '/includes/blocks/fca-ept-layout2.js',
		array( 'wp-blocks', 'wp-element' ), PTP_PLUGIN_VER
	);
	wp_register_style( 'fca-ept-layout2-editor-style', PTP_PLUGIN_URL . '/assets/blocks/layout2/fca-ept-layout2-editor.css', PTP_PLUGIN_VER );
	wp_register_style( 'fca-ept-layout2-style', PTP_PLUGIN_URL . '/assets/blocks/layout2/fca-ept-layout2.css', PTP_PLUGIN_VER );

	wp_register_script(
		'fca_ptp_layout1_script',
		PTP_PLUGIN_URL . '/includes/blocks/fca-ptp-layout1.js',
		array( 'wp-blocks', 'wp-element' ), PTP_PLUGIN_VER
	);
	wp_register_style( 'fca-ptp-layout1-editor-style', PTP_PLUGIN_URL . '/assets/blocks/layout1/fca-ptp-layout1-editor.min.css', PTP_PLUGIN_VER );
	wp_register_style( 'fca-ptp-layout1-style', PTP_PLUGIN_URL . '/assets/blocks/layout1/fca-ptp-layout1.min.css', PTP_PLUGIN_VER );

	wp_register_style( 'fca-ept-main-style', PTP_PLUGIN_URL . '/assets/blocks/fca-ept-main.css', PTP_PLUGIN_VER );
		
	if ( function_exists( 'register_block_type' ) ) {
		register_block_type( 'fatcatapps/easy-pricing-tables',
			array(
				'editor_script' => array( 'fca_ept_layout2_script', 'fca_ptp_layout1_script', 'fca_ept_main_script' ),
				'editor_style' => array( 'fca-ept-main-style', 'fca-ptp-layout1-editor-style', 'fca-ptp-layout1-style', 'fca-ept-layout2-editor-style', 'fca-ept-layout2-style' ),
				'style' => array( 'fca-ptp-layout1-style', 'fca-ept-layout2-style' ),
				'render_callback' => 'fca_ept_render',
				'attributes' => array( 
					'align' => array(
						'type' => 'string',
						'default' => 'wide',
					),
					'selectedLayout' => array(
						'type' => 'string',
						'default' => 'layout2',
					),
				// COLORS
					'ptp_buttonColor' => array(
						'type' => 'string',
						'default' => '#3498db',
					),
					'ptp_buttonFontColor' => array(
						'type' => 'string',
						'default' => '#fff',
					),
					'ptp_buttonBorderColor' => array(
						'type' => 'string',
						'default' => '#2980b9',
					),
					'ptp_buttonHoverColor' => array(
						'type' => 'string',
						'default' => '#2980b9',
					),

				// POPULAR COLORS
					'ptp_buttonColorPop' => array(
						'type' => 'string',
						'default' => '#e74c3c',
					),
					'ptp_buttonFontColorPop' => array(
						'type' => 'string',
						'default' => '#fff',
					),
					'ptp_buttonBorderColorPop' => array(
						'type' => 'string',
						'default' => '#c0392b',
					),
					'ptp_buttonHoverColorPop' => array(
						'type' => 'string',
						'default' => '#c0392b',
					),

				// DYNAMIC COLUMN SETTINGS
					'ptp_columnSettings' => array(
						'type' => 'array',
						'default' => [],
					),
					'ptp_columnPopular' => array(
						'type' => 'string',
						'default' => false,
					),
				// FONT SETTINGS
					'ptp_popularFontSize' => array(
						'type' => 'string',
						'default' => '20px',
					),
					'ptp_planFontSize' => array(
						'type' => 'string',
						'default' => '22px',
					),
					'ptp_priceFontSize' => array(
						'type' => 'string',
						'default' => '28px',
					),
					'ptp_featuresFontSize' => array(
						'type' => 'string',
						'default' => '20px',
					),
					'ptp_buttonFontSize' => array(
						'type' => 'string',
						'default' => '22px',
					),
				// EXTRA SETTINGS
					'ptp_columnHeight' => array(
						'type' => 'string',
						'default' => 'auto',
					),
					'ptp_popularText' => array(
						'type' => 'string',
						'default' => 'Most Popular',
					),
					'ptp_showButtons' => array(
						'type' => 'string',
						'default' => 'grid',
					),
					'ptp_buttonURL' => array(
						'type' => 'string',
						'default' => 'https://www.fatcatapps.com',
					),
					'ptp_urlTarget' => array(
						'type' => 'string',
						'default' => '_self',
					),
					'ptp_borderRadius' => array(
						'type' => 'string',
						'default' => '4',
					),
// EPT3
				// COLORS
					'ept_layoutBGColor' => array(
						'type' => 'string',
						'default' => '#f2f2f2',
					),
					'ept_layoutFontColor' => array(
						'type' => 'string',
						'default' => '#000',
					),
					'ept_popularBGColor' => array(
						'type' => 'string',
						'default' => 'rgba(98,54,255,0.8)',
					),
					'ept_buttonColor' => array(
						'type' => 'string',
						'default' => '#6236ff',
					),
					'ept_buttonFontColor' => array(
						'type' => 'string',
						'default' => '#fff',
					),
					'ept_accentColor' => array(
						'type' => 'string',
						'default' => '#6236ff',
					),
				// DYNAMIC COLUMN SETTINGS
					'ept_columnSettings' => array(
						'type' => 'array',
						'default' => [],
					),
				// FONT SETTINGS
					'ept_popularFontSize' => array(
						'type' => 'string',
						'default' => '12px',
					),
					'ept_planFontSize' => array(
						'type' => 'string',
						'default' => '48px',
					),
					'ept_planSubtextFontSize' => array(
						'type' => 'string',
						'default' => '16px',
					),
					'ept_priceFontSize' => array(
						'type' => 'string',
						'default' => '64px',
					),
					'ept_pricePeriodFontSize' => array(
						'type' => 'string',
						'default' => '16px',
					),
					'ept_priceBillingFontSize' => array(
						'type' => 'string',
						'default' => '13px',
					),
					'ept_featuresFontSize' => array(
						'type' => 'string',
						'default' => '20px',
					),
					'ept_buttonFontSize' => array(
						'type' => 'string',
						'default' => '24px',
					),
				// EXTRA SETTINGS
					'ept_columnHeight' => array(
						'type' => 'string',
						'default' => 'auto',
					),
					'ept_showPlanSubtext' => array(
						'type' => 'string',
						'default' => 'block',
					),
					'ept_columnHeightToggle' => array(
						'type' => 'boolean',
						'default' => true,
					),
					'ept_popularText' => array(
						'type' => 'string',
						'default' => 'Most Popular',
					),
					'ept_showButtons' => array(
						'type' => 'string',
						'default' => 'grid',
					),
					'ept_urlTarget' => array(
						'type' => 'string',
						'default' => '_self',
					),

				)
			)
		);
	}
}

add_action( 'init', 'fca_ept_block' );

function fca_ept_render( $attributes ) {

	$selectedLayout = $attributes['selectedLayout'];

	switch ( $selectedLayout ) {
		
		case 'layout1':

			if ( $attributes['ptp_columnSettings'] ){ 
				$columnSettings = $attributes['ptp_columnSettings'];
			} else {
				$columnSettings = array(
					array(
						"columnPopular" => false,
						"planText" => "Starter",
						"priceText" => "$29",
						"featuresText" => "<li>Feature 1</li><li>Feature 2</li><li>Feature 3</li><li>Feature 4</li>",
						"buttonText" => "Add to Cart",
						"buttonURL" => "https://www.fatcatapps.com"
					),
					array(
						"columnPopular" => false,
						"planText" => "Pro",
						"priceText" => "$39",
						"featuresText" => "<li>Feature 1</li><li>Feature 2</li><li>Feature 3</li><li>Feature 4</li>",
						"buttonText" => "Add to Cart",
						"buttonURL" => "https://www.fatcatapps.com"
					),
					array(
						"columnPopular" => false,
						"planText" => "Elite",
						"priceText" => "$49",
						"featuresText" => "<li>Feature 1</li><li>Feature 2</li><li>Feature 3</li><li>Feature 4</li>",
						"buttonText" => "Add to Cart",
						"buttonURL" => "https://www.fatcatapps.com"
					)
				);
			}

			/* SETTINGS */
			$columnHeight = $attributes['ptp_columnHeight'] === 'auto' ? 'stretch' : 'flex-end';
			$borderRadius = $attributes['ptp_borderRadius'] . 'px';
			$align = $attributes['align'];
		// POPULAR
			$popularFontSize = $attributes['ptp_popularFontSize'];
			$popularText = $attributes['ptp_popularText'];
		// PLAN
			$planFontSize = $attributes['ptp_planFontSize'];
		// PRICE
			$priceFontSize = $attributes['ptp_priceFontSize'];
		// FEATURES
			$featuresFontSize = $attributes['ptp_featuresFontSize'];
		// BUTTON
			$showButtons = $attributes['ptp_showButtons'];
			$buttonFontSize = $attributes['ptp_buttonFontSize'];
			$urlTarget = $attributes['ptp_urlTarget'];

			ob_start(); 

			?>

			<div style="align-items: <?php echo $columnHeight ?>" class="wp-block-fatcatapps-pricing-table-blocks align<?php echo $align ?> fca-ptp-<?php echo $selectedLayout ?>">

			<?php

			forEach ($columnSettings as $column) {

				$columnPopular = $column['columnPopular'];
				$showPopular = $columnPopular ? 'fca-ptp-most-popular' : '';

				$planText = $column['planText'] ? $column['planText'] : ' ' ;
				$priceText = $column['priceText'] ? $column['priceText'] : ' ' ;
				$featuresText = $column['featuresText'] ? $column['featuresText'] : '' ;
				$buttonText = $column['buttonText'] ? $column['buttonText'] : ' ' ;
				$buttonURL = $column['buttonURL'] ? $column['buttonURL'] : '' ;
				$buttonColor = $columnPopular ? $attributes['ptp_buttonColorPop'] : $attributes['ptp_buttonColor'];
				$buttonFontColor = $columnPopular ? $attributes['ptp_buttonFontColorPop'] : $attributes['ptp_buttonFontColor'];
				$buttonHoverColor = $attributes['ptp_buttonHoverColor'];
				$buttonHoverColorPop = $attributes['ptp_buttonHoverColorPop'];
				$buttonBorderColor = $columnPopular ? $attributes['ptp_buttonBorderColorPop'] : $attributes['ptp_buttonBorderColor'];

				?>

				<style>
					.fca-ptp-column a.fca-ptp-button:hover{ background-color: <?php echo $buttonHoverColor ?> !important; } 
					.fca-ptp-column.fca-ptp-most-popular a.fca-ptp-button:hover{ background-color: <?php echo $buttonHoverColorPop ?> !important; } 
				</style>

				<div style="border-radius: <?php echo $borderRadius ?>" class="fca-ptp-column <?php echo $showPopular ?>">

					<div style="font-size: <?php echo $popularFontSize ?>; border-radius: <?php echo $borderRadius ?>" class="fca-ptp-popular <?php echo $showPopular ?>"><?php echo $popularText ?></div>

					<div style="border-top-left-radius: <?php echo $borderRadius ?>; border-top-right-radius: <?php echo $borderRadius ?>; font-size: <?php echo $planFontSize ?>" class="fca-ptp-plan"><?php echo $planText ?></div>

					<div style="font-size: <?php echo $priceFontSize ?>" class="fca-ptp-price"><?php echo $priceText ?></div>

					<div style="font-size: <?php echo $featuresFontSize ?>" class="fca-ptp-bullet-item">

						<ul><?php echo $featuresText ?></ul>
							
					</div>

					<div style="border-bottom-left-radius: <?php echo $borderRadius ?>; border-bottom-right-radius: <?php echo $borderRadius ?>" class="fca-ptp-cta">

						<a style="font-size: <?php echo $buttonFontSize ?>; color: <?php echo $buttonFontColor ?>; background-color: <?php echo $buttonColor ?>; border-radius: <?php echo $borderRadius ?>; border-bottom: <?php echo $buttonBorderColor ?> 4px solid" class="fca-ptp-button" href=<?php echo $buttonURL ?>><?php echo $buttonText ?></a>

					</div>

				</div>

			<?php
			
			}

			?>

			</div>

			<?php

			return ob_get_clean();

		case 'layout2':

			if ( $attributes['ept_columnSettings'] ){ 
				$columnSettings = $attributes['ept_columnSettings'];
			} else {
				$columnSettings = array(
					array(
						"columnPopular" => false,
						"planText" => "Starter",
						"planSubText" => "For getting started",
						"priceText" => "$29",
						"pricePeriod" => "per month",
						"featuresText" => "<li>Feature 1</li><li>Feature 2</li><li>Feature 3</li><li>Feature 4</li>",
						"buttonText" => "Add to Cart",
						"buttonURL" => "https://www.fatcatapps.com"
					),
					array(
						"columnPopular" => false,
						"planText" => "Pro",
						"planSubText" => "Best for most users",
						"priceText" => "$39",
						"pricePeriod" => "per month",
						"featuresText" => "<li>Feature 1</li><li>Feature 2</li><li>Feature 3</li><li>Feature 4</li>",
						"buttonText" => "Add to Cart",
						"buttonURL" => "https://www.fatcatapps.com"
					),
					array(
						"columnPopular" => false,
						"planText" => "Elite",
						"planSubText" => "For enterprises",
						"priceText" => "$49",
						"pricePeriod" => "per month",
						"featuresText" => "<li>Feature 1</li><li>Feature 2</li><li>Feature 3</li><li>Feature 4</li>",
						"buttonText" => "Add to Cart",
						"buttonURL" => "https://www.fatcatapps.com"
					)
				);
			}

			/* SETTINGS */
			$columnHeight = $attributes['ept_columnHeight'] === 'auto' ? 'stretch' : 'flex-end';
			$selectedLayout = $attributes['selectedLayout'];
			$paddingBottom = $attributes['ept_showButtons'] === 'grid' ? '30px' : '0px';
			$accentColor = $attributes['ept_accentColor'];
			$layoutFontColor = $attributes['ept_layoutFontColor'];
			$layoutBGColor = $attributes['ept_layoutBGColor'];
			$align = $attributes['align'];
		// POPULAR
			$popularFontSize = $attributes['ept_popularFontSize'];
			$popularText = $attributes['ept_popularText'];
			$popularBGColor = $attributes['ept_popularBGColor'];
		// PLAN
			$planFontSize = $attributes['ept_planFontSize'];
			$showPlanSubtext = $attributes['ept_showPlanSubtext'];
			$planSubtextFontSize = $attributes['ept_planSubtextFontSize'];
		// PRICE
			$priceFontSize = $attributes['ept_priceFontSize'];
			$pricePeriodFontSize = $attributes['ept_pricePeriodFontSize'];
			$priceBillingFontSize = $attributes['ept_priceBillingFontSize'];
		// FEATURES
			$featuresFontSize = $attributes['ept_featuresFontSize'];
		// BUTTON
			$showButtons = $attributes['ept_showButtons'];
			$buttonFontSize = $attributes['ept_buttonFontSize'];
			$buttonFontColor = $attributes['ept_buttonFontColor'];
			$buttonColor = $attributes['ept_buttonColor'];
			$urlTarget = $attributes['ept_urlTarget'];

			ob_start(); ?>
			
			<div style="text-decoration:none; align-items:<?php echo $columnHeight ?>;" class="wp-block-fatcatapps-pricing-table-blocks align<?php echo $align ?> fca-ept-<?php echo $selectedLayout ?>">
					
			<?php

			forEach ($columnSettings as $column) {

				/* Column specific variables */
				$columnPopular = $column['columnPopular'];
				$showPopular = $columnPopular ? 'block' : 'none';

				$paddingTop = $columnPopular ? '30px' : '45px';
				$marginTop = $columnPopular ? '-5px' : '10px';
				$columnBorder = $columnPopular ? '2px solid ' . $buttonColor : '0px solid';

				$planText = $column['planText'] ? $column['planText'] : '';
				$planSubText = $column['planSubText'] ? $column['planSubText'] : '';
				$priceText = $column['priceText'] ? $column['priceText'] : '';
				$pricePeriod = $column['pricePeriod'] ? $column['pricePeriod'] : '';
				$featuresText = $column['featuresText'] ? $column['featuresText'] : '';
				$buttonText = $column['buttonText'] ? $column['buttonText'] : '';
				$buttonURL = $column['buttonURL'] ? $column['buttonURL'] : '';

				?>

				<div style="background-color:<?php echo $layoutBGColor ?>; padding-top:<?php echo $paddingTop ?>; padding-bottom:<?php echo $paddingBottom ?>; margin-top:<?php echo $marginTop?>; border:<?php echo $columnBorder ?>" class="fca-ept-column">
					
					<div style="box-shadow:0px; display: <?php echo $showPopular ?>; border-color:<?php echo $buttonColor ?>" class="fca-ept-popular-div">
					
						<span style="font-size:<?php echo $popularFontSize ?>; background-color:<?php echo $popularBGColor ?>; color:<?php echo $buttonFontColor ?>" class="fca-ept-popular-text"><?php echo $popularText ?></span>
					
					</div>
				
					<div class="fca-ept-plan-div">
				
						<span style="font-size:<?php echo $planFontSize ?>; color:<?php echo $accentColor ?>" class="fca-ept-plan"><?php echo $planText ?></span>
				
						<span style="display:<?php echo $showPlanSubtext ?>; color:<?php echo $layoutFontColor ?>; font-size:<?php echo $planSubtextFontSize ?>" class="fca-ept-plan-subtext"><?php echo $planSubText ?></span>
				
					</div>
				
					<div class="fca-ept-price-div">
				
						<div class="fca-ept-price-container">
				
							<span style="font-size: <?php echo $priceFontSize ?>; color:<?php echo $layoutFontColor ?>" class="fca-ept-price"><?php echo $priceText ?></span>
				
							<div class="fca-ept-price-subtext">
				
								<svg class="fca-ept-price-svg" style="background-color:<?php echo $buttonColor ?>"></svg>
				
								<span style="font-size:<?php echo $pricePeriodFontSize ?>; color:<?php echo $layoutFontColor ?>" class="fca-ept-price-period"><?php echo $pricePeriod ?></span>
				
							</div>
				
						</div>
				
					</div>
				
					<div class="fca-ept-features-div">
				
						<ul style="font-size:<?php echo $featuresFontSize ?>; color:<?php echo $layoutFontColor ?>" class="fca-ept-features">
				
							<?php echo $featuresText ?>
				
						</ul>
				
					</div>
				
					<a style="display:<?php echo $showButtons ?>; font-size:<?php echo $buttonFontSize ?>; color:<?php echo $buttonFontColor ?>; background-color:<?php echo $buttonColor ?>" class="fca-ept-button" type="button" href="<?php echo $buttonURL ?>" target="<?php echo $urlTarget ?>" rel="noopener noreferrer"><span class="fca-ept-button-text"><?php echo $buttonText ?> </span></a>
				
				</div>
			
			<?php } ?>

			</div>

			<?php

			return ob_get_clean();

	}

}





