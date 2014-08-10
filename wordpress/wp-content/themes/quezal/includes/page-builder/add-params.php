<?php

/**
 * Add new params to VC
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */

// vc_add_param parameter doesn't exist
if ( !function_exists('vc_add_param') ) {
	return;
}
 
/**
 * Row
 *
 */
vc_add_param("vc_row", array(
	"type"		  	=> "checkbox",
	"class"		  	=> "",
	"heading"	  	=> __( "Make Row Fullwidth", "tcsn_theme" ),
	"param_name"  	=> "fullwidth_row",
	"value"		  	=> array(
		__( "Yes, please", "tcsn_theme" )	=> "yes"
		),
	"description"	=> __( "This will work only with <strong>home page and fullwidth page template</strong>. <br>  Do not give '<strong>left and right margin and padding</strong>' to row in design option tab to make row fulwidth. Even do not write 0. <br> If need to give border give 0, for left and right border. <br> Check help document for more info.", "tcsn_theme" )
));
