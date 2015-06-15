<?php
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        header('Content-Type: text/html; charset=utf-8');
        $this->load->model('user_model');
        $this->load->model('achiev_model');
        $this->load->model('person_model');
        $this->load->model('post_model');
        $this->load->model('likes_model');
        $this->load->model('favorite_model');
    }
    
    public function index($login = '') {
        if($login == ''){
            $this->currentUser();
        }else{
            $this->getUser($login);
        }
    }
    
    public function currentUser(){
        Elements::isLoggedIn($this->session->userdata('logged_in'));
        $this->user($this->session->userdata('user_login'));
    }
    
    public function search(){
//        Elements::isLoggedIn($this->session->userdata('logged_in'));
        $data['title'] = 'Users';
        $data['head_menu'] = Elements::getMenu($this->session->userdata('logged_in'));
        $data['activeItem'] = 'userItem';
        $data['usersList'] = $this->user_model->getUsers();
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/user_list_view', $data);
    }


    public function user($userLogin){
//        Elements::isLoggedIn($this->session->userdata('logged_in'));
        $data['title'] = 'User information';
        $data['head_menu'] = Elements::getMenu($this->session->userdata('logged_in'));
        $data['activeItem'] = 'userItem';
        $data['personLogin'] = $userLogin;
        $userId = $this->user_model->getIdByLogin($userLogin);
        $data['personData'] = $this->person_model->getPerson($userId);
        $data['postsList'] = $this->post_model->getAllPostsFromUser($userId);
        $data['likes'] = $this->likes_model->getLikesOfUser($userId);
        $data['dislikes'] = $this->likes_model->getDislikesOfUser($userId);
        $data['favs'] = $this->favorite_model->getFavsOfUser($userId);
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/user_view', $data);      
    }
}
?>