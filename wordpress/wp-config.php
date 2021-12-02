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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'e;m]7nUsLir7>y%iWG3pv<^+5i$:qt[M&Ahy>kfvYW5MDB1Qon5vNcN^sCW6Q*zI' );
define( 'SECURE_AUTH_KEY',  'SnEEb,qx>=S>^T@iRm``8PYc%ETlTCE>m/U%t_w/.4C|i<o_!R<0+xfn/Mk}6b8q' );
define( 'LOGGED_IN_KEY',    '/}ZKZ/@n!Gq|o`d;Dn(QjNEyu#mi=,vM&72/PR#{#x:mvs[aZo(>iPwIV?bL]fIu' );
define( 'NONCE_KEY',        'ND]m&7l0%s6AZwALH*^H`ZMS/}2F2Vss<}5;iCll{#ih;[l+<H%5j](Y>]VPQSD[' );
define( 'AUTH_SALT',        'f}Y{Gw$F< lsAAy8f:xU:XagXyD/iIWdMTFEJ*6,/MPGTTkSP<V^~XKz&RQuY0lS' );
define( 'SECURE_AUTH_SALT', 'B~yD^m`51gmKPk:hz*X~4I*5p8OFv&,f3*`@i!_G&,R&7Wuzjk3CVEH%``<af^cl' );
define( 'LOGGED_IN_SALT',   '_6d8JZ8$n/N=]J+byhyxpQO5N}{Ysz*u%l^L+%uA@xV04kzMV=r`sJ]ZtTZaLs[O' );
define( 'NONCE_SALT',       'q]Q<dXHr7zywNMH* +PP^>B@9fRuEdw<Ob%:]}cq_^3SkFcd*0P?L]k0Ckvc%6$X' );

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
