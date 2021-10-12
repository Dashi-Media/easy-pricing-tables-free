<?php

function fca_ept_render_layout1( $attributes ){

	// enqueue frontend style
	wp_enqueue_style( 'fca-ept-layout1-style' );

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
	$urlTarget = empty( $attributes['urlTarget'] ) ? '_self' : ( $attributes['urlTarget'] );

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

					<span style="font-size: <?php echo $planFontSize ?>; color: <?php echo $layoutFontColor ?>; background-color: <?php echo $layoutBGTint3 ?>" class="fca-ept-plan"><?php echo $planText1 ?></span>

				</div>

				<div style="background-color: <?php echo $layoutBGTint2 ?>;" class="fca-ept-price-div">

					<span style="font-size: <?php echo $priceFontSize ?>; color: <?php echo $layoutFontColor ?>;" class="fca-ept-price"><?php echo $priceText1 ?></span>

				</div>
				
				<div style="font-size: <?php echo $featuresFontSize ?>; color: <?php echo $layoutFontColor ?>; background-color: <?php echo $layoutBGColor ?>" class="fca-ept-features-div">

					<ul class="fca-ept-features"><?php echo $featuresText ?></ul>
						
				</div>

				<div style="display: <?php echo $showButtons ?>; background-color: <?php echo $layoutBGTint2 ?>" class="fca-ept-button-div">

					<a style="font-size: <?php echo $buttonFontSize ?>; color: <?php echo $buttonFontColor ?>;" href="<?php echo $buttonURL1 ?>" class="fca-ept-button" target="<?php echo $urlTarget ?>" rel="noopener noreferrer"><?php echo $buttonText ?></a>

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

?>