<?php
/**
 * The template for displaying posts in the Quote post format.
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php global $post; ?>
<?php $pf_quote_source = get_post_meta( $post->ID, '_tcsn_pf_quote_source', true ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php get_template_part( '/includes/templates/post-formats/entry', 'title' ); ?>
  <?php if ( ! is_custom_post_type() && ! is_page() ) : ?>
  <div class="post-meta clearfix"> <span class="post-format-icon"><a href="#"><i class="icon-bubble3"></i></a></span>
    <div class="post-meta-content">
      <?php tcsn_post_meta(); ?>
      <?php if ( comments_open() && ! is_single() && ! is_page() && ! post_password_required() ) : ?>
      <span class="leave-comment-link">
      <?php comments_popup_link(  '' . __( '0 Replies', 'tcsn_theme' ), '' . __( '1 Replies', 'tcsn_theme' ), '' . __( '% Replies', 'tcsn_theme' ) ); ?>
      </span>
      <?php endif ?>
    </div>
  </div>
  <?php endif; ?>
  <?php if ( ! post_password_required() ) : ?>
  <?php if( !is_single() ) { ?>
  <a href="<?php the_permalink(); ?>" rel="bookmark">
  <?php } ?>
  <div class="pf-quote clearfix">
    <blockquote>
      <?php the_content(); ?>
    </blockquote>
    <span class="quote-source"> <?php echo  $pf_quote_source ?> </span> </div>
  <?php if( !is_single() ) { ?>
  </a>
  <?php } ?>
  <?php endif; ?>
  <div class="post-author">
    <?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
    <?php get_template_part( '/includes/templates/post-formats/author-bio' ); ?>
    <?php endif; ?>
  </div>
  <?php if(!($wp_query->post_count == $wp_query->current_post+1)) : ?>
  <div class="post-footer"></div>
  <?php endif; ?>
</article>
<!-- #post -->