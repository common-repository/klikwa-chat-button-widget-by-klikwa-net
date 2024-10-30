<?php
/**
 * @package  KlikWAPlugin
 */
namespace KWAP_Inc\Base;

use KWAP_Inc\Controllers\BaseController;

class Enqueue extends BaseController
{
    public function register() {
		add_action('admin_enqueue_scripts', array($this, 'enqueue')); 
		// change to this (below) to make it available on the front-end
		add_action('wp_enqueue_scripts', array($this, 'fenqueue'));
    }

    public function enqueue() {
		wp_enqueue_style( 'mypluginstyle', $this->plugin_url . 'asset/css/mystyle.css' );
		wp_enqueue_script( 'mypluginscript', $this->plugin_url . 'asset/js/admin.js' );
	}
	
	public function fenqueue() {
		wp_enqueue_style( 'kwstyle', $this->plugin_url . 'asset/css/mystyle.css' );
		wp_enqueue_script( 'kwscript', $this->plugin_url . 'asset/js/index.js' , array('jquery','bootstrap'));
    }
}