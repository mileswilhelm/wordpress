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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'easton11_vericorstaging' );

/** MySQL database username */
define( 'DB_USER', 'easton11_imh' );

/** MySQL database password */
define( 'DB_PASSWORD', 'dr#9SFX5B7' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'DdZsSx8fKOTTV3cYo19laFdoIrzdCvAcb4iBJYs53mINHmVy6Vdj/fes91ZI7ClN4rnfpS+5cK12t2HyU/j9eQ==');
define('SECURE_AUTH_KEY',  '4mJ7L1lKLZn3Jzk5o7fgPOX3GmHBVMo1yy70vWh9Ea8wKfXzPDJ0osdmjOj11PBj151mANeqKOPqGetc3enz+w==');
define('LOGGED_IN_KEY',    'vtbFn9DgbexMW66AM9obCMTu5FOksFO4poHFfxgu3il8oVzuIkwUS/1A6V0VhAjZXY8pOVzQihSfBe2jXG8m5g==');
define('NONCE_KEY',        'PyBd/5gOMoA/+EViaZDJrZ3sP1sS5ZC6cJsntBhM0P0CIuqZdAbP5SqD5qSBClLZTWOAm45Inxwbi5CyNvUclA==');
define('AUTH_SALT',        'R23H1aLv5EgfiX7fIyMjAagG4o4+0FlvW5YBTGwMqApic54wX8tAztPN44dXNZkbcRaOn+QVofgRXeW+RLVS1w==');
define('SECURE_AUTH_SALT', 'P+8ft7z4oCjTzvc1zUsNdlAMjp2+9joQPIQEBSS76M0o9y7u971L9OXtazj4XrXe7C29BHJzeNM/AZvU0P/mxw==');
define('LOGGED_IN_SALT',   '/6BGgIWAzflms/tgTbfj82nxD65qF5e/aaw8BVQ52SBEfWP1c5cY/J0cVUvlinjJ4ekS/AtHsmz2r9vMg4zobg==');
define('NONCE_SALT',       'OtzoS1/mPukYGBmUWkS9iyZCxxh9LzOrS29cgMIGtGyZ9tXxzpcsfArtWs6gz45L72ga40/Ol4OEarOcjAVrTQ==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';





/* Inserted by Local by Flywheel. See: http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy */
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
	$_SERVER['HTTPS'] = 'on';
}


/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
