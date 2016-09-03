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
define('DB_NAME', 'alday');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'proline55');

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
define('AUTH_KEY',         'aafayhqtg14wsl4rwvepxevgueshble8qevwddxdc73mipz8yn3p5wn0i9ivozzn');
define('SECURE_AUTH_KEY',  't8ntmukejcuoqpxngl8nuxrbrhgqr6v9ff7hdiczkknisudymzkri0kamzziyulr');
define('LOGGED_IN_KEY',    'mdl9wmyn7ryrufq6ez4qubjiq8kt1ibnm6jinovltcja1tdsncamlv7ogveiov48');
define('NONCE_KEY',        '4zjhui8pcb1vy97qj6duvu9oakolzokzaujuzkivj736oq7xwzphentuluuwcrhc');
define('AUTH_SALT',        'b2h0kzsnmtbi9dcyehhf784unhbdu9udxfg43z61b5abvgtgyomzo3xbkfyc0znl');
define('SECURE_AUTH_SALT', 'anmlo1es80qvprhbd5ac9mdvqtgx9igbvww62fmibtv2iae19pgqzehmepmfjgyv');
define('LOGGED_IN_SALT',   '5u49zcszebhykgythgs0cpfgpjly1tr3ggnan6hgxw8awws1bhldjzcny1imqlyv');
define('NONCE_SALT',       'ymzmu7v39aadwl0kcc6gwrcpywoexyfw9zx5njduxhddpt3koyujt7lbmedwaag2');

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
