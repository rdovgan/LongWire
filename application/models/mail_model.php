<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mail_model extends CI_Model {
    /*
     * MAILS
     * mail_id
     * mail_email
     * mail_last_log_in  
     * mail_ip
     * mail_access
     * mail_user_id
     */

    public function __construct() {
        parent::__construct();
    }

    function addMail($userId) {
        $name = $this->input->post('mail_email');
        $date = date("Y-m-d H:i:s");
        $ip = Elements::getIP();
        $visibility = ($this->input->post('mail_access')) ? 1 : 2;
        $data = array(
            'mail_email' => $name,
            'mail_last_log_in' => $date,
            'mail_ip' => $ip,
            'mail_access' => $visibility,
            'mail_user_id' => $userId
        );
        if ($this->getMailByName($name)){
            return;
        }
        $this->db->insert('mails', $data);
    }

    public function getMail($mailId) {
        $this->db->where('mail_id', $mailId);
        $query = $this->db->get('mails');
        $row = (array) $query->row();
        return $row;
    }

    public function getMailByName($name) {
        $this->db->where('mail_email', $name);
        $query = $this->db->get('mails');
        $row = (array) $query->row();
        return $row;
    }

    public function getMailsByUser($userId) {
        $this->db->where('mail_user_id', $userId);
        $query = $this->db->get('mails');
        if ($query->num_rows() > 0) {
            $mails = array();
            foreach ($query->result() as $rows) {
                $rows = (array) $rows;
                array_push($mails, $rows);
            }
            return $mails;
        }
        return false;
    }

    function deleteMail($mailId) {
        $this->db->where('mail_id', $mailId);
        $userId = $this->db->get('mails')->row()->mail_user_id;
        $this->db->where('mail_user_id', $userId);
        $query = $this->db->get('mails');
        if ($query->num_rows() == 1) {
            return 'single';
        }
        $this->db->trans_start();
        $this->db->where('mail_id', $mailId);
        $this->db->delete('mails');
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            return 'not';
        } else {
            return 'finish';
        }
    }

    function changeVisibility($mailId) {
        $mail = $this->getMail($mailId);
        $visib = $mail['mail_access'];
        $mail['mail_access'] = ($visib == 1) ? 2 : 1;
        $this->db->where('mail_id', $mailId);
        $this->db->update('mails', $mail);
        return $visib;
    }

}

?>