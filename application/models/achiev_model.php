<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Achiev_model extends CI_Model {
    /*
     * USER_ACH
     * user_ach_id
     * ach_id
     * user_id
     * got
     * 
     * ACHIEVS
     * achievs_id
     * achievs_name
     * achievs_desc
     * achievs_group
     */

    public function __construct() {
        parent::__construct();
    }

    function getAllAchievs() {
        $query = $this->db->get("achievs");
        if ($query->num_rows() > 0) {
            $achievs = array();
            foreach ($query->result() as $rows) {
                array_push($achievs, $rows); //achievs_id, achievs_name, achievs_desc, achievs_group
            }
            return $achievs;
        }
        return false;
    }

    function isContain($elem, $arr) {
        if (($arr == false) || ($elem == false)) {
            return false;
        }
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $item = (array) $item;
                if ($item['ach_id'] == $elem) {
                    return true;
                }
            }
        }
        return false;
    }

    function getDateQuery($ach_id, $arr) {
        if (($arr == false) || ($ach_id == false)) {
            return '';
        }
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $item = (array) $item;
                if ($item['ach_id'] == $ach_id) {
                    return $item['got'];
                }
            }
        }
        return false;
    }

    function getUserAchTable($user_id) {
        $this->db->where("user_id", $user_id);
        $query = $this->db->get("user_ach");
        if ($query->num_rows() > 0) {
            $result = array();
            foreach ($query->result() as $rows) {
                array_push($result, $rows); //user_ach_id, ach_id, got
            }
            return $result;
        }
        return false;
    }

    function getUserAchId($user_id) {
        $this->db->where("user_id", $user_id);
        $query = $this->db->get("user_ach");
        if ($query->num_rows() > 0) {
            $result = array();
            foreach ($query->result() as $rows) {
                $rows = (array) $rows;
                array_push($result, $rows['ach_id']); //user_ach_id, ach_id, got
            }
            return $result;
        }
        return false;
    }

    function getUserAchievs($user_id) {
        if (!isset($user_id)) {
            $user_id = $this->session->userdata('user_id');
        }
        $user_ach = $this->getUserAchTable($user_id);
        $achievs = $this->getAllAchievs();
        $result = array();
        if ($achievs != false) {
            foreach ($achievs as $ach) {
                $ach = (array) $ach;
                $item = array(
                    'ach_name' => $ach['achievs_name'],
                    'ach_desc' => $ach['achievs_desc'],
                    'ach_gr' => $ach['achievs_group'],
                    'ach_got' => $this->getDateQuery($ach['achievs_id'], $user_ach),
                    'ach_checked' => ($this->isContain($ach['achievs_id'], $user_ach)) ? 'true' : 'false'
                );
                array_push($result, $item);
            }
        }
        return $result;
    }

    function gotAchiev($achId, $userId) {
        $this->db->where('user_id', $userId);
        $this->db->where('ach_id', $achId);
        $query = $this->db->get('user_ach');
        if ($query->num_rows() > 0) {
            return;
        }
        $date = date("Y-m-d H:i:s");
        $data = array(
            'user_id' => $userId,
            'ach_id' => $achId,
            'got' => $date
        );
        $this->db->insert('user_ach', $data);
        Events::log_message('debug', 'Was written to DB');
        //call dialog 'success'
    }

}

?>