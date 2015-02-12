<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Elements {

    public function isLoggedIn() {
        if (!$this->session->userdata('logged_in')) {
            redirect('user/guest');
        }
    }

    public function getMenu() {
        $data = array();
        if ($this->session->userdata('logged_in')) {
            $createPost = '<a href="#" onclick="createPostDialog();"><h4><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></h4></a>';
            $userLink = anchor(
                    "user/profile", '<h4><span class="glyphicon glyphicon-user" aria-hidden="true"></span></h4><h6 hidden><span class="glyphicon glyphicon-info-sign badgeInfo" aria-hidden="true"></span></h6>', array('id' => 'userLink', 'class' => 'invlink')
            );
            $logoutLink = anchor(
                    "user/logout", '<h4><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></h4>', array('id' => 'logoutLink', 'class' => 'invlink')
            );
            $data = array(
                '<div class="headerElement">', $createPost, '</div>',
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
    
    public function getSign($post, $isAuthor){
        $tiny = ($isAuthor)?'tiny':'';
        $likes = '<button class="btn-none"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span><i>'.$post["post_likes"].'</i></button>';
        $dislikes = '<button class="btn-none"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span><i>'.$post["post_dislikes"].'</i></button>';
        $favs = '<button class="btn-none"><span class="glyphicon glyphicon-star" aria-hidden="true"></span><i>'.$post["post_fav"].'</i></button>';
        $user = anchor('profile/user/'.$post['post_user'], '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>'.$post["post_user"]);
        $data = array('<div class="postSign like">'.$likes.'</div>',
            '<div class="postSign dislike">'.$dislikes.'</div>',
            '<div class="postSign fav">'.$favs.'</div>',
            '<div class="postSign '.$tiny.'">',$user,'</div>');
        return $data;
    }

}

?>