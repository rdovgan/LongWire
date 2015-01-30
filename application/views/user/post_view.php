<div id="data" class='content'>
    <?php
    if (isset($postData) && $postData != false) {
        ?>    
        <div class = "post">
            <div class = "col-md-12 postName" onclick = "description(event);"><?php echo $postData['post_name'];
        ?>
                <?php echo anchor('post/editPost/' . $postData['post_id'], '#'); ?>
                <div class="col-md-12 postDescription" hidden="true"><?php echo $postData['post_desc']; ?></div></div>
            <pre><div class="col-md-12 postBody"><?php echo $postData['post_body']; ?></div></pre>
            </div>
        <?php
    } else {
        ?>
            <div class="fineText" style="text-align: center; margin-left: -20%;">Your haven't any posts</div>
    <?php }
    ?>
</div>