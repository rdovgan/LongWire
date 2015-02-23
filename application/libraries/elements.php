<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Elements {

    public static function isLoggedIn($isLoggedIn) {
        if (!$isLoggedIn) {
            redirect('user/guest');
        }
    }

    public static function getMenu($isLoggedIn) {
        $data = array();
        if ($isLoggedIn) {
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

    public function getSign($post, $isAuthor) {
        $tiny = ($isAuthor) ? 'tiny' : '';
        $likes = '<button class="btn-none"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span><i>' . $post["post_likes"] . '</i></button>';
        $dislikes = '<button class="btn-none"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span><i>' . $post["post_dislikes"] . '</i></button>';
        $favs = '<button class="btn-none"><span class="glyphicon glyphicon-star" aria-hidden="true"></span><i>' . $post["post_fav"] . '</i></button>';
        $user = anchor('profile/user/' . $post['post_user'], '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>' . $post["post_user"]);
        $data = array('<div class="postSign like">' . $likes . '</div>',
            '<div class="postSign dislike">' . $dislikes . '</div>',
            '<div class="postSign fav">' . $favs . '</div>',
            '<div class="postSign ' . $tiny . '">', $user, '</div>');
        return $data;
    }

    public static function getCropLibrary() {
        $headElements = "<script src='" . base_url() . "js/jquery.Jcrop.js'></script>";
        $headElements .= "<link rel='stylesheet/less' type='text/css' href='" . base_url() . "css/jquery.Jcrop.css'>  ";
        return $headElements;
    }

    public static function qToArray($query) {
        if ($query->num_rows() > 0) {
            $items = array();
            foreach ($query->result() as $item) {
                array_push($items, (array) $item);
            }
            return $items;
        }
        return false;
    }

    public static function postToHtml($item, $likes, $dislikes, $favs, $isAuthor = false) {
        $result = '<div id="' . $item['post_id'] . '" class="post">';
        $result .= '<div class="col-md-12 postName" onclick="showPost(event);">' . $item['post_name'];
        $edit = anchor('post/editPost/' . $item['post_id'], '<span class="glyphicon glyphicon-pencil badgeEdit" aria-hidden="true"></span>');
        if($isAuthor){
            $result .= $edit;
        }
        $result .= '<div class="col-md-12 postDescription"' . ($item['post_desc'] != '' ? '' : 'hidden') . '>' . $item['post_desc'] . '</div></div>';
        $result .= '<p><div class="col-md-12 postBody">' . nl2br($item['post_body']) . '</div></p>';
        $tiny = ($isAuthor) ? 'tiny' : '';
        $isLiked = (in_array($item['post_id'], $likes));
        $liked = $isLiked ? 'glyphicon-arrow-up' : 'glyphicon-chevron-up';
        $isDisliked = (in_array($item['post_id'], $dislikes));
        $disliked = $isDisliked ? 'glyphicon-arrow-down' : 'glyphicon-chevron-down';
        $isFav = (in_array($item['post_id'], $favs));
        $fav = $isFav ? '' : '-empty';
        $result .= '<div class="postSign like ' . ($isLiked ? 'fill' : '') . '"><button class="btn-none"><span class="glyphicon ' . $liked . '" aria-hidden="true"></span><i>' . $item["post_likes"] . '</i></button></div>';
        $result .= '<div class="postSign dislike ' . ($isDisliked ? 'fill' : '') . '"><button class="btn-none"><span class="glyphicon ' . $disliked . '" aria-hidden="true"></span><i>' . $item["post_dislikes"] . '</i></button></div>';
        $result .= '<div class="postSign fav ' . ($isFav ? 'fill' : '') . '"><button class="btn-none"><span class="glyphicon glyphicon-star' . $fav . '" aria-hidden="true"></span><i>' . $item["post_fav"] . '</i></button></div>';
        $result .= '<div class="postSign ' . $tiny . '">' . anchor('profile/user/' . $item['post_user'], '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>' . $item["post_user"] . '</div>') . '</div>';
        echo $result;
    }

    public function getIP() {
        $ip = null;
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

}

?>