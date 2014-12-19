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
                        <label unselectable="on" onselectstart="return false;"><input type="checkbox" name="attach_ip" class="switch ios-switch tinyswitch" checked />
                            <div style="margin: 0px; margin-top: 8px;"><div></div></div></label>
                    </div>
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
                <?php echo validation_errors('<p class="error">'); ?>
                <?php echo form_open("user/registration"); ?>
                <div class="modal-header">
                    <h4 class="modal-title">Register</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group input-group-sm col-md-12">
                        <input id="registerName" name="user_name" type="text" 
                               value="<?php echo set_value('user_name'); ?>" class="form-control col-md-8" placeholder="Username">
                    </div>
                    <div class="br"></div>
                    <div class="input-group input-group-sm col-md-12">
                        <input name="password" type="password" 
                               value="<?php echo set_value('password'); ?>" class="form-control col-md-8" placeholder="Password">
                    </div>       
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
</body>
</html>