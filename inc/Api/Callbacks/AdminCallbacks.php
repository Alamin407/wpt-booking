<?php
/**
 * @package WptBooking
 */
namespace Inc\Api\Callbacks;
use Inc\Base\BaseController;

class AdminCallbacks extends BaseController{

    public function adminDashboard(){
        return require_once("$this->plugin_path/templates/admin.php");
    }

    public function all_bookings(){
        echo "Hello World";
    }
    
    public function adminCpt(){
        return require_once("$this->plugin_path/templates/cpt.php");
    }

    public function texanomy_manager(){
        echo "Hello World";
    }

    public function media_widget(){
        echo "Hello World";
    }

    public function gallery_manager(){
        echo "Hello World";
    }

    public function template_manager(){
        echo "Hello World";
    }

    public function login_manager(){
        echo "Hello World";
    }

    public function membership_manager(){
        echo "Hello World";
    }

}