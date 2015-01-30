<div id="data" class='content'>
    
    <?php $isPost = isset($postData) && $postData != false; ?>
    <div class="bigText"><?php if(!$isPost){echo 'Create new post';}else{echo 'Update this post';} ?></div>
    
    <?php if(!$isPost) {echo form_open("post/addPost");} else {echo form_open("post/updatePost");} ?>
    <div id="personForm" class="col-md-12" style="padding-top: 0; font-family: Consolas;">
        <div class="input-group input-group-sm col-md-12">
            <input id="post_name" name="post_name" class="form-control col-md-12" 
                   <?php if($isPost){echo 'value="'.$postData['post_name'].'"';} ?> type="text" placeholder="Name of post"> </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <input id="post_desc" name="post_desc" class="form-control col-md-12" 
                   <?php if($isPost){echo 'value="'.$postData['post_desc'].'"';} ?> type="text" placeholder="Add some description, if needed"> </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <textarea id="post_body" name="post_body" class="form-control col-md-12" 
                   rows="10" style="height: 280px;" placeholder="Your post is here"><?php if($isPost){echo $postData['post_body'];} ?> </textarea> </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <input id="post_tags" name="post_tags" class="form-control col-md-12" 
                   <?php if($isPost){echo 'value="'.$postData['post_tags'].'"';} ?> type="text" placeholder="Tags"> </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <input name="submit" class="btn btn-danger col-md-2" type="submit" value="<?php if($isPost){echo 'Save';} else{echo 'Create';} ?>">
            <a href="#" style="font-size: 32px; float: right;">
                <span style="margin-right: 0px;" class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
            </a>
        </div>
        <?php if($isPost){ ?> 
            <input type="hidden" name="post_id" value="<?php echo $postData['post_id']; ?>" >
        <?php } ?>
    </div>
    <?php echo form_close(); ?>
</div>
</body>
</html>