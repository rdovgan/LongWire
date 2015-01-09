<div id="data" class='content'>

    <div class="bigText">Create new post</div>

    <?php echo form_open("post/addPost"); ?>
    <div id="personForm" class="col-md-4 panel">
        <div class="input-group input-group-sm col-md-12">
            <input id="post_name" name="post_name" class="form-control col-md-8" type="text" placeholder="Name of post"> </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <input id="post_desc" name="post_desc" class="form-control col-md-8" type="text" placeholder="Description of post"> </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <textarea id="post_body" name="post_body" class="form-control col-md-8" rows="10" placeholder="Your post is here"></textarea> </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <input name="submit" class="btn btn-danger col-md-4" type="submit" value="Create">
            <a href="#" style="font-size: 32px; float: right;">
                <span style="margin-right: 0px;" class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
            </a>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
</body>
</html>