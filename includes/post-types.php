<?php


//CUSTOM ROW ACTIONS FOR LEGACY POSTS
function fca_ept_post_row_actions( $actions, $post ) {
    
    if ( $post->post_type == "easy-pricing-table" ) {
		
		$clone_query =  add_query_arg( array(
			'fca_ept_clone_table' => $post->ID,
			'ept_nonce' => wp_create_nonce( 'ept_clone' )
		));
		
		return array(
			'edit' => $actions['edit'],
			'duplicate' => "<a href='" . esc_url( $clone_query ) . "'>Make a Copy</a>",
			'trash' => $actions['trash'],
			'view' => $actions['view']
		);
		
	}
	return $actions;
}
add_filter( 'post_row_actions', 'fca_ept_post_row_actions', 10, 2 );

function dh_ptp_add_new_pricing_table_columns($gallery_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = _x('Pricing Table Name', 'column name', 'easy-pricing-tables');    
    $new_columns['shortcode'] = __('Shortcode', 'easy-pricing-tables');
    $new_columns['date'] = _x('Date', 'column name', 'easy-pricing-tables');
 
    return $new_columns;
}
add_filter( 'manage_edit-easy-pricing-table_columns', 'dh_ptp_add_new_pricing_table_columns' );

function dh_ptp_manage_pricing_table_columns($column_name, $id) {
	
    switch ($column_name) {
	    case 'shortcode':
	        echo '<input type="text" style="width: 300px;" readonly="readonly" onclick="this.select()" value="[easy-pricing-table id=&quot;'. $id . '&quot;]"/>';
	            break;
	 
	    default:
	        break;
    } // end switch
}  
add_action( 'manage_easy-pricing-table_posts_custom_column', 'dh_ptp_manage_pricing_table_columns', 10, 2 );



/**
 * Preview functionality.
 * (Append the pricing table shortcode to the empty post.)
 * @param  [type] $content [description]
 * @return [type]          [description]
 */
function dh_ptp_live_preview($content){
    global $post;
    if ( is_user_logged_in() &&
    	 'easy-pricing-table' == get_post_type() && 
    	 is_main_query() )  {
		return $content . do_shortcode("[easy-pricing-table id={$post->ID}]");
	} else {
		return $content;
    }
}
add_filter( 'the_content', 'dh_ptp_live_preview');

/**
 * Redirect to 404 Page
 * Current user is not an admin
 * @param  [type] $content [description]
 * @return [type]          [description]
 */
function dh_ptp_404()
{
    // check is admin
    if( is_singular( 'easy-pricing-table' ) &&
    	!current_user_can( 'manage_options' ) ) {
    	
		global $wp_query;
	    $wp_query->set_404();
	    status_header(404);
	    nocache_headers();
	    include( get_query_template( '404' ) );
        die();
    }
}
add_action( 'wp', 'dh_ptp_404');

/**
 * Remove the publish metabox for pricing tables
 * @return [type] [description]
 */
function dh_ptp_remove_publish_metabox()
{
    remove_meta_box( 'submitdiv', 'easy-pricing-table', 'side' );
}
add_action( 'admin_menu', 'dh_ptp_remove_publish_metabox' );

/* Redirect when Save & Preview button is clicked */
add_filter('redirect_post_location', 'dh_ptp_save_preview_redirect');
function dh_ptp_save_preview_redirect ( $location )
{
    global $post;
 
    if (
        (isset($_POST['publish']) || isset($_POST['save'])) && preg_match("/post=([0-9]*)/", $location, $match) && $post &&
		$post->ID == $match[1] && (isset($_POST['publish']) || $post->post_status == 'publish') && $pl = get_permalink($post->ID)
		&& isset($_POST['dh_ptp_preview_url'])
    ) {
		// Flush rewrite rules
		global $wp_rewrite;
		$wp_rewrite->flush_rules(true);
		
        // Always redirect to the post
        $location = $_POST['dh_ptp_preview_url'];
    }
 
    return $location;
}

/* Number of Columns */
function dh_ptp_screen_layout_columns()
{
	global $current_screen;
	$current_user =  wp_get_current_user();
	
	if ( $current_screen->post_type == 'easy-pricing-table' ) {
		$user_id    = $current_user->ID;
		$prev_value = NULL;
		
		// Full width
		$screen_layout_option = get_user_meta($user_id, 'screen_layout_easy-pricing-table');
		if ( ! $screen_layout_option ) {
			update_user_meta($user_id, 'screen_layout_easy-pricing-table', 1, $prev_value);
		}
	}
}
add_action( 'admin_head-post.php'    , 'dh_ptp_screen_layout_columns' );
add_action( 'admin_head-post-new.php', 'dh_ptp_screen_layout_columns' );


/* design 4 hack */
function ptp_design4_color_columns() {
	
	$columns = (isset($_REQUEST['columns']) && preg_match("/^([0-9]+)+$/sim", $_REQUEST['columns']))?$_REQUEST['columns']:2;
	$post_id = (isset($_REQUEST['post_id']) && preg_match("/^([0-9]+)+$/sim", $_REQUEST['post_id']))?$_REQUEST['post_id']:0;
	
	if($columns > 0 && $post_id != 0) {
		$meta = get_post_meta($post_id, '1_dh_ptp_settings', TRUE); // HACK: 1_dh_ptp_settings
		$column_names = isset($_REQUEST['column_names'])?explode("\t\n", $_REQUEST['column_names']):array();
		for($i=0; $i<$columns; $i++) {
			$color = (isset($meta['column']) && isset($meta['column'][$i]['plancolor']))?$meta['column'][$i]['plancolor']:'#6baba1';
			$color = isset($meta['design4_color_column_'.($i+1)])?$meta['design4_color_column_'.($i+1)]:$color;
			
			?>
				<tr class="design4-js-rows">
                    <td class="settings-title">
						<?php if (isset($column_names[$i]) && strlen($column_names[$i]) > 0) : ?>
							<?php _e(sprintf('%s - Color', $column_names[$i]), 'easy-pricing-tables'); ?>
						<?php else : ?>
							<?php _e(sprintf('Column %d - Color', ($i+1)), 'easy-pricing-tables'); ?>
						<?php endif; ?>
					</td>
                    <td>
                        <input type="text" name="1_dh_ptp_settings[design4_color_column_<?php echo ($i+1); ?>]" class="design4-color" value="<?php echo $color; ?>" class="my-color-field form-control" data-default-color="#6baba1" />
                    </td>
                </tr>
			<?php
		}
	}
	
	exit();

}
add_action( 'wp_ajax_ptp_design4_color_columns'       , 'ptp_design4_color_columns' );
add_action( 'wp_ajax_nopriv_ptp_design4_color_columns', 'ptp_design4_color_columns' );

/* Deal with parasite Post Type Switcher plugin */
function ptp_dh_pts_disable( $args ) {
    $postType  = get_post_type();
    if( 'easy-pricing-table' === $postType){
        $args = array(
          'name' => 'easy-pricing-table'
        );
    }
    return $args;
}
add_filter( 'pts_post_type_filter', 'ptp_dh_pts_disable' );

