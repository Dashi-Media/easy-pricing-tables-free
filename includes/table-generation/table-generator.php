<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 11/15/13
 * Time: 15:48
 */


// include our HTML generators for each table
include ( PTP_PLUGIN_PATH . '/includes/table-generation/simple-flat-table.php');

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

