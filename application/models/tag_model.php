<?php

if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tag_model extends CI_Model{
    
    /*
     * TAGS
     * tag_id
     * tag_name
     * tag_big
     * tag_date
     */
    
    /*
     * POST_TAGS
     * post_tag_id
     * post_tag_post
     * post_tag_tag
     */
    
    public function __construct() {
        parent::__construct();
    }
    
    public function add($tag){
        $name = strtolower(trim($tag));
        if($this->get($name) != false){
            return;
        }
        $data = array(
            'tag_name' => $name
        );
        $this->db->insert('tags', $data);
        Events::log_message('debug', $tag.' was added to DB');
    }
    
    public function get($tag){
        $name = strtolower(trim($tag));
        $this->db->where('tag_name', $name);
        $query = $this->db->get('tags');
        if($query->num_rows() > 0){
            return (array) $query->row();
        }else{
            return false;
        }
    }
    
    public function getPostTag($tagId, $postId){
        $this->db->where('post_tag_post', $postId);
        $this->db->where('post_tag_tag', $tagId);
        $query = $this->db->get('post_tags');
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    
    public function addPostTag($tagId, $postId){
        if($this->getPostTag($tagId, $postId)){
            return;
        }
        $data = array(
            'post_tag_post' => $postId,
            'post_tag_tag' => $tagId
        );
        $this->db->insert('post_tags', $data);
    }
    
    public function addTagWithPost($tag, $postId){
        $this->add($tag);
        $tag_row = $this->get($tag);
        $this->addPostTag($tag_row['tag_id'], $postId);
    }
    
    public function addTagsWithPost($tags, $postId){
        $arr = preg_split("[,]", $tags);
        foreach ($arr as $item) {
            $item = trim($item);
            if ($item != '') {
                $this->addTagWithPost($item, $postId);
            }
        }
    }
    
}

