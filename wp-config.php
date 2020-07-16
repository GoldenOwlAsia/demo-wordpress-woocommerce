<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'demowordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'osxmysql' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'MZyBw_>fuI]5,ToRuZRJxG8]4=iPZBx}xkEd h@c$>,(+cyx!E-H93*kd]^)Z~5]');
define('SECURE_AUTH_KEY',  'UAThq|<~$a<(u%){= |$10C$[L*}H|Q P]U7Zeu~0&-/DxTIsrFj,YB^z!(u5!@#');
define('LOGGED_IN_KEY',    '1lcU:*bNx37 %CAPv]Y[ad<-.9&E(<g-!Ea44Lv38.rD`hsLR/Pif}`vIC7%KJ+n');
define('NONCE_KEY',        '#~D#s<?,6(|n%/Qb*%FRl gUTFF+uM8K2G+1PJr*3TiRU[X+1U|V3{!r%w0_{qQT');
define('AUTH_SALT',        '?$t=;k63R-|*v<NX>LFP?haa{Qy-XIKD{@0PodNV7a88mEZl.UL9%!5NWX7F_I8 ');
define('SECURE_AUTH_SALT', 'a@`}qj@!*?]`hU)[|AL PDkD)1_Mw|AtK1m*W2)O2~0-rX?4[=`}u<:67?=w+,?Y');
define('LOGGED_IN_SALT',   '!+?B@:NhStvVzUBBsKf(Sob;m%NDU)ijyVYiypL#kX-y,%qA{.Yh)sj=0LIg~a(>');
define('NONCE_SALT',       '2&;A-tCN|c;nY@#h.7l1r,f}g #(DT9m{cPLx,QuzcB!KC;0|-+G]Ug:MbxUsmi4');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/**
 * WordPress Install plugins without provide FTP
 */
define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
