<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Post extends CI_Controller {

    public function __construct() {
        parent::__construct();
                
        $this->load->model('user_model');
        $this->load->model('achiev_model');
        $this->load->model('post_model');
    }    
    
    public function isLoggedIn() {
        return $this->session->userdata('logged_in');
    }
    
}
?>

