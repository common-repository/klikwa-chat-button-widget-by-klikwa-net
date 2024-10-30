<?php
/**
 * @package  KlikWAPlugin
 */
namespace KWAP_Inc\Base;

use \KWAP_Inc\Controllers\BaseController;

class SettingLinks extends BaseController
{
    function register() {
        add_filter( "plugin_action_links_$this->plugin_basename", array( $this, 'settings_link' ) );
    }

    // -------- SETTINGS ---------
    public function settings_link( $links ) {
        $settings_link = '<a href="admin.php?page=klik_wa">Settings</a>';
        array_push( $links, $settings_link );
        return $links;
    }
}