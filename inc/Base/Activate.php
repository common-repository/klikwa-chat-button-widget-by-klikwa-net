<?php
/**
 * @package  KlikWAPlugin
 */
namespace KWAP_Inc\Base;

use KWAP_Inc\Controllers\BaseController;

class Activate extends BaseController
{
    
    /**
     * Database Generation when activated
     */
    public static function klikWACreateTable() {
        global $wpdb;

        //* Return if table has already been added
        // so seed data will not be re-inserted
        $table_name_general = $wpdb->prefix . 'klikwa_general';
        if ($wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $table_name_general)) == $table_name_general) {
            return;
        }

        //* Create the klik_wa_general table
        $sql_general = "CREATE TABLE $table_name_general (
            id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            float_style enum('ITB','IT', 'I') NOT NULL,
            float_text varchar(255) DEFAULT NULL,
            headline varchar(255) DEFAULT NULL,
            sub_headline varchar(255) DEFAULT NULL,
            t_response varchar(255) DEFAULT NULL,
            bubble_side enum('Right','Left') NOT NULL,
            PRIMARY KEY  (id)
        )";

        //* Create the klik_wa_cs table
        $table_name_cs = $wpdb->prefix . 'klikwa_cs';
        $sql_cs = "CREATE TABLE $table_name_cs (
            id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            name varchar(255) DEFAULT NULL,
            title varchar(255) DEFAULT NULL,
            link varchar(255) DEFAULT NULL,
            image_path varchar(255) DEFAULT NULL,
            active_status enum('No','Yes') NOT NULL,
            default_data enum('No','Yes') NOT NULL,
            PRIMARY KEY  (id)
        )";

        //* Create the klik_wa_links table
        $table_name_links = $wpdb->prefix . 'klikwa_links';
        $sql_links = "CREATE TABLE $table_name_links (
            id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            l_script varchar(2000) DEFAULT NULL,
            pop_up_event_click varchar(2000) DEFAULT NULL,
            chat_event_click varchar(2000) DEFAULT NULL,
            PRIMARY KEY  (id)
        )";

        // Create the sql database in the wordpress
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql_general );
        dbDelta( $sql_cs );
        dbDelta( $sql_links );

        $table_name_cs = $wpdb->prefix . 'klikwa_cs';

        $wpdb->insert(
            $table_name_cs,
            [ // inserting the 'table on sql' => $data from _POST
                'name' => 'Joel',
                'title' => 'Administrator',
                'link' => 'https://klikwa.net/klikwa-button-administrator',
                'image_path' => plugin_dir_url( dirname( __FILE__, 2 ) ).'asset/images/joel.jpg',
                'active_status' => 'Yes',
                'default_data' => 'Yes'
            ],
            [ // validator for each field, if theres empty field it would return error.
                '%s', // name
                '%s', // title
                '%s', // link
                '%s', // image_path
                '%s', // active_status
                '%s'  // default_data
            ]
        );

        $wpdb->insert(
            $table_name_cs,
            [ // inserting the 'table on sql' => $data from _POST
                'name' => 'Cintya',
                'title' => 'Customer Care',
                'link' => 'https://klikwa.net/klikwa-button-custcare',
                'image_path' => plugin_dir_url( dirname( __FILE__, 2 ) ).'asset/images/cynthia.jpg',
                'active_status' => 'Yes',
                'default_data' => 'Yes'
            ],
            [ // validator for each field, if theres empty field it would return error.
                '%s', // name
                '%s', // title
                '%s', // link
                '%s', // image_path
                '%s', // active_status
                '%s'  // default_data
            ]
        );

        $wpdb->insert(
            $table_name_cs,
            [ // inserting the 'table on sql' => $data from _POST
                'name' => 'Carlos',
                'title' => 'Sales Representative',
                'link' => 'https://klikwa.net/klikwa-button-salesrep',
                'image_path' => plugin_dir_url( dirname( __FILE__, 2 ) ).'asset/images/carlos.png',
                'active_status' => 'No',
                'default_data' => 'Yes'
            ],
            [ // validator for each field, if theres empty field it would return error.
                '%s', // name
                '%s', // title
                '%s', // link
                '%s', // image_path
                '%s', // active_status
                '%s'  // default_data
            ]
        );

        
        $wpdb->insert(
            $table_name_general,
            [ // inserting the 'table on sql' => $data from _POST
                'float_style' => 'ITB',
                'float_text' => 'Start a Conversation',
                'headline' => 'Welcome to KlikWa',
                'sub_headline' => 'Hi! Please click one of our member below to chat on Whatsapp',
                't_response' => 'Typically response in 5 minutes !',
                'bubble_side' => 'Right'
            ],
            [ // validator for each field, if theres empty field it would return error.
                '%s', // float_style
                '%s', // float_text
                '%s', // headline
                '%s', // sub_headline
                '%s', // t_response
                '%s'  // bubble_side
            ]
        );
    }
    
    public static function activate() {
        // flush rewrite rules
        flush_rewrite_rules();
    }
}
