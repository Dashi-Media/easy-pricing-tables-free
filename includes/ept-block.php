<?php

function fca_ept_register_block() {

	// MAIN
	wp_register_script( 'fca_ept_editor_script', PTP_PLUGIN_URL . '/assets/blocks/editor/fca-ept-editor.min.js', array( 'wp-blocks', 'wp-element', 'fca_ept_layout2_script', 'fca_ept_layout1_script' ), PTP_PLUGIN_VER );
	wp_register_style( 'fca-ept-editor-style', PTP_PLUGIN_URL . '/assets/blocks/editor/fca-ept-editor.min.css', PTP_PLUGIN_VER );
	
	$data = array( 
		'directory' => PTP_PLUGIN_URL
	);
	wp_localize_script( 'fca_ept_editor_script', 'fca_ept_data', $data );

	// LAYOUT2
	wp_register_script( 'fca_ept_layout2_script', PTP_PLUGIN_URL . '/assets/blocks/layout2/fca-ept-layout2.min.js', array( 'wp-blocks', 'wp-element' ), PTP_PLUGIN_VER );
	wp_register_style( 'fca-ept-layout2-style', PTP_PLUGIN_URL . '/assets/blocks/layout2/fca-ept-layout2.min.css', PTP_PLUGIN_VER );

	// LAYOUT1
	wp_register_script( 'fca_ept_layout1_script', PTP_PLUGIN_URL . '/assets/blocks/layout1/fca-ept-layout1.min.js', array( 'wp-blocks', 'wp-element' ), PTP_PLUGIN_VER );
	wp_register_style( 'fca-ept-layout1-style', PTP_PLUGIN_URL . '/assets/blocks/layout1/fca-ept-layout1.min.css', PTP_PLUGIN_VER );

	if ( function_exists( 'register_block_type' ) ) {
		register_block_type( 'fatcatapps/easy-pricing-tables',	array(
			'editor_script' => array( 'fca_ept_editor_script','jquery-ui-dialog' ),
			'editor_style' => 'fca-ept-editor-style',
			'style' => array( 'fca-ept-layout1-style', 'fca-ept-layout2-style' ),
			'render_callback' => 'fca_ept_render',
		));
	}
}

add_action( 'init', 'fca_ept_register_block' );

function fca_ept_get_block_html_ajax( ){

	$attributes = $_POST['attributes'];

	$attributes['columnSettings'] = stripslashes_deep( $attributes['columnSettings'] );

	$html = fca_ept_render( $attributes );

	wp_send_json_success( $html );

}

function fca_ept_render( $attributes ) {
	
	$selectedLayout = empty( $attributes['selectedLayout'] ) ? '' : $attributes['selectedLayout'];

	switch ( $selectedLayout ) {
		
		case 'layout1':
			return fca_ept_render_layout1( $attributes );
		case 'layout2':
			return fca_ept_render_layout2( $attributes );
	}

}

function fca_ept_render_layout1( $attributes ){

	$tableID = empty( $attributes['tableID'] ) ? 0 : empty( $attributes['tableID'] );

	$columnSettings = empty( $attributes['columnSettings'] ) ? false : json_decode( $attributes['columnSettings'], true );

	/* COLORS */
	$layoutBGColor = empty( $attributes['layoutBGColor'] ) ? '#f9f9f9' : ( $attributes['layoutBGColor'] );
	$layoutBGTint2 = empty( $attributes['layoutBGTint2'] ) ? '#eeeeee' : ( $attributes['layoutBGTint2'] );
	$layoutBGTint3 = empty( $attributes['layoutBGTint3'] ) ? '#dddddd' : ( $attributes['layoutBGTint3'] );
	$layoutBGTint4 = empty( $attributes['layoutBGTint4'] ) ? '#7f8c8d' : ( $attributes['layoutBGTint4'] );
	$layoutFontColor = empty( $attributes['layoutFontColor'] ) ? '#333333' : ( $attributes['layoutFontColor'] );
	$buttonFontColor = empty( $attributes['buttonFontColor'] ) ? '#fff' : ( $attributes['buttonFontColor'] );
	$accentColor = empty( $attributes['accentColor'] ) ? '#e74c3c' : ( $attributes['accentColor'] );

	/* FONT SIZES */
	$popularFontSize = empty( $attributes['popularFontSize'] ) ? '125%' : ( $attributes['popularFontSize'] );
	$planFontSize = empty( $attributes['planFontSize'] ) ? '137.5%' : ( $attributes['planFontSize'] );
	$priceFontSize = empty( $attributes['priceFontSize'] ) ? '175%' : ( $attributes['priceFontSize'] );
	$featuresFontSize = empty( $attributes['featuresFontSize'] ) ? '125%' : ( $attributes['featuresFontSize'] );
	$buttonFontSize = empty( $attributes['buttonFontSize'] ) ? '137.5%' : ( $attributes['buttonFontSize'] );

	/* SETTINGS */
	$fontFamily = empty( $attributes['fontFamily'] ) ? 'sans-serif' : $attributes['fontFamily'];
	$columnHeight = empty( $attributes['columnHeight'] ) ? 'stretch' : ( $attributes['columnHeight'] === 'auto' ? 'stretch' : 'flex-end' );
	$align = empty( $attributes['align'] ) ? 'wide' : ( $attributes['align'] );
	$popularText = empty( $attributes['popularText'] ) ? 'Most Popular' : ( $attributes['popularText'] );
	$showButtons = empty( $attributes['showButtons'] ) ? 'block' : ( $attributes['showButtons'] );
	$urlTarget = empty( $attributes['urlTarget'] ) ? 'https://www.fatcatapps.com' : ( $attributes['urlTarget'] );

	ob_start(); 

	?>

	<div style="display: contents; font-family: <?php echo $fontFamily ?>" class='fca-ept-main' id=<?php echo 'fca-ept-table-' . $tableID ?>>

		<div style="align-items: <?php echo $columnHeight ?>" class="wp-block-fatcatapps-pricing-table-blocks align<?php echo $align ?> fca-ept-layout1">

		<?php

		forEach ( $columnSettings as $column ) {

			$columnPopular = empty( $column['columnPopular'] ) ? false : true;

			$popularClass = $columnPopular ? 'fca-ept-most-popular' : '';

			//Integrations
			$planText1 = $column['planText1'];
			$priceText1 = $column['priceText1'];
			$buttonURL1 = $column['buttonURL1'];

			$featuresText = $column['featuresText'] ? $column['featuresText'] : '' ;
			$buttonText = $column['buttonText'] ? $column['buttonText'] : ' ' ;
			$buttonColor = $columnPopular ? $accentColor : ( empty( $attributes['buttonColor'] ) ? '#3498db' : ( $attributes['buttonColor'] ) );
			$buttonBorderColor = empty( $attributes['buttonBorderColor'] ) ? '#2980b9' : $attributes['buttonBorderColor'];
			$buttonBorderColorPop = empty( $attributes['buttonBorderColorPop'] ) ? '#c0392b' : $attributes['buttonBorderColorPop'];

			?>

			<div class="fca-ept-column <?php echo $popularClass ?>" style="background-color: <?php echo $layoutBGColor ?>">

				<div style="font-size: <?php echo $popularFontSize ?>; color: <?php echo $buttonFontColor ?>; background-color: <?php echo $layoutBGTint4 ?>;" class="fca-ept-popular <?php echo $popularClass ?>"><?php echo $popularText ?></div>

				<div class="fca-ept-plan-div" style="background-color: <?php echo $layoutBGTint3 ?>">

					<div style="font-size: <?php echo $planFontSize ?>; color: <?php echo $layoutFontColor ?>; background-color: <?php echo $layoutBGTint3 ?>" class="fca-ept-plan"><?php echo $planText1 ?></div>

				</div>

				<div style="font-size: <?php echo $priceFontSize ?>; color: <?php echo $layoutFontColor ?>; background-color: <?php echo $layoutBGTint2 ?>" class="fca-ept-price"><?php echo $priceText1 ?></div>

				<div style="font-size: <?php echo $featuresFontSize ?>; color: <?php echo $layoutFontColor ?>; background-color: <?php echo $layoutBGColor ?>" class="fca-ept-features-div">

					<ul><?php echo $featuresText ?></ul>
						
				</div>

				<div style="display: <?php echo $showButtons ?>; background-color: <?php echo $layoutBGTint2 ?>" class="fca-ept-button-div">

					<a style="font-size: <?php echo $buttonFontSize ?>; color: <?php echo $buttonFontColor ?>;" href="<?php echo $buttonURL1 ?>" class="fca-ept-button"><?php echo $buttonText ?></a>

				</div>

			</div>

			<style>
				#fca-ept-table-<?php echo $tableID ?> div.fca-ept-layout1 div.fca-ept-column a.fca-ept-button { background-color: <?php echo $buttonColor ?>; border-bottom: 4px solid <?php echo $buttonBorderColor ?>}
				#fca-ept-table-<?php echo $tableID ?> div.fca-ept-layout1 div.fca-ept-column a.fca-ept-button:hover { background-color: <?php echo $buttonBorderColor ?>; }
				#fca-ept-table-<?php echo $tableID ?> div.fca-ept-layout1 div.fca-ept-column.fca-ept-most-popular a.fca-ept-button { background-color: <?php echo $accentColor ?>; border-bottom: 4px solid <?php echo $buttonBorderColorPop ?>}
				#fca-ept-table-<?php echo $tableID ?> div.fca-ept-layout1 div.fca-ept-column.fca-ept-most-popular a.fca-ept-button:hover { background-color: <?php echo $buttonBorderColorPop ?>; }
			</style>

		<?php
		
		}

		?>

		</div>

	</div>

	<?php

	return ob_get_clean();

}


function fca_ept_render_layout2( $attributes ){
	
	$tableID = empty( $attributes['tableID'] ) ? 0 : empty( $attributes['tableID'] );

	$columnSettings = empty( $attributes['columnSettings'] ) ? false : json_decode( $attributes['columnSettings'], true );

	/* COLORS */
	$popularBGColor = empty( $attributes['popularBGColor'] ) ? 'rgba(98,54,255,0.8)' : ( $attributes['popularBGColor'] );
	$layoutBGColor = empty( $attributes['layoutBGColor'] ) ? '#f2f2f2' : ( $attributes['layoutBGColor'] );
	$layoutFontColor = empty( $attributes['layoutFontColor'] ) ? '#000' : ( $attributes['layoutFontColor'] );
	$buttonColor = empty( $attributes['buttonColor'] ) ? '#6236ff' : ( $attributes['buttonColor'] );
	$buttonFontColor = empty( $attributes['buttonFontColor'] ) ? '#fff' : ( $attributes['buttonFontColor'] );
	$accentColor = empty( $attributes['accentColor'] ) ? '#6236ff' : ( $attributes['accentColor'] );

	/* FONT SIZES */
	$popularFontSize = empty( $attributes['popularFontSize'] ) ? '125%' : ( $attributes['popularFontSize'] );
	$planFontSize = empty( $attributes['planFontSize'] ) ? '137.5%' : ( $attributes['planFontSize'] );
	$planSubtextFontSize = empty( $attributes['planSubtextFontSize'] ) ? '100%' : ( $attributes['planSubtextFontSize'] );
	$priceFontSize = empty( $attributes['priceFontSize'] ) ? '175%' : ( $attributes['priceFontSize'] );
	$pricePeriodFontSize = empty( $attributes['pricePeriodFontSize'] ) ? '100%' : ( $attributes['pricePeriodFontSize'] );
	$featuresFontSize = empty( $attributes['featuresFontSize'] ) ? '125%' : ( $attributes['featuresFontSize'] );
	$buttonFontSize = empty( $attributes['buttonFontSize'] ) ? '137.5%' : ( $attributes['buttonFontSize'] );

	/* SETTINGS */
	$fontFamily = empty( $attributes['fontFamily'] ) ? 'sans-serif' : $attributes['fontFamily'];
	$columnHeight = empty( $attributes['columnHeight'] ) ? 'stretch' : ( $attributes['columnHeight'] === 'auto' ? 'stretch' : 'flex-end' );
	$paddingBottom = empty( $attributes['showButtons'] ) ? '30px' : ( $attributes['showButtons'] === 'block' ? '30px' : '0px' );
	$align = empty( $attributes['align'] ) ? 'wide' : ( $attributes['align'] );
	$popularText = empty( $attributes['popularText'] ) ? 'Most Popular' : ( $attributes['popularText'] );
	$showPriceSubtext = empty( $columnSettings ) ? 'block' : ( count($columnSettings) > 1 ? 'block' : 'none' );
	$showButtons = empty( $attributes['showButtons'] ) ? 'block' : ( $attributes['showButtons'] );
	$urlTarget = empty( $attributes['urlTarget'] ) ? 'https://www.fatcatapps.com' : ( $attributes['urlTarget'] );

	ob_start(); 

	?>

	<div style="display: contents; font-family: <?php echo $fontFamily ?>" class='fca-ept-main' id=<?php echo 'fca-ept-table-' . $tableID ?>>

		<div style="text-decoration:none; align-items:<?php echo $columnHeight ?>;" class="wp-block-fatcatapps-pricing-table-blocks align<?php echo $align ?> fca-ept-layout2">
				
		<?php

		forEach ( $columnSettings as $column ) {

			/* Column specific variables */
			$columnPopular = empty( $column['columnPopular'] ) ? false : true;
			$showPopular = $columnPopular ? 'block' : 'none';
			$popularClass = $columnPopular ? 'fca-ept-most-popular' : '';

			$columnPaddingTop = $columnPopular ? '30px' : '45px';
			$marginTop = $columnPopular ? '-5px' : '10px';
			$columnBorder = $columnPopular ? '2px solid ' . $accentColor : '0px solid';

			$planText1 = $column['planText1'];
			$priceText1 = $column['priceText1'];
			$buttonURL1 = $column['buttonURL1'];

			$planSubText = $column['planSubText'] ? $column['planSubText'] : '';
			$pricePeriod1 = $column['pricePeriod1'] ? $column['pricePeriod1'] : '';
			$featuresText = $column['featuresText'] ? $column['featuresText'] : '';
			$buttonText = $column['buttonText'] ? $column['buttonText'] : '';

			?>

			<div style="background-color:<?php echo $layoutBGColor ?>; padding-top:<?php echo $columnPaddingTop ?>; padding-bottom:<?php echo $paddingBottom ?>; margin-top:<?php echo $marginTop?>; border:<?php echo $columnBorder ?>" class="fca-ept-column <?php echo $popularClass ?>">
				
				<div style="display: <?php echo $showPopular ?>; border-color:<?php echo $accentColor ?>" class="fca-ept-popular-div">
				
					<span style="font-size:<?php echo $popularFontSize ?>; background-color:<?php echo $popularBGColor ?>; color:<?php echo $buttonFontColor ?>" class="fca-ept-popular-text"><?php echo $popularText ?></span>
				
				</div>
			
				<div class="fca-ept-plan-div">

					<span style="font-size:<?php echo $planFontSize ?>; color:<?php echo $accentColor ?>" class="fca-ept-plan"><?php echo $planText1 ?></span>
			
					<span style="font-size:<?php echo $planSubtextFontSize ?>; color:<?php echo $layoutFontColor ?>;" class="fca-ept-plan-subtext"><?php echo $planSubText ?></span>
			
				</div>
			
				<div class="fca-ept-price-div">
			
					<div class="fca-ept-price-container">
			
						<span style="font-size: <?php echo $priceFontSize ?>; color:<?php echo $layoutFontColor ?>" class="fca-ept-price"><?php echo $priceText1 ?></span>
			
						<div style="display: <?php echo $showPriceSubtext ?>" class="fca-ept-price-subtext">
			
							<svg class="fca-ept-price-svg" style="background-color:<?php echo $buttonColor ?>"></svg>
			
							<span style="font-size:<?php echo $pricePeriodFontSize ?>; color:<?php echo $layoutFontColor ?>" class="fca-ept-price-period"><?php echo $pricePeriod1 ?></span>
			
						</div>
			
					</div>
			
				</div>
			
				<div class="fca-ept-features-div">
			
					<ul style="font-size:<?php echo $featuresFontSize ?>; color:<?php echo $layoutFontColor ?>" class="fca-ept-features">
			
						<?php echo $featuresText ?>
			
					</ul>
			
				</div>
			
				<a style="display:<?php echo $showButtons ?>; font-size:<?php echo $buttonFontSize ?>; color:<?php echo $buttonFontColor ?>; background-color:<?php echo $buttonColor ?>" href="<?php echo $buttonURL1 ?>" class="fca-ept-button" target="<?php echo $urlTarget ?>" rel="noopener noreferrer"><span class="fca-ept-button-text"><?php echo $buttonText ?> </span></a>
			
			</div>
		
		<?php } ?>

		</div>

	</div>

	<?php

	$result = ob_get_clean();

	return $result;

}

