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
define('DB_NAME', 'oma_local');

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
define('AUTH_KEY',         'ea,DN+(2J7:449mXPJs+jfEI5t6aOZYl(%76#~mdg+`>cIa$E=n~.BmcF-6!c3KH');
define('SECURE_AUTH_KEY',  ',zai9`$5X:1NV+F2bx;CpR3FF?8aKX7,^)L ;n4H@qR)Ci@VhFDomB|~8&C5vNYI');
define('LOGGED_IN_KEY',    'TIO7&M3.|B}(AbRF2zx&:$3#pr/MU@*%35j,s^,KJ>`QKMm>eYSx$B-@Bl|9Lz)S');
define('NONCE_KEY',        '1/-,AV3foROReH[;7$Pi5uYsbPlDfsRN_ZF!P}P]L5Lq^t)ke7Q4buGB<uKHgL!R');
define('AUTH_SALT',        'Uayqw#Vm t9PuZCw9E:4`?9m+VAnXiQU!JaI{>:-HTR{$TtZ*?PM6r&Uk@p{<Gyv');
define('SECURE_AUTH_SALT', ':XeEtHE7G6kWLmi, .<#Y*t&$yOB*Ku.E&i*u3sA$6n3MSur5zx.+eg77?w&.w)9');
define('LOGGED_IN_SALT',   'Pvb[bRS<rS_.* hvpPp`QS5n)Bfw6x9<pU p+bcHC3<dtylZ}J~&jBtb8Pxe_ir`');
define('NONCE_SALT',       'Xk9F#SeMB-KivIo#-cf9@?Cq8?D%YN|)<vR/:|S_w{pM-#dzocnc1c;H7&=37nw`');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'amo_';

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
