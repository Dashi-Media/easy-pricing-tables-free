<?php

// Standard shortcode
function dh_ptp_message_shortcode($atts)
{
	// extract id shortcode
    extract(shortcode_atts( array('id' => ''), $atts));  

    // check if id exists
    if ($id != '' ) {
    	global $features_metabox;
		$meta = get_post_meta($id, $features_metabox->get_the_id(), TRUE);

        // check if our pricing table contains any content
		if ($meta != "") {
            // if the table contains content, call the function that generates the table
			return do_shortcode(dh_ptp_generate_pricing_table($id));
		}
    }
	
	return __('Pricing table does not exist. Please check your shortcode.', 'easy-pricing-tables');
}
add_shortcode('easy-pricing-table', 'dh_ptp_message_shortcode');

// Switch shortcode
function dh_ptp_switch_shortcode( $atts, $content = null, $tag = null )
{
    // extract shortcode params
    $params = 
		shortcode_atts(
			array(
				'font_color' => '',
				'background_color' => '',
				'border_color' => '',
				'default_title' => '',
				'default_subtitle' => '',
				'default_pricing_table_id' => '',
				'alternate_title' => '',
				'alternate_subtitle' => '',
				'alternate_pricing_table_id' => '',
                'alternate_2_title' => '',
				'alternate_2_subtitle' => '',
				'alternate_2_pricing_table_id' => ''
			),
			$atts
		);

	// Check if all parameters set
	$check = $params;
	unset( $check['default_subtitle'],
               $check['alternate_subtitle'],
               $check['alternate_2_pricing_table_id'],
               $check['alternate_2_subtitle'],
               $check['alternate_2_title'] 
              );
	foreach($check as $param) {
		if (strlen($param) == 0) {
			return __('All mandatory parameters must be specified for switch pricing table shortcode!', 'easy-pricing-tables');
		}
	}
	
        if( $params['alternate_2_pricing_table_id'] !=='' ) {
            if ( $params['alternate_2_title'] === '' ) {
			return __('Alternate Title 2 parameter must be specified for switch pricing table shortcode!', 'easy-pricing-tables');
		}
        }
        
	// Check if the table ids are not the same
	if ( $params['default_pricing_table_id'] == $params['alternate_pricing_table_id'] ||
             $params['default_pricing_table_id'] == $params['alternate_2_pricing_table_id'] ||
             $params['alternate_pricing_table_id'] == $params['alternate_2_pricing_table_id'] )
            {
		return __('Default and alternate pricing table id\'s must be different!', 'easy-pricing-tables');
	    }
	
	// Additional options
	$settings = get_post_meta($params['default_pricing_table_id'], '1_dh_ptp_settings', true);
	$selected = '';
	if (isset($settings['dh-ptp-simple-flat-template']) && $settings['dh-ptp-simple-flat-template'] == 'selected') { $selected = 'design1'; }
	if (isset($settings['dh-ptp-fancy-flat-template']) && $settings['dh-ptp-fancy-flat-template'] == 'selected') { $selected = 'design2'; }
	if (isset($settings['dh-ptp-stylish-flat-template']) && $settings['dh-ptp-stylish-flat-template'] == 'selected') { $selected = 'design3'; }
	if (isset($settings['dh-ptp-design4-template']) && $settings['dh-ptp-design4-template'] == 'selected') { $selected = 'design4'; }
    if (isset($settings['dh-ptp-dg5-template']) && $settings['dh-ptp-dg5-template'] == 'selected') { $selected = 'design5'; }
    if (isset($settings['dh-ptp-dg6-template']) && $settings['dh-ptp-dg6-template'] == 'selected') { $selected = 'design6'; }
    if (isset($settings['dh-ptp-dg7-template']) && $settings['dh-ptp-dg7-template'] == 'selected') { $selected = 'design7'; }
	if (isset($settings['dh-ptp-comparison1-template']) && $settings['dh-ptp-comparison1-template'] == 'selected') { $selected = 'comparison1'; }
    if (isset($settings['dh-ptp-comparison2-template']) && $settings['dh-ptp-comparison2-template'] == 'selected') { $selected = 'comparison2'; }
	if (isset($settings['dh-ptp-comparison3-template']) && $settings['dh-ptp-comparison3-template'] == 'selected') { $selected = 'comparison3'; }
        
	//switch defaults
	$rounded_corners = '';
	$font_family = '';
	$font_size = '';
	$box_shadow = '';
	
	$subtitle_color = '';
	$subtitle_font_size = '';
	$subtitle_font_family = '';
	
	$margin_top = '';
	$margin_bottom = '';
	
	// switch
	switch ($selected) {
		case 'design1':
			// switch
			$rounded_corners = isset($settings['rounded-corners'])?$settings['rounded-corners']:'0px';
			$font_family = 'inherit';
			$font_size = '1em';
			
			// subtitle
			$design1_plan_name_font_size = isset($settings['plan-name-font-size'])?$settings['plan-name-font-size']:1;
			$design1_plan_name_font_size_type = isset($settings['plan-name-font-size-type'])?$settings['plan-name-font-size-type']:"em";
			$subtitle_color = '#8D8D8D';
			$subtitle_font_size = $design1_plan_name_font_size.$design1_plan_name_font_size_type;
			$subtitle_font_family = 'inherit';
			
			// margins
			$margin_top = '25px';
			$margin_bottom = '25px';
			break;
		case 'design2':
			// switch
			$rounded_corners = '5px';
			$font_family = 'Helvetica';
			$font_size = '16px';
			
			// subtitle
			$subtitle_color = '#8D8D8D';
			$subtitle_font_size = '15px';
			$subtitle_font_family = 'Helvetica';
			
			// margins
			$margin_top = '25px';
			$margin_bottom = '25px';
			break;
		case 'design3':
			// switch
			$rounded_corners = '3px';
			$font_family = 'inherit';
			$font_size = '16px';

			// subtitle
			$subtitle_color = '#121212';
			$subtitle_font_size = '15px';
			$subtitle_font_family = 'inherit'; // fix
			
			// margins
			$margin_top = '15px';
			$margin_bottom = '35px';
			break;
		case 'design4':
			// switch
			$rounded_corners = '5px';
			$font_family = 'inherit'; // fix
			$font_size = '16px';
			$box_shadow = '-webkit-box-shadow: 0 0 10px 0 #dbdbdb; box-shadow: 0 0 10px 0 #dbdbdb;';
			
			// subtitle
			$subtitle_color = '#8C8C8C';
			$subtitle_font_size = '15px';
			$subtitle_font_family = 'inherit'; // fix
			
			// margins
			$margin_top = '15px';
			$margin_bottom = '10px';
			break;
                case 'design5':
			// switch
			$rounded_corners = '5px;';
			$font_family = 'Helvetica';
			$font_size = '16px';
			
			// subtitle
			$subtitle_color = '#8D8D8D';
			$subtitle_font_size = '15px';
			$subtitle_font_family = 'Helvetica';
			
			// margins
			$margin_top = '25px';
			$margin_bottom = '25px';
			break; 
                case 'design6':
			// switch
			$rounded_corners = '5px;';
			$font_family = 'Helvetica';
			$font_size = '16px';
			
			// subtitle
			$subtitle_color = '#8D8D8D';
			$subtitle_font_size = '15px';
			$subtitle_font_family = 'Helvetica';
			
			// margins
			$margin_top = '25px';
			$margin_bottom = '0px';
			break;
                case 'design7':
			// switch
			$rounded_corners = '5px;';
			$font_family = 'Helvetica';
			$font_size = '16px';
			
			// subtitle
			$subtitle_color = '#8D8D8D';
			$subtitle_font_size = '15px';
			$subtitle_font_family = 'Helvetica';
			
			// margins
			$margin_top = '25px';
			$margin_bottom = '0px';
			break;    
		case 'comparison1':
			// switch
			$rounded_corners = '5px';
			$font_family = 'Open Sans Condensed';
			$font_size = '16px';
			$box_shadow = 'box-shadow: 0px 2px 2px #8C8C8C; -webkit-box-shadow: 0px 2px 2px #8C8C8C;';
			
			// subtitle
			$subtitle_color = '#8C8C8C';
			$subtitle_font_size = '15px';
			$subtitle_font_family = 'Open Sans Condensed';
			
			// margins
			$margin_top = '15px';
			$margin_bottom = '10px';
			break;
                case 'comparison2':
			// switch
			$rounded_corners = '5px';
			$font_family = 'maven_prolight';
			$font_size = '16px';
			
			// subtitle
			$subtitle_color = '#8C8C8C';
			$subtitle_font_size = '15px';
			$subtitle_font_family = 'inherit';
			
			// margins
			$margin_top = '15px';
			$margin_bottom = '10px';
			break;
               case 'comparison3':
			// switch
			$rounded_corners = '5px';
			$font_family = 'inherit';
			$font_size = '16px';
			
			// subtitle
			$subtitle_color = '#8C8C8C';
			$subtitle_font_size = '15px';
			$subtitle_font_family = 'inherit';
			
			// margins
			$margin_top = '15px';
			$margin_bottom = '10px';
			break;     
	}
	
	if ($params['default_pricing_table_id'] != '' && $params['alternate_pricing_table_id'] != '') {                                
                
		// Switch style
		$switch_style = 'display: block; margin: 0 auto; border-radius: '.$rounded_corners.'; ';

		// Common button styles
		$link_styles = '
			float:left;
			padding-top: 8px;
			padding-bottom: 7px;
			text-align: center;
			text-decoration: none;
			border-bottom: 1px solid '.$params['border_color'].';
			border-top: 1px solid '.$params['border_color'].';
			font-family: '.$font_family.';
			font-size: '.$font_size.';
		';
		
		// Subtitle style
		$subtitle_styles = '
			width: 100% !important;
			font-family: '.$subtitle_font_family.';
			font-size: '.$subtitle_font_size.';
			color: '.$subtitle_color.';
			padding-top: '.$margin_top.';
			padding-bottom: '.$margin_bottom.';
		';
		// checks if there is no subtile, hide the subtile div block 
                $margin_bottom_for_no_subtitle = false;
                $is_no_subtitle = false;
                if( !$params['default_subtitle'] && !$params['alternate_subtitle'] && !$params['alternate_2_subtitle'] ){
                    $subtitle_styles .= 'display: none;';
                    $switch_style .= 'margin-bottom: '.$margin_bottom.';';
                    $is_no_subtitle = true;
                } else {
                    $subtitle_styles .= 'display: block;';    
                }
                
                
                $id = 'dh_ptp_table_switch_'.$params['default_pricing_table_id'].'_'.$params['alternate_pricing_table_id'];
                // Detect if there are 2 same toggle shortcodes in a page/post
                static $detect_the_same_call = array();

                if ( in_array($id, $detect_the_same_call)  )
                {
                   $id .= '_'.count($detect_the_same_call);
                }

                // set the id of toggle to flag array variable
                array_push($detect_the_same_call, $id);
                
                
                $alternate_2_title_text = '';
                $alternate_2_subtitle_text = '';
                $alternate_2_shortcode_text = '';
                
                // the script will excute the toggle
                $js_script_text = '';
                // html output of toggle feature
                $output = '';
                $dh_ptp_switch_tab_html_text = '';
                $dh_ptp_switch_subtitle__html_text = '<span class="subtitle_'.$params['default_pricing_table_id'].'">'.$params['default_subtitle'] . '</span>' .
					             '<span class="subtitle_'.$params['alternate_pricing_table_id'].'" style="display:none; ">'.$params['alternate_subtitle'] . '</span>';
                // if there is 3rd pricing table
                if ( $params['alternate_2_pricing_table_id'] != '' ) {
                    
                    
                    $id .= '_'.$params['alternate_2_pricing_table_id'];
                    // Switch style
					$switch_style = 'width: 460px; display: block; margin: 0 auto; border-radius: '. $rounded_corners .'; '. $box_shadow . (($is_no_subtitle)? ( 'margin-bottom: ' . $margin_bottom .';') : '');

                    // Common button styles
                    $link_styles .= 'width: calc(33.23% - 1px);  box-sizing: border-box;';
                    // sanitise css code
                    $link_styles = sanitize_text_field($link_styles);
                    
                    $alternate_2_title_text = '<a href="#" style="'.$link_styles.' border-left: 1px solid '.$params['border_color'].'; border-top-left-radius: '.$rounded_corners.'; border-bottom-left-radius: '.$rounded_corners.'; color: '.$params['background_color'].'; background: '.$params['font_color'].';" data-id="'.$params['alternate_2_pricing_table_id'].'" title="'.$params['alternate_2_title'].'">'.$params['alternate_2_title'].'</a>';
                    
                    $dh_ptp_switch_tab_html_text = $alternate_2_title_text.
                                                   '<a href="#" class="dh_ptp_switch_selected" style="'.$link_styles.' border-left: 1px solid '.$params['border_color'].'; color: '.$params['font_color'].'; background: '.$params['background_color'].';" data-id="'.$params['default_pricing_table_id'].'" title="'.$params['default_title'].'">'.$params['default_title'].'</a>'.
					           '<a href="#" style="'.$link_styles.' border-left: 1px solid '.$params['border_color'].'; border-right: 1px solid '.$params['border_color'].'; border-top-right-radius: '.$rounded_corners.'; border-bottom-right-radius: '.$rounded_corners.'; color: '.$params['background_color'].'; background: '.$params['font_color'].';" data-id="'.$params['alternate_pricing_table_id'].'" title="'.$params['alternate_title'].'">'.$params['alternate_title'].'</a>'; 
                    
                     $alternate_2_subtitle_text = '<span class="subtitle_'.$params['alternate_2_pricing_table_id'].'" style="display:none; ">'.$params['alternate_2_subtitle'] . '</span>';                    
                    $dh_ptp_switch_subtitle__html_text = $alternate_2_subtitle_text.$dh_ptp_switch_subtitle__html_text;
                    
                    $alternate_2_shortcode_text = do_shortcode(dh_ptp_generate_pricing_table($params['alternate_2_pricing_table_id'],true));
                    $js_script_text = 'jQuery(document).ready(function($){ 
				            $("#'.$id.' .dh_ptp_switch a").on("click", function(){ 
							// Get the two switch elements
							$elem_clicked = $(this);
                                                        $elem_selected =  $("#'.$id.' .dh_ptp_switch a.dh_ptp_switch_selected");
                                                        // return if the clicked elem was selected
                                                        if($elem_clicked[0] == $elem_selected[0] ) return false;
							$elem_other = $( "#' . $id . ' .dh_ptp_switch a" ).not( $elem_clicked );
							// Get the colors
							clicked_color = $elem_clicked.css( "color" );
							clicked_bg = $elem_clicked.css( "background-color" );
							other_color = $elem_selected.css( "color" );
							other_bg = $elem_selected.css( "background-color" );
							// Switch colors
							$elem_clicked.css( { "color": other_color, "background-color": other_bg } );
							$elem_other.css( { "color": clicked_color, "background-color": clicked_bg } );
                                                        //Change the class of selected element
                                                        $elem_selected.removeAttr( "class" );
                                                        $elem_clicked.addClass( "dh_ptp_switch_selected" );                                                       
							// Toggle subtitles visibility                                                        
                                                        selected_table_id = $elem_clicked.data("id");
							$( "[class^=subtitle_]", "[id^=dh_ptp_table_switch_][id*='.$id.']" ).hide();
                                                        $( "[id^=dh_ptp_table_switch_][id*='.$id.'] .subtitle_"+selected_table_id ).show();
							// Toggle pricing tables visibility
                                                        $( "[id^=dh_ptp_table_switch_][id*='.$id.'] [id^=ptp-"+selected_table_id+"]" ).addClass("is-visible");         
                                                        $("#'.$id.' .ptp-bounce-invert").addClass("is-switched").one("webkitAnimationEnd oanimationend msAnimationEnd animationend", function() {
                                                                 $( "#'.$id.' > [id^=ptp-]" ).removeClass("is-visible");
                                                                 $(".ptp-bounce-invert").removeClass("is-switched");
					                });
							$( this ).closest(".dh_ptp_switch").siblings("div").not(".dh_ptp_switch_subtitle").hide();
                                                        $( "#ptp-" + selected_table_id ).show();                                                            
                                                        var call_matchHeight_str =         "if ($.call_match_height_"+selected_table_id+"){$.call_match_height_"+selected_table_id+"( \'#ptp-"+selected_table_id+"\' );}";
                                                        eval( call_matchHeight_str ); 
							return false; 
						});
					});';
                    // sanitise css code
                    $switch_style = sanitize_text_field($switch_style);                
                    $subtitle_styles = sanitize_text_field($subtitle_styles);
                    $output =
			'<div id="'.$id.'">'.
				'<div class="dh_ptp_switch" style="'.$switch_style.'">'.
					$dh_ptp_switch_tab_html_text.
                                        '<div style="clear:both;"></div>'.
				'</div>'.
				'<div class="dh_ptp_switch_subtitle" style="'.$subtitle_styles.' margin: 0 auto; text-align: center;">' .
                                        $dh_ptp_switch_subtitle__html_text .			        
                                '</div>';
                    
                } else {
                    
                    $link_styles .= 'width: calc(50% - 2px);  box-sizing: border-box;';
                    // sanitise css code
                    $link_styles = sanitize_text_field($link_styles);
                    
                    if( $tag === 'easy-pricing-switch' ) {                        
                    $switch_style .= 'width:100% !important;';
                    $dh_ptp_switch_tab_html_text = '<a href="#" class="dh_ptp_switch_selected" style="'.$link_styles.' border-left: 1px solid '.$params['border_color'].'; border-top-left-radius: '.$rounded_corners.'; border-bottom-left-radius: '.$rounded_corners.'; color: '.$params['font_color'].'; background: '.$params['background_color'].';" data-already-click="false" data-id="'.$params['default_pricing_table_id'].'" title="'.$params['default_title'].'">'.$params['default_title'].'</a>'.
					           '<a href="#" style="'.$link_styles.' border-right: 1px solid '.$params['border_color'].'; border-top-right-radius: '.$rounded_corners.'; border-bottom-right-radius: '.$rounded_corners.'; color: '.$params['background_color'].'; background: '.$params['font_color'].';" data-id="'.$params['alternate_pricing_table_id'].'" title="'.$params['alternate_title'].'">'.$params['alternate_title'].'</a>';

                    $js_script_text = 'jQuery(document).ready(function($){                     
                                            var $is_first_click_'.$id.' = 1; 
                                                $("#'.$id.' .dh_ptp_switch a").unbind("dblclick");
                                                $("#'.$id.' .dh_ptp_switch a").dblclick(function(e){
                                                                            e.stopPropagation();
                                                                            e.preventDefault();
                                                                            return false;
                                                                        });    
                                              $("#'.$id.' .dh_ptp_switch a").on("click", function(e){
							// Get the two switch elements
							$elem_clicked = $(this);
                                                        $elem_selected =  $("#'.$id.' .dh_ptp_switch a.dh_ptp_switch_selected");
							$elem_other = $( "#' . $id . ' .dh_ptp_switch a" ).not( $elem_clicked );
							// Get the colors
							clicked_color = $elem_clicked.css( "color" );
							clicked_bg = $elem_clicked.css( "background-color" );
							other_color = $elem_other.css( "color" );
							other_bg = $elem_other.css( "background-color" );
							// Switch colors
							$elem_clicked.css( { "color": other_color, "background-color": other_bg } );
							$elem_other.css( { "color": clicked_color, "background-color": clicked_bg } );
                                                        //Change the class of selected element
                                                        if($elem_clicked.get(0) == $elem_selected.get(0)) {
                                                          $elem_clicked.removeAttr( "class" );
                                                          $elem_other.addClass( "dh_ptp_switch_selected" );
                                                        } else {
                                                          $elem_selected.removeAttr( "class" );
                                                          $elem_clicked.addClass( "dh_ptp_switch_selected" );
                                                        }                                                                                                               
							// Toggle subtitles visibility
							$( "[class^=subtitle_]", "[id^=dh_ptp_table_switch_][id*='.$id.']" ).toggle();
							// Toggle pricing tables visibility
                                                        selected_table_id = $("#'.$id.' .dh_ptp_switch a.dh_ptp_switch_selected").data("id");                                                          
							$(  "#'.$id.' > [id^=ptp-]").toggle();                                                        
                                                        var call_matchHeight_str =         "if ($.call_match_height_"+selected_table_id+"){$.call_match_height_"+selected_table_id+"( \'#ptp-"+selected_table_id+"\' );}";
                                                        eval( call_matchHeight_str );
							return false; 
						});
					});';
                     $output =
			'<div id="'.$id.'">'.
				'<div class="dh_ptp_switch" style="'.$switch_style.'">'.
					$dh_ptp_switch_tab_html_text.
                                        '<div style="clear:both;"></div>'.
				'</div>'.
				'<div class="dh_ptp_switch_subtitle" style="'.$subtitle_styles.' margin: 0 auto; text-align: center;">' .
                                        $dh_ptp_switch_subtitle__html_text .			        
                                '</div>';
                        
                    } elseif ( $tag === 'easy-pricing-toggle'  ) {
                        $switch_style .= 'width:550px;';
                        $alternate_title_html_text = '<div class="ptp-toggle-title text-aligned-left" style="color:'.$params['font_color'].';" data-id="'.$params['alternate_pricing_table_id'].'"><label for="ptp-toggle-'.$id.'" >'.$params['alternate_title'].'</label></div>';
                        $default_title_html_text = '<div class="ptp-toggle-title text-aligned-right dh_ptp_switch_selected" style="color:'.$params['font_color'].';" data-id="'.$params['default_pricing_table_id'].'"><label for="ptp-toggle-'.$id.'"  >'.$params['default_title'].'</label></div>'; 
                        $dh_ptp_switch_tab_html_text = '<input id="ptp-toggle-'.$id.'" class="ptp-toggle ptp-toggle-round" type="checkbox"><label  for="ptp-toggle-'.$id.'"></label>';

                        $js_script_text = 'jQuery(document).ready(function($){ 
                                                  var toggle_element = $("#'.$id.' .dh_ptp_switch .ptp-toggle-round");
                                                  toggle_element.on("change", function(e){
                                                            //Change the class of selected element                                                        
                                                            $("#'.$id.' .dh_ptp_switch div.ptp-toggle-title").toggleClass( "dh_ptp_switch_selected" );
                                                            // Toggle subtitles visibility
                                                            $( "[class^=subtitle_]", "[id^=dh_ptp_table_switch_][id*='.$id.']" ).toggle();                                                
                                                            // Toggle pricing tables visibility
                                                            selected_table_id = $("#'.$id.' .dh_ptp_switch div.dh_ptp_switch_selected").data("id");                                                         
                                                            $( "[id^=dh_ptp_table_switch_][id*='.$id.'] [id^=ptp-"+selected_table_id+"]" ).addClass("is-visible");         
                                                            $("#'.$id.' .ptp-bounce-invert").addClass("is-switched").one("webkitAnimationEnd oanimationend msAnimationEnd animationend", function() {
                                                                     $( "#'.$id.' > [id^=ptp-]" ).removeClass("is-visible");
                                                                     $(".ptp-bounce-invert").removeClass("is-switched");
                                                            });
                                                           $(  "#'.$id.' > [id^=ptp-]").toggle();
                                                            var call_matchHeight_str =         "if ($.call_match_height_"+selected_table_id+"){$.call_match_height_"+selected_table_id+"( \'#ptp-"+selected_table_id+"\' );}";
                                                            eval( call_matchHeight_str );
                                                            return false; 
                                                    });
                                                    toggle_element.attr("checked", false);
                                            });';

                        $css_script_text = '#'.$id.' input.ptp-toggle-round + label:before {  background-color: '.$params['background_color'].';}
                                            #'.$id.' input.ptp-toggle-round:checked + label:before {
                                              background-color: '.$params['background_color'].';}';
                        $css_script_text='<style type="text/css">'. sanitize_text_field($css_script_text).'</style>';
                        // sanitise css code
                        $switch_style = sanitize_text_field($switch_style);                
                        $subtitle_styles = sanitize_text_field($subtitle_styles);
                        $output =   $css_script_text.
                                    '<div id="'.$id.'" >'.
                                            '<div class="ptp-toggle-row dh_ptp_switch" style="'.$switch_style.'" >'.                                        
                                                    $default_title_html_text .
                                                    '<div class="ptp-switch">'.
                                                      $dh_ptp_switch_tab_html_text.
                                                    '</div>'.                                        
                                                     $alternate_title_html_text .
                                                    '<div style="clear:both;"></div>'.
                                            '</div>'.
                                            '<div class="dh_ptp_switch_subtitle" style="'.$subtitle_styles.' margin: 0 auto; text-align: center;">' .
                                                    $dh_ptp_switch_subtitle__html_text .		        
                                            '</div>';
                    
                    }       
                }          
		// Pricing tables
                $output .= $alternate_2_shortcode_text;
		$output .= do_shortcode(dh_ptp_generate_pricing_table($params['default_pricing_table_id']));
		$output .= do_shortcode(dh_ptp_generate_pricing_table($params['alternate_pricing_table_id'],true));
                
		// Javascript
		$output .= '<script type="text/javascript">';
		$output .= $js_script_text;
		$output .= '</script>';
		
		$output .= '</div>';
		
		return $output;
	}
	
	return __('Pricing table(s) does not exist. Please check your shortcode.', 'easy-pricing-tables');
}

add_shortcode('easy-pricing-toggle', 'dh_ptp_switch_shortcode');
//This shortcode use for user who use 1.9.x version and upgrade to 2.x version
add_shortcode('easy-pricing-switch', 'dh_ptp_switch_shortcode');
?>