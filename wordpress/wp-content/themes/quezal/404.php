<?php
/**
 * The template for displaying 404 error page
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="keywords" content="business, marketing, corporate"/>
<?php global $tcsn_option; ?>
<?php if( $tcsn_option['tcsn_layout_responsive'] == 1 ) { ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<?php } ?>
<title>
<?php
if ( is_page() ) {
	wp_title( '-', true, 'right' );
} elseif ( is_search() ) {
	echo 'Search for &quot;'.esc_html($s).'&quot; - ';
} elseif ( !( is_404() ) && ( is_single() ) || ( is_page() ) ) {
	wp_title(''); echo ' - ';
} elseif ( is_404() ) {
	echo 'Not Found - ';
} elseif ( is_category() ) {
	echo 'Category : '; wp_title(''); echo ' - ';
} elseif ( is_archive() ) {
	wp_title(''); echo ' Archive - ';
} bloginfo('name');
?>
</title>
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
<?php if( $tcsn_option['tcsn_favicon'] != "" ) { ?>
<link rel="shortcut icon" href="<?php echo $tcsn_option['tcsn_favicon']['url']; ?>">
<?php } ?>
<?php if( $tcsn_option['tcsn_favicon_iphone']  != "" ) { ?>
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $tcsn_option['tcsn_favicon_iphone']['url']; ?>">
<?php } ?>
<?php if( $tcsn_option['tcsn_favicon_iphone_retina'] != "" ) { ?>
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $tcsn_option['tcsn_favicon_iphone_retina']['url']; ?>">
<?php } ?>
<?php if( $tcsn_option['tcsn_favicon_ipad'] != "" ) { ?>
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $tcsn_option['tcsn_favicon_ipad']['url']; ?>">
<?php } ?>
<?php if( $tcsn_option['tcsn_favicon_ipad_retina'] != "" ) { ?>
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $tcsn_option['tcsn_favicon_ipad_retina']['url']; ?>">
<?php } ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if( $tcsn_option['tcsn_header_tracking'] != "" ) { echo $tcsn_option['tcsn_header_tracking']; } ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<section id="content-main" class="clearfix">
  <div class="container">
    <div class="row">
      <div class="error-404 clearfix">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <h1 class="heading-404">
            <?php _e( '404', 'tcsn_theme' ); ?>
          </h1>
        </div>
        <div class="col-md-6 col-md-offset-3">
          <p>
            <?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Try with search.', 'tcsn_theme' ); ?>
          </p>
          <?php get_search_form(); ?>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 link-404"> <a class="link-underline" href="<?php echo site_url(); ?>">Back to Home</a> </div>
      </div>
    </div>
  </div>
</section>
<!-- #content -->

<?php if( $tcsn_option['tcsn_footer_tracking'] != "" ) { echo $tcsn_option['tcsn_footer_tracking']; } ?>
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<?php wp_footer(); ?>
</body>
</html>