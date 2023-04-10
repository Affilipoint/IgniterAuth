<?php
/**
 * Plugin Name: IgniterAuth
 * Plugin URI: https://affilipoint.com/plugins/
 * Description: Protects your website from the public and search engines with HTTP Basic Authentication.
 * Author: affilipoint.com
 * Author URI: https://affilipoint.com/
 * Text Domain: igniter-auth
 * Version: 1.0.0
 */

use IgniterAuth\AuthClass;

! defined( 'ABSPATH' ) ? exit : '';

if( ! defined( 'WP_ENVIRONMENT' ) )
{
    define( 'WP_ENVIRONMENT', 'development' );
}
define( 'IGNITER_AUTH_VERSION', '1.1.0' );
define( 'IGNITER_AUTH_PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'IGNITER_AUTH_PLUGIN_URL', plugin_dir_url(__FILE__) );

// Includes
include_once IGNITER_AUTH_PLUGIN_PATH . "/vendor/autoload.php";

$igniterAuth = new AuthClass();

// Actions
add_action( 'init', array( $igniterAuth, 'lock' ) );
add_action( 'admin_menu', array( $igniterAuth, 'settingsMenu' ) );
add_action( 'admin_notices', array( $igniterAuth, 'adminNoticeWarning' ), 1 );
add_action('wp_head', array( $igniterAuth, 'noIndex') );

// Filters
add_filter( 'plugin_action_links_igniter-auth/igniter-auth.php', array($igniterAuth, 'settingsLink') );

// Hooks