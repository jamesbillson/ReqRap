<?php
/**
 * Template Name: Page - Full Width
 *
 * The template for displaying full width pages without page header.
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php get_header(); ?>
<?php global $tcsn_option; ?>

<section id="content-main" class="pad-top-none pad-bottom-none">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="entry-content">
            <?php the_content(); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages :', 'tcsn_theme' ) . '</span>', 'after' => '</div>' ) ); ?>
          </div>
        </article>
        <?php if( $tcsn_option['tcsn_page_comments'] == 1 ) { ?>
        <?php comments_template(); ?>
        <?php } ?>
        <?php endwhile; endif; ?>
      </div>
    </div>
  </div>
</section>
<!-- #content -->

<?php get_footer(); ?>
