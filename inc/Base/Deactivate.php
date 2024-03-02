<?php
/**
 * @package ErosadsUsers
 */
namespace Inc\Base;
 class Deactivate{
    // Plugin deactivation method
    public static function deactive(){
        // Flush the rewrite rules
        flush_rewrite_rules();
    }
 }