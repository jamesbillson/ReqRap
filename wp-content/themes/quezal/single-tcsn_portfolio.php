<?php
/**
 * The template for displaying portfolio details.
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php get_header(); ?>
<?php global $tcsn_option; ?>
<?php global $post; ?>
<?php $tcsn_portfolio_type = get_post_meta( $post->ID, '_tcsn_portfolio_type', true ); ?>
<?php $tcsn_pf_video_audio_embed = get_post_meta( $post->ID, '_tcsn_pf_video_audio_embed', true ); ?>

<section id="content-main" class="clearfix">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <?php if( $tcsn_option['tcsn_portfolio_predefined_content'] == 1 ) { ?>
          <div class="post-thumb">
            <?php 
			switch ($tcsn_portfolio_type) {
				case 'Image': ?>
            <div class="folio-thumb">
              <?php the_post_thumbnail(); ?>
            </div>
            <?php break; // end image ?>
            <?php case 'Video': ?>
            <div class="video-wrapper"> <?php echo $tcsn_pf_video_audio_embed; ?> </div>
            <?php break; // end video ?>
            <?php case 'Audio': ?>
            <div class="audio-wrapper"> <?php echo $tcsn_pf_video_audio_embed; ?> </div>
            <?php break; // end audio ?>
            <?php case 'Gallery': ?>
            <div class="gallery-wrapper">
              <?php get_template_part( 'includes/templates/sliders/slider-gallery' ); ?>
            </div>
            <?php break; // end gallery ?>
            <?php default: ?>
            <div class="folio-thumb">
              <?php the_post_thumbnail(); ?>
            </div>
            <?php } //end switch ?>
          </div>
          <?php } ?>
          <div class="entry-content">
            <?php the_content(); ?>
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
