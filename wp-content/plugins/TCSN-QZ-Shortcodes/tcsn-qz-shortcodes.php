<?php
/**
 * TCSN QZ Shortcodes
 *
 * @package   TCSN_QZ_Shortcodes
 * @author    Tansh
 * @license   GPL-2.0+
 * @copyright 2014. Tansh
 *
 * @wordpress-plugin
 * Plugin Name: TCSN QZ Shortcodes
 * Description: Creates Shortcodes
 * Version:     1.0.0
 * Author:      Tansh
 * Author URI:  http://themeforest.net/user/tansh
 * Text Domain: tcsnqz-shortcodes
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /lang
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once( plugin_dir_path( __FILE__ ) . 'class-tcsn-qz-shortcodes.php' );
TCSN_QZ_Shortcodes::get_instance();