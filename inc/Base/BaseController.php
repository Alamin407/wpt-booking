<?php
/**
 * @package WptBooking
 */
namespace Inc\Base;

class BaseController{
    public $plugin_path;

    public $plugin_url;

    public $plugin;

    public $managers = array();

    public function __construct(){
       $this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) ); 
       $this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) ); 
       $this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/wpt-booking.php';

       $this->managers = array(
            'cpt_manager'           => 'Active CPT Manger',
            'texanomy_manager'      => 'Active Texanomy Manger',
            'media_widget'          => 'Active Media Widget',
            'gallery_manager'       => 'Active Gallery Manager',
            'template_manager'      => 'Active Template Manager',
            'login_manager'         => 'Active AJAX Login/Signup',
            'membership_manager'    => 'Active Membership Manager',
       );
    }

    public function activated( string $key){
        $option = get_option( 'car_bookings' );

        return isset( $option[ $key ] ) ? $option[ $key ] : false;
    }
}