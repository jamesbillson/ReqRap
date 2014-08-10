<?php
/**
 * The Page header
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php global $tcsn_option; ?>
<?php if( $tcsn_option['tcsn_show_page_header'] == 1 ) { ?>

<section id="page-header" class="clearfix">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <h1 class="page-title">
          <?php if ( is_page() ) { echo the_title(); } ?>
          <?php if ( is_single() && ! is_singular( array( 'tcsn_portfolio', 'tcsn_team', 'tcsn_testimonial' ) )  ||  is_home() ) { ?>
          <?php if( $tcsn_option['tcsn_blog_title'] != "" ) { ?>
          <?php echo $tcsn_option['tcsn_blog_title']; ?>
          <?php } else { ?>
          <?php echo the_title(); ?>
          <?php } ?>
          <?php } ?>
          <?php // archive 
                if ( is_archive() && ! is_category() && ! is_tag() && ! is_author() && ! is_tax() && ! is_search() && ! is_post_type_archive( array( 'tcsn_portfolio', 'tcsn_team', 'tcsn_testimonial' ) ) ) { ?>
          <?php
					if ( is_day() ) :
						printf( __( 'Daily Archives : %s', 'tcsn_theme' ), get_the_date() );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives : %s', 'tcsn_theme' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'tcsn_theme' ) ) );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives : %s', 'tcsn_theme' ), get_the_date( _x( 'Y', 'yearly archives date format', 'tcsn_theme' ) ) );
					else :
						_e( 'Archives', 'tcsn_theme' );
					endif;
				?>
          <?php } ?>
          <?php // category archive 
                if ( is_category() ) { ?>
          <?php printf( __( 'Category Archives : %s', 'tcsn_theme' ), single_cat_title( '', false ) ); ?>
          <?php } ?>
          <?php // tag archive 
                if ( is_tag() ) { ?>
          <?php printf( __( 'Tagged : %s', 'tcsn_theme' ), single_tag_title( '', false ) ); ?>
          <?php } ?>
          <?php // author archive
                if ( is_author() ) { ?>
          <?php printf( __( 'All posts by %s', 'tcsn_theme' ), '<span class="vcard">' . get_the_author() . '</span>' ); ?>
          <?php } ?>
          <?php // post format archive 
                if ( is_tax( 'post_format' ) ) { ?>
          <?php printf( __( '%s Archives', 'tcsn_theme' ), '<span>' . get_post_format_string( get_post_format() ) . '</span>' ); ?>
          <?php } ?>
          <?php if ( is_singular( array( 'tcsn_portfolio', 'tcsn_team', 'tcsn_testimonial' ) ) ) { ?>
          <?php echo the_title(); ?>
          <?php } ?>
          <?php if ( is_search() ) { ?>
          <?php printf( __( 'Search Results for : %s', 'tcsn_theme' ), get_search_query() ); ?>
          <?php } ?>
        </h1>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <?php get_template_part( 'includes/templates/headers/breadcrumb' ); ?>
      </div>
    </div>
  </div>
</section>
<!-- #page-header -->
<?php } ?>
