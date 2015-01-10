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
    
    public function getLastPostId($userId){
        $query = $this->db->query('SELECT post_id FROM posts WHERE post_user_id = '.$userId.' ORDER BY post_date DESC LIMIT 1');
        return $query->row()->post_id;
    }
    
    public function addPost(){
        $userId = $this->session->userdata('user_id');
        $date = date("Y-m-d H:i:s");
        $data = array(
            'post_user_id' => $userId,
            'post_date' => $date,
            'post_name' => $this->input->post('post_name'),
            'post_desc' => $this->input->post('post_desc'),
            'post_body' => $this->input->post('post_body'),
            'post_tags' => $this->input->post('post_tags')            
        );
        return $this->db->insert('posts', $data);
        //return postId //if postId doesn't return - get last post by data
    }
    
    public function getPost($postId){
        $this->db->where('post_id',$postId);
        $query = $this->db->get('posts');
        return (array)$query->row();
    }
    
    public function deletePost($postId){
        
    }
    
    public function getAllPostsFromUser($userId){
        $this->db->where('post_user_id',$userId);
        $query = $this->db->get('posts');
        if ($query->num_rows() > 0) {
            $posts = array();
            foreach ($query->result() as $rows) {
                array_push($posts, (array)$rows);
            }
            return (array)$posts;
        }
        return false;
    }
    
    /*  
     * $order - can be by time, popularity, top rated, most favoutites
     * $limit - count of posts on page
     */
    public function getAllPostsLimit($order, $limit){
        
    }
    
    public function updatePost($postId, $name, $desc, $body, $tags){
        
    }
}
?>