<div id="data" class='content'>

    <?php foreach ($postsList as $item): ?>    
    <div class="post">
        <div class="col-md-12 bigText postName" onclick="description(event);"><?php echo $item['post_name']; ?>
            <div class="col-md-12 postDescription" hidden="true"><?php echo $item['post_desc']; ?></div></div>
        <div class="col-md-12 postBody"><?php echo $item['post_body']; ?></div>
    </div>
    <div class="br"></div>
    <?php endforeach; ?>

</div>
</body>
</html>