<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Achievements extends CI_Controller{
    
    public function clickButton() {
        echo Events::trigger("public_controler");
    }
    
}
?>