<?php
/**
 * @package WptBooking
 */
namespace Inc\Base;
use \Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class LoginManager extends BaseController{

    public $settings;

    public $callbacks;
    
    public $subpages = array();

    public function register(){

        if( ! $this->activated( 'login_manager' ) ){
            return;
        }

        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();

        $this->setSubpages();

        $this->settings->addSubpages( $this->subpages )->register();
    }

    public function setSubpages(){
        $this->subpages = [
            [
                'parent_slug' => 'car_bookings',
                'page_title'  => 'AJAX Login/Signup',
                'menu_title'  => 'AJAX Login/Signup',
                'capability'  => 'manage_options',
                'menu_slug'   => 'login_manager',
                'callback'    => [$this->callbacks, 'login_manager'],
            ],
        ];
    }
}