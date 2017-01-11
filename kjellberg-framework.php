<?php
/**
* @kjellberg
* Plugin Name:	Kjellberg Framework
* Plugin URI:	https://www.rasmuskjellberg.se
* Description:	Kjellberg Framework for easier Wordpress plugin development
* Version:		0.0.1
* Author:		Rasmus Kjellberg
* Author URI:	https://www.rasmuskjellberg.se
*/

define( 'KJBRGFRMWRK_VERSION',  '0.0.1' );
define( 'KJBRGFRMWRK_URL',  plugin_dir_url( __FILE__ ) );
define( 'KJBRGFRMWRK_DIR',  plugin_dir_path( __FILE__ ) );

require_once( KJBRGFRMWRK_DIR . 'lib/class-tgm-plugin-activation.php' );
require_once( KJBRGFRMWRK_DIR . 'src/posttype.php' );
require_once( KJBRGFRMWRK_DIR . 'src/require_plugin.php' );

/**
 * A placeholder hook to tell other plugins that Kjellberg Framework has been loaded.
*/
add_action( 'plugins_loaded', 'register_kjellberg_framework4132' );

function register_kjellberg_framework4132() {
	do_action( 'kframework_loaded' );
}

