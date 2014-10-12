<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
error_reporting(E_ALL);
ini_set('display_errors',1);
define('WP_USE_THEMES', true);
/*require_once(dirname(__FILE__).'/../yii/framework/yii.php');
Yii::$enableIncludePath = false;
Yii::createWebApplication(dirname(__FILE__).'/req/protected/config/main.php');*/
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
/** Loads the WordPress Environment and Template */

