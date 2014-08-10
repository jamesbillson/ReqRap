<?php
/**
 * TCSN QZ Shortcodes
 *
 * @package   TCSN_QZ_Shortcodes
 * @author    Tansh
 * @license   GPL-2.0+
 * @copyright 2013 Tansh
 */

/**
 * Define constants used by the plugin.
 *
 */
 
/* Set constant path to the plugin directory */
define( 'TCSNSC_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

/* Set the constant path to the plugin directory URI */
define( 'TCSNSC_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

/**
 * TCSN_QZ_Shortcodes class.
 *
 * @package TCSN_QZ_Shortcodes
 * @author  Tansh 
 *
 */
 
class TCSN_QZ_Shortcodes {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 */
	protected $version = '1.0.0';

	/**
	 * Unique identifier for your plugin.
	 *
	 * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
	 * match the Text Domain file header in the main plugin file.
	 *
	 * @since   1.0.0
	 */
	protected $plugin_slug = 'tcsnqz-shortcodes';

	/**
	 * Instance of this class.
	 *
     * @since   1.0.0
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since   1.0.0
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin
	 *
	 * @since   1.0.0
	 */
	private function __construct() {
		
		// Make shortcodes available
		require_once( TCSNSC_DIR . 'includes/shortcodes.php' );
	
		// init process for button control
		add_action( 'init', array( &$this, 'init' ) );
	 	   
		// Add scripts and styles
		add_action( 'wp_enqueue_scripts', array( &$this, 'tcsnsc_add_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( &$this, 'tcsnsc_add_styles' ) );
		
		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since   1.0.0
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since   1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	}

	/**
	 * Registers TinyMCE rich editor buttons
	 *
	 * @since   1.0.0
	 */
	function init() {
		// Don't bother doing this stuff if the current user lacks permissions
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
	 
		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true') {
			// filter the tinyMCE buttons and add our own
			add_filter( 'mce_external_plugins', array( &$this, 'add_tcsn_tinymce_plugin' ) );
			add_filter( 'mce_buttons_3', array( &$this, 'register_tcsn_tinymce_buttons' ) );
		}
	}

	/**
	 * Defins TinyMCE rich editor js plugin
	 *
	 * @since   1.0.0
	 */
	 function add_tcsn_tinymce_plugin( $plugin_array ) {
		$plugin_array['tcsnshortcodes'] =  TCSNSC_URI . 'includes/tinymce.js';
		return $plugin_array;
	}

	/**
	 * Register TinyMCE rich editor buttons
	 *
	 * @since   1.0.0
	 */
	function register_tcsn_tinymce_buttons( $buttons ) {
		array_push( $buttons,"tcsnbuttons","tcsngeneral","tcsntypo");
		return $buttons; 
	}

	/**
	 *  Enqueue Javascript files
	 *
	 * @since   1.0.0
     */
	function tcsnsc_add_scripts() { 
	
	}

	/**
     * Enqueue Style sheets
	 *
	 * @since   1.0.0
     */
	function tcsnsc_add_styles() { // Enable this and write styles in this (sc-custom.css) if using outside theme.
		// wp_enqueue_style( 'cpt-custom-style', TCSNSC_URI . 'css/sc-custom.css' );
		
	}
	
} // class TCSN_QZ_Shortcodes






