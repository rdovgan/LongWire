<?php
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends CI_Controller {
    
    public function __construct() {
        parent::__construct();

        $this->load->model('user_model');
        $this->load->model('achiev_model');
        $this->load->model('person_model');
        $this->load->model('post_model');
    }
    
    public function index($login = '') {
        if($login == ''){
            $this->currentUser();
        }else{
            $this->getUser($login);
        }
    }
    
    public function currentUser(){        
        Elements::isLoggedIn();
        $data['title'] = 'Your personal profile';
        $data['head_menu'] = Elements::getMenu();
        $data['personLogin'] = $this->session->userdata('user_login');
        $userId = $this->session->userdata('user_id');
        $data['personData'] = $this->person_model->getPerson($userId);
        $data['postsData'] = $this->post_model->getAllPostsFromUser($userId);
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/user_view', $data);
    }
    
    public function search(){        
        Elements::isLoggedIn();
        $data['title'] = 'Users';
        $data['head_menu'] = Elements::getMenu();
        $data['activeItem'] = 'userItem';
        $data['usersList'] = $this->user_model->getUsers();
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/user_list_view', $data);
    }


    public function user($userLogin){
        Elements::isLoggedIn();
        $data['title'] = 'User information';
        $data['head_menu'] = Elements::getMenu();
        $data['activeItem'] = 'userItem';
        $data['personLogin'] = $userLogin;
        $userId = $this->user_model->getIdByLogin($userLogin);
        $data['personData'] = $this->person_model->getPerson($userId);
        $data['postsData'] = $this->post_model->getAllPostsFromUser($userId);
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/user_view', $data);      
    }
}
?>