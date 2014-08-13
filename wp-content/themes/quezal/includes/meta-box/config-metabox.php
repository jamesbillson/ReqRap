<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category Quezal
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'tcsn_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function tcsn_metaboxes( array $meta_boxes ) {
	
	// Prefix
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_tcsn_';
	
	// Display metaboxes according to post format
	add_action( 'admin_print_scripts', 'display_metaboxes', 1000 );
    function display_metaboxes() {
    	if ( get_post_type() == "post" ) :
        ?>
	<script type="text/javascript">
		jQuery( document ).ready( function($) {
	
		var	$pfaudio = $('#format-post-audio').hide(),
			$pfgallery = $('#format-post-gallery').hide(),
			$pflink = $('#format-post-link').hide(),
			$pfquote = $('#format-post-quote').hide(),
			$pfvideo = $('#format-post-video').hide(),
			$post_format = $('input[name="post_format"]');
	
		$post_format.each(function() {
			var $this = $(this);
			if( $this.is(':checked') )
				change_post_format( $this.val() );
		});
	
		$post_format.change(function() {
			change_post_format( $(this).val() );
		});
	
		function change_post_format( val ) {
			$pfaudio.hide();
			$pfgallery.hide();
			$pflink.hide();
			$pfquote.hide();
			$pfvideo.hide();
			
			if( val === 'audio' ) {
				$pfaudio.show();
			} else if( val === 'gallery' ) {
				$pfgallery.show();
			} else if( val === 'link' ) {
				$pflink.show();
			} else if( val === 'quote' ) {
				$pfquote.show();
			} else if( val === 'video' ) {
				$pfvideo.show();
			}
		}
	});
     </script>
	<?php
    	endif;
	 }

	// All Revolution sliders in array
	$revolutionslider = array();
	if( class_exists('RevSlider') ) {
		$theslider = new RevSlider();
		$arrSliders = $theslider->getArrSliders();
		$revolutionslider[0] = 'Select a Slider';
		foreach($arrSliders as $slider) { 
			$revolutionslider[$slider->getAlias()] = $slider->getTitle();
		}
	}
	else {
		$revolutionslider[0] = 'Install Revolution Slider Plugin';
	}
		
	/**
	 * Meta boxes for audio post formats
	 */
	$meta_boxes['format-post-audio'] = array(
		'id'         => 'format-post-audio',
		'title'      => __( 'Audio Embed Code', 'tcsn_theme' ),
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'desc'       => '',
		'show_names' => false, // Show field names on the left
		'fields'     => array(
			array(
				'id'   => $prefix . 'pf_audio_embed',
				'type' => 'textarea_code',
			),
		),
	);

	/**
	 * Meta boxes for gallery post formats
	 */
	$meta_boxes['format-post-gallery'] = array(
		'id'         => 'format-post-gallery',
		'title'      => __( 'Select Revolution Slider', 'tcsn_theme' ),
		'pages'      => array( 'post', 'tcsn_portfolio' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'desc'       => '',
		'show_names' => false, // Show field names on the left
		'fields'     => array(
			array(
				'id'   		=> $prefix . 'select_gallery_rev_slider',
				'options'	=> $revolutionslider,
				'desc'  	=> __( 'Revolution slider for gallery post.', 'tcsn_theme' ),
				'type' 		=> 'select',
			),
		),
	);
	
	/**
	 * Meta boxes for link post formats
	 */
	$meta_boxes['format-post-link'] = array(
		'id'         => 'format-post-link',
		'title'      => __( 'Link Text and URL', 'tcsn_theme' ),
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'desc'       => '',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __( 'Link text', 'tcsn_theme' ),
				'id'   => $prefix . 'pf_link_text',
				'type' => 'text',
			),
			array(
				'name' => __( 'Link URL', 'tcsn_theme' ),
				'id'   => $prefix . 'pf_link_url',
				'type' => 'text',
			),
		),
	);
	
	/**
	 * Meta boxes for quote post formats
	 */
	$meta_boxes['format-post-quote'] = array(
		'id'         => 'format-post-quote',
		'title'      => __( 'Quote Source', 'tcsn_theme' ),
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'desc'       => '',
		'show_names' => false, // Show field names on the left
		'fields'     => array(
			array(
				'id'   => $prefix . 'pf_quote_source',
				'type' => 'text',
			),
		),
	);
	
	/**
	 * Meta boxes for video post formats
	 */
	$meta_boxes['format-post-video'] = array(
		'id'         => 'format-post-video',
		'title'      => __( 'Video Embed Code', 'tcsn_theme' ),
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'desc'       => '',
		'show_names' => false, // Show field names on the left
		'fields'     => array(
			array(
				'id'   => $prefix . 'pf_video_embed',
				'type' => 'textarea_code',
			),
		),
	);

	/**
	 * Meta box for client info in testimonial
	 */
	$meta_boxes['client-info-metabox'] = array(
		'id'         => 'client-info-metabox',
		'title'      => __( 'Client info', 'tcsn_theme' ),
		'pages'      => array( 'tcsn_testimonial', ), // Post type
		'context'    => 'side',
		'priority'   => 'high',
		'desc'       => '',
		'show_names' => false, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __( '', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'client_info',
				'type' => 'text',
			),
		),
	);
	
	/**
	 * Meta box for Member job title in team
	 */
	$meta_boxes['member-job'] = array(
		'id'         => 'member-job',
		'title'      => __( 'Member Job Title', 'tcsn_theme' ),
		'pages'      => array( 'tcsn_team', ), // Post type
		'context'    => 'side',
		'priority'   => 'high',
		'desc'       => '',
		'show_names' => false, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __( '', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_job',
				'type' => 'text',
			),
		),
	);
	
	/**
	 * Meta box for member social in team
	 */
	$meta_boxes['member-social'] = array(
		'id'         => 'member-social',
		'title'      => __( 'Member Social Network. Provide URL.', 'tcsn_theme' ),
		'pages'      => array( 'tcsn_team', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'desc'       => '',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __( 'Behance', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_behance',
				'type' => 'text',
			),
			array(
				'name' => __( 'Delicious', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_delicious',
				'type' => 'text',
			),
			array(
				'name' => __( 'Dribbble', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_dribbble',
				'type' => 'text',
			),
			array(
				'name' => __( 'Dropbox', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_dropbox',
				'type' => 'text',
			),
			array(
				'name' => __( 'Facebook', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_facebook',
				'type' => 'text',
			),
			array(
				'name' => __( 'Flickr', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_flickr',
				'type' => 'text',
			),
			array(
				'name' => __( 'Googleplus', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_googleplus',
				'type' => 'text',
			),
			array(
				'name' => __( 'Instagram', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_instagram',
				'type' => 'text',
			),
			array(
				'name' => __( 'Linkedin', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_linkedin',
				'type' => 'text',
			),
			array(
				'name' => __( 'Paypal', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_paypal',
				'type' => 'text',
			),
			array(
				'name' => __( 'Pinterest', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_pinterest',
				'type' => 'text',
			),
			array(
				'name' => __( 'Skype', 'tcsn_theme' ),
				'desc' => 'Give Skype Username.',
				'id'   => $prefix . 'member_skype',
				'type' => 'text',
			),
			array(
				'name' => __( 'Soundcloud', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_soundcloud',
				'type' => 'text',
			),
			array(
				'name' => __( 'Stumbleupon', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_stumbleupon',
				'type' => 'text',
			),
			array(
				'name' => __( 'Tumblr', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_tumblr',
				'type' => 'text',
			),
			array(
				'name' => __( 'Twitter', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_twitter',
				'type' => 'text',
			),
			array(
				'name' => __( 'Vimeo', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_vimeo',
				'type' => 'text',
			),
			array(
				'name' => __( 'Youtube', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_youtube',
				'type' => 'text',
			),
			array(
				'name' => __( 'Mail', 'tcsn_theme' ),
				'desc' => '',
				'id'   => $prefix . 'member_mail',
				'type' => 'text',
			),
		),
	);
	
	/**
	 * Meta box for portfolio post Info
	 */
	$meta_boxes['read_me_portfolio_metabox'] = array(
		'id'         => 'read_me_portfolio_metabox',
		'title'      => __( 'Read Me', 'tcsn_theme' ),
		'pages'      => array( 'tcsn_portfolio', ), // Post type
		'context'    => 'side',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
	 // 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name'    => __( '', 'tcsn_theme' ),
				'desc'    => __( 'Go through<br> - Theme Options > Portfolio <br>- Settings > Visual Composer<br><br>Refer Help Document for more info.', 'tcsn_theme' ),
				'id'      => $prefix . 'read_me',
				'type'    => 'title',
			),
		),
	);
	
	/**
	 * Meta box to select portfolio post type
	 */
	$meta_boxes['portfolio_metabox'] = array(
		'id'         => 'portfolio_metabox',
		'title'      => __( 'Portfolio Item Type', 'tcsn_theme' ),
		'pages'      => array( 'tcsn_portfolio', ), // Post type
		'context'    => 'side',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
	 // 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name'    => __( '', 'tcsn_theme' ),
				'id'      => $prefix . 'portfolio_type',
				'type'    => 'select',
				'options' => array(
                    'Image'   => __('Image', 'tcsn_theme'),
                    'Video'   => __('Video', 'tcsn_theme'),
					'Audio'   => __('Audio', 'tcsn_theme'),
					'Gallery' => __('Gallery', 'tcsn_theme'),
                ),
			),
		),
	);
	
	/**
	 * Meta box for video url input in portfolio post
	 */
	$meta_boxes['video_url_metabox'] = array(
		'id'         => 'video_url_metabox',
		'title'      => __( 'If - Video Post', 'tcsn_theme' ),
		'pages'      => array( 'tcsn_portfolio', ), // Post type
		'context'    => 'side',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
	 // 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name'    => __( '', 'tcsn_theme' ),
				'desc'    => __( 'Enter URL here. <br/>Video will be displayed on zoom.<br/><br/><strong>URL examples</strong><br/> Youtube - http://youtu.be/XSGBVzeBUbk <br/><br/>  Vimeo - http://vimeo.com/69228454', 'tcsn_theme' ),
				'id'      => $prefix . 'video_url',
				'type'    => 'text',
			),
		),
	);
	
	/**
	 * Meta box for zoom title
	 */
	$meta_boxes['zoom_title_metabox'] = array(
		'id'         => 'zoom_title_metabox',
		'title'      => __( 'If zoom on hover', 'tcsn_theme' ),
		'pages'      => array( 'tcsn_portfolio', ), // Post type
		'context'    => 'side',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
	 // 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name'    => __( '', 'tcsn_theme' ),
				'desc'    => __( 'Title to lightbox Image / video.', 'tcsn_theme' ),
				'id'      => $prefix . 'zoom_title',
				'type'    => 'text',
			),
		),
	);

	/**
	 *  Meta box for portfolio url input
	 */
	$meta_boxes['url_metabox'] = array(
		'id'         => 'url_metabox',
		'title'      => __( 'If link on hover : <br>External Link URL', 'tcsn_theme' ),
		'pages'      => array( 'tcsn_portfolio', ), // Post type
		'context'    => 'side',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
	 // 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
				array(
				'name' => __( '<br>Checkbox to enable external link <br><br> If unchecked, link will display portfolio details page. <br><br>', 'rwmb' ),
				 'id'  => $prefix . 'external_link',
				'type' => 'checkbox',
				'std'  => 0,
			),
            array(
                'name' => '',
                'id'   => $prefix . 'link_url',
                'type' => 'text',
                'size' => 27,
                'desc' => __('Tick the checkbox and give link here', 'rwmb')
            ),
		),
	);
	
	
	/**
	 * Meta boxes for audio / video embed code for portfolio details page
	 */
	$meta_boxes['portfolio-embed-metabox'] = array(
		'id'         => 'portfolio-embed-metabox',
		'title'      => __( 'If Video/ Audio Post - Embed Code :', 'tcsn_theme' ),
		'pages'      => array( 'tcsn_portfolio', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => false, // Show field names on the left
		'fields'     => array(
			array(
				'id'   	=> $prefix . 'pf_video_audio_embed',
				'type' 	=> 'textarea_code',
				'desc'	=> __( 'This will be displayed on portfolio item details page.', 'tcsn_theme' ),
			),
		),
	);
		
	// Add new metabox

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );


/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once (get_template_directory() . '/includes/meta-box/init.php'); 

}
