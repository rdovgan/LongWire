<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Elements {

    public static function isLoggedIn($isLoggedIn) {
        if (!$isLoggedIn) {
            redirect('user/guest');
        }
    }

    public static function makeBtn($data) {
        return '<div class="headerElement">' . $data . '</div>';
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
            $data = array(Elements::makeBtn($createPost), Elements::makeBtn($userLink), Elements::makeBtn($logoutLink));
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

    public static function postToHtml($item, $likes, $dislikes, $favs, $isAuthor = false, $rang = 10) {
        $result = '<div id="' . $item['post_id'] . '" class="col-md-12 post">';
        $result .= '<div class="col-md-12 postName" onclick="showPost(event);">';
        $result .= '<div class="btnOpenPost"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span></div>' . $item['post_name'];
        $edit = anchor('post/editPost/' . $item['post_id'], '<span class="glyphicon glyphicon-pencil badgeEdit" aria-hidden="true"></span>');
        if ($isAuthor) {
            $result .= $edit;
        }
        $tiny = ($isAuthor) ? 'tiny' : '';
        $isLiked = (in_array($item['post_id'], $likes));
        $isDisliked = (in_array($item['post_id'], $dislikes));
        $isFav = (in_array($item['post_id'], $favs));
        $fav = $isFav ? '' : '-empty';
        $isHidden = (intval($item["post_likes"]) < $rang) ? false : true; //Some option, may be load from session in future
        $result .= '<div class="col-md-12 postDescription"' . ($item['post_desc'] != '' ? '' : 'hidden') . '>' . $item['post_desc'] . '</div></div>';
        $result .= '<div class="col-md-12 postBody" ' . ($isHidden ? '' : 'hidden') . '>' . nl2br($item['post_body']) . '</div>';
        $result .= '<div class="postSignGlob"><div class="postSign like ' . ($isLiked ? 'fill' : '') . '"><button class="btn-none"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span><i>' . $item["post_likes"] . '</i></button></div>';
        $result .= '<div class="postSign dislike ' . ($isDisliked ? 'fill' : '') . '"><button class="btn-none"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span><i>' . $item["post_dislikes"] . '</i></button></div>';
        $result .= '<div class="postSign fav ' . ($isFav ? 'fill' : '') . '"><button class="btn-none"><span class="glyphicon glyphicon-star' . $fav . '" aria-hidden="true"></span><i>' . $item["post_fav"] . '</i></button></div>';
        $result .= '<div class="postSign ' . $tiny . '">' . anchor('profile/user/' . $item['post_user'], '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>' . $item["post_user"] . '</div>') . '</div>';
        $result .= '<div class="postTags">' . Elements::getTags($item['post_tags']) . '</div></div>';
        echo $result;
    }

    public static function newToHtml($item) {
        $result = '<div id="' . $item['new_id'] . '" class="col-md-12 new">';
        $result .= '<div class="col-md-12 newName">' . $item['new_name'] . '</div>';
        $result .= '<div class="col-md-12 newBody">' . nl2br($item['new_body']) . '</div>';
        $result .= '<div class="col-md-6 newDate">' . $item['new_date'] . '</div>';
        $result .= '<div class="col-md-6 newUser">' . anchor('profile/user/' . $item['new_user'], 
                '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>' 
                . $item["new_user"] . '</div>') . '</div><div class="br"></div>';
        echo $result;
    }

    public static function postOnly($item, $likes, $dislikes, $favs, $isAuthor = false) {
        $result = '<div id="' . $item['post_id'] . '" class="post col-md-12">';
        $result .= '<div class="col-md-12 postName" onclick="showPost(event);">' . $item['post_name'];
        $edit = anchor('post/editPost/' . $item['post_id'], '<span class="glyphicon glyphicon-pencil badgeEdit" aria-hidden="true"></span>');
        $result .= ($isAuthor) ? $edit : '';
        $isLiked = (in_array($item['post_id'], $likes));
        $isDisliked = (in_array($item['post_id'], $dislikes));
        $isFav = (in_array($item['post_id'], $favs));
        $fav = $isFav ? '' : '-empty';
        $result .= '<div class="col-md-12 postDescription"' . ($item['post_desc'] != '' ? '' : 'hidden') . '>' . $item['post_desc'] . '</div></div>';
        $result .= '<div class="col-md-12 postBody">' . nl2br($item['post_body']) . '</div>';
        $result .= '<div class="postSignGlob col-md-4"><div class="postSign like ' . ($isLiked ? 'fill' : '') . '"><button class="btn-none"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span><i>' . $item["post_likes"] . '</i></button></div>';
        $result .= '<div class="postSign dislike ' . ($isDisliked ? 'fill' : '') . '"><button class="btn-none"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span><i>' . $item["post_dislikes"] . '</i></button></div>';
        $result .= '<div class="postSign fav ' . ($isFav ? 'fill' : '') . '"><button class="btn-none"><span class="glyphicon glyphicon-star' . $fav . '" aria-hidden="true"></span><i>' . $item["post_fav"] . '</i></button></div>';
        $result .= '<div class="postSign ' . (($isAuthor) ? 'tiny' : '') . '">' . anchor('profile/user/' . $item['post_user'], '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>' . $item["post_user"] . '</div>') . '</div>';
        $result .= '<div class="col-md-8 postTags">' . Elements::getTags($item['post_tags']) . '</div></div>';
        echo $result;
    }

    public static function getTags($tags) {
        $arr = preg_split("[,]", $tags);
        $result = '';
        foreach ($arr as $item) {
            if ($item != '') {
                $result .= '<div class="postTag">' . $item . '</div>';
            }
        }
        return $result;
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