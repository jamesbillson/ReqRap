<?php
/**
 * Quezal functions and definitions.
 *
 * By using a child theme (http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */

define( 'THEME_NAME', 'Quezal' );
define( 'THEME_VERSION', '1.0.0' );

/**
 * Include ReduxFramework
 *
 */
if ( !class_exists( 'ReduxFramework' ) ) {
	require_once( dirname( __FILE__ ) . '/admin/framework.php' );
}
if ( !isset( $redux_demo ) ) {
	require_once( dirname( __FILE__ ) . '/includes/options-config.php' );
}	

// Helper functions
require_once ( get_template_directory() . '/includes/helpers.php' );

// Theme widgets / Sidebars
require_once ( get_template_directory() . '/includes/widgets/sidebars.php' );
require_once ( get_template_directory() . '/includes/widgets/custom-widgets.php' );

// Custom styles 
require_once ( get_template_directory() . '/includes/custom-styles.php' );

// Meta boxes
require_once (get_template_directory() . '/includes/meta-box/config-metabox.php');

// Image resizer
require_once ( get_template_directory() . '/includes/aq_resizer.php' );

// Icons Fonts in array
require_once (get_template_directory() . '/includes/icon-font-array.php');

// Custom Post Types
require_once ( get_template_directory() . '/includes/plugins/portfolio-post-types.php' );
require_once ( get_template_directory() . '/includes/plugins/testimonial-post-types.php' );
require_once ( get_template_directory() . '/includes/plugins/team-post-types.php' );

// Recommend some useful plugins for this theme via TGMA script
require_once( get_template_directory() .'/includes/include-plugins.php' );

/**
 * Sets up the content width value based on the theme's design.
 *
 */
if ( ! isset( $content_width ) )
	$content_width = 1170;

/**
 * Theme only works in WordPress 3.6 or later.
 *
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/includes/bk-compatiblity.php';

/**
 * Sets up theme defaults and registers the various WordPress features that theme supports.
 *
 */
function tcsn_theme_setup() {
	
	// Makes theme available for translation.
	// Translations can be added to the /languages/ directory.
	load_theme_textdomain( 'tcsn_theme', get_template_directory() . '/languages' );
	
    //  Styles the visual editor to resemble the theme style,
	add_editor_style( 'editor-style.css' );

    //  Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

    // Switches default core markup for search form, comment form, and comments 
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	// This theme supports all available post formats by default.
	add_theme_support( 'post-formats', array(
		'audio', 'gallery', 'image', 'link', 'quote', 'video'
	) );

	// Add Menu Support
    register_nav_menus( array(
        'primary_menu'   => 'Primary menu',
		'secondary_menu' => 'Secondary Menu'
    ) );

    // Thumbnail support
	add_theme_support( 'post-thumbnails' );
	
}
add_action( 'after_setup_theme', 'tcsn_theme_setup' );

/**
 * Enqueue Scripts and Styles
 *
 */
function tcsn_theme_scripts_styles() {
	
	// enqueue scripts
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.min.js', array('jquery'), '2.6.2', false );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.0.2', true );
	wp_enqueue_script( 'theme-scripts', get_template_directory_uri() . '/js/theme-scripts.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'theme-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true );
	
	// enqueue styles
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'font', get_template_directory_uri() . '/css/iconfont.css' );
	wp_enqueue_style( 'style-main', get_stylesheet_directory_uri() . '/style.css' );
	wp_enqueue_style( 'responsive-menu-style', get_template_directory_uri() . '/css/responsive-menu.css' );
	wp_enqueue_style( 'isotope-style', get_template_directory_uri() . '/css/isotope.css' );
	wp_enqueue_style( 'prettyPhoto-style', get_template_directory_uri() . '/css/prettyPhoto.css' );
	wp_enqueue_style( 'owlcarousel-style', get_template_directory_uri() . '/css/owl.carousel.css' );
	wp_enqueue_style( 'rev-custom-style', get_template_directory_uri() . '/css/rev-custom.css' );
	wp_enqueue_style( 'responsive-style', get_template_directory_uri() . '/css/responsive.css' );

	// register style
	wp_register_style( 'bootstrap-nonrs-style', get_template_directory_uri() . '/css/non-responsive.css' );
	
	// register scripts
	wp_register_script( 'header-scripts', get_template_directory_uri() . '/js/header-scripts.js', array('jquery'), '1.0.0', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	global $tcsn_option;
	// To disable responsiveness
	if(isset($tcsn_option['tcsn_layout_responsive'])) {
		if($tcsn_option['tcsn_layout_responsive'] == 0) { 
			wp_enqueue_style( 'bootstrap-nonrs-style' );
		}
	}
	// To make header sticky
	if(isset($tcsn_option['tcsn_header_sticky'])) {
		if($tcsn_option['tcsn_header_sticky'] == 1) { 
			wp_enqueue_script( 'header-scripts' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'tcsn_theme_scripts_styles' );

/**
 * Allow shortcodes in sidebar widgets	
 *
 */
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Excerpt more string 
 */
if (!function_exists('tcsn_excerpt_more')) {
function tcsn_excerpt_more( $more ) {
    return '..';
}
}
add_filter( 'excerpt_more', 'tcsn_excerpt_more' );

/**
 * Remove WP Generator Meta Tag from head
 */
remove_action( 'wp_head', 'wp_generator' );  


/**
 * Custom callback function for comment display
 *
 */
function tcsn_comment( $comment, $args, $depth ) {
$GLOBALS['comment'] = $comment; ?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
  <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
    <div class="comment-author vcard">
      <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    </div>
    <?php printf( __( '<cite class="fn custom-fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
    <div class="comment-meta comment-metadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
      <?php
		/* translators: 1: date, 2: time */
		printf( __( '%1$s at %2$s', 'tcsn_theme' ), get_comment_date(),  get_comment_time() ); ?>
      </a>
      <?php edit_comment_link( __( '(Edit)', 'tcsn_theme' ), '&nbsp;&nbsp;', '' );
	?>
      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div>
    </div>
    <div class="comment-text">
      <?php comment_text() ?>
    </div>
    <?php if ( '0' == $comment->comment_approved ) : ?>
    <p class="comment-awaiting-moderation">
      <?php _e( 'Your comment is awaiting moderation.', 'tcsn_theme' ) ?>
    </p>
    <?php endif; ?>
  </div>
  <?php
} // end comment callback function


if ( ! function_exists( 'tcsn_post_meta' ) ) :
/**
 *
 * Prints HTML with meta information for current post: author, date.
 *
 */
function tcsn_post_meta() {
	
	// Post date
		tcsn_post_date();
		
	// Post author
	if ( 'post' == get_post_type() ) {
		$author_title = __( 'posted by ', 'tcsn_theme' );
		printf( '' . $author_title . '<span class="author vcard margin-less"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'tcsn_theme' ), get_the_author() ) ),
			get_the_author()
		);
	}
	
}
endif;

if ( ! function_exists( 'tcsn_post_meta_second' ) ) :
/**
 *
 * Prints HTML with meta information for current post: categories, tags
 *
 */
function tcsn_post_meta_second() {

	// Tags
	$tag_list = get_the_tag_list( '', __( ', ', 'tcsn_theme' ) );
	$tag_title = __( 'tagged:  ', 'tcsn_theme' );
	if ( $tag_list ) {
		echo '' . $tag_title . '<span class="tags-links">' . $tag_list . '</span>';
	}
	
	// Categories
	$categories_list = get_the_category_list( __( ', ', 'tcsn_theme' ) );
	$categories_title = __( 'in ', 'tcsn_theme' );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_title . $categories_list . '</span>';
	}
}
endif;

if ( ! function_exists( 'tcsn_post_date' ) ) :
/**
 *
 * Prints HTML with date information for current post.
 *
 */
function tcsn_post_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'tcsn_theme' );
	else
		$format_prefix = '%2$s';
	$date = sprintf( '<span class="post-date updated"><time class="entry-date" datetime="%3$s">%4$s</time></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'tcsn_theme' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);
	if ( $echo )
		echo $date;
	return $date;
}
endif;


/**
 *
 * Visual Composer
 *
 */
if( function_exists('vc_set_as_theme') ) {
	
	//  Initialize Visual Composer as a part of theme
	vc_set_as_theme(true);

	// Add, Remove params
	require_once( get_template_directory() . '/includes/page-builder/remove-params-elements.php' );
	require_once( get_template_directory() . '/includes/page-builder/add-params.php' );

	// Remove VC Custom Teaser metabox
	if ( is_admin() ) {
		if ( ! function_exists('tcsn_remove_vc_custom_teaser') ) {
			function tcsn_remove_vc_custom_teaser(){
				$post_types = get_post_types( '', 'names' ); 
				foreach ( $post_types as $post_type ) {
					remove_meta_box('vc_teaser',  $post_type, 'side');
				}
			} 
		} 
	add_action('do_meta_boxes', 'tcsn_remove_vc_custom_teaser');
	}
	
/**
 * Custom Shortcodes in Visual Composer
 */

// Icon Feature
function tcsn_icon_feature_sc( $atts, $content = null ) { 
	extract( shortcode_atts( array(
		'icon'    					=> '',
		'icon_color'				=> '',
		'heading'    				=> '',
		'box'    					=> '', 
		'border_width'    			=> '', 
		'box_padding'    			=> '', 
		'heading'   				=> '',
		'feature_style'   			=> '',
		'feature_icon_left'			=> '',
		'feature_icon_top'  		=> '',
		'return_feature_desc_style' => '',
		'icon_style'   				=> '',
		'icon_bg'   				=> '',
		), $atts ) );

		$content = wpb_js_remove_wpautop($content);
		
		if( $feature_style == 'feature_icon_top' ){
			$return_feature_style = 'feature-icon-top';
		} elseif( $feature_style == 'feature_icon_left' ){
			$return_feature_style = 'feature-icon-left';
		} else {
			$return_feature_style = 'feature-icon-top';
		}
		
		// Box
		if( $box !== 'yes' ){
			$box = '';
		} else {
			$box = ' box-border clearfix';
		}
		
		// heading
		if( $heading != '' ){
			$return_heading = '<h5>' . $heading . '</h5>';
		} else {
			$return_heading =  '';
		}
		
		$add_box_style = array();
		if ( $box_padding ) {
			$add_box_style[] = ' padding: ' . $box_padding . ';';
		} 
		if ( $border_width ) {
			$add_box_style[] = ' border-width: ' . $border_width . ';';
		} 
		$add_box_style = implode('', $add_box_style);
		if ( $add_box_style ) {
			$add_box_style = wp_kses( $add_box_style, array() );
			$add_box_style = ' style="' . esc_attr($add_box_style) . '"';
		}

		// Icon Font
		$add_icon_style = array();
		
		if ( $icon_color ) {
			$add_icon_style[] = 'color: '. $icon_color .';';
		} 
		$add_icon_style = implode('', $add_icon_style);
		if ( $add_icon_style ) {
			$add_icon_style = wp_kses( $add_icon_style, array() );
			$add_icon_style = ' style="' . esc_attr($add_icon_style) . '"';
		}
		
		if ( $icon_bg ) {
			$return_icon_bg = ' style="background-color: '. $icon_bg .';"';
		} 
		
		//Icon Style
		if( $icon_style == 'circle' ){
			$return_icon_style = '<div class="feature-icon-wrapper-outer feature-circle"' . $return_icon_bg .'><div class="feature-icon-wrapper"><i class="icon-' . $icon .'" ' . $add_icon_style . '></i></div></div>';
			$return_feature_desc_style = 'circle-desc';
		} elseif( $icon_style == 'square' ){
			$return_icon_style = '<div class="feature-icon-wrapper-outer feature-square"' . $return_icon_bg .'><i class="icon-' . $icon .'" ' . $add_icon_style . '></i></div>';
			$return_feature_desc_style = 'square-desc';
		} else {
			$return_icon_style = '<div class="feature-icon-wrapper-outer"><i class="icon-' . $icon .'" ' . $add_icon_style . '></i></div>';
		}

		return "<div class='feature-icon{$box} wpb_custom_element' {$add_box_style}><div class='{$return_feature_style} {$return_feature_desc_style}'>{$return_icon_style}<div class='feature-icon-desc'>{$return_heading}{$content}</div></div></div>";

}
add_shortcode( 'icon_feature', 'tcsn_icon_feature_sc' );

vc_map( array(
   "name"     	=> __( "Icon Feature", "tcsn_theme" ),
   "base"	  	=> "icon_feature",
   "class"    	=> '',
   "icon"     	=> "icon-wpb-bartag",
   "category"	=> __( 'Content', 'tcsn_theme' ),
   "params"   	=> array(
    array(
		"type"       	=> "dropdown",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Icon Position", "tcsn_theme" ),
		"param_name"	=> "feature_style",
		"value"       	=> array (
			"Icon to Top"	=> "feature_icon_top", 
			"Icon to Left"	=> "feature_icon_left", 
			),
		"description"	=> '',
		),
	array(
		"type"        	=> "dropdown",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Select Icon", "tcsn_theme" ),
		"param_name"	=> "icon",
		"value"       	=> $font_icons_array, 
		),
	
	array(
		"type"       	=> "dropdown",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Icon style", "tcsn_theme" ),
		"param_name"	=> "icon_style",
		"value"       	=> array (
			"Circle"	=> "circle", 
			"Square"	=> "square", 
			"None"		=> "none", 
			),
		"description"	=> '',
		),
	array(
		 "type"        	=> "colorpicker",
		 "holder"      	=> "div",
		 "class"       	=> '',
		 "heading"     	=> __( "Icon Background Color", "tcsn_theme" ),
		 "param_name"  	=> "icon_bg",
		 "value" 	   	=> '', 
		 "description"	=> __( "Leave blank for theme default.", "tcsn_theme" )
		 ),
	array(
		 "type"        	=> "colorpicker",
		 "holder"      	=> "div",
		 "class"       	=> '',
		 "heading"     	=> __( "Icon Color", "tcsn_theme" ),
		 "param_name"  	=> "icon_color",
		 "value" 	   	=> '', 
		 "description"	=> __( "Leave blank for theme default.", "tcsn_theme" )
		 ),
	array(
		"type"        	=> "textfield",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Feature Heading", "tcsn_theme" ),
		"param_name"  	=> "heading",
		"value" 	  	=> "", 
		"description"	=> '',
	  	),
	array(
		"type"        	=> "checkbox",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Make Feature Boxed", "tcsn_theme" ),
		"param_name"	=> "box",
		"value"       	=> array ( "Yes, please" => "yes" ),
	  	),
	array(
		 "type"        	=> "textfield",
		 "holder"      	=> "div",
		 "class"       	=> '',
		 "heading"     	=> __( "Box Padding", "tcsn_theme" ),
		 "param_name"  	=> "box_padding",
		 "value" 	   	=> '', 
		 "dependency"  => array( "element" => "box", "not_empty" => true ),
		 "description"	=> __( "Give it like (Top Right Bottom Left) : 20px 20px 20px 20px", "tcsn_theme" ),
		 ),
	array(
		 "type"        	=> "textfield",
		 "holder"      	=> "div",
		 "class"       	=> '',
		 "heading"     	=> __( "Box Border Width", "tcsn_theme" ),
		 "param_name"  	=> "border_width",
		 "value" 	   	=> '', 
		 "dependency"  => array( "element" => "box", "not_empty" => true ),
		 "description"	=> __( "Give it like (Top Right Bottom Left) : 0 1px 0 0", "tcsn_theme" ),
		 ),
	array(
		"type"        	=> "textarea_html",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Content", "tcsn_theme" ),
		"param_name"	=> "content",
		"value"       	=> '',
		"description"	=> __( "Enter your content.", "tcsn_theme" )
		),
	),
) );

// Contact Info
function tcsn_icon_contact_info_sc( $atts, $content = null ) { 
	extract( shortcode_atts( array(
		'icon'    			=> '',
		'icon_color'		=> '',	
		'heading'    		=> '',
		'box'    			=> '', 
		'border_width'    	=> '', 
		'box_padding'    	=> '', 
		'heading'   		=> '',
		'contact_info'      => '',
		), $atts ) );
		
		$content = wpb_js_remove_wpautop($content);

		// Box
		if( $box !== 'yes' ){
			$box = '';
		} else {
			$box = ' box-border clearfix';
		}
		
		$add_box_style = array();
		if ( $box_padding ) {
			$add_box_style[] = ' padding: ' . $box_padding . ';';
		} 
		if ( $border_width ) {
			$add_box_style[] = ' border-width: ' . $border_width . ';';
		} 
		$add_box_style = implode('', $add_box_style);
		if ( $add_box_style ) {
			$add_box_style = wp_kses( $add_box_style, array() );
			$add_box_style = ' style="' . esc_attr($add_box_style) . '"';
		}

		// Icon Font
		$add_icon_style = array();
		
		if ( $icon_color ) {
			$add_icon_style[] = 'color: '. $icon_color .';';
		} 
		$add_icon_style = implode('', $add_icon_style);
		if ( $add_icon_style ) {
			$add_icon_style = wp_kses( $add_icon_style, array() );
			$add_icon_style = ' style="' . esc_attr($add_icon_style) . '"';
		}

		return "<div class='feature-icon{$box} wpb_custom_element' {$add_box_style}><div class='feature-icon-left feature-contact-info'><div class='feature-icon-wrapper-outer'><i class='icon-{$icon }' {$add_icon_style}></i></div><div class='feature-icon-desc'><h6>{$heading}</h6>{$content}</div></div></div>";

}
add_shortcode( 'icon_contact_info', 'tcsn_icon_contact_info_sc' );

vc_map( array(
   "name"     	=> __( "Contact Info Box", "tcsn_theme" ),
   "base"	  	=> "icon_contact_info",
   "class"    	=> '',
   "icon"     	=> "icon-wpb-bartag",
   "category"	=> __( 'Content', 'tcsn_theme' ),
   "params"   	=> array(
	array(
		"type"        	=> "dropdown",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Select Icon", "tcsn_theme" ),
		"param_name"	=> "icon",
		"value"       	=> $font_icons_array, 
		),
	array(
		 "type"        	=> "colorpicker",
		 "holder"      	=> "div",
		 "class"       	=> '',
		 "heading"     	=> __( "Icon Color", "tcsn_theme" ),
		 "param_name"  	=> "icon_color",
		 "value" 	   	=> '', 
		 "description"	=> __( "Leave blank for theme default.", "tcsn_theme" )
		 ),
	array(
		"type"        	=> "textfield",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Feature Heading", "tcsn_theme" ),
		"param_name"  	=> "heading",
		"value" 	  	=> "", 
		"description"	=> '',
	  	),
	array(
		"type"        	=> "checkbox",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Make Feature Boxed", "tcsn_theme" ),
		"param_name"	=> "box",
		"value"       	=> array ( "Yes, please" => "yes" ),
	  	),
	array(
		 "type"        	=> "textfield",
		 "holder"      	=> "div",
		 "class"       	=> '',
		 "heading"     	=> __( "Box Padding", "tcsn_theme" ),
		 "param_name"  	=> "box_padding",
		 "value" 	   	=> '', 
		 "dependency"  => array( "element" => "box", "not_empty" => true ),
		 "description"	=> __( "Give it like (Top Right Bottom Left) : 20px 20px 20px 20px", "tcsn_theme" ),
		 ),
	array(
		 "type"        	=> "textfield",
		 "holder"      	=> "div",
		 "class"       	=> '',
		 "heading"     	=> __( "Box Border Width", "tcsn_theme" ),
		 "param_name"  	=> "border_width",
		 "value" 	   	=> '', 
		 "dependency"  => array( "element" => "box", "not_empty" => true ),
		 "description"	=> __( "Give it like (Top Right Bottom Left) : 0 1px 0 0", "tcsn_theme" ),
		 ),
	array(
		"type"        	=> "textarea_html",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Contact Info", "tcsn_theme" ),
		"param_name"	=> "content",
		"value"       	=> '',
		"description"	=> __( "Enter your content.", "tcsn_theme" )
		),
	),
) );

// Testimonial
function tcsn_testimonial_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'carousel'  => '',
		'limit'     => -1,
		'order'     => '',
		'orderby'   => '',
	), $atts ) );
	
	if($carousel == 'yes') {
		$return_carousel = '';
	} else {
		$return_carousel = ' testimonial-carousel ';
	}

	global $post;
	$args = array(
		'post_type'      => 'tcsn_testimonial',
		'posts_per_page' => esc_attr( $limit ),
		'order'          => esc_attr( $order ), 
		'orderby'        => $orderby,
		'post_status'    => 'publish',
	);
	query_posts( $args );
	$output = '';
	if( have_posts() ) :
		$output .= '<div class="' . $return_carousel . 'wpb_custom_element testimonial-simple">';	
			while ( have_posts() ) : the_post();
				$output .= '<div class="item clearfix">';
				$output .= '<div class="testimonial-content clearfix">';
				$content = get_the_content();
				$content = apply_filters( 'the_content', $content );
				$content = str_replace( ']]>', ']]&gt;', $content );
				$output .= $content;
				$output .= '</div>';
				$output .= '<div class="client-img">' . get_the_post_thumbnail($post->ID, 'full') . '</div>';
				$output .= '<h5 class="testimonial-heading">' . get_the_title() .'</h5>';
				$client_info = get_post_meta( $post->ID, '_tcsn_client_info', true );  
				$output .= '<span class="testimonial-subheading">' . $client_info . '</span>';	
				$output .= '</div>';
			endwhile;
		$output .= '</div>';
		wp_reset_query();
	endif;
	return $output;
}
add_shortcode('testimonial', 'tcsn_testimonial_sc');

vc_map( array(
   "name"		=> __( "Testimonial", "tcsn_theme" ),
   "base"		=> "testimonial",
   "class"		=> '',
   "icon"		=> "icon-wpb-bartag",
   "category"	=> __( 'Content', 'tcsn_theme' ),
   "params"		=> array(
   	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => "",
		"heading"     => __( "Number of Testimonial to Show in Carousel", "tcsn_theme" ),
		"param_name"  => "limit",
		"value"       => __( "4", "tcsn_theme" ),
		"description" => "",
		),
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Sort Testimonials By", "tcsn_theme" ),
		"param_name"  => "orderby",
		"value"       => array ( 
			"Date"   => "date", 
			"Random" => "rand", 
			"Title"  => "title", 
			),
		"description" => '',
		),
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Arrange Sorted Testimonials", "tcsn_theme" ),
		"param_name"  => "order",
		"value"       => array ( "Descending" => "DESC", "Ascending" => "ASC" ),
		"description" => '',
		),
	array(
		"type"        => "checkbox",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Disable Carousel in case you have only one item to show. This is to avoid carousel fade effect.", "tcsn_theme" ),
		"param_name"  => "carousel",
		"value"       => array ( "Yes, please" => "yes" ),
		),
	)
) );

// List with icon
function tcsn_icon_list_sc( $atts, $content = null ) {
	 extract( shortcode_atts( array(
     	'type'         => '', 
		'color'        => '',
		'size'         => '',
		'icon_color'   => '',
		'list_border'  => '', 
		'list_content' => '', 
   ), $atts ) );

   $add_style = array();
		if( $color != ''  ) {
			$add_style[] = 'color: '. $color .';';
		} 
		if( $size != ''  ) {
			$add_style[] = 'font-size: '. $size .';';
		} 
		$add_style = implode('', $add_style);

		if ( $add_style ) {
			$add_style = wp_kses( $add_style, array() );
			$add_style = ' style="' . esc_attr($add_style) . '"';
		}
		
	$add_style_icon = array();
		if( $icon_color != ''  ) {
			$add_style_icon[] = 'color: '. $icon_color .';';
		} 
		if( $size != ''  ) {
			$add_style_icon[] = 'font-size: '. $size .';';
		} 
		$add_style_icon = implode('', $add_style_icon);

		if ( $add_style_icon ) {
			$add_style_icon = wp_kses( $add_style_icon, array() );
			$add_style_icon = ' style="' . esc_attr($add_style_icon) . '"';
		}

	if($list_border == 'yes') {
		$return_list_border = ' list-icon-border';
	} else {
		$return_list_border = '';
	}
   
   return "<p class='list-icon{$return_list_border}'{$add_style}><i class='icon-{$type}'{$add_style_icon}></i>{$content}</p>";
}
add_shortcode( 'listicon', 'tcsn_icon_list_sc' );

vc_map( array(
   "name"     => __( "List with icon", "tcsn_theme" ),
   "base"     => "listicon",
   "class"    => '',
   "icon"     => "icon-wpb-bartag",
   "category" => __( 'Content', 'tcsn_theme' ),
   "params"   => array(
   	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Select Icon", "tcsn_theme" ),
		"param_name"  => "type",
		"value"       => $font_icons_array, 
		),
	array(
         "type"        => "colorpicker",
         "holder"      => "div",
         "class"       => '',
         "heading"     => __( "Icon color", "tcsn_theme" ),
         "param_name"  => "icon_color",
         "value"       => '', 
         "description" => "Leave blank for same color as body font color.", 
		 ),
	array(
         "type"        => "colorpicker",
         "holder"      => "div",
         "class"       => '',
         "heading"     => __( "List text color", "tcsn_theme" ),
         "param_name"  => "color",
         "value"       => '', 
         "description" => "Leave blank for same color as body font color",
		 ),
	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Font Size", "tcsn_theme" ),
		"param_name"  => "size",
		 "value"      => '',
		"description" => __( "Give it as : 20px. Leave blank for same as body font size.", "tcsn_theme" )
	  	),
	array(
		"type"        => "checkbox",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Enable border bottom", "tcsn_theme" ),
		"param_name"  => "list_border",
		"value"       => array ( "Yes, please" => "yes" ),
		),
	array(
		"type"        	=> "textarea_html",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Content", "tcsn_theme" ),
		"param_name"	=> "content",
		"value"       	=> '',
		"description"	=> __( "Enter your content.", "tcsn_theme" )
		),
	)
) );

// Box
function tcsn_box_sc( $atts, $content = null ) { 
	extract( shortcode_atts( array(
		'bg_color'     	=> '',
		'border_color' 	=> '',
		'border_width'	=> '',
		'padding'		=> '',
		), $atts ) );

	$add_style = array();
		if ( $bg_color ) {
			$add_style[] = 'background-color: '. $bg_color .';';
		} 
		if ( $border_color ) {
			$add_style[] = 'border: 1px solid ' . $border_color . ';';
		} 
		if ( $border_width ) {
			$add_style[] = 'border-width: ' . $border_width . ';';
		} 
		if ( $padding ) {
			$add_style[] = 'padding: ' . $padding . ';';
		} 

		$add_style = implode('', $add_style);

		if ( $add_style ) {
			$add_style = wp_kses( $add_style, array() );
			$add_style = ' style="' . esc_attr($add_style) . '"';
		}

	$content = wpb_js_remove_wpautop($content); 
    return "<div class='box wpb_custom_element clearfix'{$add_style}>{$content}</div>";
	
}
add_shortcode( 'box', 'tcsn_box_sc' );

vc_map( array(
   "name"     => __( "Box", "tcsn_theme" ),
   "base"	  => "box",
   "class"    => '',
   "icon"     => "icon-wpb-bartag",
   "category" => __( 'Content', 'tcsn_theme' ),
   "params"   => array(
    array(
		 "type"        => "colorpicker",
		 "holder"      => "div",
		 "class"       => '',
		 "heading"     => __( "Background Color", "tcsn_theme" ),
		 "param_name"  => "bg_color",
		 "value" 	   => '', 
		 "description" => __( "Leave blank / clear for theme default", "tcsn_theme" )
		 ),
	array(
		"type"         => "colorpicker",
		 "holder"      => "div",
		 "class"       => '',
		 "heading"     => __( "Border Color", "tcsn_theme" ),
		 "param_name"  => "border_color",
		 "value" 	   => '', 
		 "description" => __( "Leave blank / clear for no border.", "tcsn_theme" )
		 ),
	array(
		 "type"        => "textfield",
		 "holder"      => "div",
		 "class"       => '',
		 "heading"     => __( "Border Width", "tcsn_theme" ),
		 "param_name"  => "border_width",
		 "value" 	   => '', 
		 "description" => __( "Border width. Ex: 1px 0 1px 0 (top, right, bottom, left)", "tcsn_theme" ),
		 ),
	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => "",
		"heading"     => __( "Padding to box", "tcsn_theme" ),
		"param_name"  => "padding",
		"value"       => __( "", "tcsn_theme" ),
		"description" => "Can be given like : 20px 20px 20px 20px <br> Sequence is : Top Right Bottom Left <br> Leave blank for default.",
		),
   array(
		"type"        => "textarea_html",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Content", "tcsn_theme" ),
		"param_name"  => "content",
		"value"       => __( "<p>I am box text block. Click edit button to change this text.</p>", "tcsn_theme" ),
		"description" => __( "Enter your content.", "tcsn_theme" )
		),
   ),
) );

// Blockquote
function tcsn_blockquote_sc( $atts, $content = null ) { 
	extract( shortcode_atts( array(
		'style'		=> '',
		'source'	=> '',
		'link'		=> '',
		), $atts ) );

		$content = wpb_js_remove_wpautop($content);
		
		if( $style == 'boxed' ){
			$return_style = 'boxed-quote';
		} elseif( $style == 'iconbg' ){
			$return_style = 'iconbg-quote';
		} elseif( $style == 'classic-pull-right' ){
			$return_style = 'pull-right';
		} else {
			$return_style = 'classic';
		}
		
		// link
		if( $link != '' ){
			$return_source = '<a href="' . $link . '">' . $source . '</a>';
		} else {
			$return_source =  $source;
		}

		return "<blockquote class='wpb_custom_element {$return_style}'>{$content}<span class='quote-source'>{$return_source}</span></blockquote>";

}
add_shortcode( 'blockquote', 'tcsn_blockquote_sc' );

vc_map( array(
   "name"     	=> __( "Blockquote", "tcsn_theme" ),
   "base"	  	=> "blockquote",
   "class"    	=> '',
   "icon"     	=> "icon-wpb-bartag",
   "category"	=> __( 'Content', 'tcsn_theme' ),
   "params"   	=> array(
    array(
		"type"       	=> "dropdown",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Blockquote Style", "tcsn_theme" ),
		"param_name"	=> "style",
		"value"       	=> array (
			"Quote with Icon"					=> "iconbg", 
			"Quote with box"					=> "boxed", 
			"Quote with line"					=> "classic", 
			"Quote with line pulled to right"	=> "classic-pull-right", 
			),
		"description"	=> '',
		),
	array(
		"type"        	=> "textfield",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Quote Author / Source", "tcsn_theme" ),
		"param_name"  	=> "source",
		"value" 	  	=> "", 
		"description"	=> '',
	  	),
	array(
		"type"        	=> "textfield",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Link to source", "tcsn_theme" ),
		"param_name"  	=> "link",
		"value" 	  	=> "", 
		"description"	=> '',
	  	),
	array(
		"type"        	=> "textarea_html",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Content", "tcsn_theme" ),
		"param_name"	=> "content",
		"value"       	=> '',
		"description"	=> __( "Enter your content.", "tcsn_theme" )
		),
	),
) );

// Alert
function tcsn_alert_sc( $atts, $content = null ) { 
	extract( shortcode_atts( array(
		'style'		=> '',
		), $atts ) );

		$content = wpb_js_remove_wpautop($content);

		if( $style == 'info' ){
			$return_style = 'alert-info';
		} elseif( $style == 'success' ){
			$return_style = 'alert-success';
		} elseif( $style == 'warning' ){
			$return_style = 'alert-warning';
		} elseif( $style == 'danger' ){
			$return_style = 'alert-danger';
		} else {
			$return_style = 'alert-info';
		}

		return "<div class='alert {$return_style}' role='alert'>{$content}</div>";
}
add_shortcode( 'alert', 'tcsn_alert_sc' );

vc_map( array(
   "name"     	=> __( "Alert", "tcsn_theme" ),
   "base"	  	=> "alert",
   "class"    	=> '',
   "icon"     	=> "icon-wpb-bartag",
   "category"	=> __( 'Content', 'tcsn_theme' ),
   "params"   	=> array(
    array(
		"type"       	=> "dropdown",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Alert Style", "tcsn_theme" ),
		"param_name"	=> "style",
		"value"       	=> array (
			"Info"		=> "info", 
			"Warning"	=> "warning", 
			"Danger"	=> "danger", 
			"Success"	=> "success", 
			),
		"description"	=> '',
		),
	array(
		"type"        	=> "textarea_html",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Content", "tcsn_theme" ),
		"param_name"	=> "content",
		"value"       	=> '',
		"description"	=> __( "Enter your content.", "tcsn_theme" )
		),
	),
) );

// Pricing
function tcsn_pricing_sc( $atts, $content = null ) {
    extract ( shortcode_atts( array(
		'title'          => '',
		'price'          => '',
		'currency'       => '',
		'cents'          => '',
		'price_label'    => '',
		'class'          => '', 
	  	'color'          => '',
	  	'target'         => '', 
	  	'url'            => '', 
	    'table'          => '', 
	    'button_content' => '',
	), $atts ) );

	if( $url != ''  ) {
		$return_url = ' href="' . $url . '"';
	} else {
		$return_url = '';
	}

	$content = wpb_js_remove_wpautop($content); 
	
    return "<div class='pricing {$table} wpb_custom_element'><table><thead><tr><th><h3 class='pricing-title'>{$title}</h3></th></tr><tr><td class='price'><sup>{$currency}</sup>{$price}<sup>{$cents}</sup><span class='price-label'>{$price_label}</span></td></tr></thead><tbody><tr><td>{$content}</td></tr><tr><td class='focus-td'><a class='{$class} {$color}' target='{$target}'{$return_url}>{$button_content}</a></td></tr></tbody></table></div>";
}
	
add_shortcode('pricing', 'tcsn_pricing_sc');

vc_map( array(
   "name"                 => __( "Pricing", "tcsn_theme" ),
   "base"                 => "pricing",
   "class"                => "",
   "icon"                 => "icon-wpb-bartag",
   "category"             => __( 'Content', 'tcsn_theme' ),
   "params"               => array(
		array(
			"type"        => "textfield",
			"holder"      => "div",
			"class"       => "",
			"heading"     => __( "Title", "tcsn_theme" ),
			"param_name"  => "title",
			"value"       => "",
			"description" => "",
		),
		array(
			"type"        => "textfield",
			"holder"      => "div",
			"class"       => "",
			"heading"     => __( "Currency Symbol", "tcsn_theme" ),
			"param_name"  => "currency",
			"value"       => __( "$", "tcsn_theme" ),
			"description" => "",
		),
		array(
			"type"        => "textfield",
			"holder"      => "div",
			"class"       => "",
			"heading"     => __( "Price", "tcsn_theme" ),
			"param_name"  => "price",
			"value"       => __( "129", "tcsn_theme" ),
			"description" => "",
		),
		array(
			"type"        => "textfield",
			"holder"      => "div",
			"class"       => "",
			"heading"     => __( "Cents", "tcsn_theme" ),
			"param_name"  => "cents",
			"value"       => __( "99", "tcsn_theme" ),
			"description" => "",
		),
		array(
			"type"        => "textfield",
			"holder"      => "div",
			"class"       => "",
			"heading"     => __( "Price Label", "tcsn_theme" ),
			"param_name"  => "price_label",
			"value"       => __( "/month", "tcsn_theme" ),
			"description" => "",
		),
		array(
			"type"        => "dropdown",
		    "holder"      => "div",
		    "class"       => "",
		    "heading"     => __( "Button Style", "tcsn_theme" ),
		    "param_name"  => "class",
		    "value"       => array ( "Normal" => "mybtn", "Big" => "mybtn mybtn-big ", ),
		    "description" => "",
	    ),
		array(
		    "type"        => "dropdown",
		    "holder"      => "div",
		    "class"       => "",
		    "heading"     => __( "Button Color", "tcsn_theme" ),
		    "param_name"  => "color",
		    "value"       => array ( "Default" => "", "Green" => "mybtn-green", "White" => "mybtn-white", "Blue" => "mybtn-blue", "Red" => "mybtn-red", "Cyan" => "mybtn-cyan", "Olive" => "mybtn-olive", ),
		    "description" => "",
	    ),		
	   array(
	   		"type"        => "textarea",
		    "holder"      => "div",
		    "class"       => "",
		    "heading"     => __( "Button link text", "tcsn_theme" ),
		    "param_name"  => "button_content",
		    "value"       => __( "Link", "tcsn_theme" ),
		    "description" => "",
       ),
	  array(
		   "type"         => "textfield",
		   "holder"       => "div",
		   "class"        => "",
		   "heading"      => __( "Button link URL", "tcsn_theme" ),
		   "param_name"   => "url",
		   "value"        => "",
		   "description"  => "",
	  ),
	  array(
	  		"type"        => "dropdown",
		    "holder"      => "div",
		    "class"       => "",
		    "heading"     => __( "Open link in", "tcsn_theme" ),
		    "param_name"  => "target",
		    "value"       => array ( "New Window" => "_blank", "Same Window" => "_self", ),
		    "description" => "",
	   ),
	   array(
	  		"type"        => "dropdown",
		    "holder"      => "div",
		    "class"       => "",
		    "heading"     => __( "Table type", "tcsn_theme" ),
		    "param_name"  => "table",
		    "value"       => array ( "Normal" => "default-table", "Featured" => "featured-table", ),
		    "description" => "",
	   ),
	  array(
			"type"        => "textarea_html",
			"holder"      => "div",
			"class"       => "",
			"heading"     => __( "Content", "tcsn_theme" ),
			"param_name"  => "content",
			"value"       => __( "<p>I am a text block. Click edit button to change this text.</p>", "tcsn_theme" ),
			"description" => __( "Enter your content.", "tcsn_theme" )
		)
	)
) );

// Team Person
function tcsn_team_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'id'      		=> '',
		'excerpt'		=> '',
		'box'    		=> '', 
		'box_bg'    	=> '', 
		'box_border'	=> '', 
	), $atts ) );
	      
	global $post;
	$args = array(
		'name'           => esc_attr( $id ),
		'post_type'      => 'tcsn_team',
		'posts_per_page' => '',
		'post_status'    => 'publish',
	);
	query_posts( $args );

	// Box
	if( $box !== 'yes' ){
		$box = '';
	} else {
		$box = ' box-border';
	}
	
	$add_box_style = array();
	if ( $box_bg && $box != '' ) {
		$add_box_style[] = 'background-color:' . $box_bg . ';';
	} 
	if ( $box_border ) {
			$add_box_style[] = ' border: 1px solid ' . $box_border . ';';
		} 
	$add_box_style = implode('', $add_box_style);

	if ( $add_box_style ) {
		$add_box_style = wp_kses( $add_box_style, array() );
		$add_box_style = ' style="' . esc_attr($add_box_style) . '"';
	}
	
	$output = '';
	
	if( have_posts() ) :
		$output .= '<div class="team wpb_custom_element clearfix' . $box . '"' . $add_box_style . '>';	
		
		while ( have_posts() ) : the_post();
 
			$member_job         = get_post_meta( $post->ID, '_tcsn_member_job', true );     
			$member_behance     = get_post_meta( $post->ID, '_tcsn_member_behance', true );      
			$member_delicious   = get_post_meta( $post->ID, '_tcsn_member_delicious', true );    
			$member_dribbble    = get_post_meta( $post->ID, '_tcsn_member_dribbble', true );
			$member_dropbox     = get_post_meta( $post->ID, '_tcsn_member_dropbox', true );       
			$member_facebook    = get_post_meta( $post->ID, '_tcsn_member_facebook', true );      
			$member_flickr      = get_post_meta( $post->ID, '_tcsn_member_flickr', true );       
			$member_googleplus  = get_post_meta( $post->ID, '_tcsn_member_googleplus', true );    
			$member_instagram   = get_post_meta( $post->ID, '_tcsn_member_instagram', true );        
			$member_linkedin    = get_post_meta( $post->ID, '_tcsn_member_linkedin', true );        
			$member_paypal      = get_post_meta( $post->ID, '_tcsn_member_paypal', true );          
			$member_pinterest   = get_post_meta( $post->ID, '_tcsn_member_pinterest', true );        
			$member_skype       = get_post_meta( $post->ID, '_tcsn_member_skype', true );             
			$member_soundcloud  = get_post_meta( $post->ID, '_tcsn_member_soundcloud', true );       
			$member_stumbleupon	= get_post_meta( $post->ID, '_tcsn_member_stumbleupon', true );       
			$member_tumblr      = get_post_meta( $post->ID, '_tcsn_member_tumblr', true );            
			$member_twitter     = get_post_meta( $post->ID, '_tcsn_member_twitter', true );             
			$member_vimeo       = get_post_meta( $post->ID, '_tcsn_member_vimeo', true );          
			$member_youtube     = get_post_meta( $post->ID, '_tcsn_member_youtube', true );        
			$member_mail        = get_post_meta( $post->ID, '_tcsn_member_mail', true );          

			$output .= '<div class="member-image">' . get_the_post_thumbnail($post->ID, 'full') . '</div>';

			$permalink = get_permalink();
			$output .= '<h5 class="member-name"><a href="' . $permalink . '" rel="bookmark">' . get_the_title() .'</a></h5>';
			
			if( $member_job != ''  ) {
			$output .= '<span class="member-job">' . $member_job . '</span>';	
			}
			
			// excerpt
			if( $excerpt !== 'yes' ):	
			$output .= '<div class="team-excerpt">';
			$content = get_the_excerpt();
			$content = wp_trim_words( $content , '35' );
			$content = str_replace( ']]>', ']]&gt;', $content );
			$output .= $content;
			$output .= '</div>';
			endif;	
			
			$output .= '<ul class="social clearfix">';
			
			if( $member_behance != ''  ) {
				$output .= '<li><a href="' . $member_behance . '" target="_blank" title="behance"><i class="icon-behance"></i></a></li>';
			}
			if( $member_delicious != ''  ) {
				$output .= '<li><a href="' . $member_delicious . '" target="_blank" title="delicious"><i class="icon-delicious"></i></a></li>';
			}
			if( $member_dribbble != ''  ) {
				$output .= '<li><a href="' . $member_dribbble . '" target="_blank" title="dribbble"><i class="icon-dribbble"></i></a></li>';
			}
			if( $member_dropbox != ''  ) {
				$output .= '<li><a href="' . $member_dropbox . '" target="_blank" title="dropbox"><i class="icon-dropbox"></i></a></li>';
			}
			if( $member_facebook != ''  ) {
				$output .= '<li><a href="' . $member_facebook . '" target="_blank" title="facebook"><i class="icon-facebook"></i></a></li>';
			}
			if( $member_flickr != ''  ) {
				$output .= '<li><a href="' . $member_flickr . '" target="_blank" title="flickr"><i class="icon-flickr"></i></a></li>';
			}
			if( $member_googleplus != ''  ) {
				$output .= '<li><a href="' . $member_googleplus . '" target="_blank" title="googleplus"><i class="icon-googleplus8"></i></a></li>';
			}
			if( $member_instagram != ''  ) {
				$output .= '<li><a href="' . $member_instagram . '" target="_blank" title="instagram"><i class="icon-instagram"></i></a></li>';
			}
			if( $member_linkedin != ''  ) {
				$output .= '<li><a href="' . $member_linkedin . '" target="_blank" title="linkedin"><i class="icon-linkedin"></i></a></li>';
			}
			if( $member_paypal != ''  ) {
				$output .= '<li><a href="' . $member_paypal . '" target="_blank" title="paypal"><i class="icon-paypal"></i></a></li>';
			}
			if( $member_pinterest != ''  ) {
				$output .= '<li><a href="' . $member_pinterest . '" target="_blank" title="pinterest"><i class="icon-pinterest"></i></a></li>';
			}
			if( $member_skype != ''  ) {
				$output .= '<li><a href="skype:' . $member_skype . '?chat" target="_blank" title="skype"><i class="icon-skype"></i></a></li>';
			}
			if( $member_soundcloud != ''  ) {
				$output .= '<li><a href="' . $member_soundcloud . '" target="_blank" title="soundcloud"><i class="icon-soundcloud"></i></a></li>';
			}
			if( $member_stumbleupon != ''  ) {
				$output .= '<li><a href="' . $member_stumbleupon . '" target="_blank" title="stumbleupon"><i class="icon-stumbleupon"></i></a></li>';
			}
			if( $member_tumblr != ''  ) {
				$output .= '<li><a href="' . $member_tumblr . '" target="_blank" title="tumblr"><i class="icon-tumblr"></i></a></li>';
			}
			if( $member_twitter != ''  ) {
				$output .= '<li><a href="' . $member_twitter . '" target="_blank" title="twitter"><i class="icon-twitter"></i></a></li>';
			}
			if( $member_vimeo != ''  ) {
				$output .= '<li><a href="' . $member_vimeo . '" target="_blank" title="vimeo"><i class="icon-vimeo"></i></a></li>';
			}
			if( $member_youtube != ''  ) {
				$output .= '<li><a href="' . $member_youtube . '" target="_blank" title="youtube"><i class="icon-youtube"></i></a></li>';
			}
			if( $member_mail != ''  ) {
				$output .= '<li><a href="mailto:' . $member_mail . '" target="_blank" title="mail"><i class="icon-mail"></i></a></li>';
			}
			$output .= '</ul>';

		endwhile;

		$output .= '</div>';

		wp_reset_query();
	endif;
	return $output;
}
add_shortcode('team', 'tcsn_team_sc');

vc_map( array(
   "name"              => __( "Team Member", "tcsn_theme" ),
   "base"              => "team",
   "class"             => "",
   "icon"	           => "icon-wpb-bartag",
   "category"		   => __( 'Content', 'tcsn_theme' ),
   "params"            => array(
   	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => "",
		"heading"     => __( "Person ID", "tcsn_theme" ),
		"param_name"  => "id",
		"value"       => __( "ID", "tcsn_theme" ),
		"description" => "",
		),
	array(
		"type"        => "checkbox",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Hide Excerpt", "tcsn_theme" ),
		"param_name"  => "excerpt",
		"value"       => array ( "Yes, please" => "yes" ),
		"description" => '',
		),
	array(
		"type"        	=> "checkbox",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Make Team Member Boxed", "tcsn_theme" ),
		"param_name"	=> "box",
		"value"       	=> array ( "Yes, please" => "yes" ),
	  	),
	array(
		 "type"        	=> "colorpicker",
		 "holder"      	=> "div",
		 "class"       	=> '',
		 "heading"     	=> __( "Box Border Color", "tcsn_theme" ),
		 "param_name"  	=> "box_border",
		 "value" 	   	=> '', 
		 "dependency"  => array( "element" => "box", "not_empty" => true ),
		 "description"	=> __( "Leave blank for default.", "tcsn_theme" ),
		 ),
	array(
		 "type"        	=> "colorpicker",
		 "holder"      	=> "div",
		 "class"       	=> '',
		 "heading"     	=> __( "Box Background Color", "tcsn_theme" ),
		 "param_name"  	=> "box_bg",
		 "value" 	   	=> '', 
		 "dependency"  => array( "element" => "box", "not_empty" => true ),
		 "description"	=> __( "Leave blank for default.", "tcsn_theme" ),
		 ),
	)
) );

// Video Play Button
function tcsn_zoom_btn_sc( $atts, $content = null ) { 
	extract( shortcode_atts( array(
		'style'					=> '',
		'icon_color'			=> '',
		'border_color'			=> '',
		'zoom_title'			=> '',
		'zoom_link'				=> '',
		'link_text'				=> '',
		'return_border_color'	=> '',
		), $atts ) );
		
		
		$add_icon_style = array();
		if ( $icon_color ) {
			$add_icon_style[] = 'color: '. $icon_color .';';
		} 
		$add_icon_style = implode('', $add_icon_style);

		if ( $add_icon_style ) {
			$add_icon_style = wp_kses( $add_icon_style, array() );
			$add_icon_style = ' style="' . esc_attr($add_icon_style) . '"';
		}
		
		if( $border_color != '' ){
			$return_border_color = ' style="border: 3px solid ' . $border_color .'"';
		} 
		
		if( $style == 'video' ){
			$return_style = '<i class="icon-play4 zoom-btn-icon"' . $add_icon_style . '></i>';
		} 
		if( $style == 'image' ){
			$return_style = '<i class="icon-image2 zoom-btn-icon"' . $add_icon_style . '></i>';
		} 

		$lightbox = '<a title="' . $zoom_title . '"' . $add_icon_style . ' href="' . $zoom_link . '" data-rel="prettyPhoto">' . $return_style . '<span class="zoom-btn-text">' . $link_text . '</span></a>';

	return "<div class='zoom-button'{$return_border_color}>{$lightbox}</div>";
}
add_shortcode( 'zoom_button', 'tcsn_zoom_btn_sc' );

vc_map( array(
   "name"     	=> __( "Button With prettyPhoto", "tcsn_theme" ),
   "base"	  	=> "zoom_button",
   "class"    	=> '',
   "icon"     	=> "icon-wpb-bartag",
   "category"	=> __( 'Content', 'tcsn_theme' ),
   "params"   	=> array(
   array(
		"type"       	=> "dropdown",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Lightbox Style", "tcsn_theme" ),
		"param_name"	=> "style",
		"value"       	=> array (
			"prettyPhoto for Image"	=> "image", 
			"prettyPhoto for Video"	=> "video", 
			),
		"description"	=> '',
		),
   array(
		"type"        	=> "textfield",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Button Text", "tcsn_theme" ),
		"param_name"  	=> "link_text",
		"value" 	  	=> "", 
		"description"	=> '',
	  	),
	array(
		 "type"        	=> "colorpicker",
		 "holder"      	=> "div",
		 "class"       	=> '',
		 "heading"     	=> __( "Link Text and Icon Color", "tcsn_theme" ),
		 "param_name"  	=> "icon_color",
		 "value" 	   	=> '', 
		 "description"	=> __( "Leave blank for theme default.", "tcsn_theme" ),
		 ),
	array(
		 "type"        	=> "colorpicker",
		 "holder"      	=> "div",
		 "class"       	=> '',
		 "heading"     	=> __( "Border Color", "tcsn_theme" ),
		 "param_name"  	=> "border_color",
		 "value" 	   	=> '', 
		 "description"	=> __( "Leave blank for theme default.", "tcsn_theme" ),
		 ),
	array(
		"type"        	=> "textfield",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Video / Image Link", "tcsn_theme" ),
		"param_name"  	=> "zoom_link",
		"value" 	  	=> "", 
		"description"	=> '',
	  	),
	array(
		"type"        	=> "textfield",
		"holder"      	=> "div",
		"class"       	=> '',
		"heading"     	=> __( "Video / Image Title", "tcsn_theme" ),
		"param_name"  	=> "zoom_title",
		"value" 	  	=> "", 
		"description"	=> '',
	  	),
	),
) );

// Portfolio Grid
function tcsn_portfolio_sc( $atts, $content = null ) {
    extract ( shortcode_atts( array(
		'heading'     	=> '',
		'limit'      	=> -1,
		'order'	      	=> '',
		'orderby'     	=> '',
		'tax'         	=> '',
		'style'      	=> '',
		'column'      	=> '',
		'target' 		=> '',
		'remove_link'	=> '',
	), $atts ) );
	
	if( $remove_link !== 'yes' ){
		$return_remove_link = '';
  	} else {
		$return_remove_link = ' remove-link-button';
	}
	
	global $post;
	$args = array(
		'post_type'          => 'tcsn_portfolio',
		'tcsn_portfoliotags' => $tax,
		'posts_per_page'     => esc_attr( $limit ),
		'order'              => esc_attr( $order ), 
		'orderby'            => $orderby,
		'post_status'        => 'publish',
	);
	
	query_posts( $args );
	$output = '';
	
	if( $column == 'column_four' ){
		$return_column = 'portfolio-four-col';
	}  else {
		$return_column = 'portfolio-three-col';
	}
	
	if( have_posts() ) :
	
		$output .= '<div class="portfolio-grid wpb_custom_element ' . $return_column . ' clearfix">';	
		while ( have_posts() ) : the_post();
			$output .= '<div class="portfolio-item">';
		 		$thumb       	= get_post_thumbnail_id(); 
				$img_url     	= wp_get_attachment_url( $thumb, 'full' ); 
				$thumb_title 	= get_the_title();
				$img_link    	= get_permalink($post->ID);
				$permalink   	= get_permalink();
				$link_url 	   	= get_post_meta( $post->ID, '_tcsn_link_url', true );
				$external_link	= get_post_meta( $post->ID, '_tcsn_external_link', true );     
				
		if( $heading !== 'yes' ):	
				$permalink = get_permalink();
				$return_heading = '<h5><a href="' . $permalink . '" rel="bookmark">' . get_the_title() .'</a></h5>';
				endif;	
						
		if( $style == 'zoom' ){
			$return_style = '<figure><img src="' . $img_url . '" alt="' . $thumb_title . '"/><figcaption>' . $return_heading . '<a href="' . $img_url . '" data-rel="prettyPhoto" title="' . $thumb_title . '"><i class="icon-others-zoom"></i></a></figcaption></figure>';
		} 
		
		if( $style == 'none' ){
			$return_style = '<figure><img src="' . $img_url . '" alt="' . $thumb_title . '"/><figcaption>' . $return_heading . '</figcaption></figure>';
		} 
		
		if( $style == 'link' ){
			if ( $external_link == true ) { 
			$return_style = '<figure><img src="' . $img_url . '" alt="' . $thumb_title . '"/><figcaption>' . $return_heading . '<a href="' . $link_url . '" target="' . $target . '"><i class="icon-link5"></i></a></figcaption></figure>';
			} else { 
			$return_style = '<figure><img src="' . $img_url . '" alt="' . $thumb_title . '"/><figcaption>' . $return_heading . '<a href="' . $permalink . '" target="' . $target . '"><i class="icon-link5"></i></a></figcaption></figure>';
			}	
		} 
   			$output .= $return_style;		
				
			$output .= '</div>';
		endwhile;
		$output .= '</div>';
		wp_reset_query();
	endif;
	return $output;
}
add_shortcode('portfolio_grid', 'tcsn_portfolio_sc');

vc_map( array(
   "name"     => __( "Portfolio Grid", "tcsn_theme" ),
   "base"     => "portfolio_grid",
   "class"    => '',
   "icon"	  => "icon-wpb-bartag",
   "category" => __( 'Content', 'tcsn_theme' ),
   "params"   => array(
   array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Number of columns", "tcsn_theme" ),
		"param_name"  => "column",
		"value"       => array (
			"Three Columns"	=> "", 
			"Four Columns"	=> "column_four", 
			),
		"description" => '',
		),
	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Number of posts to show in carousel", "tcsn_theme" ),
		"param_name"  => "limit",
		"value"       => __( "6", "tcsn_theme" ),
		"description" => '',
		),
	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Filter by Category", "tcsn_theme" ),
		"param_name"  => "tax",
		"value"       => '',
		"description" => "Enter --- <strong>CATEGORY SLUG</strong> --- here. Separate with commas.<br>Find category slug here : Portfolio Items > Portfolio Categories<br>This will help to group portfolio items from selected categories in one carousel.",
		),
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Sort Posts By", "tcsn_theme" ),
		"param_name"  => "orderby",
		"value"       => array (
			"Date"   => "date", 
			"Random" => "rand", 
			"Title"  => "title", 
			),
		"description" => '',
		),
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Arrange Sorted Posts", "tcsn_theme" ),
		"param_name"  => "order",
		"value"       => array ( "Descending" => "DESC", "Ascending" => "ASC"),
		"description" => '',
		),
	array(
		"type"        => "checkbox",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Hide Heading", "tcsn_theme" ),
		"param_name"  => "heading",
		"value"       => array ( "Yes, please" => "yes" ),
		"description" => "",
		),
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Select Zoom / Link", "tcsn_theme" ),
		"param_name"  => "style",
		"value"       => array (
			"Zoom" => "zoom", 
			"Link" => "link", 
			"None" => "none", 
			),
		),
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Open Window In", "tcsn_theme" ),
		"param_name"  => "target",
		"value"       => array (
			"Same Window"	=> "_self", 
			"New Window"	=> "_blank", 
			),
		),
	)
) );

// Recent Posts Carousel
function tcsn_recentpost_sc( $atts, $content = null ) {
    extract ( shortcode_atts( array(
		'title'     => '',
		'thumbnail'	=> '',
		'excerpt'   => '',
		'date'   	=> '',
		'limit'     => -1,
		'order'     => '',
		'orderby'   => '',
		'cat'	    => '',
	), $atts ) );

	$cat = str_replace(' ','-',$cat);
	 
	global $post;
	$args = array(
		'post_type'      => '',
		'posts_per_page' => esc_attr( $limit ),
		'order'          => esc_attr( $order ), 
		'orderby'        => $orderby,
		'post_status'    => 'publish',
		'category_name'  => $cat, 
	);

	query_posts( $args );
	$output = '';
	if( have_posts() ) : 
		$output .= '<div class="recentpost-carousel wpb_custom_element">';
		while ( have_posts() ) : the_post();
			$output .= '<div class="item clearfix">';
			$permalink		= get_permalink();
			$thumb     		= get_post_thumbnail_id(); 
			$img_url   		= wp_get_attachment_url( $thumb, 'full' ); 
			$image       	= aq_resize( $img_url, 350, 220, true );
			$thumb_title	= get_the_title();	

			// thumbnail
			if( $thumbnail !== 'yes' ):
				if( has_post_thumbnail() ) { 
					$output .=  '<a href="' . $permalink . '" rel="bookmark"><img src="' . $image . '" alt="' . $thumb_title . '"/></a>';
				} 
			endif;	
			
			// title
			if( $title !== 'yes' ):
				$output .= '<h5 class="recentpost-heading"><a href="' . $permalink . '" rel="bookmark">' . get_the_title() . '</a></h5>';
			endif;	
			if( $date !== 'yes' ):
				$output .= '<span class="recentpost-date">' . get_the_date() . '</span>';
			endif;	
			// excerpt
			if($excerpt!=='yes'):	
				$output .= '<div class="recentpost-excerpt">';
				$content = get_the_excerpt();
				$content = wp_trim_words( $content , '35' );
				$content = str_replace( ']]>', ']]&gt;', $content );
				$output .= $content;
				$output .= '</div>';
			endif;	
			
			$output .= '<a href="' . $permalink . '" rel="bookmark" class="link-underline">Read More</a>';
		
			$output .= '</div>';
		endwhile;
		$output .= '</div>';
		wp_reset_query();
	endif;
	return $output;
}
add_shortcode('recent_post', 'tcsn_recentpost_sc');

vc_map( array(
   "name"     => __( "Recent Post", "tcsn_theme" ),
   "base"     => "recent_post",
   "class"    => '',
   "icon"	  => "icon-wpb-bartag",
   "category" => __( 'Content', 'tcsn_theme' ),
   "params"   => array(
   	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Number of Posts to Show in Carousel", "tcsn_theme" ),
		"param_name"  => "limit",
		"value"       => __( "2", "tcsn_theme" ),
		"description" => '',
		),
	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Filter by Category", "tcsn_theme" ),
		"param_name"  => "cat",
		"value"       => '',
		"description" => "Filter output by posts categories, enter category names here. Separate with commas.",
		),
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Sort Posts By", "tcsn_theme" ),
		"param_name"  => "orderby",
		"value"       => array ( 
			"Date"   => "date", 
			"Random" => "rand", 
			"Author" => "author", 
			"Title"  => "title", 
			),
		"description" => '',
		),
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Arrange Sorted Posts", "tcsn_theme" ),
		"param_name"  => "order",
		"value"       => array ( "Descending" => "DESC", "Ascending" => "ASC" ),
		"description" => '',
		),
	array(
		"type"        => "checkbox",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Hide Title", "tcsn_theme" ),
		"param_name"  => "title",
		"value"       => array ( "Yes, please" => "yes" ),
		"description" => '',
		),
	array(
		"type"        => "checkbox",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Hide Date", "tcsn_theme" ),
		"param_name"  => "date",
		"value"       => array ( "Yes, please" => "yes" ),
		"description" => '',
		),
	array(
		"type"        => "checkbox",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Hide Thumbnail", "tcsn_theme" ),
		"param_name"  => "thumbnail",
		"value"       => array ( "Yes, please" => "yes" ),
		"description" => '',
		),
	array(
		"type"        => "checkbox",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Hide Post Excerpt", "tcsn_theme" ),
		"param_name"  => "excerpt",
		"value"       => array ( "Yes, please" => "yes" ),
		"description" => '',
		),
	)
) );

// Add new shortcode
}

use WordPress\ORM\Model\Users;

function add_new_user($userID) {
	$mgm_member = mgm_get_member($userID);
	$custom_fields = $mgm_member->custom_fields;
	/*
	$user = new Users;
	if ( isset($_POST['user_password']) ) {
		$user->set_password(md5($_POST['user_password']));
		$salt = uniqid('',true);
		$user->set_salt($salt);
		$user->set_verification_code(urlencode($salt));
	}
	$user->set_firstname($custom_fields->first_name);
	$user->set_lastname($custom_fields->last_name);
   	$user->set_username($custom_fields->email);
   	$user->set_email($custom_fields->email);
   	$user->save();*/

   	$salt = uniqid('',true);
   	if ( isset($_POST['user_password']) ) {
   		$password = md5($_POST['user_password']);
   	} else {
   		$password = '';
   	}
   	global $wpdb;
   	$wpdb->insert(
	'user', 
		array( 
			'id' => $userID, 
			'password' => $password,
			'firstname' => $custom_fields->first_name,
			'lastname' => $custom_fields->last_name,
			'username' => $custom_fields->email,
			'email' => $custom_fields->email,
			'salt' => $salt,
			'verification_code' => urlencode($salt),
			'active' => 0,
		)
	);

	if ( isset($mgm_member->membership_type) && $mgm_member->membership_type == 'free' ) {
		global $wpdb;
	//	$user = Users::find_one($userID);
	//		var_dump($userID);exit;
	//	var_dump($user);exit;
		//$user->set_active(1);
		$wpdb->query("UPDATE user SET type = 0 WHERE id = $userID ");
	  //  $user->set_type(0);
	   // $user->save();
	}
	send_email($userID, urlencode($salt));
   	return true;
}
add_action('mgm_user_register', 'add_new_user');

function active_user($transaction) {
/*
	$userID = $transaction['user_id'];
	$user = Users::find_one($userID);
//	$user->set_active(1);
    $user->set_type(1);
    $user->save();
    return true;*/
    $wpdb->query("UPDATE user SET type = 1 WHERE id = $userID ");
}

add_action('mgm_membership_transaction_success', 'active_user');

function send_email($userID, $link) {
	$mgm_member = mgm_get_member($userID);
	$custom_fields = $mgm_member->custom_fields;
	add_filter( 'wp_mail_content_type', 'set_html_content_type' );

	$body = 'Dear '.$custom_fields->first_name.',
                    <br />
                    Hi, it looks like you\'ve created a ReqRap account, the 
                    rapid web requirements system.<br />
                    To confirm your email address and activate your account follow 
                    the link below and complete the join form.
                    <br />
                    Click here to accept <a href="'.site_url().'/req/user/active/verifycode/'.$link.'">'.site_url().'/user/active/verifycode/'.$link.'</a>                   
                    <br />
                    <br />
                    Thanks, 
                    from the ReqRap Team.
                    ';
	wp_mail( $custom_fields->email, 'You have registered an account on ReqRap', $body);
}

function set_html_content_type() {
	return 'text/html';
}


function redirect_login_page() {
	$login_url = home_url().'/req/site/login';
    wp_redirect( $login_url, 301 ); exit;
}
add_shortcode( 'redirect_login_page', 'redirect_login_page' );
