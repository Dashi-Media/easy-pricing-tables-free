var wp = window.wp
var el = wp.element.createElement
var $ = window.jQuery

var fca_ept_layout1_presetColors = [
	{
		name: 'White',
		slug: 'fca-white',
		color: '#fff'
	},
	{
		name: 'Black',
		slug: 'fca-black',
		color: '#333333'
	},
	{
		name: 'Blue',
		slug: 'fca-blue',
		color: '#3498db'
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

function fca_ept_set_layout1_attributes( props ) {
	
	props.setAttributes( { align: 'wide' } )
	props.setAttributes( { selectedLayout: 'layout1'} )
	if( !props.attributes.columnSettings ){
		props.setAttributes( { columnSettings: JSON.stringify( fca_ept_defaultColumnSettings ) } )
	}
	props.setAttributes( { columnHeight: 'auto' } )
	props.setAttributes( { columnHeightToggle: true } )

	// COLORS
	props.setAttributes( { layoutBGColor: '#fff' } ) 
	props.setAttributes( { layoutBGTint2: '#eeeeee' } )
	props.setAttributes( { layoutBGTint3: '#dddddd' } )
	props.setAttributes( { layoutBGTint4: '#7f8c8d' } )
	props.setAttributes( { layoutFontColor: '#333333' } )
	props.setAttributes( { buttonColor: '#3498db' } )
	props.setAttributes( { buttonFontColor: '#fff' } )
	props.setAttributes( { buttonBorderColor: '#2980b9' } )
	props.setAttributes( { buttonBorderColorPop: '#c0392b' } )
	props.setAttributes( { accentColor: '#e74c3c' } )
		
	// FONT SETTINGS
	props.setAttributes( { fontFamily: 'Hoefler Text' } )
	props.setAttributes( { popularFontSize: '125%' } ) 
	props.setAttributes( { planFontSize: '137.5%' } ) 
	props.setAttributes( { priceFontSize: '175%' } ) 
	props.setAttributes( { featuresFontSize: '125%' } ) 
	props.setAttributes( { buttonFontSize: '137.5%' } ) 

}

function fca_ept_layout1_block_edit( props ) {
	
	var columnSettings = JSON.parse( props.attributes.columnSettings )
	var selectedLayout = props.attributes.selectedLayout

	// append extra variable css settings
	fca_ept_layout1_additional_styles( props )
	fca_ept_custom_reusable_block()
	fca_ept_get_preview_settings( props )

	return el( wp.element.Fragment, { },

		fca_ept_toolbar_controls( props ),
		fca_ept_sidebar_settings( props ),
		
	// MAIN DIV
		el( 'div', {
			style: { fontFamily: props.attributes.fontFamily + ', sans serif' },
			id: 'fca-ept-table-' + props.attributes.tableID,
			className: props.attributes.togglePeriod ? 'fca-ept-table-container toggle-active' : 'fca-ept-table-container'
		},

		// TABLE
			el( 'div', { 
				style: { 
					alignItems: props.attributes.columnHeight === 'auto' ? 'stretch' : 'flex-end'
				}, 
				className: 'fca-ept-' + selectedLayout
			},
				Array.from( columnSettings, function( x, i ) {
					
					return el( 'div', { 
							key: i,
							className: columnSettings[i].columnPopular ? 'fca-ept-column fca-ept-most-popular' : 'fca-ept-column',
							style: { backgroundColor: props.attributes.layoutBGTint2 },
							onClick: ( function() { 
								fca_ept_select_column( props, i )
							})
						},

						el( 'div', { 
							style: { 
								backgroundColor: props.attributes.layoutBGTint4,
								color: props.attributes.buttonFontColor
							},
							className: columnSettings[i].columnPopular ? 'fca-ept-popular fca-ept-most-popular' : 'fca-ept-popular'
							},

							el( wp.blockEditor.RichText, { 
								style: { 
									fontSize: props.attributes.popularFontSize
								},
								allowedFormats: fca_ept_allowed_formats,
								placeholder: 'Most Popular', 
								type: "text", 
								tagName: 'span',
								value: props.attributes.popularText, 
								onClick: ( function() { 
									props.setAttributes( { selectedSection: 'popular' } ) 
									props.setAttributes( { showURLPopover: 'none' } )
								}),
								onChange: ( function( newValue ) { 
									props.setAttributes( { popularText: newValue } )
								})
							})
						),

						el( 'div', {
							style: { backgroundColor: props.attributes.layoutBGTint3 },
							className: 'fca-ept-plan-div'
						},
							el( wp.blockEditor.RichText, { 
								style: { 
									fontSize: props.attributes.planFontSize,
									color: props.attributes.layoutFontColor
								}, 
								allowedFormats: fca_ept_allowed_formats,
								className: 'fca-ept-plan',
								placeholder: 'Plan name', 
								type: "text", 
								tagName: 'span',
								value: columnSettings[i].planText1,
								onClick: ( function() { 
									props.setAttributes( { selectedSection: 'plan' } ) 
									props.setAttributes( { showURLPopover: 'none' } )
								}),
								onChange: ( function( newValue ) { 
									if( props.attributes.selectedCol !== i ){
										fca_ept_select_column( props, i )
										fca_ept_update_section( props, 'plan' )
									} else {
										var columnSettingsData = Array.from( columnSettings )
										columnSettingsData[props.attributes.selectedCol].planText1 = newValue
										props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } )
									}
								})
							})
							
						),

						el( 'div', { 
							style: { backgroundColor: props.attributes.layoutBGTint2 },
							className: 'fca-ept-price-div'
							},
							el( wp.blockEditor.RichText, { 
								style: { 
									fontSize: props.attributes.priceFontSize,
									color: props.attributes.layoutFontColor
								}, 
								allowedFormats: fca_ept_allowed_formats,
								className: 'fca-ept-price',
								placeholder: '$29', 
								type: "text", 
								tagName: 'span',
								value: columnSettings[i].priceText1, 
								onClick: ( function( section ) { 
									props.setAttributes( { selectedSection: 'price' } )
									props.setAttributes( { showURLPopover: 'none' } )
								}),
								onChange: ( function( newValue ) { 
									if( props.attributes.selectedCol !== i ){
										fca_ept_select_column( props, i )
										fca_ept_update_section( props, 'price' )
									} else {
										var columnSettingsData = Array.from( columnSettings )
										columnSettingsData[props.attributes.selectedCol].priceText1 = newValue
										props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } )
									}
								})
							})
						),

						el( 'div', { 
							style: { backgroundColor: props.attributes.layoutBGColor },
							className: 'fca-ept-features-div'
							},
							el( wp.blockEditor.RichText, { 
								style: { 
									fontSize: props.attributes.featuresFontSize,
									color: props.attributes.layoutFontColor
								}, 
								allowedFormats: fca_ept_allowed_formats,
								className: 'fca-ept-features',
								tagName: 'ul', 
								multiline: 'li', 
								placeholder: 'features offered', 
								type: "text", 
								value: columnSettings[i].featuresText, 
								onClick: ( function() { 
									props.setAttributes( { selectedSection: 'features' } )
									props.setAttributes( { showURLPopover: 'none' } )
								}),
								onChange: ( function( newValue ) { 
									if( props.attributes.selectedCol !== i ){
										fca_ept_select_column( props, i )
										fca_ept_update_section( props, 'features' )
									} else {
										var columnSettingsData = Array.from( columnSettings )
										columnSettingsData[props.attributes.selectedCol].featuresText = newValue
										props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } )
									}
								})
							})
						),

						el( 'div', { 
							style: { 
								display: props.attributes.showButtons,
								backgroundColor: props.attributes.layoutBGTint2
							},
							className: 'fca-ept-button-div'
							},

							el( 'a', { 
								style: {
									fontSize: props.attributes.buttonFontSize,
									backgroundColor: columnSettings[i].columnPopular ? props.attributes.accentColor : props.attributes.buttonColor,
									color: props.attributes.buttonFontColor,
									borderBottom: columnSettings[i].columnPopular ? props.attributes.buttonBorderColorPop + ' 2px solid' : props.attributes.buttonBorderColor + ' 2px solid'
								}, 
								className: 'fca-ept-button', 
								onClick: ( function() { 
									props.setAttributes( { selectedSection: 'button' } ) 
									props.setAttributes( { showURLPopover: 'block' } )
								})
							},
								el( wp.blockEditor.RichText, { 
									allowedFormats: fca_ept_allowed_formats,
									placeholder: 'Add to Cart', 
									type: "text", 
									tagName: 'span',
									value: columnSettings[i].buttonText, 
									onChange: ( function( newValue ) { 
										if( props.attributes.selectedCol !== i ){
											fca_ept_select_column( props, i )
											fca_ept_update_section( props, 'button' )
										} else {
											var columnSettingsData = Array.from( columnSettings )
											columnSettingsData[props.attributes.selectedCol].buttonText = newValue
											props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } ) 
										}
									})
								})
							)
						)
					) // end column div
				}) // end array
			) // end table div
		) // end main div
	) // end fragment
}

function fca_ept_layout1_additional_styles( props ){

	var id = props.attributes.tableID

	$( '#' + id ).remove()

	$( 'body' ).append( 
		"<style id='" + id + "'>" +
			"#fca-ept-table-" + id + " div.fca-ept-column a.fca-ept-button:hover { background-color: " + props.attributes.buttonBorderColor + " !important;}" +
			"#fca-ept-table-" + id + " div.fca-ept-column.fca-ept-most-popular a.fca-ept-button:hover { background-color: " + props.attributes.buttonBorderColorPop + " !important;}" +
			"#fca-ept-table-" + id + " div.fca-ept-column div.fca-ept-features li { border-bottom: dotted 1px " + props.attributes.layoutBGTint3 + ";}" +
		"</style>" 
	)

}
