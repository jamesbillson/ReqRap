<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php get_header(); ?>
<?php global $tcsn_option; ?>

<section id="content-main" class="clearfix">
  <div class="container">
    <div class="row">
      <?php if ( $tcsn_option['tcsn_single_post_layout'] == 'tcsn-single-full-width' ) : ?>
      <div class="col-md-12 col-sm-12">
        <?php get_template_part( '/includes/templates/post-formats/single', 'content' ); ?>
      </div>
      <?php elseif ( $tcsn_option['tcsn_single_post_layout'] == 'tcsn-single-with-sidebar' ) : ?>
      <?php if ( $tcsn_option['tcsn_single_post_sidebar'] == 'tcsn-single-sidebar-left' ) { ?>
      <?php get_sidebar(); ?>
      <?php } ?>
      <div class="col-md-8 col-sm-8">
        <?php get_template_part( '/includes/templates/post-formats/single', 'content' ); ?>
      </div>
      <?php if ( $tcsn_option['tcsn_single_post_sidebar'] == 'tcsn-single-sidebar-right' ) { ?>
      <?php get_sidebar(); ?>
      <?php } ?>
      <?php else : ?>
      <div class="col-md-8 col-sm-8">
        <?php get_template_part( '/includes/templates/post-formats/single', 'content' ); ?>
      </div>
      <?php get_sidebar(); ?>
      <?php endif ?>
    </div>
  </div>
</section>
<!-- #content -->

<?php get_footer(); ?>
