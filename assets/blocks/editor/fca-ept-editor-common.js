
var fca_ept_init_completed = 0
var fca_ept_allowed_formats = [
	'core/bold', 
	'core/italic', 
	'core/link',
	'core/image', 
	'core/strikethrough', 
	'core/text-color' 
]

function fca_ept_url_modal( props ) {
	
	var showURLModal = props.attributes.showURLModal === true
	
	var wp = window.wp
	var el = wp.element.createElement
	
	var columnSettings = JSON.parse( props.attributes.columnSettings )
	var selectedCol = props.attributes.selectedCol
	
	var disableUrlEditButton = ( props.attributes.togglePeriod && columnSettings[selectedCol].wooProductID2 ) || ( !props.attributes.togglePeriod && columnSettings[selectedCol].wooProductID1 ) ? true : false

	return ( showURLModal ? el( wp.components.Modal, {
			title: "Call to Action - Column " + ( selectedCol + 1 ),
			isDismissible: false,
			shouldCloseOnClickOutside: true,
			onRequestClose: function( t ){			
				props.setAttributes({ showURLModal: false })				
			}
		},
		
		el( wp.components.TextControl, {
			value: columnSettings[selectedCol].buttonText,
			label: 'Button Text',
			onChange: (
				function( newValue ){ 
					var columnSettings = JSON.parse( props.attributes.columnSettings )
					var selectedCol = props.attributes.selectedCol
					columnSettings[selectedCol].buttonText = newValue
					
					props.setAttributes( { columnSettings: JSON.stringify( columnSettings ) } )
				} 
			)
		}),
		
		el( wp.components.TextControl, {
			disabled: disableUrlEditButton,
			value: fca_ept_get_buttonurl( props, selectedCol ),
			label: 'URL',
			onChange: (
				function( newValue ){ 
					var columnSettings = JSON.parse( props.attributes.columnSettings )
					if( props.attributes.togglePeriod ){
						columnSettings[selectedCol].buttonURL2 = newValue
					} else {
						columnSettings[selectedCol].buttonURL1 = newValue
					}
					props.setAttributes( { columnSettings: JSON.stringify( columnSettings ) } )
				} 
			)
		})		
	) : null )
}

function fca_ept_confirm_modal( props ) {
	
	var showConfirmModal = props.attributes.showConfirmModal === true
	var selectedCol = props.attributes.selectedCol
	var wp = window.wp
	var el = wp.element.createElement
	var modalTitle = 'Remove column ' + ( Number( selectedCol ) + 1 ) + '?'
	return ( showConfirmModal ? el( wp.components.Modal, {
			title: modalTitle,
			isDismissible: false,
			shouldCloseOnClickOutside: true,
			onRequestClose: function( t ){			
				props.setAttributes({ showConfirmModal: false })				
			}
		},
				
		el( wp.components.Button, {
			variant: 'primary',
			style: {
				marginRight: '12px',
			},
			onClick: ( function(){
				 fca_ept_del_column( props ) 
				 props.setAttributes({ showConfirmModal: false }) 
			} ),
		},
			'Confirm'
		),
		el( wp.components.Button, {
			variant: 'secondary',
			onClick: ( function(){
				props.setAttributes({ showConfirmModal: false }) 
			} ),
		},
			'Cancel'
		)
		
		
	) : null )
}

function fca_ept_update_planimage( props, newValue ) {
	
	var columnSettingsData = JSON.parse( props.attributes.columnSettings )
	var selectedCol = props.attributes.selectedCol
	columnSettingsData[selectedCol].planImage = newValue											
	
	props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } )
	
}

function fca_ept_update_plantext( props, newValue ) {
	
	var columnSettingsData = JSON.parse( props.attributes.columnSettings )
	var selectedCol = props.attributes.selectedCol
	
	if( props.attributes.togglePeriod && props.attributes.togglePeriodToggle ){
		if ( woo_products && columnSettingsData[selectedCol].wooProductID2 ){
			columnSettingsData[selectedCol].useCustomWooTitle2 = newValue
		} else {
			columnSettingsData[selectedCol].planText2 = newValue											
		}
	} else {
		if ( woo_products && columnSettingsData[selectedCol].wooProductID1 ){
			columnSettingsData[selectedCol].useCustomWooTitle1 = newValue
		} else {
			columnSettingsData[selectedCol].planText1 = newValue											
		}
	}
	
	props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } )
	
}

function fca_ept_update_pricetext( props, newValue ) {
	
	var columnSettingsData = JSON.parse( props.attributes.columnSettings )
	var selectedCol = props.attributes.selectedCol
	
	if( props.attributes.togglePeriod && props.attributes.togglePeriodToggle ){
		columnSettingsData[selectedCol].priceText2 = newValue
	} else {
		columnSettingsData[selectedCol].priceText1 = newValue
	}
		
	props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } )
	
}
function fca_ept_update_buttontext( props, newValue ) {
	
	var columnSettingsData = JSON.parse( props.attributes.columnSettings )
	var selectedCol = props.attributes.selectedCol
	columnSettingsData[selectedCol].buttonText = newValue
	props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } )
}

function fca_ept_update_priceperiod( props, newValue ) {
	
	var columnSettingsData = JSON.parse( props.attributes.columnSettings )
	var selectedCol = props.attributes.selectedCol
	
	if( props.attributes.togglePeriod ){
		columnSettingsData[selectedCol].pricePeriod2 = newValue
	} else {
		columnSettingsData[selectedCol].pricePeriod1 = newValue
	}
	props.setAttributes( { columnSettings: JSON.stringify( columnSettingsData ) } )
}

function fca_ept_handle_cta_button_click( props ) {
	
	props.setAttributes({ selectedSection: 'button' })
	props.setAttributes({ showURLModal: true })
}

function fca_ept_handle_image_heights_toggle( props, isEnabled ) {
	
	var thisTableID = '#fca-ept-table-' + props.attributes.tableID
	var imageDivs = document.querySelectorAll( thisTableID + ' .fca-ept-plan-image img' )
	
	//RESET IMAGE DIV CSS
	for( var i = 0; i < imageDivs.length; i++ ) {							
		imageDivs[i].style.maxHeight = 'none'
	}
	
	if( isEnabled ) {
		//ARBITRARY STARTING VALUE
		var shortestImageHeight = imageDivs[0].offsetHeight
		
		for( var i = 0; i < imageDivs.length; i++ ) {
			if ( imageDivs[i].offsetHeight < shortestImageHeight ) {
				shortestImageHeight = imageDivs[i].offsetHeight
			}
		}
		
		//SET IMAGE DIV CSS
		for( var i = 0; i < imageDivs.length; i++ ) {
			
			imageDivs[i].style.maxHeight = shortestImageHeight + 'px'
		}
		
	}
	props.setAttributes( { matchHeightsToggle: isEnabled } )
}
function fca_ept_get_planImage( props, i ){

	if( fcaEptEditorData.toggle_integration ) {
		fca_ept_get_toggle_planImage( props, i )
	}
	var columnSettings = JSON.parse( props.attributes.columnSettings )
	return columnSettings[i].planImage
}

function fca_ept_get_buttonurl( props, i ){
	
	if( fcaEptEditorData.toggle_integration ) {
		return fca_ept_get_toggle_buttonurl( props, i )
	} 
	
	var columnSettings = JSON.parse( props.attributes.columnSettings )
	return columnSettings[i].buttonURL1
	
}

function fca_ept_update_featurestext( props, newValue ){

	var columnSettings = JSON.parse( props.attributes.columnSettings )
	var selectedCol = props.attributes.selectedCol
	
	columnSettings[selectedCol].featuresText = newValue
	props.setAttributes( { columnSettings: JSON.stringify( columnSettings ) } )
}

function fca_ept_update_populartext( props, newValue ){

	var columnSettings = JSON.parse( props.attributes.columnSettings )
	var selectedCol = props.attributes.selectedCol
	
	columnSettings[selectedCol].popularText = newValue
	props.setAttributes( { columnSettings: JSON.stringify( columnSettings ) } )
}

function fca_ept_get_plantext( props, i ){
		
	if( fcaEptEditorData.toggle_integration  ) {
		return fca_ept_get_toggle_plantext( props, i )
	} 
	
	var columnSettings = JSON.parse( props.attributes.columnSettings )
	return columnSettings[i].planText1
}	


function fca_ept_get_pricetext( props, i ){
		
	if( fcaEptEditorData.toggle_integration  ) {
		return fca_ept_get_toggle_pricetext( props, i )
	}
	var columnSettings = JSON.parse( props.attributes.columnSettings )
	return columnSettings[i].priceText1
	
}

//FIGURE OUT IF CLASS SHOULD BE POPULAR, SELECTED, OR BOTH
function fca_ept_column_class_name( props, i ) {
	var columnSettings = JSON.parse( props.attributes.columnSettings )
	var columnClassName = 'fca-ept-column'
	
	if( columnSettings[i].columnPopular ) {
		columnClassName = columnClassName + ' fca-ept-most-popular'
	}
	if( props.attributes.selectedCol === i ) {
		columnClassName = columnClassName + ' fca-ept-selected-column'
	}
	return columnClassName
}
function fca_ept_update_ui_state( props, newSection ) {
	
	var selection = window.getSelection()
	var selectedRange = ''
	if( selection.rangeCount > 0 ){
		selectedRange = selection.getRangeAt(0)
	}
	props.setAttributes( { selectedSection: newSection } )
	//RESET OUR CURSOR SELECTION DEPENDENT CONTEXTS
	props.setAttributes( { showIconDropdown: false } )
	props.setAttributes( { selectedRange: selectedRange } )
		
	if ( fca_ept_is_tooltip_selected( selectedRange ) ) {			
		props.setAttributes( { showTooltipModal: true } )
		props.setAttributes( { tooltipModalText: selectedRange.startContainer.parentElement.dataset.tooltip } )			
	}	
}

function fca_ept_is_tooltip_selected( range ) {
	
	if( range ) {
		var oneCharacterString = range.endOffset - range.startOffset == 1
		var matchingClassName = range.startContainer.parentElement.className === 'fca-ept-tooltip'
		if( matchingClassName && oneCharacterString ) {			
			return true			
		}
	}
	
	return false
}

// SET/SAVE DEFAULTS - RN NOTE: APPARENTLY GUTENBERG DOES NOT PASS DEFAULT ATTRIBUTES TO SERVER SIDE RENDER, SO WE UPDATE IT MANUALLY HERE
function fca_ept_maybe_set_defaults( props ) {
	props.setAttributes( { showLayoutPickerScreen: false } )	
	props.setAttributes( { showIconDropdown: false } )
	
	if( props.attributes.tableID == '' ) {
		props.setAttributes( { tableID: fca_ept_generate_id() } )		
	}
	
	//REMOVE LEFTOVER CUSTOM CSS, IF ANY
	var customTableStyles =  document.getElementById( props.attributes.tableID )
	if( customTableStyles ) {
		customTableStyles.remove()
	}
	
	if( props.attributes.columnSettings == '' ) {		
		props.setAttributes( { columnSettings: JSON.stringify( fca_ept_default_columnSettings() ) } )
	}
	
	//FORCE UPDATE DEFAULTS THAT DONT AUTO SAVE HERE
	if( typeof( props.attributes.showButtonsToggle ) === 'undefined' ) {
		props.setAttributes( { showButtonsToggle: true } )
	}
	if( typeof( props.attributes.showPriceSubtextToggle ) === 'undefined' ) {
		props.setAttributes( { showPriceSubtextToggle: true } )
	}
	if( typeof( props.attributes.showPlanSubtextToggle ) === 'undefined' ) {
		props.setAttributes( { showPlanSubtextToggle: true } )
	}
	
	
	if( typeof( props.attributes.align ) === 'undefined' && fcaEptEditorData.theme_support.wide ) {
		props.setAttributes( { align: 'wide'  } )
	}
	
}
//CUSTOM SAVE MESSAGES ON REUSABLE BLOCK EDITOR SCREEN
function fca_ept_reusable_block_init() {
	if ( fca_ept_init_completed == 1 ) {
		return
	}

	var currentPost = wp.data.select( 'core/editor' ).getCurrentPost()

	if( currentPost.type === 'wp_block' && currentPost.content.split( '<!--' )[1].includes( 'wp:fatcatapps/easy-pricing-table' ) ){
		
		//MAKE "BACK" WP BUTTON GO TO OUR POST LIST INSTEAD OF RESUABLE BLOCK LIST (NOT WORKING ATM...BUTTON IS GENERATED LATER
		var backButton = document.querySelectorAll('.edit-post-header a')
		console.log( backButton )  
		if( backButton.length ) {
			backButton[0].href = fcaEptEditorData.edit_url + '?post_type=easy-pricing-table&page=ept3-list'
		}
		
		var eptBlock = wp.data.select( 'core/block-editor' ).getBlocks().filter( function( block ){
			return block.name === 'fatcatapps/easy-pricing-tables'
		})
		
		wp.data.subscribe( function(){

			// prevent block from being removed
			var newBlockList = wp.data.select( 'core/block-editor' ).getBlocks().filter( function( block ){
				return block.name === 'fatcatapps/easy-pricing-tables'
			})

			if ( newBlockList.length < eptBlock.length ){
				wp.data.dispatch( 'core/block-editor' ).resetBlocks( eptBlock )
			}

			// save hook
			var isSavingPost = wp.data.select( 'core/editor' ).isSavingPost()
			var isAutosavingPost = wp.data.select( 'core/editor' ).isAutosavingPost()
			
			if ( isSavingPost && !isAutosavingPost ){

				var activeNotices = wp.data.select( 'core/notices' ).getNotices()
				var result = activeNotices.filter( function( notice, i ){
					return notice.id === 'fcaEptSuccessNotice'
				})

				if( !result.length ){

					wp.data.dispatch( 'core/notices' ).createNotice(
						'success',
						'Pricing Table saved successfully! Your shortcode: [ept3-block id="' + wp.data.select( 'core/editor' ).getCurrentPost().id + '"]',
						{
							id: 'fcaEptSuccessNotice',
							isDismissible: true,
							actions: [
								{
									onClick: ( function(){ window.open( 'https://fatcatapps.com/knowledge-base/how-to-create-your-first-pricing-table/', '_blank' ) } ),
									label: 'Need help publishing your new block?',
								},
							],
						}
					)
				}
			}
		})
	}
	
	fca_ept_init_completed = 1
	console.log( 'fca_ept_init completed' )
	return fca_ept_init_completed
	
}

function fca_ept_generate_id(){

	var newID = 'xxxx'.replace(/[x]/g, function( c ){
		var r = Math.random() * 16 | 0, v = c == 'x' ? r : ( r & 0x3 | 0x8 )
		return v.toString( 16 )
	})

	return newID

}

function fca_ept_hexToRGB( hex, alpha, darken ){
	if ( hex ){
		if ( hex.length === 7 ){
			var r = parseInt(hex.slice( 1, 3 ), 16 ),
				g = parseInt(hex.slice( 3, 5 ), 16 ),
				b = parseInt(hex.slice( 5, 7 ), 16 )
		} 
		if ( hex.length === 4 ){
			var r = parseInt(hex.slice( 1, 2 ) + hex.slice( 1, 2 ), 16 ),
				g = parseInt(hex.slice( 2, 3 ) + hex.slice( 2, 3 ), 16 ),
				b = parseInt(hex.slice( 3, 4 ) + hex.slice( 3, 4 ), 16 )
		}
		if ( alpha ){
			return "rgba(" + r + "," + g + "," + b + "," + alpha + ")"
		} 
		if ( darken ){
			if( ( r - darken ) > 0 ){ r -= darken } else { r = 0 }
			if( ( g - darken ) > 0 ){ g -= darken } else { g = 0 }
			if( ( b - darken ) > 0 ){ b -= darken } else { b = 0 }
			return "rgb(" + r + "," + g + "," + b + ")"
		}
	} else { return "rgb(255,255,255)" }
}