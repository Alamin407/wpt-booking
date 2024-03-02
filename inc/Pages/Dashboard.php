<?php
/**
 * @package WptBooking
 */

 namespace Inc\Pages;

 use \Inc\Api\SettingsApi;
 use \Inc\Base\BaseController;
 use \Inc\Api\Callbacks\AdminCallbacks;
 use \Inc\Api\Callbacks\ManagerCallbacks;

 class Dashboard extends BaseController{
    public $settings;

    public $callbacks;

    public $callbacks_mngr;

    public $pages = array();

    public $subpages = array();

    public function register()
    {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();
        $this->callbacks_mngr = new ManagerCallbacks();

        $this->setPages();
        // $this->setSubpages();

        $this->setSettings();
        $this->setSections();
        $this->setFields();

        //add_action( 'admin_menu', [ $this, 'add_admin_page' ] );
        $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->register();
        
    }

    public function setPages(){
        $this->pages = [
            [
                'page_title' => 'Car Bookings',
                'menu_title' => 'Bookings',
                'capability' => 'manage_options',
                'menu_slug'  => 'car_bookings',
                'callback'   => [$this->callbacks, 'adminDashboard'],
                'icon_url'   => 'dashicons-car',
                'position'   => 9

            ]
        ];
    }

    public function setSettings(){

        $args = array();

        $args[] = array(
            'option_group' => 'booking_plugin_settings',
            'option_name'  => 'car_bookings',
            'callback'     => [ $this->callbacks_mngr, 'checkboxSenetize' ]
        );

        $this->settings->setSettings($args);
    }

    public function setSections(){
        $args = array(
            array(
                'id'        => 'booking_admin_index',
                'title'     => 'Settings Manager',
                'callback'  => [ $this->callbacks_mngr, 'adminSectionsManager' ],
                'page'      => 'car_bookings',
            ),
        );

        $this->settings->setSections($args);
    }

    public function setFields(){

        $args = array();

        foreach( $this->managers as $key => $value ){
            $args[] = array(
                'id'        => $key,
                'title'     => $value,
                'callback'  => [ $this->callbacks_mngr, 'checkboxField' ],
                'page'      => 'car_bookings',
                'section'   => 'booking_admin_index',
                'args'      => array(
                    'option_name'  => 'car_bookings',
                    'label_for'    => $key,
                    'class'        => 'ui-toggle',
                )
            );
        }

        $this->settings->setFields($args);
    }

 }