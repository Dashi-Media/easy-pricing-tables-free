<?php

function fca_ept_render_layout2( $attributes ){
	
	// enqueue frontend style
	wp_enqueue_style( 'fca-ept-layout2-style' );

	$tableID = empty( $attributes['tableID'] ) ? 0 : empty( $attributes['tableID'] );

	$columnSettings = empty( $attributes['columnSettings'] ) ? false : json_decode( $attributes['columnSettings'], true );

	/* COLORS */
	$layoutBGColor = empty( $attributes['layoutBGColor'] ) ? '#f2f2f2' : ( $attributes['layoutBGColor'] );
	$layoutFontColor = empty( $attributes['layoutFontColor'] ) ? '#000' : ( $attributes['layoutFontColor'] );
	$layoutFontColor1 = empty( $attributes['layoutFontColor1'] ) ? '#6236ff' : ( $attributes['layoutFontColor1'] );
	$buttonColor = empty( $attributes['buttonColor'] ) ? '#6236ff' : ( $attributes['buttonColor'] );
	$buttonFontColor = empty( $attributes['buttonFontColor'] ) ? '#fff' : ( $attributes['buttonFontColor'] );
	$accentColor = empty( $attributes['accentColor'] ) ? '#6236ff' : ( $attributes['accentColor'] );

	/* FONT SIZES */
	$popularFontSize = empty( $attributes['popularFontSize'] ) ? '75%' : ( $attributes['popularFontSize'] );
	$planFontSize = empty( $attributes['planFontSize'] ) ? '300%' : ( $attributes['planFontSize'] );
	$planSubtextFontSize = empty( $attributes['planSubtextFontSize'] ) ? '100%' : ( $attributes['planSubtextFontSize'] );
	$priceFontSize = empty( $attributes['priceFontSize'] ) ? '400%' : ( $attributes['priceFontSize'] );
	$pricePeriodFontSize = empty( $attributes['pricePeriodFontSize'] ) ? '100%' : ( $attributes['pricePeriodFontSize'] );
	$featuresFontSize = empty( $attributes['featuresFontSize'] ) ? '125%' : ( $attributes['featuresFontSize'] );
	$buttonFontSize = empty( $attributes['buttonFontSize'] ) ? '150%' : ( $attributes['buttonFontSize'] );

	/* SETTINGS */
	$fontFamily = empty( $attributes['fontFamily'] ) ? 'sans-serif' : $attributes['fontFamily'];
	$columnHeight = empty( $attributes['columnHeight'] ) ? 'stretch' : ( $attributes['columnHeight'] === 'auto' ? 'stretch' : 'flex-end' );
	$paddingBottom = empty( $attributes['showButtons'] ) ? '30px' : ( $attributes['showButtons'] === 'block' ? '30px' : '0px' );
	$align = empty( $attributes['align'] ) ? 'wide' : ( $attributes['align'] );
	$popularText = empty( $attributes['popularText'] ) ? 'Most Popular' : ( $attributes['popularText'] );
	$showPlanSubtext = empty( $attributes['showPlanSubtext'] ) ? 'block' : $attributes['showPlanSubtext'];
	$showPriceSubtext = empty( $columnSettings ) ? 'block' : ( count($columnSettings) > 1 ? 'block' : 'none' );
	$showButtons = empty( $attributes['showButtons'] ) ? 'block' : ( $attributes['showButtons'] );
	$urlTarget = empty( $attributes['urlTarget'] ) ? '_self' : ( $attributes['urlTarget'] );

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
				
				<div class="fca-ept-plan-div">

					<div style="display: <?php echo $showPopular ?>; border-color:<?php echo $accentColor ?>" class="fca-ept-popular-div">
					
						<span style="font-size:<?php echo $popularFontSize ?>; background-color:<?php echo $accentColor ?>; color:<?php echo $buttonFontColor ?>" class="fca-ept-popular-text"><?php echo $popularText ?></span>
					
					</div>

					<span style="font-size:<?php echo $planFontSize ?>; color:<?php echo $layoutFontColor1 ?>" class="fca-ept-plan"><?php echo $planText1 ?></span>
			
					<span style="display: <?php echo $showPlanSubtext ?>;font-size:<?php echo $planSubtextFontSize ?>; color:<?php echo $layoutFontColor ?>;" class="fca-ept-plan-subtext"><?php echo $planSubText ?></span>
			
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

?>