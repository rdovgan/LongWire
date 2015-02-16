<div id="postListLine" class="col-md-12 postListLine">
    <div id="postsOwn" class="col-md-3 postListButton current">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        <z>Own</z>
    </div>
    <div id="postsFavorite" class="col-md-3 postListButton">
        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
        <z>Favorite</z>
    </div>
    <div id="postsLiked" class="col-md-3 postListButton">
        <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
        <z>Liked</z>
    </div>
    <div id="postsOther" class="col-md-3 postListButton">
        <span class="glyphicon glyphicon-link" aria-hidden="true"></span>
        <z>Other</z>
    </div>
</div>
<div id="data" class='content'>
    <?php
    if (isset($postsList) && $postsList != false) {
        foreach ($postsList as $item):{
                $isAuthor = ($item['post_user'] == $this->session->userdata('user_login'));
                Elements::postToHtml($item, $likes, $dislikes, $favs, $isAuthor);
            }
        endforeach;
    } else {
        ?>
        <div class="fineText" style="text-align: center; margin-left: -20%;">Your haven't any posts</div>
    <?php }
    ?>

</div>
</body>
</html>