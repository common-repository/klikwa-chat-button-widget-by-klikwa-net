<?php
/**
 * @package KlikWAPlugin
 * @version 1.0.0
 */
/*
Plugin Name: KlikWA Chat Button Widget by KlikWA.net
Plugin URI: https://www.klikwa.net/free-whatsapp-button-widget
Description: Need a Floating Whatsapp Button on Website that link to your number? Enable your visitor to Click and start Chat with your Business on their Phone (open Whatapp web in Desktop). klikWA Whatsapp link Button/Widget on Website for Wordpress is for You.
Author: KlikWA
Version: 1.0.0
Author URI: http://https://www.klikwa.net/
License : GPLv2 or later
*/

/*
Copyright 2011-2021 by the contributors

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

This program incorporates work covered by the following copyright and
permission notices:

  b2 is (c) 2001, 2002 Michel Valdrighi - https://cafelog.com

  Wherever third party code has been used, credit has been given in the code's
  comments.

  b2 is released under the GPL

and

  WordPress - Web publishing software

  Copyright 2003-2010 by the contributors
*/

use KWAP_Inc\Base\Activate;
use KWAP_Inc\Base\Deactivate;
use KWAP_Inc\Controllers\BaseController;

// This is for exit code, if there is unwanted connection that does not go through wordpress
if (! defined( 'ABSPATH' )){
	die;
}

// This is the composer autoload enabler
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_klik_wa_plugin() {
    Activate::activate();
    Activate::klikWACreateTable();
}
register_activation_hook( __FILE__, 'activate_klik_wa_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_klik_wa_plugin() {
	Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_klik_wa_plugin' );

// UNINTALL HOOK WILL BE INDEXED BY WORDPRESS ON ITS OWN , 
// THEY WILL SEARCH FOR (uninstall.php).
// NO NEED TO CONNECT IT ON THE MAIN PLUGIN FILE (THIS FILE)

/**
 * Initialize all the core classes of the plugin
 */
if (class_exists( 'KWAP_Inc\\Init' ))
{
  KWAP_Inc\Init::register_services();
}
function fenqueue() {
  wp_enqueue_style( 'kwstyle', plugin_dir_url( __FILE__ ).'asset/css/mystyle.css' );
  // wp_enqueue_script( 'kwscript', get_template_directory_uri() . 'asset/js/admin.js' );
  }
  
add_action('wp_enqueue_scripts', 'fenqueue'); 

function enqueueBackendJquery() {
  wp_enqueue_style( 'kwstylebootst', plugin_dir_url( __FILE__ ).'asset/css/bootstrap.min.css' );
  wp_enqueue_script('jquery');
  wp_enqueue_script( 'kwpopperjs', plugin_dir_url( __FILE__ ).'asset/js/popper.min.js' );
  wp_enqueue_script( 'kwbootsjs', plugin_dir_url( __FILE__ ).'asset/js/bootstrap.min.js' );
}
add_action( 'admin_enqueue_scripts', 'enqueueBackendJquery' );