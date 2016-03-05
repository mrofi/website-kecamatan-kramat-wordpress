<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //

if (getenv('OPENSHIFT_MYSQL_DB_HOST') !== false)
{
    /** The name of the database for WordPress */
    define('DB_NAME', 'tegalweb');

    /** MySQL database username */
    define('DB_USER', getenv('OPENSHIFT_MYSQL_DB_USERNAME'));

    /** MySQL database password */
    define('DB_PASSWORD', getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));

    /** MySQL hostname */
    define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST').':'.getenv('OPENSHIFT_MYSQL_DB_PORT'));

    /** Database Charset to use in creating database tables. */
    define('DB_CHARSET', 'utf8');

    /** The Database Collate type. Don't change this if in doubt. */
    define('DB_COLLATE', '');
}
else
{
    /** The name of the database for WordPress */
    define('DB_NAME', 'tegalweb');

    /** MySQL database username */
    define('DB_USER', 'root');

    /** MySQL database password */
    define('DB_PASSWORD', '');

    /** MySQL hostname */
    define('DB_HOST', 'localhost');

    /** Database Charset to use in creating database tables. */
    define('DB_CHARSET', 'utf8');

    /** The Database Collate type. Don't change this if in doubt. */
    define('DB_COLLATE', '');
}


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'UR T,vNjw7;I5ZTm-5*Bbh%Xz9w+{N{,]+~=VtgUL1Zm$[+bVUoN+8qjO/A[&)zZ');
define('SECURE_AUTH_KEY',  'v1**|WpwRS!%A]Q.7m7~g,#4c6aV@)Mwc8W-^W?3BZF$;OG1J%#k5{U|,?d[<mTJ');
define('LOGGED_IN_KEY',    'JmcM372-XPz5pj<}|(4BCFs4*Ko6RQ3$BE^#;GayS1tLD0<h!ccn@->SWW1<ArAe');
define('NONCE_KEY',        'VK8-}#bE-AQ76<.O|6$0i|HoAUY S^<C4~]J6^ A^vxxgBs}bM`f}!+=F>hqjU;*');
define('AUTH_SALT',        'e-Lf)SY%zZ$=GICx1&M:q21yeL.Hj!aD+,@^+<xzUY-B_=n!cX8n8B8y-t2alz@|');
define('SECURE_AUTH_SALT', '-z[SSwCN8Sn#+B[H|-aVFhu5>pY>{n<@%MbY13qie^H<=>%q+!4L0%#U6S+@gA7=');
define('LOGGED_IN_SALT',   '-$C-Ee8|>t}M7WY1GN=Ae!;PVW@u-tQ@em.]NG+DI)RK>}UV+7/uI48Yb1G8w!(G');
define('NONCE_SALT',       '~9KvQ!--6`q--C-V0Q-4%{dx)3uIBkb:IZ&d/{uX_5|kvvB,SnOWGZ`PaIIsv9#|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'tegal_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
define('WP_POST_REVISIONS', 5);
define( 'WP_AUTO_UPDATE_CORE', false );


/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'www-hclient3.rhcloud.com');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
