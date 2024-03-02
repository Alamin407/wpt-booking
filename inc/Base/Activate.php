<?php
/**
 * @package WptBooking
 */
namespace Inc\Base;
 class Activate{
    // Plugin activation method
    public static function activate(){
        // Create database
        // global $wpdb;
        // $table_name = $wpdb->prefix . 'wpt-bookings';
        

        // $charset_collate = $wpdb->get_charset_collate();

        // if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {
        //     $sql = "CREATE TABLE $table_name (
        //         id mediumint(9) NOT NULL AUTO_INCREMENT,
        //         user_id bigint(20) NOT NULL,
        //         link_title text NOT NULL,
        //         link_url text NOT NULL,
        //         link_user_email text NOT NULL,
        //         PRIMARY KEY (id)
        //     ) $charset_collate;";

        //     require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        //     dbDelta($sql);
        // }
        
        // Flush the rewrite rules
        flush_rewrite_rules();

        if( get_option( 'car_bookings' ) ){
            return;
        }

        $default = array();

        update_option( 'car_bookings', $default );
    }
 }