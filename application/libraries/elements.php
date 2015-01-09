<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Elements {
    
    public function isLoggedIn() {
        return $this->session->userdata('logged_in');
    }
    
    public function getMenu() {
        $data = array();
        if (self::isLoggedIn()) {
            $userLink = anchor(
                    "user/profile", '<h4><span class="glyphicon glyphicon-user" aria-hidden="true"></span></h4><h6 hidden><span class="glyphicon glyphicon-info-sign badgeInfo" aria-hidden="true"></span></h6>', array('id' => 'userLink', 'class' => 'invlink')
            );
            $logoutLink = anchor(
                    "user/logout", '<h4><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></h4>', array('id' => 'logoutLink', 'class' => 'invlink')
            );
            $data = array(
                '<div class="headerElement">', $userLink, '</div>',
                '<div class="headerElement">', $logoutLink, '</div>'
            );
        } else {
            $data = array(
                '<button id = "btnRegister" class="btn btn-sm btnRegister">Sign Up</button>',
                '<button id = "btnLogin" class="btn btn-sm btn-danger btnLogin">Sign In</button>'
            );
        }
        return $data;
    }

}

?>