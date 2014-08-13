<?php
/**
 * The template for displaying Author Bios.
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>

<div class="author-info clearfix">
    <div class="author-avatar"> <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 72 ); ?></a> </div>
    <div class="author-description">
        <h5 class="author-title"><?php printf( __( 'About %s', 'tcsn_theme' ), get_the_author() ); ?></h5>
        <p class="author-bio">
            <?php the_author_meta( 'description' ); ?>
        </p>
    </div>
</div>
<!-- .author-info --> 
