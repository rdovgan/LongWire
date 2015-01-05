<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Post_model extends CI_Model {
    
    /*
     * POST
     * post_id
     * post_user_id
     * post_date
     * post_name
     * post_desc
     * post_body
     * post_likes
     * post_dislikes
     * post_fav
     * post_tags
     */    
    
    public function __construct() {
        parent::__construct();
    }
    
    public function addPost($userId){
        $date = date("Y-m-d H:i:s");
        $data = array(
            'post_user_id' => $userId,
            'post_date' => $date,
            'post_name' => $this->input->post('post_name'),
            'post_desc' => $this->input->post('post_desc'),
            'post_body' => $this->input->post('post_body'),
            'post_tags' => $this->input->post('post_tags')            
        );
        $this->db->insert('posts', $data);
    }
    
}
?>

