<?php
/**
 * The Template for displaying slider on gallery post / portfolio
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php
global $post;
$tcsn_select_gallery_rev_slider = get_post_meta( $post->ID, '_tcsn_select_gallery_rev_slider', true ); 
if ( function_exists('putRevSlider') ) { 
	putRevSlider($tcsn_select_gallery_rev_slider); 
} 
?>