<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php global $tcsn_option; ?>
<?php get_header(); ?>

<section id="content-main" class="clearfix">
    <div class="container">
        <div class="row">
            <?php get_template_part( '/includes/templates/post-formats/content', 'main' ); ?>
        </div>
    </div>
</section>
<!-- #content -->

<?php get_footer(); ?>
