
( function( blocks, editor, element ) {

	var createElement  = element.createElement
	var BlockControls = editor.BlockControls
	var SelectControl = wp.components.SelectControl
	var Toolbar = wp.components.Toolbar
	var tables = dh_ptp_gutenblock_script_data.tables

	blocks.registerBlockType( 'easy-pricing-tables/gutenblock', {
		title: 'Pricing Tables',
		icon: 'editor-table',
		category: 'widgets',
		keywords: ['pricing', 'table', 'tables' ],
		edit: function( props ) {
			return [
				createElement(
					BlockControls,
					{ 
						key: 'controls'
					},		
					createElement(
						SelectControl,
						{	
							className: 'dh-ptp-gutenblock-select',
							value: props.attributes.post_id,
							options: tables,
							onChange: function( newValue ){ props.setAttributes({ post_id: newValue }) }
						}
					),
					props.attributes.post_id == 0 ? '' : 
					createElement(
						'a',
						{	
							href: dh_ptp_gutenblock_script_data.editurl + '?post=' + props.attributes.post_id + '&action=edit',
							target: '_blank',
							className: 'dh-ptp-gutenblock-link'
						},
						'Edit'
					),
					createElement(
						'a',
						{	
							href: dh_ptp_gutenblock_script_data.newurl + '?post_type=easy-pricing-table',
							target: '_blank',
							className: 'dh-ptp-gutenblock-link'
						},
						'New'
					)
				),
				createElement( wp.components.ServerSideRender, {
					block: 'easy-pricing-tables/gutenblock',
					attributes:  props.attributes,
				})
			]
		},

		save: function( props ) {
			return null
		},
	} )
}(
	window.wp.blocks,
	window.wp.editor,
	window.wp.element
))