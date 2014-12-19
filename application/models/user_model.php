<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
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

    public function add_user() {
        $data = array(
            'user_login' => $this->input->post('user_name'),
            'user_pass' => md5($this->input->post('password'))
        );
        $this->db->insert('users', $data);
    }

}
?>