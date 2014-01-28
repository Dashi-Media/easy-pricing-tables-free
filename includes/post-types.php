<?php

/**
 * Register "Pricing Table" post type
 * @return [type] [description]
 */
function dh_ptp_register_pricing_table_post_type() {

	$labels = array(
	    'name' => 'Pricing Tables',
	    'singular_name' => 'Pricing Table',
	    'add_new' => 'Add New',
	    'add_new_item' => 'Add New Pricing Table',
	    'edit_item' => 'Edit Pricing Table',
	    'new_item' => 'New Pricing Table',
	    'all_items' => 'All Pricing Tables',
	    'view_item' => 'View Pricing Table',
	    'search_items' => 'Search Pricing Tables',
	    'not_found' =>  'No Pricing Tables found',
	    'not_found_in_trash' => 'No Pricing Tables found in Trash', 
	    'parent_item_colon' => '',
	    'menu_name' => 'Pricing Tables'
	  );

  	$args = array(
	    'labels' => $labels,
	    'public' => false,
	   	'exclude_from_search' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true, 
	    'show_in_menu' => true, 
	    'query_var' => true,
	    'rewrite' => array( 'slug' => 'pricing-table' ),
	    'capability_type' => 'post',
	    'has_archive' => false, 
	    'hierarchical' => false,
	    'menu_position' => 21,
	    'supports' => array( 'title', 'revisions')
  	); 

	register_post_type( 'easy-pricing-table', $args);

}
add_action( 'init', 'dh_ptp_register_pricing_table_post_type');

/**
 * customize UI interaction messages
 * eg: Changes "Post published" to "Pricing Table published"
 * Code template from http://wp.smashingmagazine.com/2012/11/08/complete-guide-custom-post-types/
 * I removed the "view post" hyperlinks from notification messages since they are pointless
 * 
 * @param  [type] $messages [description]
 * @return [type]           [description]
 */

function dh_ptp_updated_interaction_messages( $messages ) {
	global $post, $post_ID;
	$messages['easy-pricing-table'] = array(
		0 => '', 
		1 => sprintf( __('Pricing table saved. <a href="%s">View pricing table</a>.'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Pricing table saved.'),
		5 => isset($_GET['revision']) ? sprintf( __('Pricing table restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Pricing table saved. <a href="%s">View pricing table</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Pricing table saved.'),
		//8 => sprintf( __('Pricing table submitted. <a target="_blank" href="%s">Preview pricing table</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		8 => sprintf( __('Pricing table submitted.') ),
		9 => sprintf( __('Pricing table scheduled for: <strong>%1$s</strong>.'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Pricing table saved.' ) ),
	);
	return $messages;
}
add_filter( 'post_updated_messages', 'dh_ptp_updated_interaction_messages' );

/**
 * changes the "Enter title here" to "Enter pricing table name here'" for pricing-table post type
 */
add_filter('gettext', 'dh_ptp_custom_rewrites', 10, 4);
function dh_ptp_custom_rewrites($translation, $text, $domain) {
	global $post;
        if ( ! isset( $post->post_type ) ) {
            return $translation;
        }
	$translations = get_translations_for_domain($domain);
	$translation_array = array();
 
	switch ($post->post_type) {
		case 'easy-pricing-table': // enter your post type name here
			$translation_array = array(
				'Enter title here' => 'Enter pricing table name here'
			);
			break;
	}
 
	if (array_key_exists($text, $translation_array)) {
		return $translations->translate($translation_array[$text]);
	}
	return $translation;
}


/**
 * Customize pricing table overview tables ("Pricing Tables" -> "All Pricing Tables")
 * Add / modify columns at pricing table edit overview
 * @param  [type] $gallery_columns [description]
 * @return [type]                  [description]
 */
function dh_ptp_add_new_pricing_table_columns($gallery_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = _x('Pricing Table Name', 'column name');    
    $new_columns['shortcode'] = __('Shortcode');
    $new_columns['date'] = _x('Date', 'column name');
 
    return $new_columns;
}
// Add to admin_init function
add_filter('manage_edit-easy-pricing-table_columns', 'dh_ptp_add_new_pricing_table_columns');
function dh_ptp_manage_pricing_table_columns($column_name, $id) {
    global $wpdb;

    switch ($column_name) {
	    case 'shortcode':
	        echo '<input type="text" style="width: 300px;" readonly="readonly" onclick="this.select()" value="[easy-pricing-table id=&quot;'. $id . '&quot;]"/>';
	            break;
	 
	    default:
	        break;
    } // end switch
}   
// Add to admin_init function
add_action('manage_easy-pricing-table_posts_custom_column', 'dh_ptp_manage_pricing_table_columns', 10, 2);


/**
 * Preview functionality.
(Append the pricing table shortcode to the empty post.)
 * @param  [type] $content [description]
 * @return [type]          [description]
 */
function dh_ptp_live_preview($content){
    global $post;
    if(get_post_type()=='easy-pricing-table' && is_main_query()) 
	{
		return $content . do_shortcode("[easy-pricing-table id={$post->ID}]");
	}
	else
	{
		return $content;
    }
}
add_filter( 'the_content', 'dh_ptp_live_preview');

/**
 * Remove the publish metabox for pricing tables
 * @return [type] [description]
 */
function dh_ptp_remove_publish_metabox()
{
    remove_meta_box( 'submitdiv', 'easy-pricing-table', 'side' );
}
add_action( 'admin_menu', 'dh_ptp_remove_publish_metabox' );

/* Save tab state */
function dh_ptp_save_tab_state( $post_id ) {

	// If this is just a revision, don't send the email.
	if ( wp_is_post_revision( $post_id ) )
		return;
	
	// Check if post type matches the pricing tables
	if ( isset($_POST['post_type']) && 'easy-pricing-table' != $_POST['post_type'] ) {
        return;
    }

	// Set cookie with tab data
	if (!isset($_COOKIE['dh_ptp_current_tab']) && isset($_REQUEST['dh_ptp_tab'])) {
        setcookie('dh_ptp_current_tab', $_REQUEST['dh_ptp_tab'], time()+3, COOKIEPATH, COOKIE_DOMAIN, false);
    }
}
add_action( 'save_post', 'dh_ptp_save_tab_state' );

/* Redirect when Save & Preview button is clicked */
add_filter('redirect_post_location', 'dh_ptp_save_preview_redirect');
function dh_ptp_save_preview_redirect ($location)
{
    global $post;
 
    if (
        (isset($_POST['publish']) || isset($_POST['save'])) && preg_match("/post=([0-9]*)/", $location, $match) && $post &&
		$post->ID == $match[1] && (isset($_POST['publish']) || $post->post_status == 'publish') && $pl = get_permalink($post->ID)
		&& isset($_POST['dh_ptp_preview_url'])
    ) {
        // Always redirect to the post
        $location = $_POST['dh_ptp_preview_url'];
    }
 
    return $location;
}
