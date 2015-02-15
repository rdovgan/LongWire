<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Post extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('user_model');
        $this->load->model('achiev_model');
        $this->load->model('post_model');
        $this->load->model('likes_model');
        $this->load->model('favorite_model');
    }

    public function formPost() {
        Elements::isLoggedIn($this->session->userdata('logged_in'));
        $data['head_menu'] = Elements::getMenu($this->session->userdata('logged_in'));
        $data['title'] = 'Create new post';
        //add activeItem
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/post_form_view', $data);
    }

    public function viewPost($postId) {
        Elements::isLoggedIn($this->session->userdata('logged_in'));
        $data['head_menu'] = Elements::getMenu($this->session->userdata('logged_in'));
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

    public function updatePost() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('post_name', 'Post name', 'trim|required|min_length[1]|max_length[120]');
        $this->form_validation->set_rules('post_desc', 'Description of post', 'trim|max_length[160]');
        $this->form_validation->set_rules('post_body', 'Post', 'trim|required|min_length[4]|max_length[1200]');
        $this->form_validation->set_rules('post_tags', 'Tags', 'trim|required|min_length[4]|max_length[120]');

        if ($this->form_validation->run() == FALSE) {
            $this->formPost();
        } else {
            $postId = $this->post_model->updatePost();
            $this->viewPost($postId);
        }
    }

    public function editPost($postId) {
        Elements::isLoggedIn($this->session->userdata('logged_in'));
        if (!$this->post_model->checkBeforeEdit($postId, $this->session->userdata('user_login'))) {
            $this->postsList();
        } else {
            $postData = $this->post_model->getPost($postId);
            $data['head_menu'] = Elements::getMenu($this->session->userdata('logged_in'));
            $data['title'] = 'Posts';
            $data['postData'] = $postData;
            $this->load->view('user/head_view', $data);
            $this->load->view('user/panel_view', $data);
            $this->load->view('user/post_form_view', $data);
        }
    }

    public function lastPost() {
        Elements::isLoggedIn($this->session->userdata('logged_in'));
        $data['head_menu'] = Elements::getMenu($this->session->userdata('logged_in'));
        $postId = $this->post_model->getLastPostId($this->session->userdata('user_id'));
        $this->viewPost($postId, $data);
    }

    public function postsList() {
        Elements::isLoggedIn($this->session->userdata('logged_in'));
        $userId = $this->session->userdata('user_id');
        $data['title'] = 'Posts';
        $data['head_menu'] = Elements::getMenu($this->session->userdata('logged_in'));
        $data['activeItem'] = 'postsItem';
        $data['postsList'] = $this->post_model->getAllPostsFromUser($userId);
        $data['likes'] = $this->likes_model->getLikesOfUser($userId);
        $data['dislikes'] = $this->likes_model->getDislikesOfUser($userId);
        $data['favs'] = $this->favorite_model->getFavsOfUser($userId);
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/posts_list_view', $data);
    }

    public function allPosts() {
        Elements::isLoggedIn($this->session->userdata('logged_in'));
        $userId = $this->session->userdata('user_id');
        $data['title'] = 'Dashboard';
        $data['head_menu'] = Elements::getMenu($this->session->userdata('logged_in'));
        $data['activeItem'] = 'profileItem';
        $data['postsList'] = $this->post_model->getAllPosts();
        $data['likes'] = $this->likes_model->getLikesOfUser($userId);
        $data['dislikes'] = $this->likes_model->getDislikesOfUser($userId);
        $data['favs'] = $this->favorite_model->getFavsOfUser($userId);
        $this->load->view('user/head_view', $data);
        $this->load->view('user/panel_view', $data);
        $this->load->view('user/home_view', $data);
    }

    public function deletePost($postId) {
        Elements::isLoggedIn($this->session->userdata('logged_in'));
        if ($this->post_model->checkBeforeEdit($postId, $this->session->userdata('user_login'))) {
            $this->post_model->deletePost($postId);
        }
        $this->postsList();
    }

    public function up($postId) {
        echo $this->likes_model->up($postId);
    }
    
    public function down($postId){
        echo $this->likes_model->down($postId);
    }
    
    public function fav($postId){
        echo $this->favorite_model->fav($postId);
    }

}

?>