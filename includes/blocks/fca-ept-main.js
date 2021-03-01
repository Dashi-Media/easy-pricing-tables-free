
/* block.js */
var el = wp.element.createElement;
var $ = jQuery

var fca_ept_defaultSettings = [
	{
		'columnPopular': false,
		'planText': 'Starter',
		'planSubText': 'For getting started',
		'priceText': '$29',
		'pricePeriod': 'per month',
		'priceBilling': 'billed annually',
		'featuresText': '<li>Feature 1</li><li>Feature 2</li><li>Feature 3</li><li>Feature 4</li>',
		'buttonText': 'Add to Cart',
		'buttonURL': 'https://www.fatcatapps.com'
	},
	{
		'columnPopular': false,
		'planText': 'Pro',
		'planSubText': 'Best for most users',
		'priceText': '$39',
		'pricePeriod': 'per month',
		'priceBilling': 'billed annually',
		'featuresText': '<li>Feature 1</li><li>Feature 2</li><li>Feature 3</li><li>Feature 4</li>',
		'buttonText': 'Add to Cart',
		'buttonURL': 'https://www.fatcatapps.com'
	},
	{
		'columnPopular': false,
		'planText': 'Elite',
		'planSubText': 'For enterprises',
		'priceText': '$49',
		'pricePeriod': 'per month',
		'priceBilling': 'billed annually',
		'featuresText': '<li>Feature 1</li><li>Feature 2</li><li>Feature 3</li><li>Feature 4</li>',
		'buttonText': 'Add to Cart',
		'buttonURL': 'https://www.fatcatapps.com'
	},
]

var fca_ept_main_attributes = ( {

		type: { type: 'string', default: 'default' }, 
		content: { type: 'array', source: 'children', selector: 'p' },
		target: { type: 'string', default: '' }, 
		align: { type: 'string', default: 'wide' },
		selectedLayout: { type: 'string', default: '' },
		ept_columnSettings: { type: 'array', default: fca_ept_defaultSettings },

	}
)

wp.blocks.registerBlockType('fatcatapps/easy-pricing-tables', {

	title: 'Pricing Table',

	icon: el("svg", {
			role: "img",
			focusable: "false",
			viewBox: "0 0 24 24",
			width: "24",
			height: "24",
			fill: '#111111',
			}, 
			el("path", {
				d: "M12 2C6.475 2 2 6.475 2 12C2 17.525 6.475 22 12 22C17.525 22 22 17.525 22 12C22 6.475 17.525 2 12 2ZM13.415 18.09V20H10.75V18.07C9.045 17.705 7.585 16.61 7.48 14.665H9.435C9.535 15.715 10.255 16.53 12.085 16.53C14.05 16.53 14.485 15.55 14.485 14.94C14.485 14.115 14.04 13.33 11.82 12.8C9.34 12.205 7.64 11.18 7.64 9.13C7.64 7.415 9.025 6.295 10.75 5.92V4H13.415V5.945C15.275 6.4 16.205 7.805 16.27 9.33H14.3C14.245 8.22 13.66 7.465 12.08 7.465C10.58 7.465 9.68 8.14 9.68 9.11C9.68 9.955 10.33 10.495 12.345 11.02C14.365 11.545 16.525 12.405 16.525 14.93C16.525 16.755 15.145 17.76 13.415 18.09Z"
			})
		),

	category: 'common',

	attributes: { 
		...fca_ept_main_attributes,
		...fca_ept_attributes,
		...fca_ptp_attributes,
	},

	supports: { align: true },

	edit: fca_ept_main_edit,

	save: fca_ept_main_save

})

function fca_ept_main_edit( props ) {

	if ( props.attributes.selectedLayout === 'layout1' ){
		return fca_ptp_block_edit(props)
	} else if ( props.attributes.selectedLayout === 'layout2'){
		return fca_ept_block_edit(props)
	} else {
		return el( wp.element.Fragment, { },

			fca_ept_main_sidebar(),
			el( 'div', { 
				className: 'fca-ept-layout-selection',
				},
				el('div', {
					className: 'layout-title',
				},'Select your layout'),

				el('div', {
					className: 'img-container'},

					el('div', {
						className: 'layout-name',
					},
						el('svg', {
							className: 'layout1',
							role: 'img',
							onClick: ( function() { 
								props.setAttributes({ align: 'wide' } )
								props.setAttributes({ selectedLayout: 'layout1'})
							}),
							
						}),
					'Layout1'),

					el('div', {
						className: 'layout-name',
					},
						el('svg', {
							className: 'layout2',
							role: 'img',
							onClick: ( function() { 
								props.setAttributes({ align: 'wide' } )
								props.setAttributes({ selectedLayout: 'layout2'})
							}),
							
						}),
					'Layout2'),
				),
			), // end div
		)
	} // end else
}

function fca_ept_main_save( props ) {
	return null;
}

function fca_ept_main_sidebar(){

	return el( wp.editor.InspectorControls, { key: 'controls' },

			el( wp.components.PanelBody, { 
				className: 'fca-ept-get-premium',
				title: 'Upgrade to premium',
				initialOpen: true },
				el( 'ul', {
					className: 'get-premium-features' },

					el( 'li', { },

						el( 'div', {
							className: 'dashicons dashicons-yes' },
						), 'More beautiful layouts'

					),

					el( 'li', { },

						el( 'div', {
							className: 'dashicons dashicons-yes' },
						), 'Add images to your tables'

					),

					el( 'li', { },

						el( 'div', {
							className: 'dashicons dashicons-yes' },
						), 'Comparison tables'

					),

					el( 'li', { },

						el( 'div', {
							className: 'dashicons dashicons-yes' },
						), 'WooCommerce integration'

					),

					el( 'li', { },

						el( 'div', {
							className: 'dashicons dashicons-yes' },
						), 'More customization options'

					),

					el( 'li', { },

						el( 'div', {
							className: 'dashicons dashicons-yes' },
						), 'Fast & friendly email support'

					),

					el( 'a', {
						type: 'button',
						href: 'https://www.fatcatapps.com/easypricingtables/pricing',
						className: 'get-premium-button',
					}, 'Learn more')

				),
				
			),
		)
}

/********************/
/* Shared functions */
/********************/

function fca_ept_increase_fontsize ( props, section ){

	var layout = props.attributes.selectedLayout === 'layout1' ? 'ptp_' : 'ept_'
	var fontSizeStr = eval('props.attributes.' + layout + section + 'FontSize').toString()
	var fontSizeAttr = layout + section + 'FontSize'

	fontsize = ( parseInt( fontSizeStr.slice(0,-2) ) ) + 2
	props.setAttributes( { [fontSizeAttr]: fontsize + 'px' } )

}

function fca_ept_decrease_fontsize ( props, section ){

	var layout = props.attributes.selectedLayout === 'layout1' ? 'ptp_' : 'ept_'
	var fontSizeStr = eval('props.attributes.' + layout + section + 'FontSize').toString()
	var fontSizeAttr = layout + section + 'FontSize'

	fontsize = ( parseInt( fontSizeStr.slice(0,-2) ) ) - 2
	props.setAttributes( { [fontSizeAttr]: fontsize + 'px' } )

}

function fca_ept_select_section ( props, section, id ) {

	var layout = props.attributes.selectedLayout === 'layout1' ? 'ptp_' : 'ept_'
	var sectionAttr = layout + 'selectedSection'
	var showURLPopoverAttr = layout + 'showURLPopover'
	var showFontSizePickersStr = eval('props.attributes.' + layout + 'showFontSizePickers').toString()
	var showFontSizePickersAttr = layout + 'showFontSizePickers'

	props.setAttributes( { [sectionAttr]: section } )

	if ( section === 'button' ){ 
		props.setAttributes( { [showURLPopoverAttr]: 'block' } )
	} else {
		props.setAttributes( { [showURLPopoverAttr]: 'none' } )
	}

	if ( showFontSizePickersStr === 'none' ){
		props.setAttributes ( { [showFontSizePickersAttr]: 'inline-flex' } )
	} 
	
}

function fca_ept_set_popular ( props ) {

	var layout = props.attributes.selectedLayout === 'layout1' ? 'ptp_' : 'ept_'
	var columnSettings = eval('props.attributes.' + layout + 'columnSettings')
	var selectedCol = parseInt(eval('props.attributes.' + layout + 'selectedCol'))
	var popularToolbarIconAttr = layout + 'popularToolbarIcon'
	
	columnSettings.filter(function (col, i){

		if ( i === selectedCol ){ 
			if ( col.columnPopular ){
				col.columnPopular = false
				props.setAttributes ( { [columnSettings]: columnSettings } )
				props.setAttributes ( { [popularToolbarIconAttr]: 'star-empty' } )
			} else {
				col.columnPopular = true
				props.setAttributes ( { [columnSettings]: columnSettings } )
				props.setAttributes ( { [popularToolbarIconAttr]: 'star-filled' } )
			}
		} else {
			col.columnPopular = false
			props.setAttributes ( { [columnSettings]: columnSettings } )
		}
	})
}

function fca_ept_select_column ( props, id ) {

	var layout = props.attributes.selectedLayout === 'layout1' ? 'ptp' : 'ept'
	var columnSettings = eval('props.attributes.' + layout + '_columnSettings')
	var selectedColAttr = layout + '_selectedCol'
	var popularToolbarIconAttr = layout + '_popularToolbarIcon'

	props.setAttributes ( { [selectedColAttr]: id } )

	$('.fca-' + layout + '-column').filter( function(i,column){
		column.classList.remove('fca-' + layout + '-selected-column')
	})
	$('.fca-' + layout + '-column')[id].classList.add('fca-' + layout + '-selected-column')

	if ( columnSettings[id].columnPopular ){
		props.setAttributes ( { ptp_popularToolbarIcon: 'star-filled' } )
	} else {
		props.setAttributes ( { ptp_popularToolbarIcon: 'star-empty' } )
	}

}

function fca_ept_move_column ( props, direction ) {

	var layout = props.attributes.selectedLayout === 'layout1' ? 'ptp_' : 'ept_'
	var columnSettings = eval('props.attributes.' + layout + 'columnSettings')
	var selectedCol = parseInt(eval('props.attributes.' + layout + 'selectedCol'))

	if ( direction === 'left' && selectedCol !== 0 ){
		var fromPosition = selectedCol
		var toPosition = fromPosition -1
	}
	if ( direction === 'right' && selectedCol < ( columnSettings.length -1 ) ){
		var fromPosition = selectedCol
		var toPosition = fromPosition +1
	}

	if ( fromPosition || toPosition ){
		var columnData = columnSettings.splice(fromPosition, 1)[0]
		columnSettings.splice(toPosition, 0, columnData);
		props.setAttributes( { [columnSettings]: columnSettings } ) 
		fca_ept_select_column( props, toPosition )
	}
}

function fca_ept_del_column ( props ) {

	var layout = props.attributes.selectedLayout === 'layout1' ? 'ptp_' : 'ept_'
	var columnSettings = eval('props.attributes.' + layout + 'columnSettings')
	var selectedCol = parseInt(eval('props.attributes.' + layout + 'selectedCol'))

	if ( columnSettings.length > 1 ){
		var columnData = columnSettings.splice( selectedCol, 1 )
		columnSettings.splice( (selectedCol-1 ), 0 )
		props.setAttributes( { selectedCol: ( columnSettings.length -1 ) } )
		props.setAttributes( { [columnSettings]: columnSettings } ) 
	}
}

function fca_ept_change_button_color ( props, id ) {

	var layout = props.attributes.selectedLayout === 'layout1' ? 'ptp' : 'ept'
	var columnSettings = eval('props.attributes.' + layout + '_columnSettings')
	var columnPopular = columnSettings[id].columnPopular
	var buttonHoverColor = columnPopular ? eval('props.attributes.' + layout + '_buttonHoverColorPop') : eval('props.attributes.' + layout + '_buttonHoverColor')

	$('.fca-' + layout + '-button')[id].style.backgroundColor = buttonHoverColor
}

function fca_ept_reset_button_color ( props, id ) {

	var layout = props.attributes.selectedLayout === 'layout1' ? 'ptp' : 'ept'
	var columnSettings = eval('props.attributes.' + layout + '_columnSettings')
	var columnPopular = columnSettings[id].columnPopular
	var buttonColor = columnPopular ? eval('props.attributes.' + layout + '_buttonColorPop') : eval('props.attributes.' + layout + '_buttonColor')
	
	$('.fca-' + layout + '-button')[id].style.backgroundColor = buttonColor
}

function fca_ept_hexToRGB(hex, alpha, darken) {
	if ( hex ){
		if ( hex.length === 7 ){
			var r = parseInt(hex.slice(1, 3), 16),
				g = parseInt(hex.slice(3, 5), 16),
				b = parseInt(hex.slice(5, 7), 16)
		} 
		if ( hex.length === 4 ){
			var r = parseInt(hex.slice(1, 2) + hex.slice(1, 2), 16),
				g = parseInt(hex.slice(2, 3) + hex.slice(2, 3), 16),
				b = parseInt(hex.slice(3, 4) + hex.slice(3, 4), 16)
		}
		if (alpha) {
			return "rgba(" + r + "," + g + "," + b + "," + alpha + ")"
		} 
		if (darken) {
			if( ( r - darken ) > 0 ){ r -= darken } else { r = 0 }
			if( ( g - darken ) > 0 ){ g -= darken } else { g = 0 }
			if( ( b - darken ) > 0 ){ b -= darken } else { b = 0 }
			return "rgb(" + r + "," + g + "," + b + ")"
		}
	} else { return "rgb(255,255,255)" }
}
