<div id="data" class="content">
    <div class="posts">
        <?php
        if (isset($postsList) && $postsList != false) {
            foreach ($postsList as $item):
                ?>    
                <div id="<?php echo $item['post_id']; ?>" class="post">
                    <div class="col-md-12 postName" onclick="showPost(event);"><?php echo $item['post_name']; ?>
                        <?php
                        $isAuthor = $item['post_user'] == $this->session->userdata('user_login');
                        if ($isAuthor) {
                            echo anchor('post/editPost/' . $item['post_id'], '<span class="glyphicon glyphicon-pencil badgeEdit" aria-hidden="true"></span>');
                        }
                        ?>
                        <div class="col-md-12 postDescription" <?php echo($item['post_desc'] != '') ? '' : 'hidden'; ?>><?php echo $item['post_desc']; ?></div></div>
                    <pre><div class="col-md-12 postBody"><?php echo $item['post_body']; ?></div></pre>
                    <?php
                    $tiny = ($isAuthor) ? 'tiny' : '';
                    $isLiked = (in_array($item['post_id'], $likes)); $liked = $isLiked ? 'glyphicon-arrow-up' : 'glyphicon-chevron-up';
                    $isDisliked = (in_array($item['post_id'], $dislikes)); $disliked = $isDisliked ? 'glyphicon-arrow-down' : 'glyphicon-chevron-down';
                    $isFav = (in_array($item['post_id'], $favs)); $fav = $isFav ? '' : '-empty';
                    ?>
                                    <div class="postSign like <?php if($isLiked){ echo 'fill';} ?>"><button class="btn-none"><span class="glyphicon <?php echo $liked; ?>" aria-hidden="true"></span><i><?php echo $item["post_likes"]; ?></i></button></div>
                                    <div class="postSign dislike <?php if($isDisliked){ echo 'fill';} ?>"><button class="btn-none"><span class="glyphicon <?php echo $disliked; ?>" aria-hidden="true"></span><i><?php echo $item["post_dislikes"]; ?></i></button></div>
                                    <div class="postSign fav <?php if($isFav){ echo 'fill';} ?>"><button class="btn-none"><span class="glyphicon glyphicon-star<?php echo $fav; ?>" aria-hidden="true"></span><i><?php echo $item["post_fav"]; ?></i></button></div>
                                    <div class="postSign <?php echo $tiny; ?>"><?php echo anchor('profile/user/' . $item['post_user'], '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>' . $item["post_user"] . '</div>'); ?>
                                </div><?php
                endforeach;
            }
            ?>
    </div>
</div>