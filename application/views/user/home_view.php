<div id="data" class="content">
    <img data-src="http://app.resrc.it/c=w500,h312,xof76p,yof12p/http://www.your-site.co/image-control.jpg" 
         alt="An awesome dogs head" class="resrc"/>
    <div class="posts">
        <?php
        if (isset($postsList) && $postsList != false) {
            foreach ($postsList as $item):
                ?>    
                <div id="<?php echo $item['post_id']; ?>" class="post">
                    <div class="col-md-12 postName" onclick="showPost(event);"><?php echo $item['post_name']; ?>
                        <?php
                        $isAuthor = $item['post_user'] == $this->session->userdata('user_login');
                        if ($isAuthor) {
                            echo anchor('post/editPost/' . $item['post_id'], '<span class="glyphicon glyphicon-pencil badgeEdit" aria-hidden="true"></span>');
                        }
                        ?>
                        <div class="col-md-12 postDescription" <?php echo($item['post_desc']!='')?'':'hidden'; ?>><?php echo $item['post_desc']; ?></div></div>
                    <pre><div class="col-md-12 postBody"><?php echo $item['post_body']; ?></div></pre>
                <?php
                $postSign = Elements::getSign($item, $isAuthor);
                foreach ($postSign as $signItem):
                    echo $signItem;
                endforeach;
                ?></div><?php
            endforeach;
        }
        ?>
    </div>
</div>