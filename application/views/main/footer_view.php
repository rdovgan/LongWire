<div id="footer">

</div>
<div id="modalLogin" class="modal fade right">
    <div id="modalDialogLogin" class="modal-dialog">
        <div id="modalContentLogin" class="modal-content">
            <div id="formLogin" class="col-md-12">
                <?php echo form_open("user/login"); ?>
                <div class="modal-header">
                    <h4 class="modal-title">Login</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group input-group-sm col-md-12">
                        <input id="loginName" name="username" type="text" class="form-control col-md-8" placeholder="Username">
                    </div>
                    <div class="br"></div>
                    <div class="input-group input-group-sm col-md-12">
                        <input id="pass" name="pass" type="password" class="form-control col-md-8" placeholder="Password">
                    </div>                    
                    <div class="input-group input-group-sm" style="margin-top:10px; margin-left: -12px;">
                        <span class="input-group-addon" style="background-color: transparent;">Remember me</span>
                        <label unselectable="on" onselectstart="return false;"><input type="checkbox" name="remember_me" class="switch ios-switch tinyswitch" checked />
                            <div style="margin: 0px; margin-top: 8px;"><div></div></div></label>
                    </div>
                    <?php echo validation_errors('<p class="error">'); ?>
                    <?php
                    if (isset($help_message)) {
                        echo '<p class="error">' . $help_message . '</p>';
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                    <input name="submit" class="btn btn-sm btn-danger" type="submit" value="Enter">
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>    
</div>

<div id="modalRegister" class="modal fade right">
    <div id="modalDialogRegister" class="modal-dialog">
        <div id="modalContentRegister" class="modal-content">
            <div id="formRegister" class="col-md-12">
                <?php echo form_open("user/registration"); ?>
                <div class="modal-header">
                    <h4 class="modal-title">Register</h4>
                </div>
                <div class="modal-body control-group">
                    <div class="input-group input-group-sm col-md-12">
                        <input id="registerName" name="user_name" type="text" minlength="4" maxlength="30" required
                               data-validation-required-message="Username is required"
                               value="<?php echo set_value('user_name'); ?>" class="form-control col-md-8" placeholder="Username">
                    </div>
                    <div class="br"></div>
                    <div class="input-group input-group-sm col-md-12">
                        <input name="password" type="password" minlength="4" maxlength="32" required="true"
                               data-validation-required-message="Password is required"
                               value="<?php echo set_value('password'); ?>" class="form-control col-md-8" placeholder="Password">
                    </div> 
                    <p class="help-block"></p>
                    <?php echo validation_errors('<p class="error">'); ?>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                    <input name="submit" class="btn btn-sm btn-danger" type="submit" value="Register">
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<div id="modalPost" class="modal fade right">
    <div id="modalPostCreate" class="modal-dialog">
        <div id="modalContentPost" class="modal-content">
            <div id="postCreate" class="col-md-12">
                <?php echo form_open("post/addPost"); ?>
                <div class="modal-header">
                    <h4 class="modal-title col-md-4" style="margin-top: 10px;">Create post</h4>
                    <div class="input-group input-group-sm col-md-8">
                        <input name="submit" class="btn btn-danger col-md-4" style="margin-left: 10px; float: right;" type="submit" value="Create">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" style="margin-left: 10px; float: right; margin-top: 5px;">Close</button>
                        <button type="button" class="btn btn-sm btn-info col-md-1" style="float:right; margin-top: 5px; width: 33px;">+</button>
                    </div>
                </div>
                <div class="modal-body control-group" style="min-height: 300px;">
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

<script>
    var option = <?php
                if (isset($option)) {
                    echo '"' . $option . '"';
                } else {
                    echo '""';
                }
                ?>
</script>
<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/js/jqBootstrapValidation.js"></script>
</body>
</html>