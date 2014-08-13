<?php
/**
 * Template for displaying content for single post.
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php 
while ( have_posts() ) : the_post(); 
	get_template_part( '/includes/templates/post-formats/content', get_post_format() ); 
	wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages :', 'tcsn_theme' ) . '</span>', 'after' => '</div>' ) ); 
	tcsn_post_nav(); 
	comments_template(); 
endwhile; 