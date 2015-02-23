<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        header('Content-Type: text/html; charset=utf-8');
        $this->load->model('user_model');
        $this->load->model('achiev_model');
        $this->load->model('person_model');
        $this->load->model('mail_model');
    }

    public function index() {
        Elements::isLoggedIn($this->session->userdata('logged_in'));
        if ($this->session->userdata('user_login') != 'admin') {
            redirect('post/allPosts');
        } else {
            $data['title'] = 'Admin page';
            $data['head_menu'] = Elements::getMenu($this->session->userdata('logged_in'));
            $data['achievs'] = $this->achiev_model->getAllAchievs();
            $this->load->view('admin/head_view', $data);
            $this->load->view('admin/panel_view', $data);
            $this->load->view('admin/admin_view', $data);
        }
    }
    
    public function addAchievement($name, $desc, $group = 1){
        Events::log_message('debug',"Controller: "+$name);
        echo $this->achiev_model->addAchiev($name, $desc, $group);
    }

}

?>