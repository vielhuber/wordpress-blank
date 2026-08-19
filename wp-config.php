<?php
if( @$_SERVER['SERVER_ADMIN'] === '%MAIL_USER_1%' || @$_SERVER['NAME'] === '%ID_USER_1%' )
{
    define('DB_NAME', '%DB_NAME_1%');
    define('DB_USER', '%DB_USER_1%');
    define('DB_PASSWORD', '%DB_PASSWORD_1%');
    define('DB_HOST', '%DB_HOST_1%');
    define('WP_DEBUG', true);
    define('WP_DEBUG_LOG', false); // add true if you want to log to /wp-content/debug.log
    define('WP_DEBUG_DISPLAY', true);    
    define('DIEONDBERROR', true);
    define('DISABLE_WP_CRON', true); // disable wp-cron (only locally)
}
elseif( @$_SERVER['SERVER_ADMIN'] === '%MAIL_USER_2%' )
{
    define('DB_NAME', '%DB_NAME_2%');
    define('DB_USER', '%DB_USER_2%');
    define('DB_PASSWORD', '%DB_PASSWORD_2%');
    define('DB_HOST', '%DB_HOST_2%');
    define('WP_DEBUG', true);
    define('WP_DEBUG_LOG', false);
    define('WP_DEBUG_DISPLAY', true);    
    define('DIEONDBERROR', true);
    define('DISABLE_WP_CRON', true);
}
elseif( @$_SERVER['SERVER_ADMIN'] === '%MAIL_USER_3%' )
{
    define('DB_NAME', '%DB_NAME_3%');
    define('DB_USER', '%DB_USER_3%');
    define('DB_PASSWORD', '%DB_PASSWORD_3%');
    define('DB_HOST', '%DB_HOST_3%');
    define('WP_DEBUG', true);
    define('WP_DEBUG_LOG', false);
    define('WP_DEBUG_DISPLAY', true);    
    define('DIEONDBERROR', true);
    define('DISABLE_WP_CRON', true);
}
elseif( strpos($_SERVER['HTTP_HOST'] ?? '', 'rebuhleiv.xyz') !== false )
{
    define('DB_NAME', '%DB_NAME_TESTING%');
    define('DB_USER', '%DB_USER_TESTING%');
    define('DB_PASSWORD', '%DB_PASSWORD_TESTING%');
    define('DB_HOST', '%DB_HOST_TESTING%');
    define('WP_DEBUG', false);
    define('WP_DEBUG_LOG', false);
    define('WP_DEBUG_DISPLAY', false);
    define('DIEONDBERROR', false);
}
else
{
    define('DB_NAME', '%DB_NAME_PRODUCTION%');
    define('DB_USER', '%DB_USER_PRODUCTION%');
    define('DB_PASSWORD', '%DB_PASSWORD_PRODUCTION%');
    define('DB_HOST', 'localhost');
    define('WP_DEBUG', false);
    define('WP_DEBUG_LOG', false);
    define('WP_DEBUG_DISPLAY', false);
    define('DIEONDBERROR', false);
    // increase security on production and force httponly and secure on all php session cookies
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', 1);
    // configure sentry.io php/js error monitoring plugin
    define( 'WP_SENTRY_PHP_DSN', 'https://********************************@********.ingest.sentry.io/*******' );
    define( 'WP_SENTRY_BROWSER_DSN', 'https://********************************@********.ingest.sentry.io/*******' );
    define( 'WP_SENTRY_ENV', str_replace('www.','',$_SERVER['HTTP_HOST']) );
    define( 'WP_SENTRY_ERROR_TYPES', E_ALL & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED );
}

define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

// Generate unique values: https://api.wordpress.org/secret-key/1.1/salt/
define( 'AUTH_KEY',         'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' );
define( 'SECURE_AUTH_KEY',  'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' );
define( 'LOGGED_IN_KEY',    'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' );
define( 'NONCE_KEY',        'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' );
define( 'AUTH_SALT',        'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' );
define( 'SECURE_AUTH_SALT', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' );
define( 'LOGGED_IN_SALT',   'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' );
define( 'NONCE_SALT',       'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' );

// limit post revisions to 10 (because this leads always to memory limit bottlenecks on big pages)
define('WP_POST_REVISIONS', 10);

$table_prefix = 'custom_';

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
