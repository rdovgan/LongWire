<div id="data" class='content'>

    <?php foreach ($postsList as $item): ?>
        <div class="post">
                <td>
                    <?php echo $item['post_name']; ?>
                </td>
                <td>
                    <?php echo $item['post_desc']; ?>
                </td>
                <td>
                    <?php echo $item['post_body']; ?>
                </td>
            </div>
    <?php endforeach; ?>

</div>
</body>
</html>