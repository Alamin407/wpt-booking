<?php
/**
 * @package WptBooking
 */
namespace Inc\Base;
use \Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class TexanomyManager extends BaseController{

    public $settings;

    public $callbacks;
    
    public $subpages = array();

    public function register(){

        if( ! $this->activated( 'texanomy_manager' ) ){
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
                'page_title'  => 'Texanomy Manger',
                'menu_title'  => 'Texanomy Manger',
                'capability'  => 'manage_options',
                'menu_slug'   => 'texanomy_manager',
                'callback'    => [$this->callbacks, 'texanomy_manager'],
            ],
        ];
    }
}