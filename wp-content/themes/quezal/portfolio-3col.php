<?php
/**
 * Template Name: Portfolio - 3 Column
 *
 * The Template for displaying 3 column portfolio
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
 ?>
<?php get_header(); ?>
<?php global $tcsn_option; ?>
<?php global $post; ?>

<section id="content-main" class="clearfix">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <?php if( $tcsn_option['tcsn_portfolio_filter'] == 1 ) { ?>
        <?php
						$terms = get_terms("tcsn_portfoliotags");
						$count = count($terms);
						$all = __( 'All', 'tcsn_theme' );
						echo '<ul class="filter_nav clearfix">';
						echo '<li class="all-link"><a class="active" href="#" data-filter="*">' . $all . '</a></li>';
							if ($count > 0) {
    							foreach ($terms as $term) {
        							$termname = strtolower($term->name);
        							$termname = str_replace(' ', '-', $termname);
        							echo '<li><a href="#" title="" data-filter=".' . $termname . '">' . $term->name . '</a></li>';
    							}
							}
						echo "</ul>"; ?>
        <?php } ?>
      </div>
      <!-- portfolio filter ends-->
      <div class="clearfix"></div>
      <?php 
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$loop = new WP_Query( array(
				'post_type'      => 'tcsn_portfolio',
				'posts_per_page' => ( $tcsn_option['tcsn_portfolio_items_per_page'] ?  $tcsn_option['tcsn_portfolio_items_per_page'] : 9),
				'paged'          => $paged,
				'order'          => ( $tcsn_option['tcsn_portfolio_arrange'] ?  $tcsn_option['tcsn_portfolio_arrange'] : 'DESC'),   // DESC or ASC 
				'orderby'        => ( $tcsn_option['tcsn_portfolio_sort'] ?  $tcsn_option['tcsn_portfolio_sort'] : 'date'),   // date, rand or title
			
				) );
			?>
      <div id="items" class="filter-content">
        <?php if ($loop): while ($loop->have_posts()): $loop->the_post(); ?>
        <?php
					$terms = get_the_terms($post->ID, 'tcsn_portfoliotags');
					if ($terms && !is_wp_error($terms)):
						$links = array();
					foreach ($terms as $term) {
						$links[] = $term->name;
					}
					$links = str_replace(' ', '-', $links);
					$tax   = join(" ", $links);
					else:
					$tax = ''; ?>
        <?php endif; ?>
        <div class="col-md-4 col-sm-4 col-xs-12 portfolio-item isotope-item <?php echo strtolower($tax); ?> all">
          <?php 
						$tcsn_lightbox_img_url	= wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'large'); 
						$tcsn_portfolio_type 	= get_post_meta( $post->ID, '_tcsn_portfolio_type', true );  
						$tcsn_video_url 		= get_post_meta( $post->ID, '_tcsn_video_url', true );  
						$tcsn_zoom_title 		= get_post_meta( $post->ID, '_tcsn_zoom_title', true );  
						$tcsn_external_link 	= get_post_meta( $post->ID, '_tcsn_external_link', true );  
						$tcsn_link_url 			= get_post_meta( $post->ID, '_tcsn_link_url', true ); 
						?>
          <?php 
					 	switch ($tcsn_portfolio_type) {
						case 'Image': ?>
          <?php if ( has_post_thumbnail() ) : ?>
          <div class="folio-thumb">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <?php get_template_part( 'includes/templates/post-formats/portfolio-item' ); ?>
            </div>
          </div>
          <?php endif; ?>
          <?php break; // end image ?>
          <?php case 'Video': ?>
          <?php if ( has_post_thumbnail() ) : ?>
          <div class="folio-thumb">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <?php if ( $tcsn_option['tcsn_portfolio_hover'] == 'tcsn_zoom' ) { ?>
              <figure>
                <?php the_post_thumbnail(); ?>
                <figcaption> <a href="<?php echo $tcsn_video_url; ?>" data-rel="prettyPhoto" title="<?php echo $tcsn_zoom_title; ?>"><i class="icon-others-zoom"></i></a> </figcaption>
              </figure>
              <?php  } ?>
              <?php if ( $tcsn_option['tcsn_portfolio_hover'] == 'tcsn_link' ) { ?>
              <?php if ( $tcsn_external_link == true ) { ?>
              <figure>
                <?php the_post_thumbnail(); ?>
                <figcaption><a href="<?php echo $tcsn_link_url; ?>"><i class="icon-link5"></i></a> </figcaption>
              </figure>
              <?php } else { ?>
              <figure>
                <?php the_post_thumbnail(); ?>
                <figcaption><a href="<?php the_permalink(); ?>"><i class="icon-link5"></i></a> </figcaption>
              </figure>
              <?php } ?>
              <?php } ?>
            </div>
          </div>
          <?php endif; ?>
          <?php break; // end video ?>
          <?php case 'Audio': ?>
          <?php if ( has_post_thumbnail() ) : ?>
          <div class="folio-thumb">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <?php get_template_part( 'includes/templates/post-formats/portfolio-item' ); ?>
            </div>
          </div>
          <?php endif; ?>
          <?php break; // end audio ?>
          <?php case 'Gallery': ?>
          <?php if ( has_post_thumbnail() ) : ?>
          <div class="folio-thumb">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <?php get_template_part( 'includes/templates/post-formats/portfolio-item' ); ?>
            </div>
          </div>
          <?php endif; ?>
          <?php break; // end gallery ?>
          <?php default: ?>
          <?php if ( has_post_thumbnail() ) : ?>
          <div class="folio-thumb">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <?php get_template_part( 'includes/templates/post-formats/portfolio-item' ); ?>
            </div>
          </div>
          <?php  endif; ?>
          <?php } //end switch ?>
          <div class="clearfix"></div>
          <?php if( $tcsn_option['tcsn_portfolio_heading'] == 1 ) { ?>
          <?php if ( $tcsn_external_link == true ) { ?>
          <h5 class="folio-title"><a href="<?php echo $tcsn_link_url; ?>">
            <?php the_title(); ?>
            </a></h5>
          <?php } else { ?>
          <h5 class="folio-title"><a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
            </a></h5>
          <?php } ?>
          <?php } ?>
          <?php if( $tcsn_option['tcsn_portfolio_excerpt'] == 1 ) { ?>
          <div class="folio-excerpt clearfix">
            <?php the_excerpt(); ?>
          </div>
          <?php } ?>
          <div class="clearfix"></div>
        </div>
        <?php endwhile;?>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <?php tcsn_pagination($loop->max_num_pages, $range = 2); ?>
      </div>
    </div>
  </div>
</section>
<!-- #content -->

<?php get_footer(); ?>
