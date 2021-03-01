
/* block.js */
var el = wp.element.createElement;
var $ = jQuery

var fca_ept_presetColors = [
	{
		name: 'Black',
		slug: 'black',
		color: '#000'
	},
	{
		name: 'white',
		slug: 'fca-white',
		color: '#fff'
	},
	{
		name: 'Purple',
		slug: 'fca-purple',
		color: '#6236ff'
	},
	{
		name: 'Red',
		slug: 'fca-red',
		color: '#EA2027'
	},
	{
		name: 'Grey',
		slug: 'fca-grey',
		color: '#f2f2f2'
	},
]

var fca_ept_attributes = ( {

		// COLORS
		ept_layoutBGColor: { type: 'string', default: '#f2f2f2' }, 
		ept_layoutFontColor: { type: 'string', default: '#000' },
		ept_popularBGColor: { type: 'string', default: 'rgba(98,54,255,0.8)' },
		ept_buttonColor: { type: 'string', default: '#6236ff' },
		ept_buttonFontColor: { type: 'string', default: '#fff' },
		ept_accentColor: { type: 'string', default: '#6236ff' },

		// DYNAMIC COLUMN SETTINGS
		ept_selectedCol: { type: 'int', default: 0 }, 
		ept_selectedSection: { type: 'string', default: 'plan' },
		ept_showFontSizePickers: { type: 'string', default: 'none' },

		// FONT SETTINGS
		ept_popularFontSize: { type: 'string', default: '12px' }, 
		ept_planFontSize: { type: 'string', default: '48px' }, 
		ept_planSubtextFontSize: { type: 'string', default: '16px' }, 
		ept_priceFontSize: { type: 'string', default: '64px' }, 
		ept_pricePeriodFontSize: { type: 'string', default: '16px' }, 
		ept_priceBillingFontSize: { type: 'string', default: '13px' }, 
		ept_featuresFontSize: { type: 'string', default: '20px' }, 
		ept_buttonFontSize: { type: 'string', default: '24px' }, 

		// EXTRA SETTINGS
		ept_columnHeight: { type: 'string', default: 'auto' },
		ept_columnHeightToggle: { type: 'boolean', default: true }, 
		ept_columnHeightTooltip: { type: 'string', default: 'none' },
		ept_showPlanSubtext: { type: 'string', default: 'block' }, 
		ept_showPlanSubtextToggle: { type: 'boolean', default: true },
		ept_popularText: { type: 'string', default: 'Most Popular' },
		ept_popularToolbarIcon: { type: 'string', default: 'star-empty' }, 
		ept_showButtons: { type: 'string', default: 'grid' }, 
		ept_showButtonsToggle: { type: 'boolean', default: true },
		ept_urlTarget: { type: 'string', default: '_self' },
		ept_urlTargetToggle: { type: 'boolean', default: false }, 
		ept_showURLPopover: { type: 'string', value: 'none' },
		ept_showHTMLPopover: { type: 'string', value: 'none' },

	}
)

function fca_ept_block_edit( props ) {

	var $ = jQuery
	var columnSettings = props.attributes.ept_columnSettings
	var selectedLayout = props.attributes.selectedLayout
	var selectedCol = props.attributes.ept_selectedCol

	return el( wp.element.Fragment, { },

		fca_ept_toolbar_controls( props ),
		fca_ept_sidebar_settings( props ),

		el( 'div', { 
			style: { 
				textDecoration: 'none',
				alignItems: props.attributes.ept_columnHeight === 'auto' ? 'stretch' : 'flex-end',
			}, 
			className: 'fca-ept-' + selectedLayout ,
			onBlur: ( function(){ 
				var columnSettingsData = Array.from( props.attributes.ept_columnSettings )
				props.setAttributes( { ept_columnSettings: columnSettingsData } )
			} ) },
			Array.from( props.attributes.ept_columnSettings, function( x, i ) {
				return el( 'div', { 
					style: { 
						backgroundColor: props.attributes.ept_layoutBGColor,
						paddingTop: columnSettings[i].columnPopular ? '30px' : '45px',
						paddingBottom: props.attributes.ept_showButtons === 'grid' ? '30px' : '0px',
						marginTop: columnSettings[i].columnPopular ? '-5px' : '10px',
						border: columnSettings[i].columnPopular ? '2px solid ' + props.attributes.ept_buttonColor : '0px solid',
					},
						className: columnSettings[i].columnPopular ? 'fca-ept-column fca-ept-column-popular' : 'fca-ept-column',
						onClick: ( function() { 
							fca_ept_select_column( props, i )
						}),
					},

					el( 'div', { 
						style: { 
							display: columnSettings[i].columnPopular ? 'block' : 'none',
							borderColor: props.attributes.ept_buttonColor,
						},
						className: 'fca-ept-popular-div',
						},

						el(wp.editor.RichText, { 
							style: { 
								fontSize: props.attributes.ept_popularFontSize,
								color: props.attributes.ept_buttonFontColor,
								backgroundColor: props.attributes.ept_popularBGColor,
							},
							className: 'fca-ept-popular-text',
							placeholder: 'Most Popular', 
							type: "text", 
							tagName: 'span',
							value: props.attributes.ept_popularText, 
							onClick: ( function() { 
								fca_ept_select_section( props, 'popular', i ) 
							} ),
							onChange: ( function( newValue ) { 
								props.setAttributes( { ept_popularText: newValue } )
							} )
						}),
					),

					el( 'div', { 
						className: 'fca-ept-plan-div',
						},

						el(wp.editor.RichText, { 
							style: { 
								fontSize: props.attributes.ept_planFontSize,
								color: props.attributes.ept_accentColor,
							}, 
							className: 'fca-ept-plan', 
							placeholder: 'Plan name', 
							type: "text", 
							tagName: 'span',
							value: columnSettings[i].planText, 
							onClick: ( function() { 
								fca_ept_select_section( props, 'plan', i ) 
							} ),
							onChange: ( function( newValue ) { 
								var columnSettingsData = Array.from( props.attributes.ept_columnSettings )
								columnSettingsData[props.attributes.ept_selectedCol].planText = newValue
								props.setAttributes( { ept_columnSettings: columnSettingsData } )
							} )
						}),

						el(wp.editor.RichText, { 
							style: { 
								display: props.attributes.ept_showPlanSubtext,
								color: props.attributes.ept_layoutFontColor,
								fontSize: props.attributes.ept_planSubtextFontSize,
							}, 
							className: 'fca-ept-plan-subtext', 
							placeholder: 'To get started', 
							type: "text", 
							tagName: 'span',
							value: columnSettings[i].planSubText, 
							onClick: ( function() { fca_ept_select_section( props, 'planSubtext', i ) } ),
							onChange: ( function( newValue ) { 
								var columnSettingsData = Array.from( props.attributes.ept_columnSettings )
								columnSettingsData[props.attributes.ept_selectedCol].planSubText = newValue
								props.setAttributes( { ept_columnSettings: columnSettingsData } )
							} )
						}),
					),

					el( 'div', { 
						className: 'fca-ept-price-div',
						},

						el( 'div', { 
							className: 'fca-ept-price-container',
							},

							el(wp.editor.RichText, { 
								className: 'fca-ept-price',
								style: { 
									fontSize: props.attributes.ept_priceFontSize,
									color: props.attributes.ept_layoutFontColor,
								}, 
								placeholder: '$29', 
								type: "text", 
								tagName: 'span',
								value: columnSettings[i].priceText, 
								onClick: ( function( section ) { 
									fca_ept_select_section( props, 'price', i )
								} ),
								onChange: ( function( newValue ) { 
									var columnSettingsData = Array.from( props.attributes.ept_columnSettings )
									columnSettingsData[props.attributes.ept_selectedCol].priceText = newValue
									props.setAttributes( { ept_columnSettings: columnSettingsData } )
								} )
							}),

							el( 'div', { 
								className: 'fca-ept-price-subtext',
								},
								el ( 'svg', {
									className: 'fca-ept-price-svg',
									style: { 
										backgroundColor: props.attributes.ept_buttonColor 
									},
								}),
								el(wp.editor.RichText, { 
									style: { 
										fontSize: props.attributes.ept_pricePeriodFontSize,
										color: props.attributes.ept_layoutFontColor,
									},
									className: 'fca-ept-price-period', 
									placeholder: 'per month', 
									type: "text", 
									tagName: 'span',
									value: columnSettings[i].pricePeriod, 
									onClick: ( function() { 
										fca_ept_select_section( props, 'pricePeriod', i ) 
									} ),
									onChange: ( function( newValue ) { 
										var columnSettingsData = Array.from( props.attributes.ept_columnSettings )
										columnSettingsData[props.attributes.ept_selectedCol].pricePeriod = newValue
										props.setAttributes( { ept_columnSettings: columnSettingsData } )
									} )
								}),

								el(wp.editor.RichText, { 
									style: { 
										fontSize: props.attributes.ept_priceBillingFontSize,
										color: props.attributes.ept_layoutFontColor,
									},
									className: 'fca-ept-price-billing', 
									placeholder: 'billed annually', 
									type: "text", 
									tagName: 'span',
									value: columnSettings[i].priceBilling, 
									onChange: ( function( newValue ) { 
										var columnSettingsData = Array.from( props.attributes.ept_columnSettings )
										columnSettingsData[props.attributes.ept_selectedCol].priceBilling = newValue
										props.setAttributes( { ept_columnSettings: columnSettingsData } )
									} )
								}),
							),
						),
					),

					el( 'div', { 
						className: 'fca-ept-features-div',
						},
						el(wp.editor.RichText, { 
							style: { 
								fontSize: props.attributes.ept_featuresFontSize,
								color: props.attributes.ept_layoutFontColor,
							}, 
							className: 'fca-ept-features', 
							tagName: 'ul', 
							multiline: 'li', 
							placeholder: 'features offered', 
							type: "text", 
							value: columnSettings[i].featuresText, 
							onClick: ( function() { 
								fca_ept_select_section( props, 'features', i )
							} ),
							onChange: ( function( newValue ) { 
								var columnSettingsData = Array.from( props.attributes.ept_columnSettings )
								columnSettingsData[props.attributes.ept_selectedCol].featuresText = newValue
								props.setAttributes( { ept_columnSettings: columnSettingsData } )
							} )
						}),
					),

					el( 'a', { 
						style: {
							display: props.attributes.ept_showButtons,
							fontSize: props.attributes.ept_buttonFontSize,
							color: props.attributes.ept_buttonFontColor,
							backgroundColor: props.attributes.ept_buttonColor,
						}, 
						className: 'fca-ept-button', 
						onClick: ( function() { 
							fca_ept_select_section( props, 'button', i ) 
						} ),
						type: 'button', 
					},
						el(wp.editor.RichText, { 
							placeholder: 'Add to Cart', 
							type: "text", 
							tagName: 'span',
							value: columnSettings[i].buttonText, 
							onChange: ( function( newValue ) { 
								var columnSettingsData = Array.from( props.attributes.ept_columnSettings )
								columnSettingsData[props.attributes.ept_selectedCol].buttonText = newValue
								props.setAttributes( { ept_columnSettings: columnSettingsData } ) 
							} ),
						}),
					),
				) // end column div
			}) // end array
		) // end main div
	) // end fragment
}

function fca_ept_toolbar_controls( props ){

	var columnSettings = props.attributes.ept_columnSettings
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

		el( wp.components.ToolbarButton, { icon: 'plus-alt', label: 'Add column', onClick: ( function(){ fca_ept_add_column( props ) } ) } ),
		el( wp.components.ToolbarButton, { icon: 'trash', label: 'Remove selected column', onClick: ( function(){ fca_ept_del_column( props ) } ) } ),
		el( wp.components.ToolbarButton, { icon: props.attributes.ept_popularToolbarIcon, label: 'Set as most popular', onClick: ( function() { fca_ept_set_popular( props ) } ) } ),
		el( wp.components.ToolbarButton, { icon: 'arrow-left-alt', label: 'Move selected column to the left', onClick: ( function(){ fca_ept_move_column( props, 'left' ) } ) } ),
		el( wp.components.ToolbarButton, { icon: 'arrow-right-alt', label: 'Move selected column to the right', onClick: ( function(){ fca_ept_move_column( props, 'right' ) } ) } ),
		el( wp.components.ToolbarButton, { 
			icon: 'html', 
			label: 'Copy table HTML', 
			onClick: ( function(){ 
				fca_ept_copy_html( props ) 
				props.setAttributes( { ept_showHTMLPopover: 'block' } )
			} ),
			onMouseOut: ( function(){ props.setAttributes( { ept_showHTMLPopover: 'none' } ) } ),
			},
		),
		el( wp.components.Popover, {
			style: { 
				display: props.attributes.ept_showHTMLPopover ? props.attributes.ept_showHTMLPopover : 'none',
			},
		},
			el( 'p', { 
				className: 'fca-ept-copyhtml-popover',
			},
				'Successfully copied table HTML to clipboard!'
			),
		),
		el( wp.components.Popover, {
			style: { 
				display: props.attributes.ept_showURLPopover ? props.attributes.ept_showURLPopover : 'none',
			},
			className: 'fca-ept-url-popover',
			onFocusOutside: ( function(){ 
				props.setAttributes( { ept_showURLPopover: 'none' } )
			} ),
		},

			el( wp.components.TextControl, { 
				className: 'fca-ept-url-input',
				value: columnSettings.length > props.attributes.ept_selectedCol ? columnSettings[props.attributes.ept_selectedCol].buttonURL : columnSettings[props.attributes.ept_selectedCol-1].buttonURL,
				onChange: (                                                                                                                                 
					function( newValue ){ 

						var columnSettingsData = Array.from( props.attributes.ept_columnSettings )
						columnSettingsData[props.attributes.ept_selectedCol].buttonURL = newValue
						props.setAttributes( { [columnSettings]: columnSettingsData } ) 

					} 
				)
			}),
			el( wp.components.PanelHeader, { label: 'Open in new tab' },
				el( wp.components.ToggleControl, { 
					checked: props.attributes.ept_urlTargetToggle,
					className: 'fca-ept-toggle',
					onChange: (
						function( newValue ){ 
							if ( newValue ){
								props.setAttributes( { ept_urlTarget: '_blank' } )

							} else {
								props.setAttributes( { ept_urlTarget: '_self' } )
							}
							props.setAttributes( { ept_urlTargetToggle: newValue } )
						}
					),
				}),
			),
		),
		el( wp.components.ToolbarButton, { style: { display: props.attributes.ept_showFontSizePickers }, className: 'fca-ept-increase-fontsize', icon: IncreaseFontsizeIcon, label: 'Increase font size', onClick: ( function(){ fca_ept_increase_fontsize( props, props.attributes.ept_selectedSection ) } ) } ),
		el( wp.components.ToolbarButton, { style: { display: props.attributes.ept_showFontSizePickers }, icon: DecreaseFontsizeIcon, label: 'Decrease font size', onClick: ( function(){ fca_ept_decrease_fontsize( props, props.attributes.ept_selectedSection ) } ) } ),
	))
}

function fca_ept_sidebar_settings( props ){

	var columnSettings = props.attributes.ept_columnSettings
	return el( wp.editor.InspectorControls, { key: 'controls' },
					
		el( wp.editor.PanelColorSettings, {
			title: 'Background Color',
			className: 'fca-ept-colorpicker',
			initialOpen: false,
			colorSettings: [{
				colors: fca_ept_presetColors,
				label: 'Currently:',
				disableCustomColors: false,
				value: props.attributes.ept_layoutBGColor,
				onChange: ( function( newValue ){ props.setAttributes( { ept_layoutBGColor: newValue } ) } ),
			}]
		}),

		el( wp.editor.PanelColorSettings, {
			title: 'Font Color',
			className: 'fca-ept-colorpicker',
			initialOpen: false,
			colorSettings: [{
				colors: fca_ept_presetColors,
				label: 'Currently:',
				disableCustomColors: false,
				value: props.attributes.ept_layoutFontColor,
				onChange: ( function( newValue ){ props.setAttributes( { ept_layoutFontColor: newValue } ) } ),
			}]
		}),

		el( wp.editor.PanelColorSettings, {
			title: 'Button Color',
			className: 'fca-ept-colorpicker',
			initialOpen: false,
			colorSettings: [{
				colors: fca_ept_presetColors,
				label: 'Currently:',
				disableCustomColors: false,
				value: props.attributes.ept_buttonColor,
				onChange: ( function( newValue ){ 
					props.setAttributes( { ept_buttonColor: newValue } ) 
					alphaColor = fca_ept_hexToRGB( newValue, 0.65, 0 )
					props.setAttributes( { ept_popularBGColor: alphaColor } )
				} ),
			}]
		}),

		el( wp.editor.PanelColorSettings, {
			title: 'Button Font Color',
			className: 'fca-ept-colorpicker',
			initialOpen: false,
			colorSettings: [{
				colors: fca_ept_presetColors,
				label: 'Currently:',
				disableCustomColors: false,
				value: props.attributes.ept_buttonFontColor,
				onChange: ( function( newValue ){ props.setAttributes( { ept_buttonFontColor: newValue } ) } ),
			}]
		}),

		el( wp.editor.PanelColorSettings, {
			title: 'Accent Color',
			className: 'fca-ept-colorpicker',
			initialOpen: false,
			colorSettings: [{
				colors: fca_ept_presetColors,
				label: 'Currently:',
				disableCustomColors: false,
				value: props.attributes.ept_accentColor,
				onChange: ( function( newValue ){ props.setAttributes( { ept_accentColor: newValue } ) } ),
			}]
		}),

		el( wp.components.PanelHeader, { label: 'Show plan subtext' },
			el( wp.components.ToggleControl, { 
				checked: props.attributes.ept_showPlanSubtextToggle,
				className: 'fca-ept-toggle',
				onChange: (
					function( newValue ){ 
						if ( newValue ){
							props.setAttributes( { ept_showPlanSubtext: 'block' } )

						} else {
							props.setAttributes( { ept_showPlanSubtext: 'none' } )
						}
						props.setAttributes( { ept_showPlanSubtextToggle: newValue } )
					}
				),
			}),
		),

		el( wp.components.PanelHeader, { label: 'Match column height' },
			el( wp.components.Icon, {
				icon: 'editor-help',
				className: 'fca-ept-tooltip',
				onMouseOver: ( function(){
					props.setAttributes({ ept_columnHeightTooltip: 'block' } )
				}),
				onMouseOut: ( function(){
					props.setAttributes({ ept_columnHeightTooltip: 'none' } )
				})
			}),
			el( wp.components.Popover, {
				style: { 
					display: props.attributes.ept_columnHeightTooltip,
				},
			},
				el( 'p', { 
					className: 'fca-ept-sidebar-popover',
				},
					'Force all columns to be the same height. Useful if some columns have more features rows than others.'
				),
			),
			el( wp.components.ToggleControl, { 
				checked: props.attributes.ept_columnHeightToggle,
				className: 'fca-ept-toggle',
				onChange: (
					function( newValue ){ 
						if ( newValue ){
							props.setAttributes( { ept_columnHeight: 'auto' } )
						} else {
							props.setAttributes( { ept_columnHeight: 'fit-content' } )
						}
						props.setAttributes( { ept_columnHeightToggle: newValue } )
					}
				),
			}),
		),

		el( wp.components.PanelHeader, { label: 'Show buttons' },
			el( wp.components.ToggleControl, { 
				checked: props.attributes.ept_showButtonsToggle,
				className: 'fca-ept-toggle',
				onChange: (
					function( newValue ){ 
						if ( newValue ){
							props.setAttributes( { ept_showButtons: 'grid' } )

						} else {
							props.setAttributes( { ept_showButtons: 'none' } )
						}
						props.setAttributes( { ept_showButtonsToggle: newValue } )
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
			opened: true },
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

function fca_ept_copy_html( props ){

	var outputHTML = 	`<div style="text-decoration:none; align-items: ` + props.attributes.ept_columnHeight + `" class="wp-block-fatcatapps-pricing-table-blocks align` + props.attributes.align + ` fca-ept-` + props.attributes.selectedLayout +`">`

	props.attributes.ept_columnSettings.forEach(function(column){

		var columnPopular = column.columnPopular
		var showPopular = column.columnPopular ? 'fca-ept-most-popular' : ''

		var buttonColor = column.columnPopular ? props.attributes.ept_buttonColorPop : props.attributes.ept_buttonColor
		var buttonFontColor = column.columnPopular ? props.attributes.ept_buttonFontColorPop : props.attributes.ept_buttonFontColor
		var buttonBorderColor = column.columnPopular ? props.attributes.ept_buttonBorderColorPop : props.attributes.ept_buttonBorderColor

		var buttonHoverColor = props.attributes.ept_buttonHoverColor
		var buttonHoverColorPop = props.attributes.ept_buttonHoverColorPop

		var paddingTop = column.columnPopular ? '30px' : '45px'
		var paddingBottom = props.attributes.ept_showButtons === 'grid' ? '30px' : '0px'
		var marginTop = column.columnPopular ? '-5px' : '10px'
		var columnBorder = column.columnPopular ? '2px solid ' + props.attributes.ept_buttonColor : '0px solid'

		outputHTML += `<div style="background-color: ` + props.attributes.ept_layoutBGColor + `; padding-top: ` + paddingTop + `; padding-bottom: ` + paddingBottom + `; margin-top: ` + marginTop + `; border: ` + columnBorder + `" class="fca-ept-column">
					
							<div style="box-shadow:0px; display: ` + showPopular + `; border-color: ` + props.attributes.ept_buttonColor + `" class="fca-ept-popular-div">
							
								<span style="font-size: ` + props.attributes.ept_popularFontSize + `; background-color: ` + props.attributes.ept_popularBGColor + `; color: ` + props.attributes.ept_buttonFontColor + `" class="fca-ept-popular-text">` + props.attributes.ept_popularText + `</span>
							
							</div>
						
							<div class="fca-ept-plan-div">
						
								<span style="font-size: ` + props.attributes.ept_planFontSize + `; color: ` + props.attributes.ept_accentColor + `" class="fca-ept-plan">` + column.planText + `</span>
						
								<span style="display: ` + props.attributes.ept_showPlanSubtext + `; color: ` + props.attributes.ept_layoutFontColor + `; font-size: ` + props.attributes.ept_planSubtextFontSize + `" class="fca-ept-plan-subtext">` + column.planSubText + `</span>
						
							</div>
						
							<div class="fca-ept-price-div">
						
								<div class="fca-ept-price-container">
						
									<span style="font-size: ` + props.attributes.ept_priceFontSize + `; color: ` + props.attributes.ept_layoutFontColor + `" class="fca-ept-price">` + column.priceText + `</span>
						
									<div class="fca-ept-price-subtext">
						
										<svg class="fca-ept-price-svg" style="background-color: ` + props.attributes.ept_buttonColor + `"></svg>
						
										<span style="font-size: ` + props.attributes.ept_pricePeriodFontSize + `; color: ` + props.attributes.ept_layoutFontColor + `" class="fca-ept-price-period">` + column.pricePeriod + `</span>
						
									</div>
						
								</div>
						
							</div>
						
							<div class="fca-ept-features-div">
						
								<ul style="font-size:` + props.attributes.ept_featuresFontSize + `; color:` + props.attributes.ept_layoutFontColor + `" class="fca-ept-features">
						
									` + column.featuresText + `
						
								</ul>
						
							</div>
						
							<a style="display: ` + props.attributes.ept_showButtons + `; font-size: ` + props.attributes.ept_buttonFontSize + `; color: ` + props.attributes.ept_buttonFontColor + `; background-color: ` + props.attributes.ept_buttonColor + `" class="fca-ept-button" type="button" href="` + column.buttonURL + `" target="` + props.attributes.ept_urlTarget + `" rel="noopener noreferrer"><span class="fca-ept-button-text">` + column.buttonText + `</span></a>
						
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

function fca_ept_add_column( props ){
	
	var columnCount = props.attributes.ept_columnSettings.length

	var planDefaults = [
		'Starter',
		'Pro',
		'Elite',
		'Custom',
	]

	var newList = Array.from( props.attributes.ept_columnSettings )
	
	newList.push( {
		'columnPopular': false,
		'planText': planDefaults[ columnCount ],
		'planSubText': 'For custom requirements',
		'priceText': '$' + Number( 29 + ( ( columnCount ) * 10 ) ),
		'pricePeriod': 'per month',
		'priceBilling': 'billed annually',
		'featuresText': '<li>Feature 1</li><li>Feature 2</li><li>Feature 3</li><li>Feature 4</li>',
		'buttonText': 'Add to Cart',
		'buttonURL': 'https://www.fatcatapps.com'
	} )
	
	props.setAttributes( { ept_columnSettings: newList } )

}

