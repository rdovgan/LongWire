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
        $config = array(
            'upload_path' => "./img/avatars/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "768",
            'max_width' => "1024"
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {
            $data = array('upload_data' => $this->upload->data());
            redirect('user/person');
        } else {
            $errors = array('error' => $this->upload->display_errors());
            $this->gallery($errors);                    
        }
    }

}

?>