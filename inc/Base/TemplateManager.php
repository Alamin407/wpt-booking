<?php
/**
 * @package WptBooking
 */
namespace Inc\Base;
use \Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class TemplateManager extends BaseController{

    public $settings;

    public $callbacks;
    
    public $subpages = array();

    public function register(){

        if( ! $this->activated( 'template_manager' ) ){
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
                'page_title'  => 'Template Manager',
                'menu_title'  => 'Template Manager',
                'capability'  => 'manage_options',
                'menu_slug'   => 'template_manager',
                'callback'    => [$this->callbacks, 'template_manager'],
            ],
        ];
    }
}