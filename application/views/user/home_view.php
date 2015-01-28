<div id="data" class="content">
    <div class="bigText">Home page with usefull info</div>
    <?php echo 'openssl: ',  extension_loaded  ('openssl') ? 'yes':'no', "\n";
    if (!isset($wp_news) || $wp_news == false) {
        echo "Can't load news for you";
    } else {
        $count = count($wp_news);
        for ($i = 0; $i < $count; $i++) {
            $title = str_replace(' & ', ' &amp; ', $wp_news[$i]['title']);
            $link = $wp_news[$i]['link'];
            $description = $wp_news[$i]['desc'];
            $date = date('l F d, Y', strtotime($wp_news[$i]['date']));
            echo '<p><strong><a href="' . $link . '" title="' . $title . '">' . $title . '</a></strong><br />';
            echo '<small><em>Posted on ' . $date . '</em></small></p>';
            echo '<p>' . $description . '</p>';
        }
    }
    ?>
</div>