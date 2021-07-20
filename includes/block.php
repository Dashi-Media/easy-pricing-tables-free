<?php
/*
GUTENBERG BLOCK INTEGRATION
*/

/**************/
/* EPT LEGACY */
/**************/
function dh_ptp_gutenblock_register() {

	wp_register_script(
		'dh_ptp_gutenblock_script',
		PTP_PLUGIN_URL . '/includes/block.js',
		array( 'wp-blocks', 'wp-element', 'wp-editor' )
	);
	wp_register_style( 'dh-ptp-block-css', PTP_PLUGIN_URL . '/assets/ui/block.css' );
	wp_register_style( 'dh-ptp-design1', PTP_PLUGIN_URL . '/assets/pricing-tables/design1/pricingtable.min.css' );
		
	if ( function_exists( 'register_block_type' ) ) {

		wp_enqueue_style( array( 'dh-ptp-block-css', 'dh-ptp-design1' ) );
		
		register_block_type( 'easy-pricing-tables/gutenblock',
			array(
				'editor_script' => 'dh_ptp_gutenblock_script',
				'render_callback' => 'dh_ptp_gutenblock_render',
				'attributes' => array( 
					'post_id' => array( 
						'type' => 'string',
						'default' => '0'				
					),
				)
			)
		);
	}
}

add_action( 'init', 'dh_ptp_gutenblock_register' );

function dh_ptp_gutenblock_enqueue() {

	$posts = get_posts( array(
		'post_type' => 'easy-pricing-table',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'fields' => 'ids'
	));
	
	$table_list = array( 
		array(
			'value' => 0,
			'label' => 'Select a pricing table',
		) 
	);
	
	forEach ( $posts as $p ) {
		$title =  get_the_title( $p );
		if ( empty( $title ) ) {
			$title = __("(no title)", 'easy-pricing-tables' );
		}

		$table_list[] = array(
			'value' => $p,
			'label' => html_entity_decode( $title ),
		);
		
	}

	$existing_install = dh_ptp_check_existing_install();
	
	wp_localize_script( 'dh_ptp_gutenblock_script', 'dh_ptp_gutenblock_script_data', array( 'existing' => $existing_install, 'tables' => $table_list, 'editurl' => admin_url( 'post.php' ), 'newurl' => admin_url( 'post-new.php' )  ) );
	
}
add_action( 'enqueue_block_editor_assets', 'dh_ptp_gutenblock_enqueue' );


function dh_ptp_gutenblock_render( $attributes ) {

	$id = empty( $attributes['post_id'] ) ? 0 : $attributes['post_id'];
	if ( $id ) {		
		return do_shortcode( "[easy-pricing-table id='$id']" );
		//return ;
	}
	return '<p>' . __( 'Click here and select a pricing table from the menu above.', 'easy-pricing-tables' ) . '</p>';
	
}
