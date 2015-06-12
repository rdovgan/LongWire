<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class New_model extends CI_Model {
    /*
     * NEWS
     * new_id
     * new_user_id
     * new_date
     * new_name
     * new_body
     */
    
    public function __construct() {
        parent::__construct();
    }    
    
    public function addNew() {
        $userId = $this->session->userdata('user_id');
        $date = date("Y-m-d H:i:s");
        $data = array(
            'new_user_id' => $userId,
            'new_date' => $date,
            'new_name' => $this->input->post('new_name'),
            'new_body' => $this->input->post('new_body')
        );
        $this->db->insert('news', $data);
        $id = $this->db->insert_id();
        return $id;
    }
        
    public function getNew($newId) {
        $this->db->where('new_id', $newId);
        $query = $this->db->get('news');
        $row = (array) $query->row();
        $row['new_user'] = Post_model::getUserName($row['new_user_id']);
        return $row;
    }
    
    public function updateNew() {
        $data = array(
            'new_name' => $this->input->post('new_name'),
            'new_body' => $this->input->post('new_body')
        );
        $newId = $this->input->post('new_id');
        $this->db->where('new_id', $newId);
        $this->db->update('news', $data);
        return $newId;
    }
    
    public function getAllNews() {
        $this->db->order_by('new_date','desc');
        $query = $this->db->get('news');
        if ($query->num_rows() > 0) {
            $news = array();
            foreach ($query->result() as $rows) {
                $rows = (array) $rows;
                $rows['new_user'] = $this->getUserName($rows['new_user_id']);
                array_push($news, $rows);
            }
            return $news;
        }
        return false;
    }
    
    public function getLastNews($page = 0) {
        $this->db->order_by('new_date','desc');
        $query = $this->db->get('news',10,10*($page));
        if ($query->num_rows() > 0) {
            $news = array();
            foreach ($query->result() as $rows) {
                $rows = (array) $rows;
                $rows['new_user'] = $this->getUserName($rows['new_user_id']);
                array_push($news, $rows);
            }
            return $news;
        }
        return false;
    }    
    
    public function getUserName($userId) {
        $this->db->where('user_id', $userId);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return $query->row()->user_login;
        }
        return 'unknown';
    }
}