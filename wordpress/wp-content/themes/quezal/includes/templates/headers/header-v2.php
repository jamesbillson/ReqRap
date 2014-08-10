<?php
/**
 * The Header variation 2
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php global $tcsn_option; ?>
<?php get_template_part( 'includes/templates/headers/slide-panel' ); ?>

<div id="header-v2" class="clearfix">
  <?php if( $tcsn_option['tcsn_show_topbar'] == 1 ) { ?>
  <div id="topbar">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 topbar-left">
          <?php if( $tcsn_option['tcsn_show_topbar_social'] == 1 ) { ?>
          <div class="header-wiget-area">
            <?php if ( is_active_sidebar( 'widget-social-network' ) ) : ?>
            <?php dynamic_sidebar( 'widget-social-network' ); ?>
            <?php else : ?>
            <div class="widget-alert">
              <p>
                <?php _e( 'Social Network Widget not activated yet - Activate!', 'tcsn_theme' ); ?>
              </p>
              <p>
                <?php _e( 'OR Disable through options panel.', 'tcsn_theme' ); ?>
              </p>
            </div>
            <?php endif; ?>
          </div>
          <?php } ?>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <?php if ( $tcsn_option['tcsn_select_topbar_info'] == 'tcsn_links' ) { ?>
          <?php if( has_nav_menu( 'secondary_menu' ) ) {
			  wp_nav_menu( array( 
					'theme_location'  => 'secondary_menu',
					'container'       => 'div',
					'container_class' => 'secondary-menu',
					'depth'           => -1,
					) ); ?>
          <?php  }  
		  } ?>
          <?php if ( $tcsn_option['tcsn_select_topbar_info'] == 'tcsn_text' ) {  echo $tcsn_option['tcsn_text_topbar_info']; } ?>
        </div>
      </div>
    </div>
  </div>
  <!-- #topbar -->
  <?php  } ?>
  <div id="responsive-menu"></div>
  <div id="header">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12 logo">
          <?php if( ( $tcsn_option['tcsn_logo_type'] == "tcsn_show_image_logo" ) ) : ?>
          <?php if( $tcsn_option['tcsn_image_standard_logo'] != "" ) { ?>
          <a href="<?php echo home_url(); ?>" title="<?php bloginfo('title'); ?>"><img src="<?php echo $tcsn_option['tcsn_image_standard_logo']['url']; ?>" alt="<?php bloginfo('title'); ?>" class="logo-standard"></a>
          <?php } ?>
          <?php if( $tcsn_option['tcsn_image_retina_logo'] != "" ) { ?>
          <a href="<?php echo home_url(); ?>" title="<?php bloginfo('title'); ?>"><img src="<?php echo $tcsn_option['tcsn_image_retina_logo']['url']; ?>" alt="<?php bloginfo('title'); ?>" class="logo-retina"></a>
          <?php } ?>
          <?php elseif( ( $tcsn_option['tcsn_logo_type'] == "tcsn_show_text_logo" ) ) : ?>
          <?php if( $tcsn_option['tcsn_text_logo'] != "" ) { ?>
          <a href="<?php echo home_url(); ?>" title="<?php bloginfo('title'); ?>"><?php echo $tcsn_option['tcsn_text_logo']; ?></a>
          <?php } ?>
          <?php else : ?>
          <a href="<?php echo home_url(); ?>" title="<?php bloginfo('title'); ?>"><img src="<?php echo get_template_directory_uri() . "/img/logo.png" ?>" alt="<?php bloginfo('title'); ?>"></a>
          <?php endif; ?>
        </div>
        <!-- .logo -->
        
        <div class="col-md-8 col-sm-8 col-xs-12">
          <nav class="menu-wrapper clearfix">
            <?php get_template_part( 'includes/templates/headers/main-menu' ); ?>
          </nav>
          <!-- #menu --> 
        </div>
      </div>
    </div>
  </div>
  <!-- #header -->
  
  <?php 
		if ( ! is_page_template('template-full.php') ) {
		get_template_part( 'includes/templates/headers/page-header' ); } 
	 ?>
</div>
<!-- #header variation --> 
