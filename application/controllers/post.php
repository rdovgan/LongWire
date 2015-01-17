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

    public function formPost() {
        Elements::isLoggedIn();
        $data['head_menu'] = Elements::getMenu();
        $data['title'] = 'Create new post';
        $data['head_menu'] = Elements::getMenu();
        //add activeItem
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/form_post_view', $data);
    }

    public function viewPost($postId) {
        Elements::isLoggedIn();
        $data['head_menu'] = Elements::getMenu();
        $data['title'] = 'View post';
        $data['activeItem'] = 'postsItem';
        $data['postData'] = $this->post_model->getPost($postId);
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/post_view', $data);
    }

    public function addPost() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('post_name', 'Post name', 'trim|required|min_length[1]|max_length[120]');
        $this->form_validation->set_rules('post_desc', 'Description of post', 'trim|max_length[160]');
        $this->form_validation->set_rules('post_body', 'Post', 'trim|required|min_length[4]|max_length[1200]');
        $this->form_validation->set_rules('post_tags', 'Tags', 'trim|required|min_length[4]|max_length[120]');

        if ($this->form_validation->run() == FALSE) {
            $this->formPost();
        } else {
            $this->post_model->addPost();
            //$result = Events::trigger('register_event', 'system_events', 'string'); //TODO:give result to $this->thank()
            //call modal with message
            //$this->achiev_model->gotAchiev(1, $this->session->userdata('user_id'));
            $postId = $this->post_model->getLastPostId($this->session->userdata('user_id'));
            $this->viewPost($postId);
        }
    }

    public function lastPost() {
        Elements::isLoggedIn();
        $data['head_menu'] = Elements::getMenu();
        $postId = $this->post_model->getLastPostId($this->session->userdata('user_id'));
        $this->viewPost($postId, $data);
    }

    public function postsList() {
        Elements::isLoggedIn();
        $data['head_menu'] = Elements::getMenu();
        $data['title'] = 'Posts';
        $data['head_menu'] = Elements::getMenu();
        $data['activeItem'] = 'postsItem';
        $data['postsList'] = $this->post_model->getAllPostsFromUser($this->session->userdata('user_id'));
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/posts_list_view', $data);
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
        $config['file_name'] = 'avatar.png';
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

    private function cropAvatar($upload_data) {
        //get min length and center crop'
        $width = $upload_data['image_width'];
        $height = $upload_data['image_height'];

        if ($width > $height) {
            $x_axis = ($width / 2) - ($height / 2);
            $y_axis = 0;
            $width = $height;
        } else {
            $x_axis = 0;
            $y_axis = ($height / 2) - ($width / 2);
            $height = $width;
        }

        $image_config['image_library'] = 'gd2';
        $image_config['source_image'] = $upload_data["file_path"] . 'avatar.png';
        $image_config['new_image'] = $upload_data["file_path"] . 'product.png';
        $image_config['quality'] = "100%";
        $image_config['maintain_ratio'] = FALSE;
        $image_config['width'] = $width;
        $image_config['height'] = $width;
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
        $image_config["source_image"] = $upload_data["file_path"] . 'product.png';
        $image_config['create_thumb'] = TRUE;
        $image_config['maintain_ratio'] = TRUE;
        $image_config['new_image'] = $upload_data["file_path"] . 'product.png';
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