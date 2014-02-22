<?php

// include our HTML generators for each table
include ( PTP_PLUGIN_PATH . '/includes/table-generation/design1.php');

/* CSS Styling */
function dh_ptp_easy_pricing_table_dynamic_css()
{
    global $features_metabox;
    
    echo '<style type="text/css">';

        // Retrieve all meta data for easy pricing tables
        $query = new WP_Query(array('post_type' => 'easy-pricing-table', 'posts_per_page' => -1, 'post_status' => 'any'));
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                // Print CSS styles per table
                $meta = get_post_meta(get_the_ID(), $features_metabox->get_the_id(), true);
                dh_ptp_simple_flat_css(get_the_ID(), $meta);
            endwhile;
        endif;
        wp_reset_postdata();
    
    echo "</style>" . "\n";
}
add_action( 'wp_head', 'dh_ptp_easy_pricing_table_dynamic_css');

/**
 * This function decides which table style we should create. It enqueue the appropriate CSS file and calls the appropriate function.
 *
 * @return string pricing table html
 */
function dh_ptp_generate_pricing_table($id)
{
    global $features_metabox;
    $meta = get_post_meta($id, $features_metabox->get_the_id(), TRUE);

    // Enqueue IE Hacks
    wp_enqueue_style('ept-ie-style', PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/ui-ie.css');
    global $wp_styles;
    $wp_styles->add_data('ept-ie-style', 'conditional', 'lt IE 9');
    
    //include css
    wp_enqueue_style( 'dh-ptp-design1', PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/pricing-tables/design1/pricingtable.css' );

    //call appropriate function
    return dh_ptp_generate_simple_flat_pricing_table_html($id);
}

