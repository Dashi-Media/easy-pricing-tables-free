var el = wp.element.createElement
var $ = jQuery

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
		color: '#EA2027'
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
	props.setAttributes( { columnSettings: JSON.stringify( fca_ept_defaultColumnSettings ) } )
	// COLORS
	props.setAttributes( { popularBGColor: 'rgba(98,54,255,0.8)' } )
	props.setAttributes( { layoutBGColor: '#f2f2f2' } ) 
	props.setAttributes( { layoutFontColor: '#000' } )
	props.setAttributes( { buttonColor: '#6236ff' } )
	props.setAttributes( { buttonFontColor: '#fff' } )
	props.setAttributes( { accentColor: '#6236ff' } )

	// FONT SETTINGS
	props.setAttributes( { fontFamily: 'sans-serif' } )
	props.setAttributes( { popularFontSize: '0.75rem' } ) 
	props.setAttributes( { planFontSize: '3rem' } ) 
	props.setAttributes( { planSubtextFontSize: '1rem' } ) 
	props.setAttributes( { priceFontSize: '4rem' } ) 
	props.setAttributes( { pricePeriodFontSize: '1rem' }) 
	props.setAttributes( { priceBillingFontSize: '0.8125rem' } ) 
	props.setAttributes( { featuresFontSize: '1.25rem' } ) 
	props.setAttributes( { buttonFontSize: '1.5rem' } ) 

}

function fca_ept_layout2_block_edit( props ) {
	
	var $ = jQuery
	var columnSettings = JSON.parse( props.attributes.columnSettings )
	var selectedLayout = props.attributes.selectedLayout
	var selectedCol = props.attributes.selectedCol

	fca_ept_layout2_additional_styles( props )
 
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
							marginTop: columnSettings[i].columnPopular ? '-5px' : '10px',
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
									backgroundColor: props.attributes.popularBGColor
								},
								allowedFormats: fca_ept_allowed_formats,
								className: 'fca-ept-popular-text',
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
							className: 'fca-ept-plan-div'
							},
							el( wp.blockEditor.RichText, { 
								style: { 
									fontSize: props.attributes.planFontSize,
									color: props.attributes.accentColor
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
									var columnSettingsData = Array.from( columnSettings )
									columnSettingsData[props.attributes.selectedCol].planText1 = newValue
									props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } )
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
								onClick: function() { 
									props.setAttributes( { selectedSection: 'planSubtext' } ) 
									props.setAttributes( { showURLPopover: 'none' } )
								},
								onChange: function( newValue ) { 
									var columnSettingsData = Array.from( columnSettings )
									columnSettingsData[props.attributes.selectedCol].planSubText = newValue
									props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } )
								}
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
										props.setAttributes( { selectedSection: 'price' } )
										props.setAttributes( { showURLPopover: 'none' } )
									}),
									onChange: ( function( newValue ) { 
										var columnSettingsData = Array.from( columnSettings )
										columnSettingsData[props.attributes.selectedCol].priceText1 = newValue
										props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } )
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
											props.setAttributes( { selectedSection: 'pricePeriod' } ) 
											props.setAttributes( { showURLPopover: 'none' } )
										}),
										onChange: ( function( newValue ) { 
											var columnSettingsData = Array.from( columnSettings )
											columnSettingsData[props.attributes.selectedCol].pricePeriod1 = newValue
											props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } )
										})
									}),

									el( wp.blockEditor.RichText, { 
										style: { 
											fontSize: props.attributes.priceBillingFontSize,
											color: props.attributes.layoutFontColor
										},
										allowedFormats: fca_ept_allowed_formats,
										className: 'fca-ept-price-billing', 
										placeholder: 'billed annually', 
										type: "text", 
										tagName: 'span',
										value: columnSettings[i].priceBilling1, 
										onChange: ( function( newValue ) { 
											var columnSettingsData = Array.from( columnSettings )
											columnSettingsData[props.attributes.selectedCol].priceBilling1 = newValue
											props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } )
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
									props.setAttributes( { selectedSection: 'features' } )

								}),
								onChange: ( function( newValue ) { 
									var columnSettingsData = Array.from( columnSettings )
									columnSettingsData[props.attributes.selectedCol].featuresText = newValue
									props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } )
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
									var columnSettingsData = Array.from( columnSettings )
									columnSettingsData[props.attributes.selectedCol].buttonText = newValue
									props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } ) 
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

	id = props.attributes.tableID

	$(id).remove()

	$( 'body' ).append( 
		"<style id='" + id + "'>" +
			"div.fca-ept-toggle-period-container .fca-ept-slider { background-color: " + props.attributes.buttonColor + " }" +
		"</style>" 
	)

}
