
/* block.js */
var el = wp.element.createElement;
var $ = jQuery

var fca_ptp_presetColors = [
	{
		name: 'white',
		slug: 'fca-white',
		color: '#fff'
	},
	{
		name: 'Blue',
		slug: 'fca-blue',
		color: '#3498db'
	},
	{
		name: 'Deep Blue',
		slug: 'fca-deepblue',
		color: '#2980b9'
	},
	{
		name: 'Red',
		slug: 'fca-red',
		color: '#e74c3c'
	},
	{
		name: 'Deep Red',
		slug: 'fca-deepred',
		color: '#c0392b'
	},

]

var fca_ptp_defaultSettings = [
	{
		'columnPopular': false,
		'planText': 'Starter',
		'priceText': '$29',
		'featuresText': '<li>Feature 1</li><li>Feature 2</li><li>Feature 3</li><li>Feature 4</li>',
		'buttonText': 'Add to Cart',
		'buttonURL': 'https://www.fatcatapps.com'
	},
	{
		'columnPopular': false,
		'planText': 'Pro',
		'priceText': '$39',
		'featuresText': '<li>Feature 1</li><li>Feature 2</li><li>Feature 3</li><li>Feature 4</li>',
		'buttonText': 'Add to Cart',
		'buttonURL': 'https://www.fatcatapps.com'
	},
	{
		'columnPopular': false,
		'planText': 'Elite',
		'priceText': '$49',
		'featuresText': '<li>Feature 1</li><li>Feature 2</li><li>Feature 3</li><li>Feature 4</li>',
		'buttonText': 'Add to Cart',
		'buttonURL': 'https://www.fatcatapps.com'
	},
]

var fca_ptp_attributes = ( {

		// DYNAMIC COLUMN SETTINGS
		ptp_columnSettings: { type: 'array', default: fca_ptp_defaultSettings },
		ptp_selectedCol: { type: 'int', default: 0 }, 
		ptp_selectedSection: { type: 'string', default: 'plan' },
		ptp_showFontSizePickers: { type: 'string', default: 'none' },

		// FONT SETTINGS
		ptp_popularFontSize: { type: 'string', default: '20px' }, 
		ptp_planFontSize: { type: 'string', default: '22px' }, 
		ptp_priceFontSize: { type: 'string', default: '28px' }, 
		ptp_featuresFontSize: { type: 'string', default: '20px' }, 
		ptp_buttonFontSize: { type: 'string', default: '22px' }, 

		// BUTTON COLORS 
		ptp_buttonColor: { type: 'string', default: '#3498db' },
		ptp_buttonFontColor: { type: 'string', default: '#fff' },
		ptp_buttonBorderColor: { type: 'string', default: '#2980b9' },
		ptp_buttonHoverColor: { type: 'string', default: '#2980b9' },

		// POPULAR BUTTON COLORS 
		ptp_buttonColorPop: { type: 'string', default: '#e74c3c' },
		ptp_buttonFontColorPop: { type: 'string', default: '#fff' },
		ptp_buttonBorderColorPop: { type: 'string', default: '#c0392b' },
		ptp_buttonHoverColorPop: { type: 'string', default: '#c0392b' },

		// EXTRA SETTINGS
		ptp_columnHeight: { type: 'string', default: 'auto' },
		ptp_columnHeightToggle: { type: 'boolean', default: true }, 
		ptp_columnHeightTooltip: { type: 'string', default: 'none' },
		ptp_popularText: { type: 'string', default: 'Most Popular' },
		ptp_popularToolbarIcon: { type: 'string', default: 'star-empty' }, 
		ptp_urlTarget: { type: 'string', default: '_self' },
		ptp_urlTargetToggle: { type: 'boolean', default: false }, 
		ptp_showURLPopover: { type: 'string', value: 'none' },
		ptp_showHTMLPopover: { type: 'string', value: 'none' },
		ptp_borderRadius: { type: 'string', default: '4' },

	}
)

function fca_ptp_block_edit( props ) {

	var $ = jQuery
	var columnSettings = props.attributes.ptp_columnSettings
	var selectedLayout = props.attributes.selectedLayout
	var selectedCol = props.attributes.ptp_selectedCol

	return el( wp.element.Fragment, { },

		fca_ptp_toolbar_controls( props ),
		fca_ptp_sidebar_settings( props ),

		el( 'div', { 
			style: { 
				alignItems: props.attributes.ptp_columnHeight === 'auto' ? 'stretch' : 'flex-end',
			}, 
			className: 'fca-ptp-' + selectedLayout ,
			onBlur: ( function(){ 
				var columnSettingsData = Array.from( props.attributes.ptp_columnSettings )
				props.setAttributes( { ptp_columnSettings: columnSettingsData } )
			} ) },
			Array.from( props.attributes.ptp_columnSettings, function( x, i ) {
				
				return el( 'div', { 
						style: { borderRadius: props.attributes.ptp_borderRadius + 'px' },
						className: columnSettings[i].columnPopular ? 'fca-ptp-column fca-ptp-most-popular' : 'fca-ptp-column',
						onClick: ( function() { 
							fca_ept_select_column( props, i )
						}),
					},

					el( 'div', { 
						style: { borderRadius: props.attributes.ptp_borderRadius + 'px' },
						className: columnSettings[i].columnPopular ? 'fca-ptp-popular fca-ptp-most-popular' : 'fca-ptp-popular',
						},

						el(wp.editor.RichText, { 
							style: { 
								fontSize: props.attributes.ptp_popularFontSize,
							},
							placeholder: 'Most Popular', 
							type: "text", 
							tagName: 'span',
							value: props.attributes.ptp_popularText, 
							onClick: ( function() { 
								fca_ept_select_section( props, 'popular', i ) 
							} ),
							onChange: ( function( newValue ) { 
								props.setAttributes( { ptp_popularText: newValue } )
							} )
						}),
					),

					el( 'div', { 
						style: {
							borderTopLeftRadius: props.attributes.ptp_borderRadius + 'px',
							borderTopRightRadius: props.attributes.ptp_borderRadius + 'px',
						},
						className: 'fca-ptp-plan',
						},
						el(wp.editor.RichText, { 
							style: { 
								fontSize: props.attributes.ptp_planFontSize,
							}, 
							placeholder: 'Plan name', 
							type: "text", 
							tagName: 'span',
							value: columnSettings[i].planText, 
							onClick: ( function() { 
								fca_ept_select_section( props, 'plan', i ) 
							} ),
							onChange: ( function( newValue ) { 
								var columnSettingsData = Array.from( props.attributes.ptp_columnSettings )
								columnSettingsData[props.attributes.ptp_selectedCol].planText = newValue
								props.setAttributes( { ptp_columnSettings: columnSettingsData } )
							} )
						}),
					),

					el( 'div', { 
						className: 'fca-ptp-price',
						},
						el(wp.editor.RichText, { 
							style: { 
								fontSize: props.attributes.ptp_priceFontSize,
							}, 
							placeholder: '$29', 
							type: "text", 
							tagName: 'span',
							value: columnSettings[i].priceText, 
							onClick: ( function( section ) { 
								fca_ept_select_section( props, 'price', i )
							} ),
							onChange: ( function( newValue ) { 
								var columnSettingsData = Array.from( props.attributes.ptp_columnSettings )
								columnSettingsData[props.attributes.ptp_selectedCol].priceText = newValue
								props.setAttributes( { ptp_columnSettings: columnSettingsData } )
							} )
						}),
					),

					el( 'div', { 
						className: 'fca-ptp-bullet-item',
						},
						el(wp.editor.RichText, { 
							style: { 
								fontSize: props.attributes.ptp_featuresFontSize,
							}, 
							tagName: 'ul', 
							multiline: 'li', 
							placeholder: 'features offered', 
							type: "text", 
							value: columnSettings[i].featuresText, 
							onClick: ( function() { 
								fca_ept_select_section( props, 'features', i )
							} ),
							onChange: ( function( newValue ) { 
								var columnSettingsData = Array.from( props.attributes.ptp_columnSettings )
								columnSettingsData[props.attributes.ptp_selectedCol].featuresText = newValue
								props.setAttributes( { ptp_columnSettings: columnSettingsData } )
							} )
						}),
					),

					el( 'div', { 
						style: {
							borderBottomLeftRadius: props.attributes.ptp_borderRadius + 'px',
							borderBottomRightRadius: props.attributes.ptp_borderRadius + 'px',
						},
						className: 'fca-ptp-cta',
						},

						el( 'a', { 
							style: {
								fontSize: props.attributes.ptp_buttonFontSize,
								borderRadius: props.attributes.ptp_borderRadius + 'px',
								backgroundColor: columnSettings[i].columnPopular ? props.attributes.ptp_buttonColorPop : props.attributes.ptp_buttonColor,
								color: columnSettings[i].columnPopular ? props.attributes.ptp_buttonFontColorPop : props.attributes.ptp_buttonFontColor,
								borderBottom: columnSettings[i].columnPopular ? props.attributes.ptp_buttonBorderColorPop + ' 2px solid' : props.attributes.ptp_buttonBorderColor + ' 2px solid',
							}, 
							className: 'fca-ptp-button', 
							onClick: ( function() { 
								fca_ept_select_section( props, 'button', i ) 
							} ),
							onMouseOver: ( function() {
								fca_ept_change_button_color( props, i )
							} ),
							onMouseOut: ( function() {
								fca_ept_reset_button_color( props, i )
							} ),
							type: 'button', 
						},
							el(wp.editor.RichText, { 
								placeholder: 'Add to Cart', 
								type: "text", 
								tagName: 'span',
								value: columnSettings[i].buttonText, 
								onChange: ( function( newValue ) { 
									var columnSettingsData = Array.from( props.attributes.ptp_columnSettings )
									columnSettingsData[props.attributes.ptp_selectedCol].buttonText = newValue
									props.setAttributes( { ptp_columnSettings: columnSettingsData } ) 
								} ),
							}),
						),
					),
				) // end column div
			}) // end array
		) // end main div
	) // end fragment
}

function fca_ptp_toolbar_controls( props ){

	var columnSettings = props.attributes.ptp_columnSettings
	var IncreaseFontsizeIcon = ( el("svg", {
			role: "img",
			focusable: "false",
			viewBox: "0 0 24 24",
			width: "24",
			height: "24"
			}, 
			el("path", {
				d: "M2 4V7H7V19H10V7H15V4H2Z",
				fill: "#111111"
			}),
			el("rect",{
				x: "13",
				y: "12",
				width: "8",
				height: "2",
				fill: "#000"
			}),
			el("rect",{
				x: "18",
				y: "9",
				width: "8",
				height: "2",
				transform: "rotate(90 18 9)",
				fill: "#000"
			}),
		)
	)

	var DecreaseFontsizeIcon = ( el("svg", {
			role: "img",
			focusable: "false",
			viewBox: "0 0 24 24",
			width: "24",
			height: "24"
			}, 
			el("path", {
				d: "M4 4V7H9V19H12V7H17V4H4Z",
				fill: "#111111"
			}),
			el("rect",{
				x: "15",
				y: "12",
				width: "6",
				height: "2",
				fill: "#000"
			}),
		) 
	)

	var changeButtonURL = ( el("svg", {
			role: "img",
			focusable: "false",
			viewBox: "0 0 24 24",
			width: "24",
			height: "24"
			}, 
			el("path", {
				d: "M15.6 7.2H14v1.5h1.6c2 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7H14v1.5h1.6c2.8 0 5.2-2.3 5.2-5.2 0-2.9-2.3-5.2-5.2-5.2zM4.7 12.4c0-2 1.7-3.7 3.7-3.7H10V7.2H8.4c-2.9 0-5.2 2.3-5.2 5.2 0 2.9 2.3 5.2 5.2 5.2H10v-1.5H8.4c-2 0-3.7-1.7-3.7-3.7zm4.6.9h5.3v-1.5H9.3v1.5z",
			}),
		)
	)

	// TOOLBAR CONTROLS
	return( el( wp.editor.BlockControls, { key: 'controls' },

		el( wp.components.ToolbarButton, { icon: 'plus-alt', label: 'Add column', onClick: ( function(){ fca_ptp_add_column( props ) } ) } ),
		el( wp.components.ToolbarButton, { icon: 'trash', label: 'Remove selected column', onClick: ( function(){ fca_ept_del_column( props ) } ) } ),
		el( wp.components.ToolbarButton, { icon: props.attributes.ptp_popularToolbarIcon, label: 'Set as most popular', onClick: ( function() { fca_ept_set_popular( props ) } ) } ),
		el( wp.components.ToolbarButton, { icon: 'arrow-left-alt', label: 'Move selected column to the left', onClick: ( function(){ fca_ept_move_column( props, 'left' ) } ) } ),
		el( wp.components.ToolbarButton, { icon: 'arrow-right-alt', label: 'Move selected column to the right', onClick: ( function(){ fca_ept_move_column( props, 'right' ) } ) } ),
		el( wp.components.ToolbarButton, { 
			icon: 'html', 
			label: 'Copy table HTML', 
			onClick: ( function(){ 
				fca_ptp_copy_html( props ) 
				props.setAttributes( { ptp_showHTMLPopover: 'block' } )
			} ),
			onMouseOver: ( function(){ props.setAttributes( { ptp_showHTMLPopover: 'none' } ) } ),
			},
		),
		el( wp.components.Popover, {
			style: {
				display: props.attributes.ptp_showHTMLPopover ? props.attributes.ptp_showHTMLPopover : 'none',
			},
		},
			el( 'p', { 
				className: 'fca-ptp-copyhtml-popover',
			},
				'Successfully copied table HTML to clipboard!'
			),
		),
		el( wp.components.Popover, {
			style: { 
				display: props.attributes.ptp_showURLPopover ? props.attributes.ptp_showURLPopover : 'none',
			},
			className: 'fca-ptp-url-popover',
			onFocusOutside: ( function(){ 
				props.setAttributes( { ptp_showURLPopover: 'none' } )
			} ),
		},

			el( wp.components.TextControl, { 
				className: 'fca-ptp-url-input',
				value: columnSettings.length > props.attributes.ptp_selectedCol ? columnSettings[props.attributes.ptp_selectedCol].buttonURL : columnSettings[props.attributes.ptp_selectedCol-1].buttonURL,
				onChange: (                                                                                                                                 
					function( newValue ){ 

						var columnSettingsData = Array.from( props.attributes.ptp_columnSettings )
						columnSettingsData[props.attributes.ptp_selectedCol].buttonURL = newValue
						props.setAttributes( { [columnSettings]: columnSettingsData } ) 

					} 
				)
			}),
			el( wp.components.PanelHeader, { label: 'Open in new tab' },
				el( wp.components.ToggleControl, { 
					checked: props.attributes.ptp_urlTargetToggle,
					className: 'fca-ptp-toggle',
					onChange: (
						function( newValue ){ 
							if ( newValue ){
								props.setAttributes( { ptp_urlTarget: '_blank' } )

							} else {
								props.setAttributes( { ptp_urlTarget: '_self' } )
							}
							props.setAttributes( { ptp_urlTargetToggle: newValue } )
						}
					),
				}),
			),
		),
		el( wp.components.ToolbarButton, { style: { display: props.attributes.ptp_showFontSizePickers }, className: 'fca-ptp-increase-fontsize', icon: IncreaseFontsizeIcon, label: 'Increase font size', onClick: ( function(){ fca_ept_increase_fontsize( props, props.attributes.ptp_selectedSection ) } ) } ),
		el( wp.components.ToolbarButton, { style: { display: props.attributes.ptp_showFontSizePickers }, icon: DecreaseFontsizeIcon, label: 'Decrease font size', onClick: ( function(){ fca_ept_decrease_fontsize( props, props.attributes.ptp_selectedSection ) } ) } ),
	))
}

function fca_ptp_sidebar_settings( props ){

	var columnSettings = props.attributes.ptp_columnSettings
	return el( wp.editor.InspectorControls, { key: 'controls' },

		el( wp.components.PanelBody, { title: 'Featured Button Colors', initialOpen: false },

			el( wp.editor.PanelColorSettings, {
				title: 'Button Color',
				className: 'fca-ptp-colorpicker',
				initialOpen: false,
				colorSettings: [{
					colors: fca_ptp_presetColors,
					label: 'Currently:',
					disableCustomColors: false,
					value: props.attributes.ptp_buttonColorPop,
					onChange: ( function( newValue ){ props.setAttributes( { ptp_buttonColorPop: newValue } ) } ),
				}]
			}),

			el( wp.editor.PanelColorSettings, {
				title: 'Button Font Color',
				className: 'fca-ptp-colorpicker',
				initialOpen: false,
				colorSettings: [{
					colors: fca_ptp_presetColors,
					label: 'Currently:',
					disableCustomColors: false,
					value: props.attributes.ptp_buttonFontColorPop,
					onChange: ( function( newValue ){ props.setAttributes( { ptp_buttonFontColorPop: newValue } ) } ),
				}]
			}),

			el( wp.editor.PanelColorSettings, {
				title: 'Button Hover Color',
				className: 'fca-ptp-colorpicker',
				initialOpen: false,
				colorSettings: [{
					colors: fca_ptp_presetColors,
					label: 'Currently:',
					disableCustomColors: false,
					value: props.attributes.ptp_buttonHoverColorPop,
					onChange: ( function( newValue ){ props.setAttributes( { ptp_buttonHoverColorPop: newValue } ) } ),
				}]
			}),

			el( wp.editor.PanelColorSettings, {
				title: 'Button Border Color',
				className: 'fca-ptp-colorpicker',
				initialOpen: false,
				colorSettings: [{
					colors: fca_ptp_presetColors,
					label: 'Currently:',
					disableCustomColors: false,
					value: props.attributes.ptp_buttonBorderColorPop,
					onChange: ( function( newValue ){ props.setAttributes( { ptp_buttonBorderColorPop: newValue } ) } ),
				}]
			}),
		),


		el( wp.components.PanelBody, { title: 'Unfeatured Button Colors', initialOpen: false, className: 'test321'},

			el( wp.editor.PanelColorSettings, {
				title: 'Button Color',
				className: 'fca-ptp-colorpicker',
				initialOpen: false,
				colorSettings: [{
					colors: fca_ptp_presetColors,
					label: 'Currently:',
					disableCustomColors: false,
					value: props.attributes.ptp_buttonColor,
					onChange: ( function( newValue ){ props.setAttributes( { ptp_buttonColor: newValue } ) } ),
				}]
			}),

			el( wp.editor.PanelColorSettings, {
				title: 'Button Font Color',
				className: 'fca-ptp-colorpicker',
				initialOpen: false,
				colorSettings: [{
					colors: fca_ptp_presetColors,
					label: 'Currently:',
					disableCustomColors: false,
					value: props.attributes.ptp_buttonFontColor,
					onChange: ( function( newValue ){ props.setAttributes( { ptp_buttonFontColor: newValue } ) } ),
				}]
			}),

			el( wp.editor.PanelColorSettings, {
				title: 'Button Hover Color',
				className: 'fca-ptp-colorpicker',
				initialOpen: false,
				colorSettings: [{
					colors: fca_ptp_presetColors,
					label: 'Currently:',
					disableCustomColors: false,
					value: props.attributes.ptp_buttonHoverColor,
					onChange: ( function( newValue ){ props.setAttributes( { ptp_buttonHoverColor: newValue } ) } ),
				}]
			}),

			el( wp.editor.PanelColorSettings, {
				title: 'Button Border Color',
				className: 'fca-ptp-colorpicker',
				initialOpen: false,
				colorSettings: [{
					colors: fca_ptp_presetColors,
					label: 'Currently:',
					disableCustomColors: false,
					value: props.attributes.ptp_buttonBorderColor,
					onChange: ( function( newValue ){ props.setAttributes( { ptp_buttonBorderColor: newValue } ) } ),
				}]
			}),
		),

		el( wp.components.PanelHeader, { label: 'Border Radius (px)' },
			el( wp.components.TextControl, { 
				className: 'fca-ptp-input',
				value: props.attributes.ptp_borderRadius,
				onChange: ( 
					function( newValue ){ 
						props.setAttributes( { ptp_borderRadius: newValue } ) 
				})
			}),
		),

		el( wp.components.PanelHeader, { label: 'Match column height' },
			el( wp.components.Icon, {
				icon: 'editor-help',
				className: 'fca-ptp-tooltip',
				onMouseOver: ( function(){
					props.setAttributes({ ptp_columnHeightTooltip: 'block' } )
				}),
				onMouseOut: ( function(){
					props.setAttributes({ ptp_columnHeightTooltip: 'none' } )
				})
			}),
			el( wp.components.Popover, {
				style: { 
					display: props.attributes.ptp_columnHeightTooltip,
				},
			},
				el( 'p', { 
					className: 'fca-ptp-sidebar-popover',
				},
					'Force all columns to be the same height. Useful if some columns have more features rows than others.',
				),
			),
			el( wp.components.ToggleControl, { 
				checked: props.attributes.ptp_columnHeightToggle,
				className: 'fca-ptp-toggle',
				onChange: (
					function( newValue ){ 
						if ( newValue ){
							props.setAttributes( { ptp_columnHeight: 'auto' } )
						} else {
							props.setAttributes( { ptp_columnHeight: 'fit-content' } )
						}
						props.setAttributes( { ptp_columnHeightToggle: newValue } )
					}
				),
			}),
		),
		el( wp.components.Button, { 
			style: {
				padding: '15px',
			},
			className: 'components-button is-link',
			onClick: ( function(){ 
				props.setAttributes({ align: 'full' } )
				props.setAttributes({ selectedLayout: '' } ) 
			} ),
		},
			'Choose a different layout',
		),

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


function fca_ptp_copy_html( props ){

	var outputHTML = `<div style="align-items: ` + props.attributes.ptp_columnHeight + `" class="wp-block-fatcatapps-pricing-table-blocks align` + props.attributes.align + ` fca-ptp-` + props.attributes.selectedLayout +`">`
	
	props.attributes.ptp_columnSettings.forEach(function(column){

		var columnPopular = column.columnPopular
		var showPopular = column.columnPopular ? 'fca-ptp-most-popular' : ''

		var buttonColor = column.columnPopular ? props.attributes.ptp_buttonColorPop : props.attributes.ptp_buttonColor
		var buttonFontColor = column.columnPopular ? props.attributes.ptp_buttonFontColorPop : props.attributes.ptp_buttonFontColor
		var buttonBorderColor = column.columnPopular ? props.attributes.ptp_buttonBorderColorPop : props.attributes.ptp_buttonBorderColor

		var buttonHoverColor = props.attributes.ptp_buttonHoverColor
		var buttonHoverColorPop = props.attributes.ptp_buttonHoverColorPop

		outputHTML += `<style>
							.fca-ptp-column a.fca-ptp-button:hover{ background-color: ` + props.attributes.ptp_buttonHoverColor + ` !important; } 
							.fca-ptp-column.fca-ptp-most-popular a.fca-ptp-button:hover{ background-color: ` + props.attributes.ptp_buttonHoverColorPop + ` !important; } 
						</style>

						<div style="border-radius: ` + props.attributes.ptp_borderRadius + `" class="fca-ptp-column ` + showPopular + `">

							<div style="font-size: ` + props.attributes.ptp_popularFontSize + `; border-radius: ` + props.attributes.ptp_borderRadius + `" class="fca-ptp-popular ` + showPopular + `">` + props.attributes.ptp_popularText + `</div>

							<div style="border-top-left-radius: ` + props.attributes.ptp_borderRadius + `; border-top-right-radius: ` + props.attributes.ptp_borderRadius + `; font-size: ` + props.attributes.ptp_planFontSize + `" class="fca-ptp-plan">` + column.planText + `</div>

							<div style="font-size: ` + props.attributes.ptp_priceFontSize + `" class="fca-ptp-price">` + column.priceText + `</div>

							<div style="font-size: ` + props.attributes.ptp_featuresFontSize + `" class="fca-ptp-bullet-item">

								<ul>` + column.featuresText + `</ul>
									
							</div>

							<div style="border-bottom-left-radius: ` + props.attributes.ptp_borderRadius + `; border-bottom-right-radius: ` + props.attributes.ptp_borderRadius + `" class="fca-ptp-cta">

								<a style="font-size: ` + props.attributes.ptp_buttonFontSize + `; color: ` + buttonFontColor + `; background-color: ` + buttonColor + `; border-radius: ` + props.attributes.ptp_borderRadius + `; border-bottom: ` + buttonBorderColor + ` 4px solid" class="fca-ptp-button" href=` + column.buttonURL + `>` + column.buttonText + `</a>

							</div>

						</div>`
	})

	outputHTML += `</div>`

	// copy HTML to clipboard
	var tempTextarea = document.createElement("textarea")
	document.body.appendChild(tempTextarea)
	tempTextarea.value = outputHTML
	tempTextarea.select()
	document.execCommand("copy")
	document.body.removeChild(tempTextarea)

}


function fca_ptp_add_column( props ){
	
	var columnCount = props.attributes.ptp_columnSettings.length

	var planDefaults = [
		'Starter',
		'Pro',
		'Elite',
		'Custom',
	]

	var newList = Array.from( props.attributes.ptp_columnSettings )
	
	newList.push( {
		'columnPopular': false,
		'planText': planDefaults[ columnCount ],
		'priceText': '$' + Number( 29 + ( ( columnCount ) * 10 ) ),
		'featuresText': '<li>Feature 1</li><li>Feature 2</li><li>Feature 3</li><li>Feature 4</li>',
		'buttonText': 'Add to Cart',
		'buttonURL': 'https://www.fatcatapps.com'
	} )
	
	props.setAttributes( { ptp_columnSettings: newList } )

}

