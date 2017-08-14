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
$host=getenv('MYSQL_SERVICE_HOST');
$user=getenv('MYSQL_USER');
$password=getenv('MYSQL_PASSWORD');
$access_key_id=getenv('AWS_ACCESS_KEY_ID');
$access_secret=getenv('AWS_ACCESS_SECRET_KEY');



define('DB_NAME', 'imbera2017');

m/** MySQL database username */
define('DB_USER', $user);

/** MySQL database password */
define('DB_PASSWORD', $password);

/** MySQL hostname */
define('DB_HOST', $host);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');


/** get amazon credentials from the env */
define( 'DBI_AWS_ACCESS_KEY_ID', $access_key_id );
define( 'DBI_AWS_SECRET_ACCESS_KEY', $access_secret );

	


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'pSzcaurk+=A^Cy>&$j8L-D~FVn}SHgAO:I|d Z%u>0>Yt:3n ub%%/@]4z=]rhji');
define('SECURE_AUTH_KEY',  'I@q&B!_1B7mq&|ONrh{?^yFqo{u-Bcxm9AD(=(g%k!Zlj@Cl],O.(F+Ll0Ps{p]G');
define('LOGGED_IN_KEY',    'L~Ew^++2L.of:JS&8nB4*VSU;i;pd1w+_PR[MjBB!r=6W(VVhgvc%%0fzE:U{X@i');
define('NONCE_KEY',        '^<TT$Yp_aq$0il:(g3C4ZGdc6V`4vg3aL`R45OW/r@&6cOaq5@;k_/zwz3F8Oy;S');
define('AUTH_SALT',        '*X+_gM )F s?C%!sSm>H#{R%Dc?>J>[ahXRvTz-XpO;Hc^d=W 4![L]fJS9r<;Ys');
define('SECURE_AUTH_SALT', 'XW5Z1)P}/ilewS.vYz`wobn#_9T!IPS1_l;qaLRVlWBa6xIwo-lATl)-c6+[_ZD_');
define('LOGGED_IN_SALT',   '4DO;)Rhbk*z_;)ABta#F-&QKlQiOX.)HCUE;P-.Nc?YrgZ,l$[.v*Bfpd.n{M:uP');
define('NONCE_SALT',       '{];kZ!/o)Xr`8%QiyjNR(VV}s]*4LwK9* Lu):W@y93AnPjOp]l9 [@$/p4:hE}:');

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
