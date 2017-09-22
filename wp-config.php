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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'restaurant');

/** MySQL database username */
define('DB_USER', 'stevenquinn');

/** MySQL database password */
define('DB_PASSWORD', 'stevenquinn');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'c/l)6TS]W&B67%+`_f5-[2s/WH`zG!N~>C>h1kEo8XI7;^yQ> sm 1P2ROG0W/^i');
define('SECURE_AUTH_KEY',  'vUkV(r3NlZR} /o,j]X2~#]pb5]:3<v?U]R`=Dt#D0kRM)BJ{s^.lv>:!iCybaZ{');
define('LOGGED_IN_KEY',    '3YNU8S`k/6[t.Iz+7k{CRxuA)LqIv,_EDndW5jT*ei]Uu/jx*8,RK6,a/yn]]mZ6');
define('NONCE_KEY',        '-~5sTSE[xx@n/+!-DZF434NMS%VPgKD(%Ws7~7|vGqFsL*s=u-0$ks<#/LzZz=}N');
define('AUTH_SALT',        'KcK#vWCONOx4x/tK5`J0gkDK_?$Ky`$eR1}4uj*]`._Y&aU|&`3zkI<J5v;LikbO');
define('SECURE_AUTH_SALT', 'q:W?X|,W8q}K@Cn`zEO2ioK&CvMtUr-dl[O a{hy{WtA.a0$n@=v,kMFdF.16r_b');
define('LOGGED_IN_SALT',   '8o9Y)-N?a`84We?5&Ghu=I2CWacnF,9Uv: K#`kt5h/5OFmoCw5RW|0`Wtrr*PG<');
define('NONCE_SALT',       'Ms9Hh)6O7j6da%A{AL@Ks:[MN,)lww$$i2?UarI=Re8fEUE3z~<bsa]1!}^%H~Lg');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
