<div id="data" class="content">
    <div class="posts">
        <?php
        if (isset($postsList) && $postsList != false) {
            foreach ($postsList as $item):
                ?>    
                <div class="post">
                    <div class="col-md-12 postName" onclick="description(event);"><?php echo $item['post_name']; ?>
                        <?php echo anchor('post/editPost/' . $item['post_id'], '<span class="glyphicon glyphicon-info-sign badgeInfo" style="float: right;" aria-hidden="true"></span>');
                        ?>
                        <div class="col-md-12 postDescription" hidden="true"><?php echo $item['post_desc']; ?></div></div>
                    <pre><div class="col-md-12 postBody"><?php echo $item['post_body']; ?></div></pre>
                    </div>
                    <div class="divider"></div>
                <?php
            endforeach;
        }
        ?>
    </div>
</div>