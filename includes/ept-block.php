<?php

function fca_ept_register_block() {

	// MAIN
	wp_register_script( 'fca_ept_editor_script', PTP_PLUGIN_URL . '/assets/blocks/editor/fca-ept-editor.min.js', array( 'wp-blocks', 'wp-element' ), PTP_PLUGIN_VER );
	wp_register_style( 'fca-ept-editor-style', PTP_PLUGIN_URL . '/assets/blocks/editor/fca-ept-editor.min.css', PTP_PLUGIN_VER );
	
	$data = array( 
		'directory' => PTP_PLUGIN_URL
	);
	wp_localize_script( 'fca_ept_editor_script', 'fca_ept_data', $data );

	// LAYOUT1
	wp_register_script( 'fca_ept_layout1_script', PTP_PLUGIN_URL . '/assets/blocks/layout1/fca-ept-layout1.min.js', array( 'wp-blocks', 'wp-element' ), PTP_PLUGIN_VER );
	wp_register_style( 'fca-ept-layout1-style', PTP_PLUGIN_URL . '/assets/blocks/layout1/fca-ept-layout1.min.css', PTP_PLUGIN_VER );

	// LAYOUT2
	wp_register_script( 'fca_ept_layout2_script', PTP_PLUGIN_URL . '/assets/blocks/layout2/fca-ept-layout2.min.js', array( 'wp-blocks', 'wp-element' ), PTP_PLUGIN_VER );
	wp_register_style( 'fca-ept-layout2-style', PTP_PLUGIN_URL . '/assets/blocks/layout2/fca-ept-layout2.min.css', PTP_PLUGIN_VER );

	if ( function_exists( 'register_block_type' ) ) {
		register_block_type( 'fatcatapps/easy-pricing-tables', array( 'render_callback' => 'fca_ept_render' ) );
	}

}

add_action( 'init', 'fca_ept_register_block' );


function fca_ept_block_enqueue( ) {

	// enqueue editor style
	wp_enqueue_style( 'fca-ept-editor-style' );
	wp_enqueue_style( 'fca-ept-layout1-style' );
	wp_enqueue_style( 'fca-ept-layout2-style' );

	// enqueue layout scripts for editor
	wp_enqueue_script( 'fca_ept_editor_script' );
	wp_enqueue_script( 'fca_ept_layout1_script' );
	wp_enqueue_script( 'fca_ept_layout2_script' );

}
add_action( 'enqueue_block_editor_assets', 'fca_ept_block_enqueue' );


function fca_ept_get_block_html_ajax( ){

	$attributes = $_POST['attributes'];

	$attributes['columnSettings'] = stripslashes_deep( $attributes['columnSettings'] );

	$html = fca_ept_render( $attributes );

	wp_send_json_success( $html );

}

// Standard shortcode
function fca_ept_block_shortcode($atts){

	$table_ID = empty( $atts['id'] ) ? 0 : $atts['id'];
	$table = get_post( $table_ID );

	return apply_filters( 'the_content', $table->post_content);

}
add_shortcode('ept3-block', 'fca_ept_block_shortcode');

function fca_ept_render( $attributes ) {
	
	$selectedLayout = empty( $attributes['selectedLayout'] ) ? '' : $attributes['selectedLayout'];

	$renderLayout = 'fca_ept_render_' . $selectedLayout;

	if ( function_exists( $renderLayout ) ) {

		return call_user_func( $renderLayout, $attributes );

	}

}
