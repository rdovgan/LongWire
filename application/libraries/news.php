<?php

defined('BASEPATH') or exit('No direct script access allowed');

class News {

    public static function getWP() {
        $rss = new DOMDocument();
        $rss->load('http://purl.org/rss/1.0/modules/content/');
        $feed = array();
        foreach ($rss->getElementsByTagName('item') as $node) {
            $item = array(
                'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
                'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                'category' => $node->getElementsByTagName('category')->item(0)->nodeValue,
                'comment' => $node->getElementsByTagName('comments')->item(0)->nodeValue
            );
            array_push($feed, $item);
        }
        return $feed;
    }

    public static function getWPnews($limit, $page=0) {
        if (!isset($limit) || $limit <= 0) {
            return false;
        }
        //$feed = News::getWP();
        if (!isset($page) || $page <= 0) {
            return null;//array_slice($feed, 0, $limit);
        } else {
            return null;//array_slice($feed, ($page - 1) * $limit, $limit * $page);
        }
    }
}
?>