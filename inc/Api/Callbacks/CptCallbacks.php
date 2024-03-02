<?php
/**
 * @package WptBooking
 */
namespace Inc\Api\Callbacks;

class CptCallbacks{
    

    public function cptSectionsManager(){
        echo 'Manage your custom post types';
    }

    public function cptSenetize( $input ){
        return $input;
    }

    public function textField( $args ){
        $name = $args['label_for'];
        // var_dump( $name );
		$option_name = $args['option_name'];

		echo '<input type="text" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" placeholder="' . $args['placeholder'] . '">';
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