<?php
/**
 * WP List Table Example class
 *
 * @package   WPListTableExample
 * @author    Matt van Andel
 * @copyright 2016 Matthew van Andel
 * @license   GPL-2.0+
 */

/**
 * Example List Table Child Class
 *
 * Create a new list table package that extends the core WP_List_Table class.
 * WP_List_Table contains most of the framework for generating the table, but we
 * need to define and override some methods so that our data can be displayed
 * exactly the way we need it to be.
 *
 * To display this example on a page, you will first need to instantiate the class,
 * then call $yourInstance->prepare_items() to handle any data manipulation, then
 * finally call $yourInstance->display() to render the table to the page.
 *
 * Our topic for this list table is going to be movies.
 *
 * @package WPListTableExample
 * @author  Matt van Andel
 */
class EPT3_List_Table extends WP_List_Table {

	public function __construct() {
		// Set parent defaults.
		parent::__construct( array(
			'singular' => 'table',     // Singular name of the listed records.
			'plural'   => 'tables',    // Plural name of the listed records.
			'ajax'     => false,       // Does this table support ajax?
		) );
	}

	public function get_columns() {
		$columns = array(
			'cb'       => '<input type="checkbox" />', // Render a checkbox instead of text.
			'title'    => _x( 'Pricing Table Name', 'Column label', 'wp-list-table-example' ),
			'shortcode'   => _x( 'Shortcode', 'Column label', 'wp-list-table-example' ),
			'date' => _x( 'Date', 'Column label', 'wp-list-table-example' ),
		);

		return $columns;
	}

	protected function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'shortcode':
				return '<input type="text" style="width: 300px;" readonly="readonly" onclick="this.select()" value="[ept3-block id=&quot;'. $item->ID . '&quot;]"/>';
			case 'date':
				$date_format = get_option( 'links_updated_date_format', 'Y/m/d \a\t g:i a' );
				return '<span>Published</span></br>' . wp_date( $date_format, strtotime( $item->post_date ) );
			default:
				return print_r( $item, true ); // Show the whole array for troubleshooting purposes.
		}
	}

	protected function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="%1$s[]" value="%2$s" />',
			$this->_args['singular'],  // Let's simply repurpose the table's singular label ("movie").
			$item->ID                // The value of the checkbox should be the record's ID.
		);
	}

	protected function column_title( $item ) {
		$page = wp_unslash( $_REQUEST['page'] ); // WPCS: Input var ok.

		// Build edit row action.
		$edit_query_args = array(
			'post'  => $item->ID,
			'action' => 'edit',
			'ept3' => true
		);

		$actions['edit'] = sprintf(
			'<a href="%1$s">%2$s</a>',
			esc_url( add_query_arg( $edit_query_args, 'post.php' ), $item->post_title ),
			_x( 'Edit', 'List table row action', 'wp-list-table-example' )
		);

		// Build delete row action.
		$delete_query_args = array(
			'post'  => $item->ID,
			'action' => 'trash'
		);

		$actions['trash'] = sprintf(
			'<a href="%1$s">%2$s</a>',
			esc_url( wp_nonce_url( add_query_arg( $delete_query_args ), $item->ID ) ),
			_x( 'Trash', 'List table row action', 'wp-list-table-example' )
		);

		// Return the title contents.
		return sprintf( '<a class="row-title" href="' . esc_url( add_query_arg( $edit_query_args, 'post.php' ), $item->post_title ) . '">%1$s</a> <span style="display:none;">(id:%2$s)</span>%3$s',
			$item->post_title,
			$item->ID,
			$this->row_actions( $actions )
		);
	}

	protected function process_bulk_action() {
		// Detect when a bulk action is being triggered.
		if ( 'trash' === $this->current_action() ) {
			// javascript > move to trash here
			$postID = intval( $_GET['post'] );
			?>
				<script type="text/javascript">
					function ConfirmDelete(){
						if ( confirm("Delete Post?") ){ 
							//location.href='www.google2.com';
							<?php echo( 'test1234132' ); ?>
							//wp_delete_post( $postID );
						} else {
							location.href='www.google.com';
						}
					}
					ConfirmDelete()
				</script>

			<?php

			//wp_delete_post( $postID );
			//wp_die( 'Items moved to Trash!' );
		}
	}

	function prepare_items() {

		$post_status = empty( $_GET['post_status'] ) ? '' : sanitize_text_field( $_GET['post_status'] );

		$per_page = 20;

		$columns  = $this->get_columns();
		$hidden   = array();

		$this->_column_headers = array( $columns, $hidden );

		$this->process_bulk_action();

    	$args = array(
    			'post_status'	 => $post_status,
                'post_type'      => 'wp_block',
                'posts_per_page' => '-1'
        	);

		$data = get_posts( $args );

		$current_page = $this->get_pagenum();

		$total_items = count( $data );

		$data = array_slice( $data, ( ( $current_page - 1 ) * $per_page ), $per_page );

		$this->items = $data;

		$this->set_pagination_args( array(
			'total_items' => $total_items,                     // WE have to calculate the total number of items.
			'per_page'    => $per_page,                        // WE have to determine how many items to show on a page.
			'total_pages' => ceil( $total_items / $per_page ), // WE have to calculate the total number of pages.
		) );
	}

	protected function usort_reorder( $a, $b ) {
		// If no sort, default to title.
		$orderby = ! empty( $_REQUEST['orderby'] ) ? wp_unslash( $_REQUEST['orderby'] ) : 'title'; // WPCS: Input var ok.

		// If no order, default to asc.
		$order = ! empty( $_REQUEST['order'] ) ? wp_unslash( $_REQUEST['order'] ) : 'asc'; // WPCS: Input var ok.

		// Determine sort order.
		$result = strcmp( $a[ $orderby ], $b[ $orderby ] );

		return ( 'asc' === $order ) ? $result : - $result;
	}
}