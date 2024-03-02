<?php
/**
 * @package WptBooking
 */
 namespace Inc\Base;

 use \Inc\Base\BaseController;

 class Enqueue extends BaseController{
    public function register(){
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ] );
    }

    // Enqueue andmin and public styles and js
    public function enqueue(){
        // Styles
        wp_enqueue_style( 'admin-bootstrap', $this->plugin_url . 'assets/css/bootstrap.min.css' );
        wp_enqueue_style( 'admin-style', $this->plugin_url . 'assets/css/style.css' );

        // Js
        wp_enqueue_script( 'admin-bootstrap-js', $this->plugin_url . 'assets/js/bootstrap.min.js', [ 'jquery' ], false, true );
        wp_enqueue_script( 'eds-main-js', $this->plugin_url . 'assets/js/app.js', [ 'admin-bootstrap-js' ], false, true );
        // wp_enqueue_script('wpt-ajax-script', $this->plugin_url . 'assets/js/wpt-ajax-script', array('eds-main-js'), false, true);

        // Localize the script with the AJAX URL
        // wp_localize_script('eds-main-js', 'custom_ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
    }
 }