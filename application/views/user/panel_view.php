<div id="userPanel">
    <div class="panelTitle">PAGES</div>
    <ul class="nav nav-pills nav-stacked">
        <li id="profileItem"><?php echo anchor('user/profile', '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>Dashboard') ?></li>
        <li id="messagesItem"><?php echo anchor('user/messages', '<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>Messages') ?></li>
        <?php echo anchor('post/formPost', '<button id="btnCreatePost" class="btn btn-sm">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        </button>'); ?>
        <li id="postsItem"><?php echo anchor('post/postsList', '<span class="glyphicon glyphicon-book" aria-hidden="true"></span>Posts') ?></li>
        <li id="userItem"><?php echo anchor('profile/search', '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>People') ?></li>
        <li id="personItem"><?php echo anchor('user/person', '<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>Person') ?></li>
        <li id="achievItem"><?php echo anchor('user/achiev', '<span class="glyphicon glyphicon-star" aria-hidden="true"></span>Achievements') ?></li>
    </ul>
    <script>var activeItem = "<?php echo $activeItem; ?>";
        var upUrl = '<?php echo anchor("post/up"); ?>';
    </script>
</div>



<div id="modalPost" class="modal fade right">
    <div id="modalPostCreate" class="modal-dialog">
        <div id="modalContentPost" class="modal-content" style="margin-top: 10%;">
            <div id="postCreate" class="col-md-12">
                <?php echo form_open("post/addPost"); ?>
                <div class="modal-header">
                    <h4 class="modal-title col-md-4" style="margin-top: 10px;">Create post</h4>
                    <div class="input-group input-group-sm col-md-8">
                        <input name="submit" class="btn btn-danger col-md-4" style="margin-left: 20px; float: right;" type="submit" value="Create">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" style="float: right;margin-top: 5px;">Close</button>
                    </div>
                </div>
                <div class="modal-body control-group" style="min-height: 320px;">
                    <div id="personForm" class="col-md-12" style="padding-top: 0; font-family: Consolas;">
                        <div class="input-group input-group-sm col-md-12 wide">
                            <input id="post_name" name="post_name" class="form-control col-md-12" type="text" minlength="4" maxlength="120" required
                                   data-validation-required-message="Post name is required" placeholder="Name of post"> </div>
                        <div class="br"></div>
                        <div class="input-group input-group-sm col-md-12 wide">
                            <input id="post_desc" name="post_desc" class="form-control col-md-12" type="text" maxlength="160" placeholder="Add some description, if needed"> </div>
                        <div class="br"></div>
                        <div class="input-group input-group-sm col-md-12 wide">
                            <textarea id="post_body" name="post_body" class="form-control col-md-12" rows="10" style="min-height: 155px;" minlength="4" maxlength="1200" required
                                      data-validation-required-message="Post body is required" placeholder="Your post is here"></textarea> </div>
                        <div class="br"></div>
                        <div class="input-group input-group-sm col-md-12 wide">
                            <input id="post_tags" name="post_tags" class="form-control col-md-12" type="text" minlength="2" maxlength="120" required
                                   data-validation-required-message="At least 1 tag is required" placeholder="Tags"> </div>
                        <div class="br"></div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>    
</div>