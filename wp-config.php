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

/**
 * Use MySQL or sqlite databases
 */
define('USE_MYSQL', false);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '1234');

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
define('AUTH_KEY',         '>P{&j6}-qWDLs#Kxz1ay5f83E.LL2`s|Rz+OGMqIOt0d3@|(&jggKg]!.lg{]>-4');
define('SECURE_AUTH_KEY',  'iwR=2jyb~{+XcS+bmGT%G]dY0/l9SX~XH$T@r2tm0,MD7^a;2#?.BuE(F$H00@8H');
define('LOGGED_IN_KEY',    'U|tWTUcZF^,ja?ODIA=O9tJD`SfNlGc9,wuGr<}HRqOBM%/B3g=qb8<XdtjYu_@J');
define('NONCE_KEY',        'CsM|V7mC_>akL>[.J:.1 F3/WWmW1js,9l!0/Rwl=KmwY TWeoEIz3XC0A/ti tD');
define('AUTH_SALT',        '~t0}HWyVCjfMx@lRz5/bWR:6-CJ6{0ueerFR1>]?vUUt02#+ttHg|Z2Qs2P=EUh1');
define('SECURE_AUTH_SALT', 'C)G>X%-sV:r5iC{z8|,mkk:.#C:wsn3pRtsG`P`!B1|]*.xC[)?mW4jR7dn5`[r2');
define('LOGGED_IN_SALT',   '#rH*`W!QrGtaXT4;b)G~_e|^YBDo!0,TD1MUX;2t(Z>NWwJ}6j0t?zs=`YqUyWlt');
define('NONCE_SALT',       'X=?:~+S7u,:hh<j:y,kfGO=]d!aL[[#6g)[pF7(KL<d$6-4w<] #6W16OMvM7H.I');

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
