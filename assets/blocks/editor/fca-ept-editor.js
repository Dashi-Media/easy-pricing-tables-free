var wp = window.wp
var el = wp.element.createElement
var $ = window.jQuery
var customBlock = 1

var fca_ept_allowed_formats = [
	'core/bold', 
	'core/italic', 
	'core/link', 
	'core/image', 
	'core/strikethrough', 
	'core/text-color' 
]

var fca_ept_defaultColumnSettings = [
	{
		'columnPopular': false,
		'planText1': 'Starter',
		'planSubText': 'For getting started',
		'priceText1': '$29',
		'pricePeriod1': 'per month',
		'priceBilling1': 'billed monthly',
		'featuresText': '<li>Feature 1</li><li>Feature 2</li><li>Feature 3</li><li>Feature 4</li>',
		'buttonText': 'Add to Cart',
		'buttonURL1': 'https://www.fatcatapps.com',
	},
	{
		'columnPopular': true,
		'planText1': 'Pro',
		'planSubText': 'Best for most users',
		'priceText1': '$39',
		'pricePeriod1': 'per month',
		'priceBilling1': 'billed monthly',
		'featuresText': '<li>Feature 1</li><li>Feature 2</li><li>Feature 3</li><li>Feature 4</li>',
		'buttonText': 'Add to Cart',
		'buttonURL1': 'https://www.fatcatapps.com',
	},
	{
		'columnPopular': false,
		'planText1': 'Elite',
		'planSubText': 'For enterprises',
		'priceText1': '$49',
		'pricePeriod1': 'per month',
		'priceBilling1': 'billed monthly',
		'featuresText': '<li>Feature 1</li><li>Feature 2</li><li>Feature 3</li><li>Feature 4</li>',
		'buttonText': 'Add to Cart',
		'buttonURL1': 'https://www.fatcatapps.com',
	},
]

var fca_ept_main_attributes = {
	
	align: { type: 'string', default: 'wide' },
	selectedLayout: { type: 'string', default: '' },
	selectedCol: { type: 'int', default: 0 }, 
	selectedSection: { type: 'string', default: 'plan' },
	tableID: { type: 'string', default: '' },
	columnSettings: { type: 'string', default: '' },
	// COLORS
	layoutBGColor: { type: 'string', default: '#f2f2f2' },
	layoutBGTint1: { type: 'string', default: 'rgb(245, 245, 245)' },
	layoutBGTint2: { type: 'string', default: '#eeeeee' },
	layoutBGTint3: { type: 'string', default: '#dddddd' },
	layoutBGTint4: { type: 'string', default: '#7f8c8d' },
	layoutFontColor: { type: 'string', default: '#000' },
	layoutFontColor1: { type: 'string', default: '#6236ff' },
	priceSubtextColor: { type: 'string', default: '#0c1f28' },
	buttonColor: { type: 'string', default: '#6236ff' },
	buttonFontColor: { type: 'string', default: '#fff' },
	buttonBorderColor: { type: 'string', default: 'rgb(0,103,103)' },
	buttonBorderColorPop: { type: 'string', default: 'rgb(200,104,12)' },
	accentColor: { type: 'string', default: '#6236ff' },

	// FONT SETTINGS
	fontFamily: { type: 'string', default: 'Sans Serif' },
	popularFontSize: { type: 'string', default: '75%' }, 
	planFontSize: { type: 'string', default: '300%' }, 
	planSubtextFontSize: { type: 'string', default: '100%' }, 
	priceFontSize: { type: 'string', default: '400%' }, 
	pricePeriodFontSize: { type: 'string', default: '100%' }, 
	featuresFontSize: { type: 'string', default: '125%' }, 
	buttonFontSize: { type: 'string', default: '150%' }, 

	// EXTRA SETTINGS
	columnHeight: { type: 'string', default: 'auto' },
	columnHeightToggle: { type: 'boolean', default: true }, 
	columnHeightTooltip: { type: 'string', default: 'none' },
	showPlanSubtext: { type: 'string', default: 'block' }, 
	showPlanSubtextToggle: { type: 'boolean', default: true },
	popularText: { type: 'string', default: 'Most Popular' },
	showButtons: { type: 'string', default: 'block' }, 
	showButtonsToggle: { type: 'boolean', default: true },
	urlTarget: { type: 'string', default: '_self' },
	urlTargetToggle: { type: 'boolean', default: false }, 
	showURLPopover: { type: 'string', value: 'none' },

}

wp.blocks.registerBlockType( 'fatcatapps/easy-pricing-tables', {

	title: 'Pricing Table',

	icon: el( 'svg', {
			role: 'img',
			focusable: 'false',
			viewBox: '0 0 24 24',
			width: '24',
			height: '24',
			fill: '#111111',
			}, 
			el( 'path', {
				d: 'M12 2C6.475 2 2 6.475 2 12C2 17.525 6.475 22 12 22C17.525 22 22 17.525 22 12C22 6.475 17.525 2 12 2ZM13.415 18.09V20H10.75V18.07C9.045 17.705 7.585 16.61 7.48 14.665H9.435C9.535 15.715 10.255 16.53 12.085 16.53C14.05 16.53 14.485 15.55 14.485 14.94C14.485 14.115 14.04 13.33 11.82 12.8C9.34 12.205 7.64 11.18 7.64 9.13C7.64 7.415 9.025 6.295 10.75 5.92V4H13.415V5.945C15.275 6.4 16.205 7.805 16.27 9.33H14.3C14.245 8.22 13.66 7.465 12.08 7.465C10.58 7.465 9.68 8.14 9.68 9.11C9.68 9.955 10.33 10.495 12.345 11.02C14.365 11.545 16.525 12.405 16.525 14.93C16.525 16.755 15.145 17.76 13.415 18.09Z'
			})
		),

	category: 'common',

	attributes: fca_ept_main_attributes,

	supports: { 
		align: true,
		html: false,
		reusable: true
	},

	edit: fca_ept_main_edit,

	save: fca_ept_main_save

})

function fca_ept_main_edit( props ) {

	fca_ept_custom_reusable_block()

	if ( props.attributes.selectedLayout ){
		return eval( 'fca_ept_' + props.attributes.selectedLayout + '_block_edit' )( props )
	} else {
		//LAYOUT PICKER SCREEN
		return el( wp.element.Fragment, { },

			el( 'div', { 
				className: 'fca-ept-layout-selection',
				},
				el( 'div', {
					className: 'layout-headline'
				}, 'Select your layout' ),

				el( 'div', {
					className: 'layout-container' },

					el( 'div', {
						className: 'layout',
						onClick: function() { 
							props.setAttributes( { tableID: fca_ept_generate_id() } )
							fca_ept_set_layout1_attributes( props )
						}
					},
						el( 'div', { 
							className: 'layout-title',
						}, 'Layout 1' ),
						el( 'img', {
							src: fca_ept_data.directory + '/assets/blocks/layout1/screenshot.png',
						})
					),

					el( 'div', {
						className: 'layout',
						onClick: function() { 
							props.setAttributes( { tableID: fca_ept_generate_id() } )
							fca_ept_set_layout2_attributes( props )
						}
					},
						el( 'div', { 
							className: 'layout-title',
						}, 'Layout 2' ),
						el( 'img', {
							src: fca_ept_data.directory + '/assets/blocks/layout2/screenshot.png',
						})
					),

					el( 'div', {
						className: 'layout-premium',
						onMouseOver: ( function(){
							$( '.learn-more3' ).css( 'display', 'block' )
						}),
						onMouseOut: ( function(){
							$( '.learn-more3' ).css( 'display', 'none' )
						}),
						onClick: function() { 
							window.open( 'https://fatcatapps.com/easypricingtables/?utm_campaign=wp%2Bgutenberg&utm_source=Easy%2BPricing%2BTables%2BFree&utm_medium=plugin&utm_content=v1', '_blank' )
						}
					},
						el( 'div', { 
							className: 'layout-title',
						}, 'Layout 3 (Premium only)' ),
						el( wp.components.Button, { 
							className: 'learn-more3 button button-primary button-large'
						}, 'Learn more' ),
						el( 'img', {
							src: fca_ept_data.directory + '/assets/blocks/layout3/screenshot.png',
						})
					),

					el( 'div', {
						className: 'layout-premium',
						onMouseOver: ( function(){
							$( '.learn-more4' ).css( 'display', 'block' )
						}),
						onMouseOut: ( function(){
							$( '.learn-more4' ).css( 'display', 'none' )
						}),
						onClick: function() { 
							window.open( 'https://fatcatapps.com/easypricingtables/?utm_campaign=wp%2Bgutenberg&utm_source=Easy%2BPricing%2BTables%2BFree&utm_medium=plugin&utm_content=v1', '_blank' )
						}
					},
						el( 'div', { 
							className: 'layout-title',
						}, 'Layout 4 (Premium only)' ),
						el( wp.components.Button, { 
							className: 'learn-more4 button button-primary button-large'
						}, 'Learn more' ),
						el( 'img', {
							src: fca_ept_data.directory + '/assets/blocks/layout4/screenshot.png',
						})
					),

					el( 'div', {
						className: 'layout-premium',
						onMouseOver: ( function(){
							$( '.learn-more5' ).css( 'display', 'block' )
						}),
						onMouseOut: ( function(){
							$( '.learn-more5' ).css( 'display', 'none' )
						}),
						onClick: function() { 
							window.open( 'https://fatcatapps.com/easypricingtables/?utm_campaign=wp%2Bgutenberg&utm_source=Easy%2BPricing%2BTables%2BFree&utm_medium=plugin&utm_content=v1', '_blank' )
						}
					},
						el( 'div', { 
							className: 'layout-title',
						}, 'Layout 5 (Premium only)' ),
						el( wp.components.Button, { 
							className: 'learn-more5 button button-primary button-large',
						}, 'Learn more' ),
						el( 'img', {
							src: fca_ept_data.directory + '/assets/blocks/layout5/screenshot.png',
						})
					),

					el( 'div', {
						className: 'layout-premium',
						onMouseOver: ( function(){
							$( '.learn-more6' ).css( 'display', 'block' )
						}),
						onMouseOut: ( function(){
							$( '.learn-more6' ).css( 'display', 'none' )
						}),
						onClick: function() { 
							window.open( 'https://fatcatapps.com/easypricingtables/?utm_campaign=wp%2Bgutenberg&utm_source=Easy%2BPricing%2BTables%2BFree&utm_medium=plugin&utm_content=v1', '_blank' )
						}
					},
						el( 'div', { 
							className: 'layout-title',
						}, 'Layout 6 (Premium only)' ),
						el( wp.components.Button, { 
							className: 'learn-more6 button button-primary button-large'
						}, 'Learn more' ),
						el( 'img', {
							src: fca_ept_data.directory + '/assets/blocks/layout6/screenshot.png',
						})
					)
					
				)
			) // end div
		)
	} // end else
}

function fca_ept_main_save( props ) {
	return null
}

function fca_ept_sidebar_settings( props ){
	
	var columnSettings = JSON.parse( props.attributes.columnSettings )
	var selectedLayout = props.attributes.selectedLayout
	var presetColors =  eval( 'fca_ept_' + selectedLayout + '_presetColors' )
	return el( wp.blockEditor.InspectorControls, { key: 'ept-background-color' },
			el( 'div', { className: 'fca-ept-sidebar-items' },
				el( wp.blockEditor.PanelColorSettings, {
				"title": "Color Settings",
				"initialOpen": false,
				"colorSettings": [
					{
						"label": "Background Color",
						"colors": presetColors,
						"value": props.attributes.layoutBGColor,
						"clearable": false,
						"onChange": function( newValue ){ 
							props.setAttributes( { "layoutBGColor": newValue } )
							props.setAttributes( { "layoutBGTint1": fca_ept_hexToRGB( newValue, 0, 10 ) } )
							props.setAttributes( { "layoutBGTint2": fca_ept_hexToRGB( newValue, 0, 15 ) } )
							props.setAttributes( { "layoutBGTint3": fca_ept_hexToRGB( newValue, 0, 30 ) } )
							props.setAttributes( { "layoutBGTint4": fca_ept_hexToRGB( newValue, 0, 107 ) } )
						}
					},	
					{
						"label": "Text Color",
						"value": props.attributes.layoutFontColor,
						"clearable": false,
						"colors": presetColors,
						"onChange": function( newValue ){ 
							props.setAttributes( { "layoutFontColor": newValue } )
						}
					},
					selectedLayout === 'layout2' ? {
							"label": "Plan Text Color",
							"value": props.attributes.layoutFontColor1,
							"colors": presetColors,
							"clearable": false,
							"onChange": function( newValue ){ 
								props.setAttributes( { "layoutFontColor1": newValue } )
							}
						} : '',
					{
						"label": "Button Color",
						"value": props.attributes.buttonColor,
						"clearable": false,
						"colors": presetColors,
						"onChange": function( newValue ){ 
							props.setAttributes( { "buttonColor": newValue } )
							props.setAttributes( { "priceSubtextColor": fca_ept_hexToRGB( newValue, 0.4, 0 ) } )
							props.setAttributes( { "buttonBorderColor": fca_ept_hexToRGB( newValue, 0, 55 ) } )
						}
					},
					{
						"label": "Button Font Color",
						"value": props.attributes.buttonFontColor,
						"clearable": false,
						"colors": presetColors,
						"onChange": function( newValue ){ 
							props.setAttributes( { "buttonFontColor": newValue } )
						}
					},
					{
						"label": "Accent Color",
						"value": props.attributes.accentColor,
						"clearable": false,
						"colors": presetColors,
						"onChange": function( newValue ){ 
							props.setAttributes( { "accentColor": newValue } )
							props.setAttributes( { "buttonBorderColorPop": fca_ept_hexToRGB( newValue, 0, 55 ) } )
						}
					}
				
				]
			}),	
			
			el( wp.components.PanelBody, { 
				title: 'Misc Settings',
				className: 'fca-ept-misc-settings',
				initialOpen: false },

				el( 'div', {
					style: { 
						display: props.attributes.selectedLayout === 'layout2' ? 'block' : 'none',
					},
				},

					el( wp.components.PanelHeader, { label: 'Show plan subtext' },
						el( wp.components.ToggleControl, { 
							checked: props.attributes.showPlanSubtextToggle,
							className: 'fca-ept-toggle',
							onChange: (
								function( newValue ){ 
									if ( newValue ){
										props.setAttributes( { showPlanSubtext: 'block' } )
									} else {
										props.setAttributes( { showPlanSubtext: 'none' } )
									}
									props.setAttributes( { showPlanSubtextToggle: newValue } )
								}
							)
						})
					)
				),

				el( wp.components.PanelHeader, { label: 'Match column height' },
					el( wp.components.Icon, {
						style: { 
							marginLeft: '-8px',
							marginBottom: '18px' 
						},
						icon: 'editor-help',
						className: 'fca-ept-tooltip',
						onMouseOver: ( function(){
							props.setAttributes( { columnHeightTooltip: 'block' } )
						}),
						onMouseOut: ( function(){
							props.setAttributes( { columnHeightTooltip: 'none' } )
						})
					}),
					el( wp.components.Popover, {
						style: { 
							display: props.attributes.columnHeightTooltip
						}
					},
						el( 'p', { 
							className: 'fca-ept-sidebar-popover',
						},
							'Force all columns to be the same height. Useful if some columns have more features rows than others.'
						)
					),
					el( wp.components.ToggleControl, { 
						checked: props.attributes.columnHeightToggle,
						className: 'fca-ept-toggle',
						onChange: (
							function( newValue ){ 
								if ( newValue ){
									props.setAttributes( { columnHeight: 'auto' } )
								} else {
									props.setAttributes( { columnHeight: 'fit-content' } )
								}
								props.setAttributes( { columnHeightToggle: newValue } )
							}
						)
					})
				),

				el( wp.components.PanelHeader, { label: 'Show buttons' },
					el( wp.components.ToggleControl, { 
						checked: props.attributes.showButtonsToggle,
						className: 'fca-ept-toggle',
						onChange: (
							function( newValue ){ 
								if ( newValue ){
									props.setAttributes( { showButtons: 'block' } )

								} else {
									props.setAttributes( { showButtons: 'none' } )
								}
								props.setAttributes( { showButtonsToggle: newValue } )
							}
						)
					})
				)
			),

			el( 'div', {
				style: { 
					display: props.attributes.showURLPopover ? props.attributes.showURLPopover : 'none',
				},
				className: 'fca-ept-sidebar-url'
			},
				el( 'label', { }, 'URL for column ' + ( props.attributes.selectedCol +1) ),
				el( wp.components.TextControl, { 
					value: columnSettings[props.attributes.selectedCol].buttonURL1,																																		
					onChange: (
						function( newValue ){ 

							var columnSettings = JSON.parse( props.attributes.columnSettings )
							columnSettings[props.attributes.selectedCol].buttonURL1 = newValue
							props.setAttributes( { columnSettings: JSON.stringify( columnSettings ) } )

						} 
					)
				}),
				
				el( 'div', { 
					style: { 
						display: 'flex'
					}
				},

					el( 'label', { },'Open in new tab' ),
					el( wp.components.ToggleControl, { 
						checked: props.attributes.urlTargetToggle,
						className: 'fca-ept-toggle',
						onChange: (
							function( newValue ){ 
								if ( newValue ){
									props.setAttributes( { urlTarget: '_blank' } )

								} else {
									props.setAttributes( { urlTarget: '_self' } )
								}
								props.setAttributes( { urlTargetToggle: newValue } )
							}
						)
					})
				)
			),

			el( wp.components.PanelHeader, {},
				el( wp.components.Button, { 
					className: 'components-button is-link fca-ept-select-layout',
					onClick: ( function(){ 
						props.setAttributes( { align: 'wide' } )
						props.setAttributes( { selectedLayout: '' } ) 
						$( '#' + props.attributes.tableID ).remove()
					} )
				},
					'Choose a different layout'
				)

			),
			el( wp.components.PanelBody, { 
				className: 'fca-ept-get-premium',
				title: 'Upgrade to premium',
				initialOpen: true },
				el( 'ul', {
					className: 'get-premium-features' },

					el( 'li', { },

						el( 'div', {
							className: 'dashicons dashicons-yes' }
						), 'More beautiful layouts'

					),

					el( 'li', { },

						el( 'div', {
							className: 'dashicons dashicons-yes' }
						), 'Add images to your tables'

					),

					el( 'li', { },

						el( 'div', {
							className: 'dashicons dashicons-yes' }
						), 'Comparison tables'

					),

					el( 'li', { },

						el( 'div', {
							className: 'dashicons dashicons-yes' }
						), 'WooCommerce integration'

					),

					el( 'li', { },

						el( 'div', {
							className: 'dashicons dashicons-yes' }
						), 'More customization options'

					),

					el( 'li', { },

						el( 'div', {
							className: 'dashicons dashicons-yes' }
						), 'Fast & friendly email support'

					),

					el( 'a', {
						type: 'button',
						target: '_blank',
						href: 'https://fatcatapps.com/easypricingtables/?utm_campaign=wp%2Bgutenberg&utm_source=Easy%2BPricing%2BTables%2BFree&utm_medium=plugin&utm_content=v1',
						className: 'get-premium-button',
					}, 'Learn more' )

				)
				
			)

		)

	)
} 
/********************/
/* Shared functions */
/********************/

function fca_ept_custom_reusable_block(){

	var currentPost = wp.data.select( 'core/editor' ).getCurrentPost()

	if( customBlock && currentPost.type === 'wp_block' && currentPost.content.split( '<!--' )[1].includes( 'wp:fatcatapps/easy-pricing-table' ) ) {

	 	var eptBlock = wp.data.select( 'core/block-editor' ).getBlocks().filter( function( block ){
	 		return block.name === 'fatcatapps/easy-pricing-tables'
	 	})

		wp.data.subscribe(function () {

			// prevent block from being removed
		 	var newBlockList = wp.data.select( 'core/block-editor' ).getBlocks().filter( function( block ){
		 		return block.name === 'fatcatapps/easy-pricing-tables'
		 	})

			if ( newBlockList.length < eptBlock.length ) {
				wp.data.dispatch( 'core/block-editor' ).resetBlocks( eptBlock );
			}

			// save hook
			var isSavingPost = wp.data.select( 'core/editor' ).isSavingPost();
			var isAutosavingPost = wp.data.select( 'core/editor' ).isAutosavingPost();
			if ( isSavingPost && !isAutosavingPost ) {

				var activeNotices = wp.data.select( 'core/notices' ).getNotices()
				var result = activeNotices.filter( function( notice, i ){
					return notice.id === 'fcaEptSuccessNotice'
				})

				if( !result.length ){

				    wp.data.dispatch( 'core/notices' ).createNotice(
				        'success',
				       	'Pricing Table saved successfully! Your shortcode: [ept3-block id="' + wp.data.select( 'core/editor' ).getCurrentPost().id + '"]', // Text string to display.
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
				    );
				}
			}
		})

		// After the block is rendered, add style changes
		$( document ).ready( function(){

			// on first load, select block
			if( $( '.components-button.edit-post-header-toolbar__inserter-toggle.is-primary.has-icon' ).css( 'display' ) !== 'none' ){
				wp.data.dispatch( 'core/block-editor' ).selectBlock( eptBlock[0].clientId )
			}

			$( '.components-button.edit-post-header-toolbar__inserter-toggle.is-primary.has-icon' ).css( 'display', 'none' )
			if( wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ) ){
				$( '.components-button.edit-post-fullscreen-mode-close.has-icon' ).first().attr( 'href', 'edit.php?post_type=easy-pricing-table&page=ept3-list' )
			}
			$( '.components-panel__header.interface-complementary-area-header.edit-post-sidebar__panel-tabs' ).css( 'display', 'none' )
			$( '.editor-post-title__input' ).css( 'textAlign', 'center' )
			$( '.editor-post-title__input' ).css( 'height', 'unset' )
			$( '.editor-post-title__input' ).css( 'fontSize', '300%' )
			$( '.editor-post-title__input' ).css( 'margin', '0%' )
			$( '.wp-block editor-post-title.editor-post-title__block' ).css( 'paddingBottom', '30px' )
			$( '.block-editor-default-block-appender' ).css( 'display', 'none' )
			$( '.components-dropdown.block-editor-inserter' ).css( 'display', 'none' )
			$( '.edit-post-header-toolbar__left div.components-dropdown' ).css( 'display', 'none' )
			$( '.edit-post-visual-editor__post-title-wrapper' ).css( 'paddingBottom', '5px' )
			$( '.editor-styles-wrapper' ).css( 'backgroundColor', 'white' )
			$( '.block-editor-block-list__layout.is-root-container .block-list-appender.wp-block' ).css( 'display', 'none' )
			$( '.wp-block.editor-post-title.editor-post-title__block' ).appendTo( '.edit-post-header__toolbar' )
			$( '.wp-block.editor-post-title.editor-post-title__block' ).css( 'margin', '0 auto' )
			$( '.wp-block.editor-post-title.editor-post-title__block' ).css( 'width', '100%' )
			$( '.wp-block.editor-post-title.editor-post-title__block' ).css( 'padding', '0 110px 0 0' )
			$( '.wp-block.editor-post-title.editor-post-title__block' ).css( 'fontSize', '0.5vw' )
			$( '.edit-post-header-toolbar' ).css( 'flexGrow', '0' )
			$( '.editor-styles-wrapper' ).css( 'paddingTop', '30px' )

		})

		customBlock = 0

	}

}

function fca_ept_increase_fontsize ( props ){
	var section = props.attributes.selectedSection
	var fontSizeStr = eval( 'props.attributes.' + section + 'FontSize' ).toString()
	var fontSizeAttr = section + 'FontSize' 
	var fontsize = ( Number( fontSizeStr.slice( 0,-1 ) ) ) + 15

	var fontSizeObj = JSON.parse( '{"' + fontSizeAttr + '": "' + fontsize + '%"' + '}' )

	props.setAttributes( fontSizeObj )

}

function fca_ept_decrease_fontsize ( props ){
	var section = props.attributes.selectedSection
	var fontSizeStr = eval( 'props.attributes.' + section + 'FontSize' ).toString()
	var fontSizeAttr = section + 'FontSize'
 	var fontsize = ( Number( fontSizeStr.slice( 0,-1 ) ) ) - 15

 	var fontSizeObj = JSON.parse( '{"' + fontSizeAttr + '": "' + fontsize + '%"' + '}' )

	props.setAttributes( fontSizeObj )

}

function fca_ept_set_popular ( props ) {

	var columnSettings = JSON.parse( props.attributes.columnSettings )
	var selectedCol = parseInt( props.attributes.selectedCol )
	var tableID = props.attributes.tableID

	columnSettings.filter( function ( col, i ){

		if ( i === selectedCol ){ 
			if ( col.columnPopular ){
				col.columnPopular = false
				props.setAttributes( { columnSettings: JSON.stringify( columnSettings ) } )
				props.setAttributes ( { popularToolbarIcon: 'star-empty' } )
				setTimeout( function(){
					$( '#fca-ept-table-' + tableID + ' .fca-ept-column' )[selectedCol].classList.add( 'fca-ept-selected-column' )
				}, 30 )
			} else {
				col.columnPopular = true
				props.setAttributes( { columnSettings: JSON.stringify( columnSettings ) } )
				props.setAttributes ( { popularToolbarIcon: 'star-filled' } )
				setTimeout( function(){
					$( '#fca-ept-table-' + tableID + ' .fca-ept-column' )[selectedCol].classList.add( 'fca-ept-selected-column' )
				}, 30 )
			}
		} else {
			col.columnPopular = false
			props.setAttributes( { columnSettings: JSON.stringify( columnSettings ) } )
		}
	})

}

function fca_ept_get_preview_settings( props ){

	var selectedLayout = props.attributes.selectedLayout
	var tableID = props.attributes.tableID

	wp.data.subscribe(function () {

		var previewDisplay = wp.data.select( 'core/edit-post' ).__experimentalGetPreviewDeviceType()

		if( previewDisplay === 'Mobile' || previewDisplay === 'Tablet' ){
			$( '#fca-ept-table-' + tableID + ' .fca-ept-table-container div.fca-ept-toggle-period-container' ).css( 'paddingRight', '0' )
			$( '#fca-ept-table-' + tableID + ' div.fca-ept-' + selectedLayout ).css( 'display', 'block' )
			$( '#fca-ept-table-' + tableID + ' div.fca-ept-' + selectedLayout ).css( 'fontSize', '75%' )
			$( '#fca-ept-table-' + tableID + ' div.fca-ept-' + selectedLayout ).css( 'paddingRight', '0' )
			$( '#fca-ept-table-' + tableID + ' div.fca-ept-' + selectedLayout + ' div.fca-ept-column' ).css( 'marginTop', '15px' )
			if( selectedLayout === 'layout1' ){
				$( '#fca-ept-table-' + tableID + ' div.fca-ept-layout1 div.fca-ept-column.fca-ept-most-popular' ).css( 'marginTop', '70px' )
			} 	
		} else {
			$( '#fca-ept-table-' + tableID + ' .fca-ept-table-container div.fca-ept-toggle-period-container' ).css( 'paddingRight', '20px' )
			$( '#fca-ept-table-' + tableID + ' div.fca-ept-' + selectedLayout ).css( 'display', 'flex' )
			$( '#fca-ept-table-' + tableID + ' div.fca-ept-' + selectedLayout ).css( 'fontSize', '16px' )
			$( '#fca-ept-table-' + tableID + ' div.fca-ept-' + selectedLayout ).css( 'paddingRight', '20px' )
			$( '#fca-ept-table-' + tableID + ' div.fca-ept-' + selectedLayout + ' div.fca-ept-column' ).css( 'marginTop', '10px' )
			if( selectedLayout === 'layout1' ){
				$( '#fca-ept-table-' + tableID + ' div.fca-ept-layout1 div.fca-ept-column' ).css( 'marginTop', '54px' )
			} 
			
		}

	})

}

function fca_ept_select_column ( props, id ) {

	var columnSettings = JSON.parse( props.attributes.columnSettings )
	var tableID = props.attributes.tableID

	props.setAttributes ( { selectedCol: id } )

	if( columnSettings[id].columnPopular ){
		props.setAttributes ( { popularToolbarIcon: 'star-filled' } )
	} else {
		 props.setAttributes ( { popularToolbarIcon: 'star-empty' } )
	}

	$( '#fca-ept-table-' + tableID + ' .fca-ept-column' ).filter( function( i, column ){
		if( column.classList.contains( 'fca-ept-selected-column' ) ){
			if( i === id ){
				return;
			} 
			column.classList.remove( 'fca-ept-selected-column' )
		} else if( i === id ) {
			setTimeout( function(){
				column.classList.add( 'fca-ept-selected-column' )
			}, 30 )
		}
	})

}

function fca_ept_move_column ( props, direction ) {

	var columnSettings = JSON.parse( props.attributes.columnSettings )
	var selectedCol = parseInt( props.attributes.selectedCol )
	var fromPosition = selectedCol
	var columnData = columnSettings.splice( fromPosition, 1 )[0]
	var toPosition = selectedCol + 1

	if ( direction === 'left' ){
		toPosition = selectedCol -1 < 0 ? columnSettings.length : selectedCol -1
	}
	if ( direction === 'right' ){
		toPosition = selectedCol +1 > columnSettings.length ? 0 : selectedCol +1
	}

	columnSettings.splice( toPosition, 0, columnData )
	props.setAttributes( { columnSettings: JSON.stringify( columnSettings ) } )
	fca_ept_select_column( props, toPosition )

}

function fca_ept_add_column ( props ) {
	var columnSettings = JSON.parse( props.attributes.columnSettings )
	var newList = Array.from( columnSettings )
	
	var columnDefaults = fca_ept_defaultColumnSettings
	newList.push( columnDefaults[0] )
	
	props.setAttributes( { columnSettings: JSON.stringify( newList ) } )

}

function fca_ept_del_column ( props ) {

	var columnSettings = JSON.parse( props.attributes.columnSettings )
	var selectedCol = parseInt( props.attributes.selectedCol )

	if ( columnSettings.length > 1 ){

		columnSettings.splice( ( selectedCol ), 1 )
		props.setAttributes( { selectedCol: ( columnSettings.length - 1 ) } )
		props.setAttributes( { columnSettings: JSON.stringify( columnSettings ) } )

		fca_ept_select_column( props, columnSettings.length - 1 )
	}
	
}

function fca_ept_generate_id() {

	var newID = 'xxxx'.replace(/[x]/g, function(c) {
		var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8)
		return v.toString(16)
	})

	return newID

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

function fca_ept_toolbar_controls( props ){

	var IncreaseFontsizeIcon = ( el( 'svg', {
			role: 'img',
			focusable: 'false',
			viewBox: '0 0 24 24',
			width: '24',
			height: '24'
			}, 
			el( 'path', {
				d: 'M2 4V7H7V19H10V7H15V4H2Z',
				fill: '#111111'
			}),
			el( 'rect',{
				x: '13',
				y: '12',
				width: '8',
				height: '2',
				fill: '#000'
			}),
			el( 'rect',{
				x: '18',
				y: '9',
				width: '8',
				height: '2',
				transform: 'rotate(90 18 9)',
				fill: '#000'
			})
		)
	)

	var DecreaseFontsizeIcon = ( el( 'svg', {
			role: 'img',
			focusable: 'false',
			viewBox: '0 0 24 24',
			width: '24',
			height: '24'
			}, 
			el( 'path', {
				d: 'M4 4V7H9V19H12V7H17V4H4Z',
				fill: '#111111'
			}),
			el( 'rect' ,{
				x: '15',
				y: '12',
				width: '6',
				height: '2',
				fill: '#000'
			})
		) 
	)

	// TOOLBAR CONTROLS
	return( el( wp.blockEditor.BlockControls, { key: 'ept-toolbar-controls' },

		el( wp.components.ToolbarButton, { 
			icon: 'plus-alt', 
			label: 'Add column', 
			onClick: function(){ fca_ept_add_column( props ) }
		}),
		el( wp.components.ToolbarButton, {
			icon: 'trash', 
			label: 'Remove selected column',
			onClick: function(){ fca_ept_del_column( props ) }
		}),
		el( wp.components.ToolbarButton, {
			icon: props.attributes.popularToolbarIcon ? props.attributes.popularToolbarIcon : 'star-empty',
			label: 'Set as most popular',
			onClick: function() { fca_ept_set_popular( props ) }
		}),
		el( wp.components.ToolbarButton, { 
			icon: 'arrow-left-alt', 
			label: 'Move selected column to the left', 
			onClick: function(){ fca_ept_move_column( props, 'left' ) }
		}),
		el( wp.components.ToolbarButton, {
			icon: 'arrow-right-alt',
			label: 'Move selected column to the right',
			onClick: function(){ fca_ept_move_column( props, 'right' ) }
		}),
		el( wp.components.ToolbarButton, {
			className: 'fca-ept-increase-fontsize',
			icon: IncreaseFontsizeIcon,
			label: 'Increase font size',
			onClick: function(){ fca_ept_increase_fontsize( props ) }
		}),
		el( wp.components.ToolbarButton, {
			icon: DecreaseFontsizeIcon,
			label: 'Decrease font size',
			onClick: function(){ fca_ept_decrease_fontsize( props ) } 
		}),
		el( wp.editPost.PluginBlockSettingsMenuItem, {
			icon: 'html',
			label: 'Copy table HTML',
			onClick: ( function(){				
				$.ajax({
					url: fca_ept_editor_script_data.ajax_url,
					type: 'POST',
					data: {
						"attributes": props.attributes,
						"action": "fca_ept_get_block_html_ajax",
					}
				}).done( function( response ) {
					if( response && response.success ) {

						var tempTextarea = document.createElement( 'textarea' )
						document.body.appendChild(tempTextarea)
						tempTextarea.value = response.data
						tempTextarea.select()
						document.execCommand( 'copy' )
						document.body.removeChild( tempTextarea )

						alert( 'Successfully copied table HTML to clipboard!' )
					} else if( response.data ) {
						alert( response.data )
					} else {
						alert( 'An error occurred :(' )
					}
				})
			})
		})
	))
}

function fca_ept_update_section( props, section ){

	props.setAttributes({ selectedSection: section })
	section === 'button' ? props.setAttributes({ showURLPopover: 'block' }) : props.setAttributes({ showURLPopover: 'none' })

}
