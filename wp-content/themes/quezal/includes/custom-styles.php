<?php 
/**
 * Custom styles through options panel
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
function tcsn_custom_styles() {
	global $tcsn_option;

	wp_enqueue_style( 'tcsn-custom-style', get_template_directory_uri() . '/css/custom_script.css' );
	
	// Variables
	if(isset($tcsn_option['tcsn_theme_base_color'])) { $tcsn_theme_base_color = $tcsn_option['tcsn_theme_base_color']; }
	if(isset($tcsn_option['tcsn_dropdown_border'])) { $tcsn_dropdown_border = $tcsn_option['tcsn_dropdown_border']; }
	if(isset($tcsn_option['tcsn_widget_border_color'])) { $tcsn_widget_border_color = $tcsn_option['tcsn_widget_border_color']; }
	if(isset($tcsn_option['tcsn_footer_widget_border_color'])) { $tcsn_footer_widget_border_color  = $tcsn_option['tcsn_footer_widget_border_color']; }
	if(isset($tcsn_option['tcsn_footer_widget_border_color'])) { $tcsn_slide_panel_widget_border_color = $tcsn_option['tcsn_slide_panel_widget_border_color']; }

	// Custom Styles
	$custom_css = "
	.sf-menu ul { border-color: {$tcsn_dropdown_border}; }
	.custom-tagcloud a, .widget_archive ul li, .widget_categories ul li, .widget_recent_entries ul li, .widget_nav_menu ul li a, .tcsn_widget_flickr a img,  #calendar_wrap th, #calendar_wrap td, .list-border li, .list-icon-border { border-color: {$tcsn_widget_border_color}; }
	#slide-top .custom-tagcloud a, #slide-top .widget_archive ul li, #slide-top .widget_categories ul li, #slide-top .widget_recent_entries ul li, #slide-top .tcsn_widget_twitter, #slide-top .widget_nav_menu ul li a, #slide-top .tcsn_widget_flickr a img, #slide-top #calendar_wrap th, #slide-top #calendar_wrap td, #slide-top .list-border li, #slide-top .list-icon-border {  border-color: {$tcsn_slide_panel_widget_border_color}; }
	#footer .custom-tagcloud a, #footer .widget_archive ul li, #footer .widget_categories ul li, #footer .widget_recent_entries ul li, #footer .tcsn_widget_twitter, #footer .widget_nav_menu ul li a, #footer .tcsn_widget_flickr a img, #footer #calendar_wrap th, #footer #calendar_wrap td, #footer .list-border li, #footer .list-icon-border {  border-color: {$tcsn_footer_widget_border_color}; }
	.pager li > a, .pager li > span, .page-links a, .inactive-folio-page, .dropcap, .highlight, #take-me-top:hover, .feature-icon .feature-icon-wrapper-outer.feature-square, .feature-icon:hover .feature-icon-wrapper, .custom-tagcloud a:hover { background-color: {$tcsn_theme_base_color}; }
	blockquote, blockquote.pull-right, .testimonial-simple .client-img, .featured-table .price, .pf-quote .quote-source, .pf-link-source, .featured-table .price { border-color: {$tcsn_theme_base_color}; }
	.custom-tagcloud a:hover { border-color: {$tcsn_theme_base_color} !important; }
	";
	wp_add_inline_style( 'tcsn-custom-style', $custom_css );
} 
add_action( 'wp_enqueue_scripts', 'tcsn_custom_styles', 80 );

// Cutom styles with conditions
if ( ! function_exists( 'tcsn_css_custom' ) ) {
	function tcsn_css_custom() {
	global $tcsn_option; 
	
// echo "\n".'<link rel="stylesheet" href="'. get_template_directory_uri() .'/css/custom.css?ver=' . THEME_VERSION . '" media="all" />'."\n";
?>
<style type="text/css">
<?php if( $tcsn_option['tcsn_topbar_border_bottom'] == true ) { ?> 
#topbar { border-bottom: 1px solid <?php echo $tcsn_option['tcsn_topbar_border_bottom_color']; ?>; }
<?php } ?> 
<?php if( $tcsn_option['tcsn_header_border_bottom'] == true ) { ?> 
#header { border-bottom: 1px solid <?php echo $tcsn_option['tcsn_header_border_bottom_color']; ?>; }
<?php } ?>
<?php if( $tcsn_option['tcsn_page_header_border_bottom'] == true ) { ?> 
#page-header { border-bottom: 1px solid <?php echo $tcsn_option['tcsn_page_header_border_bottom_color']; ?>; }
<?php } ?>  
<?php if( $tcsn_option['tcsn_show_slide_panel'] == true ) { ?> 
#slide-top { background-color: <?php echo $tcsn_option['tcsn_slide_panel_background']; ?>; }
#slide-top a.slide-panel-btn { border-color: transparent <?php echo $tcsn_option['tcsn_slide_panel_btn_background']; ?> transparent; }
<?php } ?> 
<?php if( $tcsn_option['tcsn_show_take_top'] == true ) { ?> 
#take-me-top { background-color: <?php echo $tcsn_option['tcsn_take_top_background']; ?>; }
<?php } ?> 
<?php if( $tcsn_option['tcsn_custom_css'] != '' ) { echo $tcsn_option['tcsn_custom_css']; } ?>
</style>
<?php }
} // End if
add_action( 'wp_head', 'tcsn_css_custom', 190 );