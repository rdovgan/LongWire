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
        $data['wp_news'] = News::getWPNews(10);
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
    
    public function gallery($errors = '') {
        Elements::isLoggedIn();
        $data['title'] = 'Galary';
        $data['head_menu'] = Elements::getMenu();
        $data['activeItem'] = 'galleryItem';
        $data['error'] = $errors;
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/gallery_view', $data);
    }

    public function uploadAvatar() {
        $config['upload_path'] = './img/avatars/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = ''.$this->session->userdata('user_login').'_full.png';
        $config['overwrite'] = TRUE;
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';

        $this->load->library('upload', $config);

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }

        if (!$this->upload->do_upload()) { //Upload file
            $errors = array('error' => $this->upload->display_errors());
            $this->gallery($errors);
        } else {
            $upload_data = $this->upload->data();
            $this->cropAvatar($upload_data);
        }
    }

    private function getAvatarConf($upload_data){
        $image_config['image_library'] = 'gd2';
        $image_config['source_image'] = $upload_data["file_path"] . $this->session->userdata('user_login').'_full.png';
        $image_config['new_image'] = $upload_data["file_path"] . $this->session->userdata('user_login').'.png';
        $image_config['quality'] = "100%";
        $image_config['maintain_ratio'] = FALSE;
        return $image_config;
    }
    
    private function cropAvatar($upload_data) {
        //get min length and center crop'
        $length = min($upload_data['image_width'], $upload_data['image_height']);
        $x_axis = $y_axis = 0;

        if ($upload_data['image_width'] > $upload_data['image_height']) {
            $x_axis = ($upload_data['image_width'] / 2) - ($upload_data['image_height'] / 2);
        } else {
            $y_axis = ($upload_data['image_height'] / 2) - ($upload_data['image_width'] / 2);
        }
        
        $image_config = $this->getAvatarConf($upload_data);
        $image_config['width'] = $length;
        $image_config['height'] = $length;
        $image_config['x_axis'] = $x_axis;
        $image_config['y_axis'] = $y_axis;

        $this->load->library('image_lib');
        $this->image_lib->initialize($image_config);

        if (!$this->image_lib->crop()) {
            $errors = array('error' => $this->image_lib->display_errors());
            $this->gallery($errors);
        } else {
            $upload_data = $this->upload->data();
            $this->resizeAvatar($upload_data);
        }
    }

    private function resizeAvatar($upload_data) {
        $image_config["image_library"] = "gd2";
        $image_config["source_image"] = $upload_data["file_path"] . $this->session->userdata('user_login').'.png';
        $image_config['create_thumb'] = TRUE;
        $image_config['maintain_ratio'] = TRUE;
        $image_config['new_image'] = $upload_data["file_path"] . $this->session->userdata('user_login').'.png';
        $image_config['quality'] = "100%";
        $image_config['width'] = 96;
        $image_config['height'] = 96;
        $dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
        $image_config['master_dim'] = ($dim > 0) ? "height" : "width";

        $this->image_lib->clear();
        $this->image_lib->initialize($image_config);

        if (!$this->image_lib->resize()) { //Resize image
            $errors = array('error' => $this->image_lib->display_errors());
            $this->gallery($errors);
        } else {
            $this->gallery();
        }
    }

}

?>