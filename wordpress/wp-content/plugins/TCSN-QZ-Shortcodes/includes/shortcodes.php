<?php
/*------------------------------------------------------------
 * Table of Contents
 *
 * 1.  Lists
 * 2.  Text color
 * 3.  Dropcap
 * 4.  Highlight
 * 5.  Spacer / Gap
 * 6.  Tooltip
 * 7.  Table
 * 8. Button
 * 9. Icons
 * 10. Horizontal Spacer / Gap
 * 11. Styled link
 * 
 *------------------------------------------------------------*/

/*------------------------------------------------------------
 * Remove extra P tags
 *
 *------------------------------------------------------------*/
add_filter("the_content", "tcsn_shortcode_format");
 
function tcsn_shortcode_format($content) {
 
// array of custom shortcodes requiring the fix
$block = join("|",array( "list","ordered_list","list_item","list_checkmark","list_arrow","list_star","list_heart","list_circle","list_inline","list_separator","list_pricing_thead","list_pricing","text_style","dropcap","highlight","spacer","spacer_wide","blockquote","tooltip","table","tbody","thead","tr","th","td", "text_big", "text_caps", "button", "icon", "link_underline") );
// opening tag
$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
// closing tag
$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
 
return $rep;
 
}

/*------------------------------------------------------------
 * add_shortcodes
 *
 * @since 1.0
 * 
 *------------------------------------------------------------*/
 function tcsn_register_shortcodes() {
	add_shortcode( 'list', 'tcsn_list_sc' );
	add_shortcode( 'ordered_list', 'tcsn_ordered_list_sc' );
	add_shortcode( 'list_item', 'tcsn_list_item_sc' );
	add_shortcode( 'list_checkmark', 'tcsn_checkmark_list_sc' );
	add_shortcode( 'list_arrow', 'tcsn_arrow_list_sc' );
	add_shortcode( 'list_star', 'tcsn_star_list_sc' );
	add_shortcode( 'list_heart', 'tcsn_heart_list_sc' );
	add_shortcode( 'list_circle', 'tcsn_circle_list_sc' );
	add_shortcode( 'list_inline', 'tcsn_inline_list_sc' );
	add_shortcode( 'list_separator', 'tcsn_separator_list_sc' );
	add_shortcode( 'list_pricing', 'tcsn_pricing_list_sc' );
	add_shortcode( 'list_pricing_thead', 'tcsn_pricing_thead_list_sc' );
	add_shortcode( 'text_style', 'tcsn_text_style_sc' );
	add_shortcode( 'dropcap', 'tcsn_dropcap_sc' );
	add_shortcode( 'highlight', 'tcsn_text_highlight_sc' );
	add_shortcode( 'spacer', 'tcsn_spacer_sc' );
	add_shortcode( 'spacer_wide', 'tcsn_wide_spacer_sc' );
	add_shortcode( 'blockquote', 'tcsn_blockquote_sc' );
	add_shortcode( 'tooltip', 'tcsn_tooltip_sc' );
	add_shortcode( 'table', 'tcsn_table_sc' );
	add_shortcode( 'tbody', 'tcsn_table_body_sc' );
	add_shortcode( 'thead', 'tcsn_table_head_sc' );
	add_shortcode( 'tr', 'tcsn_table_tr_sc' );
	add_shortcode( 'th', 'tcsn_table_th_sc' );
	add_shortcode( 'td', 'tcsn_table_td_sc' );
	add_shortcode( 'button', 'tcsn_button_sc' );
	add_shortcode( 'icon', 'tcsn_icon_sc' );
	add_shortcode( 'link_underline', 'tcsn_link_underline_sc' );
}
add_action('init', 'tcsn_register_shortcodes');

/*------------------------------------------------------------
 * 1. Lists
 *
 * @since 1.0
 *
 * Examples below:
 *
// [list][list_item]List item one[/list_item][list_item]List item two[/list_item][/list]
// [list color="yellow" font_size="30px" list_style="square"][list_item]List item one[/list_item][list_item]List item two[/list_item][/list]
// [list_inline][list_item]List item one[/list_item][list_item]List item two[/list_item][/list_inline]
 *
 *------------------------------------------------------------*/
// ul
function tcsn_list_sc( $atts, $content = null ) {
	
	extract ( shortcode_atts( array(
		'color'			=> '', 
		'font_size'		=> '', 
		'list_style'	=> '', 
    ), $atts ) );
	
	$add_style = array();
		if( $color != ''  ) {
			$add_style[] = 'color: '. $color .';';
		} 
		if( $font_size != ''  ) {
			$add_style[] = 'font-size: '. $font_size .';';
		} 
		if( $list_style != ''  ) {
			$add_style[] = 'list-style-type: '. $list_style .';';
		} 
		$add_style = implode('', $add_style);

		if ( $add_style ) {
			$add_style = wp_kses( $add_style, array() );
			$add_style = ' style="' . esc_attr($add_style) . '"';
		}
	 return '<ul class="list" ' . $add_style . '>' . do_shortcode( $content ) . '</ul>';
}

// ol
function tcsn_ordered_list_sc( $atts, $content = null ) {
	
	extract ( shortcode_atts( array(
		'color'			=> '', 
		'font_size'		=> '', 
		'list_style'	=> '', 
    ), $atts ) );
	
	$add_style = array();
		if( $color != ''  ) {
			$add_style[] = 'color: '. $color .';';
		} 
		if( $font_size != ''  ) {
			$add_style[] = 'font-size: '. $font_size .';';
		} 
		if( $list_style != ''  ) {
			$add_style[] = 'list-style-type: '. $list_style .';';
		} 
		$add_style = implode('', $add_style);

		if ( $add_style ) {
			$add_style = wp_kses( $add_style, array() );
			$add_style = ' style="' . esc_attr($add_style) . '"';
		}
	 return '<ol class="list" ' . $add_style . '>' . do_shortcode( $content ) . '</ol>';
}

// li
function tcsn_list_item_sc( $atts, $content = null ) {
   return '<li>' . do_shortcode( $content ) . '</li>';
}
// Checkmark list
function tcsn_checkmark_list_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'color'		=> '', 
		'font_size'	=> '', 
    ), $atts ) );
		
   $add_style = array();
		if( $color != ''  ) {
			$add_style[] = 'color: '. $color .';';
		} 
		if( $font_size != ''  ) {
			$add_style[] = 'font-size: '. $font_size .';';
		} 
		$add_style = implode('', $add_style);

		if ( $add_style ) {
			$add_style = wp_kses( $add_style, array() );
			$add_style = ' style="' . esc_attr($add_style) . '"';
		}
   return '<ul class="list-checkmark"' . $add_style . '>' . do_shortcode( $content ) . '</ul>';
}
// Arrow list
function tcsn_arrow_list_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'color'		=> '', 
		'font_size'	=> '', 
    ), $atts ) );
		
   $add_style = array();
		if( $color != ''  ) {
			$add_style[] = 'color: '. $color .';';
		} 
		if( $font_size != ''  ) {
			$add_style[] = 'font-size: '. $font_size .';';
		} 
		$add_style = implode('', $add_style);

		if ( $add_style ) {
			$add_style = wp_kses( $add_style, array() );
			$add_style = ' style="' . esc_attr($add_style) . '"';
		}
   return '<ul class="list-arrow"' . $add_style . '>' . do_shortcode( $content ) . '</ul>';
}
// Heart list
function tcsn_heart_list_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'color'		=> '', 
		'font_size'	=> '', 
    ), $atts ) );
		
   $add_style = array();
		if( $color != ''  ) {
			$add_style[] = 'color: '. $color .';';
		} 
		if( $font_size != ''  ) {
			$add_style[] = 'font-size: '. $font_size .';';
		} 
		$add_style = implode('', $add_style);

		if ( $add_style ) {
			$add_style = wp_kses( $add_style, array() );
			$add_style = ' style="' . esc_attr($add_style) . '"';
		}
   return '<ul class="list-heart"' . $add_style . '>' . do_shortcode( $content ) . '</ul>';
}
// Star list
function tcsn_star_list_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'color'		=> '', 
		'font_size'	=> '', 
    ), $atts ) );
		
   $add_style = array();
		if( $color != ''  ) {
			$add_style[] = 'color: '. $color .';';
		} 
		if( $font_size != ''  ) {
			$add_style[] = 'font-size: '. $font_size .';';
		} 
		$add_style = implode('', $add_style);

		if ( $add_style ) {
			$add_style = wp_kses( $add_style, array() );
			$add_style = ' style="' . esc_attr($add_style) . '"';
		}
   return '<ul class="list-star"' . $add_style . '>' . do_shortcode( $content ) . '</ul>';
}
// Circle list
function tcsn_circle_list_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'color'		=> '', 
		'font_size'	=> '', 
    ), $atts ) );
		
   $add_style = array();
		if( $color != ''  ) {
			$add_style[] = 'color: '. $color .';';
		} 
		if( $font_size != ''  ) {
			$add_style[] = 'font-size: '. $font_size .';';
		} 
		$add_style = implode('', $add_style);

		if ( $add_style ) {
			$add_style = wp_kses( $add_style, array() );
			$add_style = ' style="' . esc_attr($add_style) . '"';
		}
   return '<ul class="list-circle"' . $add_style . '>' . do_shortcode( $content ) . '</ul>';
}

// Inline list
function tcsn_inline_list_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'color'		=> '', 
		'font_size'	=> '', 
    ), $atts ) );
		
	$add_style = array();
		if( $color != ''  ) {
			$add_style[] = 'color: '. $color .';';
		} 
		if( $font_size != ''  ) {
			$add_style[] = 'font-size: '. $font_size .';';
		} 
		$add_style = implode('', $add_style);

		if ( $add_style ) {
			$add_style = wp_kses( $add_style, array() );
			$add_style = ' style="' . esc_attr($add_style) . '"';
		}
   return '<ul class="list-inline"' . $add_style . '>' . do_shortcode( $content ) . '</ul>';
}
// Separator list
function tcsn_separator_list_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'color'		=> '', 
		'font_size'	=> '', 
    ), $atts ) );
		
	$add_style = array();
		if( $color != ''  ) {
			$add_style[] = 'color: '. $color .';';
		} 
		if( $font_size != ''  ) {
			$add_style[] = 'font-size: '. $font_size .';';
		} 
		$add_style = implode('', $add_style);

		if ( $add_style ) {
			$add_style = wp_kses( $add_style, array() );
			$add_style = ' style="' . esc_attr($add_style) . '"';
		}
   return '<ul class="list-separator"' . $add_style . '>' . do_shortcode( $content ) . '</ul>';
}

// Pricing list
function tcsn_pricing_list_sc( $atts, $content = null ) {
   return '<ul class="list-pricing">' . do_shortcode( $content ) . '</ul>';
}

function tcsn_pricing_thead_list_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'padding_top'	=> '', 
    ), $atts ) );
   return '<ul class="list-pricing th-list" style="padding-top: '. $padding_top.'">' . do_shortcode( $content ) . '</ul>';
}

/*------------------------------------------------------------
 * 2. Text style
 *
 * @since 1.0
 *
 * Examples below: 
 *
// [text_color size="like 24px, leave blank for default" line_height="" color=""]Content here[/text_color] 
 *
 *------------------------------------------------------------*/
function tcsn_text_style_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'size' => '', 
		'line_height' => '', 
		'color' => '', 
    ), $atts ) );
	
	
	$add_style = array();
		if ( $size ) {
			$add_style[] = ' font-size: ' . $size . ';';
		} 
		if ( $line_height ) {
			$add_style[] = ' line-height: ' . $line_height . ';';
		} 
		if ( $color ) {
			$add_style[] = ' color: ' . $color . ';';
		} 
		$add_style = implode('', $add_style);
		if ( $add_style ) {
			$add_style = wp_kses( $add_style, array() );
			$add_style = ' style="' . esc_attr($add_style) . '"';
		}

	
	return '<span' . $add_style . '>' . do_shortcode( $content ) . '</span>';
}

/*------------------------------------------------------------
 * 3. Dropcap
 *
 * @since 1.0
 *
 * Examples below: 
 *
// [dropcap size="" bg_color=""]T[/dropcap]
 *
 *------------------------------------------------------------*/
function tcsn_dropcap_sc( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'bg_color' => '', 
    ), $atts ) );
	
	if( $bg_color != ''  ) {
		$return_bg_color = ' style="background:' . $bg_color . ';"';
	}
	else{
		$return_bg_color = '';
	}

return '<span class="dropcap"' . $return_bg_color . '>' . do_shortcode( $content ) . '</span>';
}  
  
/*------------------------------------------------------------
 * 4. Highlight
 *
 * @since 1.0
 *
 * Examples below: 
 *
// [highlight bgcolor="green" color="#fff"]Content here[/highlight] 
 *
 *------------------------------------------------------------*/
function tcsn_text_highlight_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'bgcolor' => '', 
		'color'   => '', 
    ), $atts ) );
	
	if( $bgcolor != '' ||  $color != '' ) {

	$return_start = ' style="';
	$return_end = '"';

	if( $bgcolor != '' ) {
		$return_bgcolor = 'background-color:' . $bgcolor . ';';
	}
	else {
		$return_bgcolor = '';
	}
	if( $color != ''  ) {
		$return_color = 'color:' . $color . ';';
	}
	else{
		$return_color = '';
	}
}
else {
	$return_start = '';
	$return_end = '';
	$return_bgcolor = '';
	$return_color = '';
}
	return '<span class="highlight"' . $return_start . '' . $return_bgcolor . '' . $return_color . '' . $return_end . '>' . do_shortcode( $content ) . '</span>';
}

/*------------------------------------------------------------
 * 5. Vertical Spacer / Gap
 *
 * @since 1.0
 *
 * Example below: 
 * 
// [spacer height="in px"]
 * 
 *------------------------------------------------------------*/
function tcsn_spacer_sc( $atts, $content ) {
	extract ( shortcode_atts( array(
		'height'       => '', // in px
    ), $atts ) );

	return '<div class="spacer" style="height: ' . $height . ';"></div>';
}

/*------------------------------------------------------------
 * 6. Blockquote
 *
 * @since 1.0
 *
 * Examples below:
 *
// [blockquote align=""]Content here[/blockquote]
// [blockquote align="pull-right"]Content here[/blockquote]
 *
 *------------------------------------------------------------*/
//function tcsn_blockquote_sc( $atts,  $content = null ) {
//	extract( shortcode_atts( array(
//    	'align' => '', 
//    ), $atts ) );
//	if( $align != ''  ) {
//		$return_align = ' class="' . $align . '"';
//	}
//	else{
//		$return_align = '';
//	}
//    return '<blockquote' . $return_align . '>' . do_shortcode( $content ) . '</blockquote>';
//}

/*------------------------------------------------------------
 * 7. Tooltip
 *
 * @since 1.0
 *
// [tooltip url="" title="Content inside tooltip" placement="top"]Link text[/tooltip]
 *
 *------------------------------------------------------------*/
function tcsn_tooltip_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'url'       => '', 
		'title'     => '', 
        'placement' => 'top', // top, bottom, left, right
    ), $atts ) );
	
	if( $url != ''  ) {
		$return_url = 'href="' . $url . '" ';
	}
	else{
		$return_url = '';
	}
    return '<a ' . $return_url . 'title="' . $title . '" data-placement="' . $placement . '" data-toggle="tooltip" target="_blank">' . do_shortcode( $content ) . '</a>';
}

/*------------------------------------------------------------
 * 8. Table
 *
 * @since 1.0
 *
 * Example below:
 *
// [table strip="striped" border="bordered" compact="" hover="hover"]
//
// [thead]
// [tr]
// [th]Heading one[/th]
// [th]Heading two[/th]
// [/tr]
// [/thead]
//
// [tbody]
// [tr]
// [td]One[/td]
// [td]Two[/td]
// [/tr]
// [tr]
// [td]Three[/td]
// [td]Four[/td]
// [/tr]
// [/tbody]
//
// [/table]
 *
 *------------------------------------------------------------*/
function tcsn_table_sc( $atts,  $content = null ) {
	extract( shortcode_atts( array(
    	'strip'   => '', // null, striped
        'border'  => '', // null, bordered
        'hover'   => '', // null, hover
        'compact' => '' // null, condensed
    ), $atts ) );
    if ( $strip ) {
        $strip = 'table-' . $strip;
    }
    if ( $border ) {
        $border = 'table-' . $border;
    }
    if ( $hover ) {
        $hover = 'table-' . $hover;
    }
    if ( $compact ) {
        $compact  = 'table-' . $compact;
    }
    return '<table class="table ' . $strip . ' ' . $border . ' ' . $hover . ' ' . $compact  . '">' . do_shortcode( $content ) . '</table>';
}

// Table Body
function tcsn_table_body_sc( $atts,  $content = null ) {
	extract ( shortcode_atts( array(
		'class'       => '',  // null, success, error, warning, info
    ), $atts ) );
	if( $class != ''  ) {
		$return_url = ' class="' . $class . '"';
	}
	else{
		$return_url = '';
	}
    return '<tbody' . $return_url . '>' . do_shortcode( $content ) . '</tbody>';
}

// Table Head
function tcsn_table_head_sc( $atts,  $content = null ) {
	extract ( shortcode_atts( array(
		'class'       => '', 
    ), $atts ) );
	if( $class != ''  ) {
		$return_url = ' class="' . $class . '"';
	}
	else{
		$return_url = '';
	}
    return '<thead' . $return_url . '>' . do_shortcode( $content ) . '</thead>';
}

// Table Row
function tcsn_table_tr_sc( $atts,  $content = null ) {
	extract ( shortcode_atts( array(
		'class'       => '',  // null, success, error, warning, info
    ), $atts ) );
	if( $class != ''  ) {
		$return_url = ' class="' . $class . '"';
	}
	else{
		$return_url = '';
	}
    return '<tr' . $return_url . '>' . do_shortcode( $content ) . '</tr>';
}

// Table Head Cell
function tcsn_table_th_sc( $atts,  $content = null ) {
	extract ( shortcode_atts( array(
		'class'       => '', 
    ), $atts ) );
	if( $class != ''  ) {
		$return_url = ' class="' . $class . '"';
	}
	else{
		$return_url = '';
	}
    return '<th' . $return_url . '>' . do_shortcode( $content ) . '</th>';
}

// Table Cell
function tcsn_table_td_sc( $atts,  $content = null ) {
	extract ( shortcode_atts( array(
		'class'       => '', 
    ), $atts ) );
	if( $class != ''  ) {
		$return_url = ' class="' . $class . '"';
	}
	else{
		$return_url = '';
	}
    return '<td' . $return_url . '>' . do_shortcode( $content ) . '</td>';
}
/*------------------------------------------------------------
 * 11. Button
 *
 * @since 1.0
 *
 * Example below:
 *
// [button class="" target="" url=""]Link text here[/button]
 * 
 *------------------------------------------------------------*/
function tcsn_button_sc( $atts, $content=null ) {
	extract ( shortcode_atts( array(
		'class'  => '', 
		'color'  => '',
		'target' => '', 
		'url'    => '', 
		'icon'   => '', 
	), $atts ) );
	
	if( $icon != ''  ) {
		$return_icon = '<span class="btn-icon"><i class="icon-' . $icon . '"></i></span>';
  	} else {
		$return_icon = '';
	}
	if( $url != ''  ) {
		$return_url = ' href="' . $url . '"';
	} else {
		$return_url = '';
	}
	return '<a class="' . $class . $color . '" target="' . $target . '" ' . $return_url . '>' .  $return_icon . do_shortcode( $content ) . '</a>';
}

/*------------------------------------------------------------
 * 12. Icons
 *
 * @since 1.0
 *
 * Examples below:
 *
// [icon type="star" color="" size=""]
// [icon type="star" color="red" size="3em"]
// [icon type="star" color="#69F" size="20px"]
 *
 *------------------------------------------------------------*/
function tcsn_icon_sc( $atts, $content ) {
	extract( shortcode_atts( array(
		'type'  => '', 
        'color' => 'black', 
		'size' => '',
    ), $atts ) );
	
	if( $size != ''  ) {
		$return_size = 'font-size: ' . $size . ';';
	}
	else{
		$return_size = '';
	}
	
    return '<i class="icon-' . $type . '" style="color:' . $color . ';' . $return_size . '"></i>';
}

/*------------------------------------------------------------
 * 13. Horizontal Spacer / Gap
 *
 * @since 1.0
 *
 * Example below: 
 * 
// [spacer width="in px"]
 * 
 *------------------------------------------------------------*/
function tcsn_wide_spacer_sc( $atts, $content ) {
	extract ( shortcode_atts( array(
		'width'       => '', // in px
    ), $atts ) );

	return '<span class="spacer-wide" style="width: ' . $width . ';"></span>';
}

/*------------------------------------------------------------
 * 14. Styled Link
 *
 * @since 1.0
 *
 * Example below: 
 * 
// [link_underline color="leave blank for theme default" target="_self" url=""]Link text here[/link_underline]
 * 
 *------------------------------------------------------------*/
function tcsn_link_underline_sc( $atts, $content=null ) {
	extract ( shortcode_atts( array(
		'target' => '', 
		'url'    => '',  
		'color'  => '',  
	), $atts ) );

	if( $url != ''  ) {
		$return_url = ' href="' . $url . '"';
	} else {
		$return_url = '';
	}
	
	$add_style = array();
		if( $color != ''  ) {
			$add_style[] = 'color: '. $color .';';
		} 
		$add_style = implode('', $add_style);

	if ( $add_style ) {
			$add_style = wp_kses( $add_style, array() );
			$add_style = ' style="' . esc_attr($add_style) . '" ';
		}
		
		
	return '<a class="link-underline" target="' . $target . '"' . $add_style . '' . $return_url . '>' . do_shortcode( $content ) . '</a>';
}