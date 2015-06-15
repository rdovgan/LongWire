<div class="col-md-12 postListLine" style="width: 100%;">
    <ul class="nav nav-tabs" style="padding-left: 30px;">
        <li class="active">
            <a href="#own_posts" data-toggle="tab">    
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <text>Own</text>
            </a>
        </li>
        <li>
            <a href="#fav_posts" data-toggle="tab">
                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                <text>Favorite</text>
            </a>
        </li>
        <li>
            <a href="#liked_posts" data-toggle="tab">
                <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                <text>Liked</text>
            </a>
        </li>
        <li>
            <a href="#best_posts" data-toggle="tab">
                <span class="glyphicon glyphicon-king" aria-hidden="true"></span>
                <text>Best</text>
            </a>
        </li>
    </ul>
</div>

<div id="data" class='content col-md-12' style="width: 100%;"> 
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="own_posts">
            <?php
            if (isset($postsList) && $postsList != false) {
                foreach ($postsList as $item): {
                        $isAuthor = ($item['post_user'] == $this->session->userdata('user_login'));
                        Elements::postToHtml($item, $likes, $dislikes, $favs, $isAuthor);
                    }
                endforeach;
            } else {
                ?>
                <div class="fineText">Your haven't any posts</div>
            <?php }
            ?>
        </div>
        <div class="tab-pane fade" id="fav_posts">        
            <?php
            if (isset($favPosts) && $favPosts != false) {
                foreach ($favPosts as $item): {
                        $isAuthor = ($item['post_user'] == $this->session->userdata('user_login'));
                        Elements::postToHtml($item, $likes, $dislikes, $favs, $isAuthor);
                    }
                endforeach;
            } else {
                ?>
                <div class="fineText">Your haven't any favorite posts</div>
            <?php }
            ?>
        </div>
        <div class="tab-pane fade" id="liked_posts">
            <?php
            if (isset($likedPosts) && $likedPosts != false) {
                foreach ($likedPosts as $item): {
                        $isAuthor = ($item['post_user'] == $this->session->userdata('user_login'));
                        Elements::postToHtml($item, $likes, $dislikes, $favs, $isAuthor);
                    }
                endforeach;
            } else {
                ?>
                <div class="fineText">Your haven't any liked posts</div>
            <?php }
            ?>
        </div>
        <div class="tab-pane fade" id="best_posts">
            <?php
            if (isset($bestPosts) && $bestPosts != false) {
                foreach ($bestPosts as $item): {
                        $isAuthor = ($item['post_user'] == $this->session->userdata('user_login'));
                        Elements::postToHtml($item, $likes, $dislikes, $favs, $isAuthor);
                    }
                endforeach;
            } else {
                ?>
                <div class="fineText">Your haven't any liked posts</div>
            <?php }
            ?>
        </div>
    </div>
</div>

</body>
</html>