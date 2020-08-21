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

define( 'DB_NAME', 'stagingp_demo_shopy' );



/** MySQL database username */

define( 'DB_USER', 'stagingp_demo_shopy' );



/** MySQL database password */

define( 'DB_PASSWORD', 'PCqP]bCDHd)&' );



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

define( 'AUTH_KEY',         '7$BI4SIfBpbh;NTJ]EC*Tq,vDopN;nBLCYa?SiX X@=Q|kQIM1I|WKzafA`Rco ]' );

define( 'SECURE_AUTH_KEY',  'b[=Y%Ybg#G7J<1 AuT7VKIE`W>$pJ{x,QU-J);RJCH=8f HPB1zsN9n^vrNK:2[-' );

define( 'LOGGED_IN_KEY',    'DKFVv&%5=HzOAxr:A8aaF}{1|<=K3WnPHo[Y4aGdmp[Y1cU3qjY^oSezm|1:I]qh' );

define( 'NONCE_KEY',        '=aoP?Q>Cgr`}/,Egy,hXx*c&1+7p[fY$c[)77/lDZ4@$j1=[?M?n>MYKX61LcS%R' );

define( 'AUTH_SALT',        '( gdV)y9P>xUk2iOckRO)e?eQ~VzrUAY1f,l* Q%*xl19,Y<M8tilHQ{6zYcuYJ4' );

define( 'SECURE_AUTH_SALT', '5?4tt7Lw4P|go!7MY(T$>^~N$u/XWpx`>6tHw@f~/^pY$*=5y<yN,(1 G@sJ*{Rz' );

define( 'LOGGED_IN_SALT',   '^R7?2C^P.gO=GBRC7S0I!|vA_v:K|EtP1FVDWzBjK/q`^kW#ORB@xg|2=a;_l>=I' );

define( 'NONCE_SALT',       '0aCO`btBg$5e%+.u{|su84)-yv8qv90PAYh0(=KWMX7]IREZ9,5j1oUBR>7PSP7y' );



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

