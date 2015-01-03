<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    /*
     * USERS
     * user_id
     * user_login
     * user_pass
     * user_hash
     * user_ip
     */
    
    public function __construct() {
        parent::__construct();
    }
    
    function checkLogin($username){
        $this->db->where("user_login", $username);
        $query = $this->db->get("users");
        if($query->num_rows() > 0){
            return true;
        }
        return false;
    }
    
    function login($username, $password) {
        $this->db->where("user_login", $username);
        $this->db->where("user_pass", $password);

        $query = $this->db->get("users");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                //add all data to session
                $newdata = array(
                    'user_id' => $rows->user_id,
                    'user_name' => $rows->user_login,
                    'logged_in' => TRUE,
                );
            }
            $this->session->set_userdata($newdata);
            return true;
        }
        return false;
    }

    public function add_user($userId) {
        $data = array(
            'user_login' => $this->input->post('user_name'),
            'user_pass' => md5($this->input->post('password'))
        );
        $this->db->insert('users', $data);
        
    }

}
?>