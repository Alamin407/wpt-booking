<?php
/**
 * @package WptBooking
 */
namespace Inc\Api\Callbacks;
use Inc\Base\BaseController;

class ManagerCallbacks extends BaseController{
    public function checkboxSenetize($input){

        $output = array();

        foreach( $this->managers as $key => $value ){
            $output[$key] = isset( $input[$key] ) ? true : false;
        }

        return $output;
    }

    public function adminSectionsManager(){
        echo 'Manage the Sections and Features of this plugin';
    }

    public function checkboxField($args){
        $name = $args[ 'label_for' ];
        $classes = $args[ 'class' ];
        $option_name = $args[ 'option_name' ];
        $checkbox = get_option( $option_name );
        $checked = isset($checkbox[$name]) ? ($checkbox[$name] ? true : false) : false;

        echo '<div class="custom-control custom-switch">
        <input type="checkbox" name="'. $option_name .'['. $name .']" class="custom-control-input ' . $classes . '" id="'. $name .'" " value="1" ' . ( $checked ? 'checked' : '' ) . '>
        <label class="custom-control-label" for="'. $name .'"></label>
      </div>';
    }
}