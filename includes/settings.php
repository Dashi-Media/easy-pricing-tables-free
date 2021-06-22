<?php

/************************************
 Settings UI
 ************************************* */
function dh_ptp_settings_menu() {
	global $submenu;
	$submenu_list = $submenu['edit.php?post_type=easy-pricing-table'];
	$position = count( $submenu_list ) -1;
	$existing_install = dh_ptp_check_existing_install();

	if ( $existing_install === false ){ 
		add_submenu_page( 'edit.php?post_type=easy-pricing-table', __('Settings', 'easy-pricing-tables'), __('Settings', 'easy-pricing-tables'), 'manage_options', 'easy-pricing-tables-settings', 'dh_ptp_settings', $position);
	}
}
add_action('admin_menu', 'dh_ptp_settings_menu');

function dh_ptp_settings() {

	$dh_ptp_show_legacy_tables = ( get_option( 'dh_ptp_show_legacy_tables') == 'no' || get_option( 'dh_ptp_show_legacy_tables') == '' ? false : 'checked' );
	?>
	
	<div class="wrap">
		<form method="post" action="options.php">

				<h3>
					<?php _e('Misc options', 'easy-pricing-tables'); ?>
				</h3>

				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row" valign="top">
								<?php _e('Show legacy pricing tables sidebar menu', 'easy-pricing-tables'); ?>
							</th>
							<td>
								<input id="dh_ptp_show_legacy_tables" name="dh_ptp_show_legacy_tables" type="checkbox" value="yes" <?php echo $dh_ptp_show_legacy_tables ?>/><br/>
								<label for="dh_ptp_show_legacy_tables" style="width: 50px" class="description"><?php _e('Enable for the option to build legacy pricing tables', 'easy-pricing-tables'); ?></div>
							</td>
						</tr>
					</tbody>
				</table>

			<?php
			settings_fields('dh_ptp_settings'); 
			submit_button();
			?>
	
		</form>
	</div>
	<?php
}

do_action( 'update_option_dh_ptp_show_legacy_tables', 'dh_ptp_show_legacy_tables' );


function dh_ptp_register_option() {
	// creates our settings in the options table
	register_setting('dh_ptp_settings', 'dh_ptp_show_legacy_tables');
}
add_action('admin_init', 'dh_ptp_register_option');

