<div id="data" class='content'>
    <?php $isPerson = isset($personData) && $personData != false; ?>
    <div id="personData" class="col-md-12 personBlock" style="display: inline;">
        <?php
        $imgLink = FCPATH . '/img/avatars/' . $personLogin . '.png';
        ?>
        <div class="avatarBig col-md-3" style="display: inline;">
            <img src="/img/avatars/<?php echo (is_file($imgLink)) ? ($personLogin) : ('q'); ?>.png"
                 width="96" height="96" border="0">
        </div>
        <div class="col-md-6">
            <?php echo $personLogin; ?>
            <br>
            <?php if ($isPerson) { ?>
                <?php echo $personData['person_name']; ?>
                <br>
                <?php echo $personData['person_surname']; ?>
                <br>
                <?php echo $personData['person_birth']; ?>
                <br>
                <?php
                if ($personData['person_gender'] == '1') {
                    echo 'Male';
                } else if ($personData['person_gender'] == '2') {
                    echo 'Female';
                } else {
                    echo 'Unknown';
                }
                ?>
            <?php } ?>
        </div>
    </div>
    <div class="posts">
        <?php        
        if (isset($postsData) && $postsData != false) {
            foreach ($postsData as $item):
                ?>    
                <div class="post">
                    <div class="col-md-12 postName" onclick="description(event);"><?php echo $item['post_name']; ?>
                        <?php
                        $isAuthor = $personLogin==$this->session->userdata('user_login');
                        if($isAuthor) {
                            echo anchor('post/editPost/' . $item['post_id'], '<span class="glyphicon glyphicon-pencil    badgeInfo" style="float: right;" aria-hidden="true"></span>');
                        }
                        ?>
                        <div class="col-md-12 postDescription" hidden="true"><?php echo $item['post_desc']; ?></div></div>
                    <pre><div class="col-md-12 postBody"><?php echo $item['post_body']; ?></div></pre>
                        </div>
                        <div class="postUsername <?php if($isAuthor){echo 'tiny';} ?>" ><?php echo $personLogin; ?></div>                        
                                            <div class="divider"></div>
                <?php
            endforeach;
        }
        ?>
    </div>
</div>
</body>
</html>