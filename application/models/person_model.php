<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Person_model extends CI_Model {
    /*
     * PERSONS
     * person_id
     * person_name
     * person_surname
     * person_birth
     * person_gender
     * person_user_id
     */

    public function __construct() {
        parent::__construct();
    }

    function getId() {
        $this->db->where("person_user_id", $this->session->userdata('user_id'));
        $query = $this->db->get("person");
        if ($query->num_rows() > 0) {
            return $query->row()->person_id;
        }
        return false;
    }

    function getPerson($userId) {
        $this->db->where("person_user_id", $userId);
        $query = $this->db->get("person");
        if ($query->num_rows() > 0) {
            return $query->row(); //return first result
        }
    }

    function addPerson($userId) {
        $data = array(
            'person_name' => $this->input->post('person_name'),
            'person_surname' => $this->input->post('person_surname'),
            'person_birth' => $this->input->post('person_birth'),
            'person_gender' => $this->input->post('person_gender'),
            'person_user_id' => $userId
        );
        $personId = $this->getId();
        if ($personId) {
            $this->db->where("person_id", $personId);
            $this->db->update("persons", $data);
        } else {
            $this->db->insert('persons', $data);
        }
    }

}
?>

