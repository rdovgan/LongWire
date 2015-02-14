<div id="data" class="content">
    <div class="posts">
        <?php
        if (isset($postsList) && $postsList != false) {
            foreach ($postsList as $item):
                Elements::postToHtml($item, $likes, $dislikes, $favs);
            endforeach;
        }
        ?>
    </div>
</div>