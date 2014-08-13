<?php
/**
 * The Image for post 
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php if ( is_single() ) { ?>
<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
<div class="post-thumb">
  <?php the_post_thumbnail(); ?>
</div>
<?php endif; ?>
<?php } else { ?>
<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
<div class="post-thumb"> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
  <?php the_post_thumbnail(); ?>
  </a> </div>
<?php endif; ?>
<?php } ?>
