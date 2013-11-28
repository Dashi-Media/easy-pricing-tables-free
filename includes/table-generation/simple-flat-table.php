<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 11/15/13
 * Time: 15:28
 */



add_action( 'wp_head', 'dh_ptp_get_custom_styling' );

/**
 * Read all custom styling from our database
 */
function dh_ptp_get_custom_styling($id)
{
    global $features_metabox;
    $meta = get_post_meta($id, $features_metabox->get_the_id(), TRUE);

    /* get all variables from custom settings */
    /**
     * Overall Styles *
     */
    //<editor-fold desc="Get Overall Styles">
    // get rounded corner width
    if(isset($meta['rounded-corners']))
        $rounded_corner_width = $meta['rounded-corners'];
    else
        $rounded_corner_width = '0px';
    //</editor-fold>

    /**
     * Font Styles
     */
    //<editor-fold desc="Get Font Styles">
    // most popular
    if(isset($meta['most-popular-font-size']))
        $most_popular_font_size = $meta['most-popular-font-size'];
    else
        $most_popular_font_size = 0.9;
    if(isset($meta['most-popular-font-size-type']))
        $most_popular_font_size_type = $meta['most-popular-font-size-type'];
    else
        $most_popular_font_size_type = "em";

    // plan name
    if(isset($meta['plan-name-font-size']))
        $plan_name_font_size = $meta['plan-name-font-size'];
    else
        $plan_name_font_size = 1;
    if(isset($meta['plan-name-font-size-type']))
        $plan_name_font_size_type = $meta['plan-name-font-size-type'];
    else
        $plan_name_font_size_type = "em";

    // price
    if(isset($meta['price-font-size']))
        $price_font_size = $meta['price-font-size'];
    else
        $price_font_size = 1.25;
    if(isset($meta['price-font-size-type']))
        $price_font_size_type = $meta['price-font-size-type'];
    else
        $price_font_size_type = "em";

    // bullet item
    if(isset($meta['bullet-item-font-size']))
        $bullet_item_font_size = $meta['bullet-item-font-size'];
    else
        $bullet_item_font_size = 0.875;
    if(isset($meta['bullet-item-font-size-type']))
        $bullet_item_font_size_type = $meta['bullet-item-font-size-type'];
    else
        $bullet_item_font_size_type = "em";

    // button
    if(isset($meta['button-font-size']))
        $button_font_size = $meta['button-font-size'];
    else
        $button_font_size = 1;
    if(isset($meta['button-font-size-type']))
        $button_font_size_type = $meta['button-font-size-type'];
    else
        $button_font_size_type = "em";
    //</editor-fold>

    /**
     * Button Colors
     */
    //<editor-fold desc="Get Button Colors">
    // get featured button font color
    if(isset($meta['featured-button-font-color']))
        $featured_button_font_color = $meta['featured-button-font-color'];
    else
        $featured_button_font_color = '#ffffff';

    // get featured button color
    if(isset($meta['featured-button-color']))
        $featured_button_color = $meta['featured-button-color'];
    else
        $featured_button_color = '#3498db';

    // get featured button  border color
    if(isset($meta['featured-button-border-color']))
        $featured_button_border_color = $meta['featured-button-border-color'];
    else
        $featured_button_border_color = '#2980b9';

    // get featured button hover color
    if(isset($meta['featured-button-hover-color']))
        $featured_button_hover_color = $meta['featured-button-hover-color'];
    else
        $featured_button_hover_color = '#2980b9';

    // non-featured buttons
    // get  button font color
    if(!empty($meta['button-font-color']))
        $button_font_color = $meta['button-font-color'];
    else
        $button_font_color = '#ffffff';

    // get button color
    if(!empty($meta['button-color']))
        $button_color = $meta['button-color'];
    else
        $button_color = '#e74c3c';

    // get button border color
    if(isset($meta['button-border-color']))
        $button_border_color = $meta['button-border-color'];
    else
        $button_border_color = '#c0392b';

    // get button hover color
    if(isset($meta['button-hover-color']))
        $button_hover_color = $meta['button-hover-color'];
    else
        $button_hover_color = '#c0392b';
    //</editor-fold>

    return dh_ptp_print_inline_css($id, $rounded_corner_width, $most_popular_font_size, $most_popular_font_size_type, $plan_name_font_size,
        $plan_name_font_size_type, $price_font_size, $price_font_size_type, $button_font_size, $button_font_size_type,
        $bullet_item_font_size, $bullet_item_font_size_type,
        $featured_button_font_color, $featured_button_color, $featured_button_border_color, $featured_button_hover_color,
        $button_font_color, $button_color, $button_border_color, $button_hover_color);
}

/**
 * Big ugly function to generate our custom CSS
 */
function dh_ptp_print_inline_css($id, $rounded_corner_width, $most_popular_font_size, $most_popular_font_size_type, $plan_name_font_size,
                                 $plan_name_font_size_type, $price_font_size, $price_font_size_type, $button_font_size, $button_font_size_type,
                                 $bullet_item_font_size, $bullet_item_font_size_type,
                                 $featured_button_font_color, $featured_button_color, $featured_button_border_color, $featured_button_hover_color,
                                 $button_font_color, $button_color, $button_border_color, $button_hover_color)

{
    $id = "#ptp-".$id;
    ?>
    <!-- Dynamic CSS from Easy Pricing Tables -->
    <style type="text/css">
        <?php echo $id ?> ul.ptp-item-container{
            border-radius: <?php echo $rounded_corner_width; ?>;"
        }
        <?php echo $id ?> li.ptp-plan{
            border-top-right-radius: <?php echo $rounded_corner_width; ?>;
            border-top-left-radius: <?php echo $rounded_corner_width; ?>;
            font-size: <?php echo $plan_name_font_size . $plan_name_font_size_type; ?>;
        }
        <?php echo $id ?> li.ptp-price{
            font-size: <?php echo $price_font_size . $price_font_size_type; ?>;
        }
        <?php echo $id ?> li.ptp-cta{
            border-bottom-right-radius: <?php echo $rounded_corner_width; ?>;
            border-top-left-radius: <?php echo $rounded_corner_width; ?>;
        }
        <?php echo $id ?> a.ptp-button{
            border-radius: <?php echo $rounded_corner_width; ?>;
            font-size: <?php echo $button_font_size.$button_font_size_type; ?>;
            color: <?php echo $button_font_color; ?>;
            background-color: <?php echo $button_color; ?>;
            border-bottom: <?php echo $button_border_color;?> 4px solid;
        }
        <?php echo $id ?> a.ptp-button:hover{
            background-color: <?php echo $button_hover_color; ?>
        }

        div<?php echo $id ?>.ptp-highlight a.ptp-button{
            color: <?php echo $featured_button_font_color; ?>;
            background-color: <?php echo $featured_button_color; ?>;
            border-bottom: <?php echo $featured_button_border_color;?> 4px solid;
        }
        div<?php echo $id ?>.ptp-highlight a.ptp-button:hover{
            background-color: <?php echo $featured_button_hover_color; ?>;
        }
        <?php echo $id ?> li.ptp-bullet-item{
            font-size: <?php echo $bullet_item_font_size.$bullet_item_font_size_type; ?>;
        }
        <?php echo $id ?> div.ptp-most-popular{
            border-radius: <?php echo $rounded_corner_width; ?>;"
        font-size: <?php echo $most_popular_font_size.$most_popular_font_size_type; ?>;
        }
    </style>
    <!-- / End Easy Pricing Tables Dynamic CSS -->
<?php
}






/**
 * Generate our simple flat pricing table HTML
 * @return [type]
 */
function dh_ptp_generate_simple_flat_pricing_table_html ($id) {
    global $features_metabox;
    global $meta;

    $meta = get_post_meta($id, $features_metabox->get_the_id(), TRUE);

    do_action( 'wp_head', $id );
    add_action( 'wp_head', 'dh_ptp_get_custom_styling');



    /**
     * the string to be returned that includes the pricing table html
     * @var string
     */

    $loop_index = 0;
    $pricing_table_html = '<div class="ptp-pricing-table" >';
    foreach ($meta['column'] as $column)
    {
        // Note: beneath ifs are to prevent 'undefined variable notice'. It wasn't possible to put this code into a function since the passing argument might be undefined.

        //<editor-fold desc="get settings relevant to current column">
        // get plan name
        if(isset($column['planname']))
            $planname = $column['planname'];
        else
            $planname = '';

        // get plan price
        if(isset($column['planprice']))
            $planprice = $column['planprice'];
        else
            $planprice = '';

        if(isset($column['planfeatures']))
        {
            $planfeatures = $column['planfeatures'];
        }
        else
            $planfeatures = '';

        // get plan price
        if(isset($column['buttonurl']))
            $buttonurl = $column['buttonurl'];
        else
            $buttonurl = '';

        // get plan price
        if(isset($column['buttontext']))
            $buttontext = $column['buttontext'];
        else
            $buttontext = '';
        //</editor-fold>

        //<editor-fold desc="set html based on if our current column is featured">
        if(isset($column['feature']))
            if ($column['feature'] == "featured")
            {
                $feature = "ptp-highlight";
                $feature_label = '<div class="ptp-most-popular">Most Popular</div>';
            }
            else
            {
                $feature = '';
                $feature_label = '<div class="ptp-not-most-popular">&nbsp;</div>';
            }
        else
        {
            $feature = '';
            $feature_label = '<div class="ptp-not-most-popular">&nbsp;</div>';
        }
        //</editor-fold>

        // create the html code
        $pricing_table_html .= '
		<div id="ptp-'. $id .'" class="ptp-col ' . dh_ptp_get_number_of_columns() . ' '. $feature . ' ptp-col-id-' . $loop_index . '">'
            . $feature_label .
            '<ul class="ptp-item-container">
				<li class="ptp-plan">' . $planname . '</li>
		  		<li class="ptp-price">' . $planprice . '</li>'
            . dh_ptp_features_to_html_simple_flat($planfeatures,dh_ptp_get_max_number_of_features()) . '
	  			<li class="ptp-cta">
	  				<a class="ptp-button" href="' . $buttonurl . '">' . $buttontext . '</a>
	  			</li>
			</ul>
		</div>
		';

        $loop_index++;
    }

    $pricing_table_html .= '</div>';

    return $pricing_table_html;
}

/**
 * Returns the appropriate HTML class depending on how many columns our pricing table has
 * @return string
 */
function dh_ptp_get_number_of_columns()
{
    global $meta;

    switch (count($meta['column'])) {
        case 1:
            $number_of_columns = "ptp-one-col";
            break;
        case 2:
            $number_of_columns = "ptp-two-col";
            break;
        case 3:
            $number_of_columns = "ptp-three-col";
            break;
        case 4:
            $number_of_columns = "ptp-four-col";
            break;
        case 5:
            $number_of_columns = "ptp-five-col";
            break;
        case 6:
            $number_of_columns = "ptp-six-col";
            break;
        case 7:
            $number_of_columns = "ptp-seven-col";
            break;
        case 8:
            $number_of_columns = "ptp-eight-col";
            break;
        case 9:
            $number_of_columns = "ptp-nine-col";
            break;
        case 10:
            $number_of_columns = "ptp-ten-col";
            break;
        default:
            $number_of_columns = "ptp-more-col";
            break;
    }

    return $number_of_columns;
}

/**
 * Returns the highest number of features that one of our columns uses (needed to create blank rows)
 * @return int
 */
function dh_ptp_get_max_number_of_features(){
    global $meta;
    $max_number_of_features = 0;

    // go through all columns
    foreach ($meta['column'] as $column)
    {
        if(isset($column['planfeatures']))
        {
            // get number of features
            $col_number_of_features = count( explode( "\n", $column['planfeatures'] ) );

            if ($col_number_of_features > $max_number_of_features)
                $max_number_of_features = $col_number_of_features;
        }
    }

    return $max_number_of_features;
}


/**
 * Generate HTML code for our features
 * @param $dh_ptp_plan_features - this is an array containing all features
 * @param $dh_ptp_max_number_of_features - the highest number of features that one of our columns uses
 * @return string - the html string containing all features
 */
function dh_ptp_features_to_html_simple_flat ($dh_ptp_plan_features, $dh_ptp_max_number_of_features){

    // the string to be returned
    $dh_ptp_feature_html = "";

    // explode string into a useable array
    $dh_ptp_features = explode("\n", $dh_ptp_plan_features);

    //how many features does this column have?
    $this_columns_number_of_features = count($dh_ptp_features);

    //add each feature to $dh_ptp_feature_html
    for ($iterator=0; $iterator<$dh_ptp_max_number_of_features; $iterator++)
    {
        if ($iterator < $this_columns_number_of_features)
        {
            if ($dh_ptp_features[$iterator] == "") {
                $dh_ptp_feature_html .= '<li class="ptp-bullet-item ">&nbsp;</li>';
            }
            else
                $dh_ptp_feature_html .= '<li class="ptp-bullet-item">' . $dh_ptp_features[$iterator] . '</li>';
        }
        else
            $dh_ptp_feature_html .= '<li class="ptp-bullet-item ">&nbsp;</li>';
    }

    // return the features html
    return $dh_ptp_feature_html;
}
