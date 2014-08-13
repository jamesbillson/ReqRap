<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>

<h4 class="post-title">
    <?php _e( 'Nothing Found', 'tcsn_theme' ); ?>
</h4>
<div class="page-content">
    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
    <p><?php printf( __( 'Ready to go for your first post? <a href="%1$s">Get started</a>.', 'tcsn_theme' ), admin_url( 'post-new.php' ) ); ?></p>
    <?php elseif ( is_search() ) : ?>
    <p>
        <?php _e( 'Sorry, no results were found for your search terms. Please try again with different keywords.', 'tcsn_theme' ); ?>
    </p>
    <?php get_search_form(); ?>
    <?php else : ?>
    <p>
        <?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Try with search.', 'tcsn_theme' ); ?>
    </p>
    <?php get_search_form(); ?>
    <?php endif; ?>
</div>