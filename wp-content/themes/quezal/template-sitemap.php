<?php
/**
 * Template Name: Sitemap
 *
 * The template for displaying sitemap.
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php get_header(); ?>
<?php global $tcsn_option; ?>

<section id="content-main">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <ul class="list-sitemap">
          <?php wp_list_pages( 'title_li=' ); ?>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- #content -->

<?php get_footer(); ?>
