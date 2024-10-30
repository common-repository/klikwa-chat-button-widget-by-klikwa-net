<?php

/**
 * This is triggered when uninstalling the plug-ins
 * 
 * @package KlikWAPlugin
 */

if(! defined('WP_UNINSTALL_PLUGIN'))
{
    die;
}

// Drop the database's table
global $wpdb;

$tableArray = [
    $wpdb->prefix . "klikwa_general",
    $wpdb->prefix . "klikwa_cs",
    $wpdb->prefix . "klikwa_links",
];
foreach($tableArray as $table){
    $wpdb->query("DROP TABLE IF EXISTS $table");
}
