<?php
/*
Plugin Name: Captain Favicon
Plugin URI: http://captaintheme.com/plugins/favicon/
Description: The easiest way to add a Favicon to your site.
Author: Captain Theme
Author URI: http://captaintheme.com
Version: 1.1
Text Domain: ctfavicon
License: GNU GPL V2
*/


/*
|--------------------------------------------------------------------------
| CONSTANTS
|--------------------------------------------------------------------------
*/

// Plugin Folder Path
if( !defined( 'CTFAVICON_PLUGIN_DIR' ) ) {
	define( 'CTFAVICON_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}


/*
|--------------------------------------------------------------------------
| INCLUDES
|--------------------------------------------------------------------------
*/

// Register Some Settings
include_once( CTFAVICON_PLUGIN_DIR . 'includes/settings.php' );

// Use Uploaded Favicon
include_once( CTFAVICON_PLUGIN_DIR . 'includes/usage.php' );


/*
|--------------------------------------------------------------------------
| I18N - LOCALIZATION
|--------------------------------------------------------------------------
*/

load_plugin_textdomain( 'ctfavicon', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );


/*
|--------------------------------------------------------------------------
| OTHER-FUNCTIONS
|--------------------------------------------------------------------------
*/

/*****
 * Add 'Settings' Link to Plugins Page
**/

function ctfavicon_settings_link( $links, $file ) {
	static $this_plugin;
	
	if ( !$this_plugin ) $this_plugin = plugin_basename(__FILE__);
 
	if ( $file == $this_plugin ) {
		$settings_link = '<a href="options-general.php?page=ctfavicon-settings">' . __( "Settings", "eddslider" ) . '</a>';
		array_unshift( $links, $settings_link );
	}
	
	return $links;
}
add_filter( 'plugin_action_links', 'ctfavicon_settings_link', 10, 2 );