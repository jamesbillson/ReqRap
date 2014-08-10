<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php get_header(); ?>

<section id="content-main">
  <div class="container">
    <div class="row">
      <?php if ( have_posts() ) : ?>
      <div class="mssearch-content">
        <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( '/includes/templates/post-formats/content-search' ); ?>
        <?php endwhile; ?>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <?php tcsn_paging_nav(); ?>
      </div>
      <?php else : ?>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <?php get_template_part( '/includes/templates/post-formats/content', 'none' ); ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- #content -->

<?php get_footer(); ?>
