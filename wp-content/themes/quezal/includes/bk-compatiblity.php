<?php
/**
 * Back compatibility
 *
 * Prevents theme from running on WordPress versions prior to 3.6,
 * as theme relies on some new functions and markup changes introduced in 3.6.
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 *
 */

/**
 * Prevent switching to theme on WordPress versions prior to 3.6. 
 * Switches to the default theme.
 *
 */
function tcsn_theme_switch() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'tcsn_wp_upgrade_notice' );
}
add_action( 'after_switch_theme', 'tcsn_theme_switch' );

/**
 * Prints an update nag after an unsuccessful attempt to 
 * switch to theme on WordPress versions prior to 3.6.
 *
 */
function tcsn_wp_upgrade_notice() {
	$message = sprintf( __( 'Theme requires at least WordPress version 3.6. You have version %s. Please upgrade and try again.', 'tcsn_theme' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Theme Preview loading on WordPress versions prior to 3.6.
 *
 */
function tcsn_theme_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Theme requires at least WordPress version 3.6. You have version %s. Please upgrade and try again.', 'tcsn_theme' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'tcsn_theme_preview' );