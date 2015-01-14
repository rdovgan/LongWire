<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('user_model');
        $this->load->model('achiev_model');
        $this->load->model('person_model');
    }

    public function index() {
        Elements::isLoggedIn();
        $this->welcome();
    }

    public function welcome($message = '') {
        $data['title'] = 'Welcome';
        $data['head_menu'] = Elements::getMenu();
        if ((isset($message)) && ($message != '')) {
            $data['messageText'] = $message;
        }
        $this->load->view('main/header_view', $data);
        $this->load->view("main/main_top_view.php", $data);
        $this->load->view('main/menu_view.php', $data);
        $this->load->view('main/welcome_view.php', $data);
        $this->load->view('main/footer_view', $data);
    }

    public function guest($option = '') {
        $data['title'] = 'Home';
        $data['head_menu'] = Elements::getMenu();
        if ((isset($option)) && ($option != '')) {
            $data['option'] = $option;
            if ($option == "wrong_pass") {
                $data['option'] = "login";
                $data['help_message'] = "Wrong password";
            }
        }
        $this->load->view('main/header_view', $data);
        $this->load->view("main/main_top_view.php", $data);
        $this->load->view("main/menu_view.php", $data);
        $this->load->view("main/main_content_view.php", $data);
        $this->load->view('main/footer_view', $data);
    }

    public function login() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[30]|xss_clean|callback_is_username');

        if ($this->form_validation->run() == FALSE) {
            $this->guest('login');
        }
        $username = $this->input->post('username');
        $password = md5($this->input->post('pass'));

        $result = $this->user_model->login($username, $password);
        $this->achList = $this->achiev_model->getUserAchId($this->session->userdata('user_id'));
        if ($result) {
            $person = $this->person_model->getPerson($this->session->userdata('user_id'));
            if ($person) {
                $this->session->set_userdata(array('user_name' => $person['person_name'] . ' ' . $person['person_surname']));
            }
            $this->welcome('Login succesful');
        } else {
            $this->guest('wrong_pass');
        }
    }

    public function thanks() {
        $data['title'] = 'Thanks';
        $data['head_menu'] = Elements::getMenu();
        $this->load->view('main/header_view', $data);
        $this->load->view('main/menu_view', $data);
        $this->load->view('main/thanks_view.php', $data);
        $this->load->view('main/footer_view', $data);
    }

    function is_username($str) {
        if (!$this->user_model->checkLogin($str)) {
            $this->form_validation->set_message('is_username', 'Wrong username');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function username_check($str) {
        if ($this->user_model->checkLogin($str)) {
            $this->form_validation->set_message('username_check', 'The %s is already existed');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function registration() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required|min_length[4]|max_length[30]|xss_clean|callback_username_check');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');

        if ($this->form_validation->run() == FALSE) {
            $this->guest('register');
        } else {
            $this->user_model->add_user();
            $result = Events::trigger('register_event', 'system_events', 'string'); //TODO:give result to $this->thank()
            //call modal with message
            $this->achiev_model->gotAchiev(1, $this->session->userdata('user_id'));
            $this->thanks();
        }
    }

    public function logout() {
        $newdata = array(
            'user_id' => '',
            'user_name' => '',
            'user_login' => '',
            'logged_in' => FALSE
        );
        $this->session->unset_userdata($newdata);
        $this->session->sess_destroy();
        $this->index();
    }

    public function action() {
        $data['title'] = 'Home';
        $data['head_menu'] = Elements::getMenu();
        $this->load->view('main/header_view', $data);
        $this->load->view('main/action_top_view', $data);
        $this->load->view('main/menu_view', $data);
        $this->load->view('main/action_view.php', $data);
        $this->load->view('main/footer_view', $data);
    }

    public function profile() {
        Elements::isLoggedIn();
        $data['title'] = 'User page';
        $data['head_menu'] = Elements::getMenu();
        $data['activeItem'] = 'profileItem';
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/home_view', $data);
    }

    public function person() {
        Elements::isLoggedIn();
        $data['title'] = 'Personal information';
        $data['head_menu'] = Elements::getMenu();
        $data['activeItem'] = 'personItem';
        $data['personData'] = $this->person_model->getPerson($this->session->userdata('user_id'));
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/person_view', $data);
    }

    public function savePerson() {
        $this->person_model->addPerson($this->session->userdata('user_id'));
        //show message
        $this->person();
    }

    public function gallery() {
        Elements::isLoggedIn();
        $data['title'] = 'Galary';
        $data['head_menu'] = Elements::getMenu();
        $data['activeItem'] = 'galleryItem';
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/gallery_view', $data);
    }

    public function messages() {
        Elements::isLoggedIn();
        $data['title'] = 'Messages';
        $data['head_menu'] = Elements::getMenu();
        $data['activeItem'] = 'messagesItem';
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/messages_view', $data);
    }

    public function calendar() {
        Elements::isLoggedIn();
        $data['title'] = 'Calendar';
        $data['head_menu'] = Elements::getMenu();
        $data['activeItem'] = 'calendarItem';
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/calendar_view', $data);
    }

    public function achiev() {
        Elements::isLoggedIn();
        $data['title'] = 'Calendar';
        $data['head_menu'] = Elements::getMenu();
        $data['achievs'] = $this->achiev_model->getUserAchievs($this->session->userdata('user_id'));
        $data['activeItem'] = 'achievItem';
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/achiev_view', $data);
    }

}

?>