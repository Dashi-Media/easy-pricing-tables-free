var wp = window.wp
var el = wp.element.createElement
var $ = window.jQuery

var fca_ept_layout2_presetColors = [
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
		color: '#ea2027'
	},
	{
		name: 'Grey',
		slug: 'fca-grey',
		color: '#f2f2f2'
	},
]

function fca_ept_set_layout2_attributes( props ) {
	
	props.setAttributes( { align: 'wide' } )
	props.setAttributes( { selectedLayout: 'layout2'} )
	if( !props.attributes.columnSettings ){
		props.setAttributes( { columnSettings: JSON.stringify( fca_ept_defaultColumnSettings ) } )
	}
	props.setAttributes( { columnHeight: 'auto' } )
	props.setAttributes( { columnHeightToggle: true } )

	// COLORS
	props.setAttributes( { layoutBGColor: '#f2f2f2' } ) 
	props.setAttributes( { layoutFontColor: '#000' } )
	props.setAttributes( { layoutFontColor1: '#6236ff' } )
	props.setAttributes( { buttonColor: '#6236ff' } )
	props.setAttributes( { buttonFontColor: '#fff' } )
	props.setAttributes( { accentColor: '#6236ff' } )

	// FONT SETTINGS
	props.setAttributes( { fontFamily: 'sans-serif' } )
	props.setAttributes( { popularFontSize: '75%' } ) 
	props.setAttributes( { planFontSize: '300%' } ) 
	props.setAttributes( { planSubtextFontSize: '100%' } ) 
	props.setAttributes( { priceFontSize: '400%' } ) 
	props.setAttributes( { pricePeriodFontSize: '100%' }) 
	props.setAttributes( { featuresFontSize: '125%' } ) 
	props.setAttributes( { buttonFontSize: '150%' } ) 

}

function fca_ept_layout2_block_edit( props ) {
	
	var columnSettings = JSON.parse( props.attributes.columnSettings )
	var selectedLayout = props.attributes.selectedLayout

	fca_ept_layout2_additional_styles( props )
	fca_ept_custom_reusable_block()
	fca_ept_get_preview_settings( props )
 
	return el( wp.element.Fragment, { },

		fca_ept_toolbar_controls( props ),
		fca_ept_sidebar_settings( props ),

	// MAIN DIV
		el( 'div', {
			style: { fontFamily: props.attributes.fontFamily + ', sans-serif' },
			id: 'fca-ept-table-' + props.attributes.tableID,
			className: props.attributes.togglePeriod ? 'fca-ept-table-container toggle-active' : 'fca-ept-table-container'
		},

		// TABLE
			el( 'div', { 
				style: { 
					textDecoration: 'none',
					alignItems: props.attributes.columnHeight === 'auto' ? 'stretch' : 'flex-end'
				}, 
				className: 'fca-ept-' + selectedLayout
			},
				Array.from( columnSettings, function( x, i ) {
					return el( 'div', { 
						key: i,
						style: { 
							backgroundColor: props.attributes.layoutBGColor,
							paddingTop: columnSettings[i].columnPopular ? '30px' : '45px',
							paddingBottom: props.attributes.showButtons === 'block' ? '30px' : '0px',
							marginTop: columnSettings[i].columnPopular ? '0px' : '10px',
							border: columnSettings[i].columnPopular ? '2px solid ' + props.attributes.accentColor : '0px solid'
						},
							className: columnSettings[i].columnPopular ? 'fca-ept-column fca-ept-most-popular' : 'fca-ept-column',
							onClick: ( function() { 
								fca_ept_select_column( props, i )
							})
						},

						el( 'div', { 
							style: { 
								display: columnSettings[i].columnPopular ? 'block' : 'none',
								borderColor: props.attributes.accentColor
							},
							className: 'fca-ept-popular-div'
							},

							el( wp.blockEditor.RichText, { 
								style: { 
									fontSize: props.attributes.popularFontSize,
									color: props.attributes.buttonFontColor,
									backgroundColor: props.attributes.accentColor
								},
								allowedFormats: fca_ept_allowed_formats,
								className: 'fca-ept-popular-text',
								placeholder: 'Most Popular', 
								type: "text", 
								tagName: 'span',
								value: props.attributes.popularText, 
								onClick: ( function() { 
									fca_ept_update_section( props, 'popular' )
								}),
								onChange: ( function( newValue ) { 
									props.setAttributes( { popularText: newValue } )
								})
							})
						),

						el( 'div', { 
							className: 'fca-ept-plan-div'
							},
							el( wp.blockEditor.RichText, { 
								style: { 
									fontSize: props.attributes.planFontSize,
									color: props.attributes.layoutFontColor1
								}, 
								allowedFormats: fca_ept_allowed_formats,
								className: 'fca-ept-plan', 
								placeholder: 'Plan name', 
								type: "text", 
								tagName: 'span',
								value: columnSettings[i].planText1,
								onClick: ( function() { 
									fca_ept_update_section( props, 'plan' )
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
							}),

							el( wp.blockEditor.RichText, { 
								style: { 
									display: props.attributes.showPlanSubtext,
									color: props.attributes.layoutFontColor,
									fontSize: props.attributes.planSubtextFontSize
								}, 
								allowedFormats: fca_ept_allowed_formats,
								className: 'fca-ept-plan-subtext', 
								placeholder: 'To get started', 
								type: "text", 
								tagName: 'span',
								value: columnSettings[i].planSubText, 
								onClick: ( function() { 
									fca_ept_update_section( props, 'planSubtext' )
								}),
								onChange: ( function( newValue ) { 
									if( props.attributes.selectedCol !== i ){
										fca_ept_select_column( props, i )
										fca_ept_update_section( props, 'planSubtext' )
									} else {
										var columnSettingsData = Array.from( columnSettings )
										columnSettingsData[props.attributes.selectedCol].planSubText = newValue
										props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } )
									}
								})
							})
						),

						el( 'div', { 
							className: 'fca-ept-price-div'
							},

							el( 'div', { 
								className: 'fca-ept-price-container'
								},

								el( wp.blockEditor.RichText, { 
									className: 'fca-ept-price',
									style: { 
										fontSize: props.attributes.priceFontSize,
										color: props.attributes.layoutFontColor
									}, 
									allowedFormats: fca_ept_allowed_formats,
									placeholder: '$29', 
									type: "text", 
									tagName: 'span',
									value: columnSettings[i].priceText1, 
									onClick: ( function( section ) { 
										fca_ept_update_section( props, 'price' )
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
								}),

								el( 'div', { 
									style: { display: columnSettings.length > 1 ? 'block' : 'none' },
									className: 'fca-ept-price-subtext'
									},
									el ( 'svg', {
										className: 'fca-ept-price-svg',
										style: { 
											backgroundColor: props.attributes.buttonColor 
										}
									}),
									el( wp.blockEditor.RichText, { 
										style: { 
											fontSize: props.attributes.pricePeriodFontSize,
											color: props.attributes.layoutFontColor
										},
										allowedFormats: fca_ept_allowed_formats,
										className: 'fca-ept-price-period', 
										placeholder: 'per month', 
										type: "text", 
										tagName: 'span',
										value: columnSettings[i].pricePeriod1,
										onClick: ( function() { 
											fca_ept_update_section( props, 'pricePeriod' )
										}),
										onChange: ( function( newValue ) { 
											if( props.attributes.selectedCol !== i ){
												fca_ept_select_column( props, i )
												fca_ept_update_section( props, 'pricePeriod' )
											} else {
												var columnSettingsData = Array.from( columnSettings )
												columnSettingsData[props.attributes.selectedCol].pricePeriod1 = newValue
												props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } )
											}
										})
									})
								)
							)
						),

						el( 'div', { 
							className: 'fca-ept-features-div',
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
									fca_ept_update_section( props, 'features' )
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

						el( 'a', { 
							style: {
								display: props.attributes.showButtons,
								fontSize: props.attributes.buttonFontSize,
								color: props.attributes.buttonFontColor,
								backgroundColor: props.attributes.buttonColor
							}, 
							className: 'fca-ept-button', 
							onClick: ( function() { 
								fca_ept_update_section( props, 'button' )
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
					) // end column div
				}) // end array
			) // end table div
		) // end main div
	) // end fragment
}

function fca_ept_layout2_additional_styles( props ){

	var id = props.attributes.tableID

	$( '#' + id ).remove()

	$( 'body' ).append( 
		"<style id='" + id + "'>" +
			"#fca-ept-table-" + id + " div.fca-ept-toggle-period-container .fca-ept-slider { background-color: " + props.attributes.buttonColor + " }" +
		"</style>" 
	)

}
