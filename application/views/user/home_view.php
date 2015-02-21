<div id="data" class="content">
    <div class="posts">
        <?php
        if (isset($postsList) && $postsList != false) {
            foreach ($postsList as $item):{
                $isAuthor = ($item['post_user'] == $this->session->userdata('user_login'));
                Elements::postToHtml($item, $likes, $dislikes, $favs, $isAuthor);
            }
            endforeach;
        }
        ?>
    </div>
</div>