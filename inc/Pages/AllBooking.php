<?php
/**
 * @package WptBooking
 */
namespace Inc\Pages;
use \Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class AllBooking extends BaseController{

    public $settings;

    public $callbacks;
    
    public $subpages = array();

    public function register(){

        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();

        $this->setSubpages();

        $this->settings->addSubpages( $this->subpages )->register();
    }

    public function setSubpages(){
        $this->subpages = [
            [
                'parent_slug' => 'car_bookings',
                'page_title'  => 'All Bookings',
                'menu_title'  => 'All Bookings',
                'capability'  => 'manage_options',
                'menu_slug'   => 'all_bookings',
                'callback'    => [$this->callbacks, 'all_bookings'],
            ],
        ];
    }
}