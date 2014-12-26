<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        
        $this->load->model('user_model');
        $this->load->model('achiev_model');
    }

    private function getMenu() {
        $data = array();
        if ($this->isLoggedIn()) {
            $userLink = anchor(
                    "user/profile", '<h4><span class="glyphicon glyphicon-user" aria-hidden="true"></span></h4><h6 hidden><span class="glyphicon glyphicon-info-sign badgeInfo" aria-hidden="true"></span></h6>', array('id' => 'userLink', 'class' => 'invlink')
            );
            $logoutLink = anchor(
                    "user/logout", '<h4><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></h4>', array('id' => 'logoutLink', 'class' => 'invlink')
            );
            $data = array(
                '<div class="headerElement">', $userLink, '</div>',
                '<div class="headerElement">', $logoutLink, '</div>'
            );
        } else {
            $data = array(
                '<button id = "btnRegister" class="btn btn-sm btnRegister">Sign Up</button>',
                '<button id = "btnLogin" class="btn btn-sm btn-danger btnLogin">Sign In</button>'
            );
        }
        return $data;
    }

    public function isLoggedIn() {
        return ($this->session->userdata('user_name') != "") ? true : false;
    }

    public function index() {
        if ($this->isLoggedIn()) {
            $this->welcome();
        } else {
            $this->guest();
        }
    }

    public function welcome() {
        $data['title'] = 'Welcome';
        $data['head_menu'] = $this->getMenu();
        $this->load->view('header_view', $data);
        $this->load->view("main_top_view.php", $data);
        $this->load->view('menu_view.php', $data);
        $this->load->view('welcome_view.php', $data);
        $this->load->view('footer_view', $data);
    }

    public function guest() {
        $data['title'] = 'Home';
        $data['head_menu'] = $this->getMenu();
        $this->load->view('header_view', $data);
        $this->load->view("main_top_view.php", $data);
        $this->load->view("menu_view.php", $data);
        $this->load->view("main_content_view.php", $data);
        $this->load->view('footer_view', $data);
    }

    public function login() {
        $username = $this->input->post('username');
        $password = md5($this->input->post('pass'));

        $result = $this->user_model->login($username, $password);
        $this->achList = $this->achiev_model->getUserAchId($this->session->userdata('user_id'));
        if ($result){
            $this->welcome();
        }else{
            $this->index();
        }
    }

    public function thank() {
        $data['title'] = 'Thank';
        $data['head_menu'] = $this->getMenu();
        $this->load->view('header_view', $data);
        $this->load->view('menu_view', $data);
        $this->load->view('thank_view.php', $data);
        $this->load->view('footer_view', $data);
    }

    public function registration() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $this->user_model->add_user();
            $result = Events::trigger('register_event', 'system_events', 'string');//TODO:give result to $this->thank()
            //call modal with message
            $this->achiev_model->gotAchiev(1, $this->session->userdata('user_id'));
            $this->thank();
        }
    }

    public function logout() {
        $newdata = array(
            'user_id' => '',
            'user_name' => '',
            'logged_in' => FALSE,
        );
        $this->session->unset_userdata($newdata);
        $this->session->sess_destroy();
        $this->index();
    }

    public function profile() {
        if ($this->isLoggedIn()) {
            $data['title'] = 'User page';
            $data['head_menu'] = $this->getMenu();
            $data['achievs'] = $this->achiev_model->getUserAchievs($this->session->userdata('user_id'));
            $this->load->view('user_head_view', $data);
            $this->load->view('user_panel_view', $data);
        } else {
            $this->guest();
        }
    }

    public function action(){
        $data['title'] = 'Home';
        $data['head_menu'] = $this->getMenu();
        $this->load->view('header_view', $data);
        $this->load->view('menu_view', $data);
        $this->load->view('action_view.php', $data);
        $this->load->view('footer_view', $data);
    }
}

?>