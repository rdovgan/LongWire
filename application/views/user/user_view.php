<div id="data" class='content col-md-12'>
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
            <div class="userPersonLogin">
                <?php echo $personLogin; ?>
            </div>
            <?php if ($isPerson) { ?>
                <div class="userPersonName"><?php echo $personData['person_name']; ?> <?php echo $personData['person_surname']; ?> </div>
                <div class="userPersonBirth"><?php echo $personData['person_birth']; ?></div>
                <div class="userPersonGender"><?php
                    if ($personData['person_gender'] == '1') {
                        echo 'Male';
                    } else if ($personData['person_gender'] == '2') {
                        echo 'Female';
                    } else {
                        echo 'Unknown';
                    }
                    ?></div>
            <?php } ?>
        </div>
    </div>
    <div class="posts">
        <?php
        if (isset($postsList) && $postsList != false) {
            foreach ($postsList as $item): {
                    $isAuthor = ($item['post_user'] == $this->session->userdata('user_login'));
                    Elements::postToHtml($item, $likes, $dislikes, $favs, $isAuthor);
                }
            endforeach;
        } else {
            ?>
            <div class="fineText">User didn't create any post</div>
        <?php }
        ?>
    </div>
</div>
</body>
</html>