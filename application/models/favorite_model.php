<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Favorite_model extends CI_Model {
    /*
     * FAVORITES
     * fav_id
     * fav_user
     * fav_post
     */

    public function __construct() {
        parent::__construct();
    }
    
    public function isFav($postId){
        $userId = $this->session->userdata('user_id');
        $this->db->where('fav_user', $userId);
        $this->db->where('fav_post', $postId);
        $query = $this->db->get('favorites');
        if($query->num_rows() > 0){
            return true;
        }
        return false;
    }
    
    public function setFav($postId){
        $userId = $this->session->userdata('user_id');        
        $data = array(
            'fav_user' => $userId,
            'fav_post' => $postId
        );
        $this->db->insert('favorites', $data);
    }
    
    public function unsetFav($postId){
        $userId = $this->session->userdata('user_id');
        $this->db->where('fav_post', $postId);
        $this->db->where('fav_user', $userId);
        $this->db->delete('favorites');
    }    

    public function addFav($postId) {
        $this->db->where('post_id', $postId);
        $post = $this->db->get('posts');
        $data = array(
            'post_fav' => $post->row()->post_fav + 1
        ); //or do recalculation based on FAVORITES table
        $this->db->where('post_id', $postId);
        $this->db->update('posts', $data);
    }

    public function removeFav($postId) {
        $this->db->where('post_id', $postId);
        $post = $this->db->get('posts');
        $data = array(
            'post_fav' => $post->row()->post_fav - 1
        ); //or do recalculation based on FAVORITES table
        $this->db->where('post_id', $postId);
        $this->db->update('posts', $data);
    }
    
    public function fav($postId){
        if($this->isFav($postId)){
            $this->unsetFav($postId);
            $this->removeFav($postId);
            return 'dec';
        }else{
            $this->setFav($postId);
            $this->addFav($postId);
            return 'inc';
        }
    }
}
?>