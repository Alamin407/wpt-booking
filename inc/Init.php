<?php
/**
 * @package WptBooking
 */

 namespace Inc;

 final class Init{
    /**
     * store all the classes in an array
     * @return array full list of classes
     */
    public static function get_services(){
        return [
            Pages\Dashboard::class,
            Pages\AllBooking::class,
            Base\Enqueue::class,
            Base\SettingLinks::class,
            Base\CustomPostTypeManager::class,
            Base\TexanomyManager::class,
            Base\MediaWidget::class,
            Base\GalleryManager::class,
            Base\TemplateManager::class,
            Base\LoginManager::class,
            Base\MembershipManager::class,
        ];
    }

    /**
     * Loop through the classes, initialize them 
     * and call the register method if it exists 
     * @return
     */
    public static function register_services(){
        foreach( self::get_services() as $class ){
            $service = self::instantiate($class);
            if( method_exists( $service, 'register' ) ){
                $service->register();
            }
        }
    }
    /**
     * Initialize the class
     * @param class $class class from the service array
     * @return class instance new instance of the class
     */
    private static function instantiate($class){
        $service = new $class;

        return $service;
    }
 }
