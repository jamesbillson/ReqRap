<?php
/**
 * The Title for page / post 
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php if ( is_single() ) : ?>
<h3 class="post-title entry-title">
  <?php the_title(); ?>
</h3>
<?php elseif ( is_page() ) : ?>
<h3 class="post-title entry-title no-display"></h3>
<?php else : ?>
<h3 class="post-title entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark">
  <?php the_title(); ?>
  </a></h3>
<?php endif; ?>