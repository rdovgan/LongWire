<div id="data" class='content col-md-12'>

    <?php $isPost = isset($postData) && $postData != false; ?>
    <div class="bigText">
        <?php
        if (!$isPost) {
            echo 'Create new post';
        } else {
            echo 'Update this post';
        }
        ?>
    </div>
    <?php
    if (!$isPost) {
        echo form_open("post/addPost");
    } else {
        echo '<a href="#" data-toggle="modal" data-target="#deleteModal"><span class="glyphicon glyphicon-trash badgeDelete" aria-hidden="true"></span></a>';
        //echo anchor('post/deletePost/' . $postData['post_id'], '<span class="glyphicon glyphicon-trash badgeDelete" aria-hidden="true"></span>');
        echo form_open("post/updatePost");
    }
    ?>
    <div id="personForm" class="col-md-12" style="padding-top: 0; font-family: Consolas;">
        <div class="input-group input-group-sm col-md-12">
            <input id="post_name" name="post_name" class="form-control col-md-12" 
            <?php
            if ($isPost) {
                echo 'value="' . $postData['post_name'] . '"';
            }
            ?> type="text" minlength="4" maxlength="120" required
                   data-validation-required-message="Post name is required" placeholder="Name of post"> </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <input id="post_desc" name="post_desc" class="form-control col-md-12" 
            <?php
            if ($isPost) {
                echo 'value="' . $postData['post_desc'] . '"';
            }
            ?> type="text" maxlength="160" placeholder="Add some description, if needed"> </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <textarea id="post_body" name="post_body" class="form-control col-md-12" 
                      rows="10" style="height: 280px;" minlength="4" maxlength="1200" required
                      data-validation-required-message="Post body is required" placeholder="Your post is here"><?php
                          if ($isPost) {
                              echo $postData['post_body'];
                          }
                          ?></textarea> </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <input id="post_tags" name="post_tags" class="form-control col-md-12" 
            <?php
            if ($isPost) {
                echo 'value="' . $postData['post_tags'] . '"';
            }
            ?> type="text" minlength="2" maxlength="120" required
                   data-validation-required-message="At least 1 tag is required" placeholder="Tags"> </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <input name="submit" class="btn btn-danger col-md-2" type="submit" value="
            <?php
            if ($isPost) {
                echo 'Save';
            } else {
                echo 'Create';
            }
            ?>">
            <a href="#" style="font-size: 32px; float: right;">
                <span style="margin-right: 0px;" class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
            </a>
        </div>
        <?php if ($isPost) { ?> 
            <input type="hidden" name="post_id" value="<?php echo $postData['post_id']; ?>" >
        <?php } ?>
    </div>
    <?php echo form_close(); ?>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Warning</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this post: "<?php echo $postData['post_name']; ?>"?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <?php echo anchor('post/deletePost/' . $postData['post_id'], '<button type="button" class="btn btn-primary">Delete</button>'); ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>