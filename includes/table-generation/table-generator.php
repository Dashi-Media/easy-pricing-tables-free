<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 11/15/13
 * Time: 15:48
 */


// include our HTML generators for each table
include ( PTP_PLUGIN_PATH . '/includes/table-generation/simple-flat-table.php');

/* CSS Styling */
add_action( 'wp_head', 'dh_ptp_easy_pricing_table_dynamic_css');

function dh_ptp_easy_pricing_table_dynamic_css()
{
    global $features_metabox;
    
    echo '<style type="text/css">';
    
    // Retrieve all meta data for easy pricing tables
    $args = array(
        'post_type' => 'easy-pricing-table',
        'posts_per_page' => -1,
        'post_status' => 'any'
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $meta = get_post_meta(get_the_ID(), $features_metabox->get_the_id(), true);
            
            // Print css style per table
            dh_ptp_simple_flat_css(get_the_ID(), $meta);
        endwhile;
    endif;
    wp_reset_postdata();
    
    echo "</style>" . "\n";
}


/**
 * This function decides which table style we should create. It enqueue the appropriate CSS file and calls the appropriate function.
 *
 * @return string pricing table html
 */
function dh_ptp_generate_pricing_table($id)
{
    global $features_metabox;
    $meta = get_post_meta($id, $features_metabox->get_the_id(), TRUE);

    //include css
    wp_enqueue_style( 'simple-flat-table-style', PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/pricing-tables/simple-flat/pricingtable.css'  );

    //call appropriate function
    return dh_ptp_generate_simple_flat_pricing_table_html($id);
}

