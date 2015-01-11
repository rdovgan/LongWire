<div id="data" class='content'>

    <?php
    if (isset($postsList)) {
        foreach ($postsList as $item):
            ?>    
            <div class="post">
                <div class="col-md-12 postName" onclick="description(event);"><?php echo $item['post_name']; ?>
                    <div class="col-md-12 postDescription" hidden="true"><?php echo $item['post_desc']; ?></div></div>
                <div class="col-md-12 postBody"><?php echo $item['post_body']; ?></div>
            </div>
            <div class="divider"></div>
            <?php
        endforeach;
    } else {
        ?>
        <div class="fineText" style="text-align: center; margin-left: -20%;">Your haven't any posts</div>
    <?php }
    ?>

</div>
</body>
</html>