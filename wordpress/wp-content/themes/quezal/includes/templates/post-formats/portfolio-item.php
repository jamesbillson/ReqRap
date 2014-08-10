<?php
/**
 * The template for displaying Portfolio item content
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php global $tcsn_option; ?>
<?php global $post; ?>
<?php 
	$tcsn_lightbox_img_url	= wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'large'); 
	$tcsn_portfolio_type 	= get_post_meta( $post->ID, '_tcsn_portfolio_type', true );  
	$tcsn_video_url 		= get_post_meta( $post->ID, '_tcsn_video_url', true );  
	$tcsn_zoom_title 		= get_post_meta( $post->ID, '_tcsn_zoom_title', true );  
	$tcsn_external_link 	= get_post_meta( $post->ID, '_tcsn_external_link', true );  
	$tcsn_link_url 			= get_post_meta( $post->ID, '_tcsn_link_url', true );       
?>
<?php if ( $tcsn_option['tcsn_portfolio_hover'] == 'tcsn_zoom' ) { ?>
<figure>
  <?php the_post_thumbnail(); ?>
  <figcaption> <a href="<?php echo $tcsn_lightbox_img_url; ?>" data-rel="prettyPhoto" title="<?php echo $tcsn_zoom_title; ?>"><i class="icon-others-zoom"></i></a> </figcaption>
</figure>
<?php  } ?>
<?php if ( $tcsn_option['tcsn_portfolio_hover'] == 'tcsn_link' ) { ?>
<?php if ( $tcsn_external_link == true ) { ?>
<figure>
  <?php the_post_thumbnail(); ?>
  <figcaption><a href="<?php echo $tcsn_link_url; ?>"><i class="icon-link5"></i></a> </figcaption>
</figure>
<?php } else { ?>
<figure>
  <?php the_post_thumbnail(); ?>
  <figcaption><a href="<?php the_permalink(); ?>"><i class="icon-link5"></i></a> </figcaption>
</figure>
<?php } ?>
<?php } ?>
