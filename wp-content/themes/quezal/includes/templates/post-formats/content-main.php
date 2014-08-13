<?php
/**
 * Template for displaying content for archive.
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php global $tcsn_option; ?>
<?php if ( $tcsn_option['tcsn_blog_layout'] == 'tcsn-full-width' ) : ?>

<div class="col-md-12 col-sm-12">
  <?php get_template_part( '/includes/templates/post-formats/archive', 'content' ); ?>
</div>
<?php elseif ( $tcsn_option['tcsn_blog_layout'] == 'tcsn-with-sidebar' ) : ?>
<?php if ( $tcsn_option['tcsn_blog_sidebar'] == 'tcsn-sidebar-left' ) { ?>
<?php get_sidebar(); ?>
<?php } ?>
<div class="col-md-8 col-sm-8">
  <?php get_template_part( '/includes/templates/post-formats/archive', 'content' ); ?>
</div>
<?php if ( $tcsn_option['tcsn_blog_sidebar'] == 'tcsn-sidebar-right' ) { ?>
<?php get_sidebar(); ?>
<?php } ?>
<?php else : ?>
<div class="col-md-8 col-sm-8">
  <?php get_template_part( '/includes/templates/post-formats/archive', 'content' ); ?>
</div>
<?php get_sidebar(); ?>
<?php endif ?>
