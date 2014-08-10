<?php
/**
 * The template for displaying testimonial details.
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php get_header(); ?>
<?php global $post; ?>

<section id="content-main" class="clearfix">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 testimonial-single">
              <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
              <div class="post-thumb">
                <?php the_post_thumbnail(); ?>
              </div>
              <?php endif; ?>
              <h5 class="testimonial-heading">
                <?php the_title(); ?>
              </h5>
              <?php $tcsn_client_info = get_post_meta( $post->ID, '_tcsn_client_info', true ); ?>
              <span class="testimonial-subheading"><?php echo $tcsn_client_info; ?></span>
              <div class="testimonial-content">
                <?php the_content(); ?>
              </div>
            </div>
          </div>
        </article>
        <?php tcsn_post_nav(); ?>
        <?php endwhile; endif; ?>
      </div>
    </div>
  </div>
</section>
<!-- #content -->

<?php get_footer(); ?>
