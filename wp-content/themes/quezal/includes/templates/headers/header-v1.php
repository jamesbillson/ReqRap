<?php
/**
 * The Header variation 1
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php global $tcsn_option; ?>
<?php get_template_part( 'includes/templates/headers/slide-panel' ); ?>

<div id="header-v1" class="clearfix">
  <?php if( $tcsn_option['tcsn_show_topbar'] == 1 ) { ?>
  <div id="topbar">
    <div class="container">
      <div class="row"> 
          <div class="col-md-3 col-sm-3 col-xs-6 topbar-left">
          <img src="/req/images/furniture/logo_sm.png">    
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12 topbar-left">
            
          <?php //if ( $tcsn_option['tcsn_select_topbar_info'] == 'tcsn_links' ) { ?>
          <?php /*if( has_nav_menu( 'secondary_menu' ) ) {
			  wp_nav_menu( array( 
					'theme_location'  => 'secondary_menu',
					'container'       => 'div',
					'container_class' => 'secondary-menu',
					'depth'           => -1,
					) ); ?>
          <?php  }  
		  } */ ?>
		  <div class="secondary-menu">
		  	<ul id="menu-main-menu" class="menu">
			  	<li id="menu-item-113" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-113">
			  		<a href="<?php echo get_site_url(); ?>/benefits/">Benefits</a>
			  	</li>
				<li id="menu-item-112" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-112">
					<a href="<?php echo get_site_url(); ?>/plans/">Plans</a>
				</li>
			</ul>
		 </div>
          <?php if ( $tcsn_option['tcsn_select_topbar_info'] == 'tcsn_text' ) {  echo $tcsn_option['tcsn_text_topbar_info']; } ?>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
         
          <div class="search-header">
             <?php if ( is_user_logged_in() ) { ?>
            <a  href="/req/site/logout/">Logout</a>
 <?php  } else {?> 
            <a class="mgm-login-link" href="/req/site/login/">Login</a> |  <a href="/register/">Register</a>
            <?php } ?> 
          </div>
          
          <?php if( $tcsn_option['tcsn_show_topbar_social'] == 1 ) { ?>
          <div class="header-wiget-area">
          
            <?php dynamic_sidebar( 'widget-social-network' ); ?>

          </div>
          <?php } ?>
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
