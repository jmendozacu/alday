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
define('DB_NAME', 'rideal5_wp483');

/** MySQL database username */
define('DB_USER', 'rideal5_wp483');

/** MySQL database password */
define('DB_PASSWORD', 'SP975@Kx@4');

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
define('AUTH_KEY',         'r8mmmh3332b69emf7vfdb0kgbtajt84bbohmwybc77j9bhpffflaoispnsp7suvk');
define('SECURE_AUTH_KEY',  'cntqzyqwpqifyj2xys643dfifkzi55fmtlxzcppnsqbiamaq7uwtwqy6j16sxgxx');
define('LOGGED_IN_KEY',    'buunzhfx8xowwhcv3fo4ez2uggteo9zith0ren2zzsp2fqbpdcvrboojsuw8cmlz');
define('NONCE_KEY',        '2gh4aqc7zstwiompbjqiyx5wmvkdvylyvza5exgsm0udw4keyo45wgxd2m9wipvc');
define('AUTH_SALT',        'bhhqibxpb6jpj82rzwwjysyc0ur3ahlyeuhjrobgxepxi9w6hsbbftdofdj2v1nk');
define('SECURE_AUTH_SALT', 'm2c4j5p3ervo2jgvpn5kxjqtg4xbwaclpmiizazh0ozf5jppzvilet5qrkxggdud');
define('LOGGED_IN_SALT',   'npawgl4aj8fnhizemfr9qvdzap5fpexmzggrbwsjow7hqucy8mu2wrmhgeiy2nla');
define('NONCE_SALT',       'jqhr6jfa0i4n0kp4bxzuaddl35wctjxbkehgvtxogvygsro6gsxsxaozdsx6gmvg');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
