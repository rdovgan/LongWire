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

    public function formPost() {
        $data['title'] = 'Create new post';
        $data['head_menu'] = Elements::getMenu();
        //add activeItem
        $this->load->view('user_head_view', $data);
        $this->load->view('user_panel_view', $data);
        $this->load->view('form_post_view', $data);
    }

    public function viewPost($postId) {
        $data['title'] = 'View post';
        $data['activeItem'] = 'postsItem';
        $data['postData'] = $this->post_model->getPost($postId);
        $this->load->view('user_head_view', $data);
        $this->load->view('user_panel_view', $data);
        $this->load->view('user_post_view', $data);
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
        $postId = $this->post_model->getLastPostId($this->session->userdata('user_id'));
        $this->viewPost($postId);
    }

    public function postsList() {
        $data['title'] = 'Posts';
        $data['head_menu'] = Elements::getMenu();
        $data['activeItem'] = 'postsItem';
        $data['postsList'] = $this->post_model->getAllPostsFromUser($this->session->userdata('user_id'));
        $this->load->view('user_head_view', $data);
        $this->load->view('user_panel_view', $data);
        $this->load->view('user_posts_list_view', $data);
    }

}

?>