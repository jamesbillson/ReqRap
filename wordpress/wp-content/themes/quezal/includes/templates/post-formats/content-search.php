<?php
/**
 * The default template for displaying content of search results
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>

<div id="search-results">
  <?php if( get_post_type($post->ID) == 'post' ){ ?>
  <article class="search-entry">
    <div class="col-md-4 col-sm-4 col-xs-12 mssearch-item">
      <div class="archive-inner">
        <?php if ( has_post_thumbnail() ) { ?>
        <div class="archive-thumb"> <?php echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail( $post->ID, 'full', array( 'title' => '' ) ) . '</a>';  ?> </div>
        <?php } ?>
        <h6 class="archive-entry-title"><a href="<?php the_permalink (); ?>">
          <?php the_title(); ?>
          </a></h6>
        <?php if ( has_excerpt() ) { ?>
        <div class="archive-excerpt">
          <?php the_excerpt(); ?>
        </div>
        <?php } ?>
        <span class="search-from"><?php echo __('From : Blog Post', 'tcsn_theme'); ?></span> </div>
    </div>
  </article>
  <?php }
							
	else if( get_post_type($post->ID) == 'page' ){ ?>
  <article class="search-entry">
    <div class="col-md-4 col-sm-4 col-xs-12 mssearch-item">
      <div class="archive-inner">
        <h6 class="archive-entry-title"><a href="<?php the_permalink (); ?>">
          <?php the_title(); ?>
          </a></h6>
        <?php if ( has_excerpt() ) { ?>
        <div class="archive-excerpt">
          <?php the_excerpt(); ?>
        </div>
        <?php } ?>
        <span class="search-from"><?php echo __('From : Pages', 'tcsn_theme'); ?></span> </div>
    </div>
  </article>
  <?php }
							
	else if( get_post_type($post->ID) == 'tcsn_portfolio' ){ ?>
  <article class="search-entry">
    <div class="col-md-4 col-sm-4 col-xs-12 mssearch-item">
      <div class="archive-inner">
        <?php if ( has_post_thumbnail() ) { ?>
        <div class="archive-thumb"> <?php echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail( $post->ID, 'full', array( 'title' => '' ) ) . '</a>';  ?> </div>
        <?php } ?>
        <h6 class="archive-entry-title"><a href="<?php the_permalink (); ?>">
          <?php the_title(); ?>
          </a></h6>
        <?php if ( has_excerpt() ) { ?>
        <div class="archive-excerpt">
          <?php the_excerpt(); ?>
        </div>
        <?php } ?>
        <span class="search-from"><?php echo __('From : Portfolio', 'tcsn_theme'); ?></span> </div>
    </div>
  </article>
  <?php }
	
	else if( get_post_type($post->ID) == 'tcsn_team' ){ ?>
  <article class="search-entry">
    <div class="col-md-4 col-sm-4 col-xs-12 mssearch-item">
      <div class="archive-inner">
        <?php if ( has_post_thumbnail() ) { ?>
        <div class="archive-thumb"> <?php echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail( $post->ID, 'full', array( 'title' => '' ) ) . '</a>';  ?> </div>
        <?php } ?>
        <h6 class="archive-entry-title"><a href="<?php the_permalink (); ?>">
          <?php the_title(); ?>
          </a></h6>
        <span class="search-from"><?php echo __('From : Team Members', 'tcsn_theme'); ?></span> </div>
    </div>
  </article>
  <?php }
	
	
							
	else if( get_post_type($post->ID) == 'tcsn_testimonial' ){ ?>
  <article class="search-entry">
    <div class="col-md-4 col-sm-4 col-xs-12 mssearch-item">
      <div class="archive-inner">
        <h6 class="archive-entry-title"><a href="<?php the_permalink (); ?>">
          <?php the_title(); ?>
          </a></h6>
        <span class="search-from"><?php echo __('From : Testimonials', 'tcsn_theme'); ?></span> </div>
    </div>
  </article>
  <?php } else { ?>
  <article class="search-entry">
    <div class="col-md-4 col-sm-4 col-xs-12 mssearch-item">
      <div class="archive-inner">
        <?php if ( has_post_thumbnail() ) { ?>
        <div class="archive-thumb"> <?php echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail( $post->ID, 'full', array( 'title' => '' ) ) . '</a>';  ?> </div>
        <?php } ?>
        <h6 class="archive-entry-title"><a href="<?php the_permalink (); ?>">
          <?php the_title(); ?>
          </a></h6>
        <?php if ( has_excerpt() ) { ?>
        <div class="archive-excerpt">
          <?php the_excerpt(); ?>
        </div>
        <?php } ?>
      </div>
    </div>
  </article>
  <!--/search-result-->
  <?php } ?>
</div>
