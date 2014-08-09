<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'req');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '1> +{H;39LH|%:jnC_xI@XdJ?F7(b[zdhn(R^tdo!c0,~&^@;lEM|vkKLX)OPPK~');
define('SECURE_AUTH_KEY',  'v|#UKz!]?1dmYG-O&+ SN.ps[U46G~gO0J:^4}T?aXc_}y2t_LSW:})phbIVxNr,');
define('LOGGED_IN_KEY',    'zMs;i~i<v-o&^40tY@|0z]~+Fsg|LW5OkBpW]Q}1B{[PdC3;2hTngHN:v;ACf5(3');
define('NONCE_KEY',        '&pHwY,?yqj8BlpByUpY}/MIzs<%dki>_:-_UzlCmxoB-^}HijE}R^fD(ZdS%b1m/');
define('AUTH_SALT',        'BJ+PD6Qy t0amm+-/UH4+Ua+l:;K0N][ZGe,IyU~)*-~J,;KgDV3ADs_JuKzWf0X');
define('SECURE_AUTH_SALT', 's;t}M9)w6Y}ri|Nwju0B2K%dd<}9WE@2:^+nE5Fw=%]J>-B-aM.Nbmw_|!`m+TIE');
define('LOGGED_IN_SALT',   'g`&rGc<Gwnph$pEtn!HHuO61RGNYMKPBQ)qnKhuzU743!koBV2`RWv7Pp$e{|4&F');
define('NONCE_SALT',       'pe{Io[ %2/oG1xC,xuYEJ?s]u&>DO6F#Z|Z-c()kOVYv3XKf|pSO1Ew+J,Ysdxs<');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
