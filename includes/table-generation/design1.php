<?php

function dh_ptp_simple_flat_css($id, $meta)
{ 
	// Design Settings
	$design1_rounded_corner_width = isset($meta['rounded-corners'])?$meta['rounded-corners']:'0px';
		
	// Font Sizes
	$design1_most_popular_font_size = isset($meta['most-popular-font-size'])?$meta['most-popular-font-size']:0.9;
	$design1_most_popular_font_size_type = isset($meta['most-popular-font-size-type'])?$meta['most-popular-font-size-type']:"em";
	$design1_plan_name_font_size = isset($meta['plan-name-font-size'])?$meta['plan-name-font-size']:1;
	$design1_plan_name_font_size_type = isset($meta['plan-name-font-size-type'])?$meta['plan-name-font-size-type']:"em";
	$design1_price_font_size = isset($meta['price-font-size'])?$meta['price-font-size']:1.25;
	$design1_price_font_size_type = isset($meta['price-font-size-type'])?$meta['price-font-size-type']:"em";
	$design1_bullet_item_font_size = isset($meta['bullet-item-font-size'])?$meta['bullet-item-font-size']:0.875;
	$design1_bullet_item_font_size_type = isset($meta['bullet-item-font-size-type'])?$meta['bullet-item-font-size-type']:"em";
	$design1_button_font_size = isset($meta['button-font-size'])?$meta['button-font-size']:1;
	$design1_button_font_size_type = isset($meta['button-font-size-type'])?$meta['button-font-size-type']:"em";
	
	// Button Color
	$design1_button_color = isset($meta['button-color'])?$meta['button-color']:'#e74c3c';
	$design1_button_border_color = isset($meta['button-border-color'])?$meta['button-border-color']:'#c0392b';
	$design1_button_hover_color = isset($meta['button-hover-color'])?$meta['button-hover-color']:'#c0392b';
	$design1_button_font_color = isset($meta['button-font-color'])?$meta['button-font-color']:'#ffffff';
	
	// Button Color (Featured Column)
	$design1_featured_button_color = isset($meta['featured-button-color'])?$meta['featured-button-color']:'#3498db';
	$design1_featured_button_border_color = isset($meta['featured-button-border-color'])?$meta['featured-button-border-color']:'#2980b9';
	$design1_featured_button_hover_color = isset($meta['featured-button-hover-color'])?$meta['featured-button-hover-color']:'#2980b9';
	$design1_featured_button_font_color = isset($meta['featured-button-font-color'])?$meta['featured-button-font-color']:'#ffffff';
	
	?>

	#ptp-<?php echo $id ?> div.ptp-item-container {
		border-radius: <?php echo esc_attr( $design1_rounded_corner_width ); ?>;
		padding: 0px;
		margin-left: 0px;
		margin-right: 0px;
	}
	#ptp-<?php echo $id ?> div.ptp-item-container div {
		margin: 0px; 
	}
	#ptp-<?php echo $id ?> div.ptp-plan{
		border-top-right-radius: <?php echo esc_attr( $design1_rounded_corner_width ); ?>;
		border-top-left-radius: <?php echo esc_attr( $design1_rounded_corner_width ); ?>;
		font-size: <?php echo esc_attr( $design1_plan_name_font_size ) . esc_attr( $design1_plan_name_font_size_type ); ?>;
		padding: 0.9375em 1.25em;
	}
	#ptp-<?php echo $id ?> div.ptp-price{
		font-size: <?php echo esc_attr( $design1_price_font_size ) . esc_attr( $design1_price_font_size_type ); ?>;
		padding: 0.9375em 1.25em;
	}
	#ptp-<?php echo $id ?> div.ptp-cta{
		border-bottom-right-radius: <?php echo esc_attr( $design1_rounded_corner_width ); ?>;
		border-bottom-left-radius: <?php echo esc_attr( $design1_rounded_corner_width ); ?>;
		padding-top: 1.25em;
		padding-bottom: 1.25em;
	}
	#ptp-<?php echo $id ?> a.ptp-button{
		border-radius: <?php echo esc_attr( $design1_rounded_corner_width ); ?>;
		font-size: <?php echo esc_attr( $design1_button_font_size ) . esc_attr( $design1_button_font_size_type ); ?>;
		color: <?php echo esc_attr( $design1_button_font_color ); ?>;
		background-color: <?php echo esc_attr( $design1_button_color ); ?>;
		border-bottom: <?php echo esc_attr( $design1_button_border_color );?> 4px solid;
		margin: 0px;
	}
	#ptp-<?php echo $id ?> a.ptp-button:hover{
		background-color: <?php echo esc_attr( $design1_button_hover_color ); ?>
	}

	div#ptp-<?php echo $id ?> .ptp-highlight a.ptp-button{
		color: <?php echo esc_attr( $design1_featured_button_font_color ); ?>;
		background-color: <?php echo esc_attr( $design1_featured_button_color ); ?>;
		border-bottom: <?php echo esc_attr( $design1_featured_button_border_color );?> 4px solid;
	}
	div#ptp-<?php echo $id ?> .ptp-highlight a.ptp-button:hover{
		background-color: <?php echo esc_attr( $design1_featured_button_hover_color ); ?>;
	}
	#ptp-<?php echo $id ?> div.ptp-bullet-item{
		font-size: <?php echo esc_attr( $design1_bullet_item_font_size ) . esc_attr( $design1_bullet_item_font_size_type ); ?>;
		padding: 0.9375em 0.5em 0.9375em 0.5em;
	}
	#ptp-<?php echo $id ?> div.ptp-most-popular{
		border-radius: <?php echo $design1_rounded_corner_width; ?>;
		font-size: <?php echo esc_attr( $design1_most_popular_font_size ) . esc_attr( $design1_most_popular_font_size_type ); ?>;
	}
	<?php
		
	// Print stylish custom css setting
	if(isset($meta['ept-custom-css-setting-dg1'])) {
		if (function_exists ('wp_add_inline_script') ) {
			wp_add_inline_style ( 'dh-ptp-custom-css', $meta['ept-custom-css-setting-dg1'] );
		} else {
			echo $meta['ept-custom-css-setting-dg1'];
		}
	}		     
}


/**
 * Generate our simple flat pricing table HTML
 * @return [type]
 */
function dh_ptp_generate_simple_flat_pricing_table_html( $id, $hide = false )
{
	global $features_metabox;
	global $meta;
	
	$ept_allowed_tags = array(
	    'a'       => array(
	        'href'   => array(),
	        'title'  => array(),
	        'target' => array(),
	        'style' => array(),
	    ),
	    'abbr'    => array( 'title' => array() ),
	    'acronym' => array( 'title' => array() ),
	    'i'      => array(),
	    'b'      => array(),
	    'br'      => array(),
	    'u'      => array(),
	    'code'    => array(),
	    'pre'     => array(),
	    'em'      => array(),
	    'strong'  => array(),
	    'div'     => array( 'style' => array() ),
	    'p'       => array( 'style' => array() ),
	    'span'    => array( 'style' => array() ),
	    'strike'  => array( 'style' => array() ),
	    'ul'      => array(),
	    'ol'      => array(),
	    'li'      => array(),
	    'h1'      => array(),
	    'h2'      => array(),
	    'h3'      => array(),
	    'h4'      => array(),
	    'h5'      => array(),
	    'h6'      => array(),
	    'img'     => array(
	        'src'   => array(),
	        'class' => array(),
	        'alt'   => array(),
	    ),
	);

	$ept_allowed_tags = apply_filters( 'fca_ept_allowed_tags', $ept_allowed_tags );

	$meta = get_post_meta( $id, $features_metabox->get_the_id(), true );
	
	$loop_index = 0;
	$hide_table = ($hide)?'style="display:none"':'';
	$pricing_table_css = dh_ptp_easy_pricing_table_dynamic_css( $id, $meta );
	$pricing_table_html = '<div id="ptp-'. $id .'" class="ptp-pricing-table" '.$hide_table.'>';
	
	foreach ($meta['column'] as $column) {

		// Column details
		$plan_name = isset($column['planname'])?do_shortcode( $column['planname'] ):'';
		$plan_price = isset($column['planprice'])?do_shortcode( $column['planprice'] ):'';
		$plan_features = isset($column['planfeatures'])?do_shortcode( $column['planfeatures'] ):'';
		$button_text = isset($column['buttontext'])?$column['buttontext']:__('Add to Cart', 'easy-pricing-tables');
		$button_url = isset($column['buttonurl'])?$column['buttonurl']:'';
		$button_url = trim($button_url);
		
		// Get custom shortcode if any
		$custom_button = false;
		$shortcode_pattern = '|^\[shortcode\](?P<custom_button>.*)\[/shortcode\]$|';
		if ( 
			preg_match( $shortcode_pattern, $button_text, $matches) 
			||
			preg_match( $shortcode_pattern, $button_url, $matches) 
		) {
			$custom_button = $matches[ 'custom_button' ];
		}

		// Featured column
		$feature = '';
		$feature_label = '<div class="ptp-not-most-popular">&nbsp;</div>';
		if(isset($column['feature']) && $column['feature'] == "featured") {
			$feature = "ptp-highlight";
			$most_popular_text = isset($meta['most-popular-label-text'])?$meta['most-popular-label-text']:__('Most Popular', 'easy-pricing-tables');
			$feature_label = '<div class="ptp-most-popular">'.$most_popular_text.'</div>';
		}

		// create the html code
		$pricing_table_html .= '
		<div class="ptp-col ' . dh_ptp_get_number_of_columns() . ' '. $feature . ' ptp-col-id-' . $loop_index . '">' .
			$feature_label .
			'<div class="ptp-item-container">' . 
				'<div class="ptp-plan">' . wp_kses( $plan_name, $ept_allowed_tags ) . '</div> ' .
				'<div class="ptp-price">' . wp_kses( $plan_price, $ept_allowed_tags ) . '</div>' .
					dh_ptp_features_to_html_simple_flat( $plan_features, dh_ptp_get_max_number_of_features(), $ept_allowed_tags ) .
				'<div class="ptp-cta">'.
					(($custom_button)?$custom_button:'<a class="ptp-button" id="ptp-'.$id.'-cta-'.$loop_index.'" href="' . esc_url( do_shortcode ( $button_url ) ) . '">' . do_shortcode ( wp_kses( $button_text, $ept_allowed_tags ) ) . '</a>') .
				'</div>' .
			'</div>' .
		'</div>';

		$loop_index++;
	}
	
	$pricing_table_html .= '</div>';

	return $pricing_table_css . $pricing_table_html;
}

/**
 * Returns the appropriate HTML class depending on how many columns our pricing table has
 * @return string
 */
function dh_ptp_get_number_of_columns()
{
	global $meta;

	$number_to_text = array(
		'1'=>'one', '2'=>'two', '3'=>'three', '4'=>'four', '5'=>'five',
		'6'=>'six', '7'=> 'seven', '8'=>'eight', '9'=>'nine', '10'=>'ten'
	);
	
	$count = count($meta['column']);
	if ($count > 0 && $count <= 10) {
		return sprintf('ptp-%s-col', $number_to_text[$count]);
	}
	
	return 'ptp-more-col';
}

/**
 * Returns the highest number of features that one of our columns uses (needed to create blank rows)
 * @return int
 */
function dh_ptp_get_max_number_of_features()
{
	global $meta;

	$max = 0;
	foreach ($meta['column'] as $column) {
		if(isset($column['planfeatures'])) {
			// get number of features
			$col_number_of_features = count( explode( "\n", $column['planfeatures'] ) );

			if ($col_number_of_features > $max) {
				$max = $col_number_of_features;
			}
		}
	}

	return $max;
}

/**
 * Generate HTML code for our features
 * @param $dh_ptp_plan_features - this is an array containing all features
 * @param $dh_ptp_max_number_of_features - the highest number of features that one of our columns uses
 * @return string - the html string containing all features
 */
function dh_ptp_features_to_html_simple_flat ($plan_features, $max_number_of_features, $ept_allowed_tags )
{
	// the string to be returned
	$html = '';

	// explode string into a useable array
	$features = explode("\n", $plan_features);

	//how many features does this column have?
	$this_columns_number_of_features = count($features);

	for ($i=0; $i<$max_number_of_features; $i++) {
		if ($i < $this_columns_number_of_features && trim($features[$i]) != '') {
			$html .= '<div class="ptp-bullet-item ptp-row-id-'.$i.'">' . str_replace(array("\n", "\r"), '', wp_kses( $features[$i], $ept_allowed_tags ) ) . '</div>';
		} else {
			$html .= '<div class="ptp-bullet-item ptp-row-id-'.$i.' tt-ptp-empty-row">&nbsp;</div>';
		}
	}

	return $html;
}

function tt_ptp_enable_column_match_height_script_dg1() {
	ob_start();
	?>
		<script type="text/javascript">
		 jQuery(document).ready(function($) {    
		   
		  $('.ptp-plan').matchHeight(false); 
		  $('.ptp-cta').matchHeight(false); 
		  $('.ptp-price').matchHeight(false);
		  $('.ptp-button').matchHeight(false);
		  
		  $('.ptp-bullet-item').each(function( index ){
			  $('.ptp-row-id-'+index).matchHeight(false);
			 
			});
		  
		   
		  
		 });
	  </script>
	  
		<?php
	return ob_get_clean();  
}