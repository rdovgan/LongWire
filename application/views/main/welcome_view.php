<div id="content" class="content">
    <h2>Welcome Back, <?php echo $this->session->userdata('user_name'); ?>!</h2>
    <p>This section represents the area that only logged in members can access.</p>
    <h4><?php echo anchor('user/logout', 'Logout'); ?></h4>
    <?php echo 'Text' ?>
    <div  class='col-md-12'>
        <div class='col-md-4'><label unselectable="on" onselectstart="return false;">Tiny green<input type="checkbox" class="ios-switch green tinyswitch" checked /><div><div></div></div></label>
        </div><div><label class='col-md-4'>Tiny blue<input type="checkbox" class="ios-switch tinyswitch" checked /><div><div></div></div></label>
        </div> <div class='col-md-4'><label unselectable="on" onselectstart="return false;">Big green<input type="checkbox" class="ios-switch green  bigswitch" checked /><div><div></div></div></label>
        </div></div>
    <div  class='col-md-12'>
        <div class='col-md-4'><label>Big blue<input type="checkbox" class="ios-switch bigswitch" checked /><div><div></div></div></label>
        </div><div class='col-md-4'><label unselectable="on" onselectstart="return false;">Normal green<input type="checkbox" class="ios-switch green" /><div><div></div></div></label>
        </div><div class='col-md-4'><label>Normal blue<input type="checkbox" class="ios-switch"  /><div><div></div></div></label>
        </div></div>
</div><!--<div class="content">-->