<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db_huya' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'J_>4sC4*c40d//eZh1eR^09TlbZhPq15{9~HUQni&R6C7#^$KRwh{PY Bm 89n}l' );
define( 'SECURE_AUTH_KEY',  'UXY;3QCbr`bwhqmJT+2#q3k>lzyR:rz[?]%jC$p8{g1VceKm!hzy2L/WTatDZ+Ru' );
define( 'LOGGED_IN_KEY',    'hXgX>d]17leidA4|lr)>SK/>btxU,VJ7M=QRNl<R}vQs-HN;E^UmjiTP#$I#?~48' );
define( 'NONCE_KEY',        '52.=00.@0dp V,*J1TC^Re59i7-G(@lxnt(xE:pwsnnq~cW+mKWu/&/zy.HYqPG*' );
define( 'AUTH_SALT',        'BX&aNH*NS,Qx~[7/ls%6S.${ %eTkWf^2~j,jfe&+A`!8VnL 6;?^:FFkP;#t~Hn' );
define( 'SECURE_AUTH_SALT', '<:+sq%3[JR/) FBr(7W~ch=0Mx} v<J{s`yK>h?&1i|;w5d]JR2rbepZjA/rC>!2' );
define( 'LOGGED_IN_SALT',   '1Yol#(c?OgA_eced_Xr48Vh_`>6Pg7g9Xb_AZE[Kk++~/*WkA?XB80o<?ku2O&=T' );
define( 'NONCE_SALT',       'H8/$8IyR4HKmmuHH~5 ,FsY8L|+{GV(p[^*GfbBS<SrzDSDJ|!~0xRd=`/UL e#}' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
