<div id="data" class='content' style="width: 100%; padding-right: 20px;">
    <?php
    if (isset($usersList) && $usersList != false) {
        foreach ($usersList as $item):
            $imgLink = FCPATH . '/img/avatars/' . $item['user_login'] . '.png';
            $isPerson = isset($item['person']) && $item['person'] != false;
            $gender = $item['person']['person_gender'];
            ?>    
            <div class="userItem <?php echo 'back'.$gender ?>">
                <div class="avatarBig col-md-3" style="display: inline;">
                    <img src="/img/avatars/<?php echo (is_file($imgLink)) ? ($item['user_login']) : ('q'); ?>.png"
                         width="96" height="96" border="0">
                </div>
                <div class="col-md-6">
                    <?php echo anchor('profile/user/'.$item['user_login'],$item['user_login']); ?>
                    <br>
                    <?php if ($isPerson) { ?>
                        <?php echo $item['person']['person_name']; ?>
                        <br>
                        <?php echo $item['person']['person_surname']; ?>
                        <br>
                        <?php echo $item['person']['person_birth']; ?>
                        <br>
                        <?php
                        if ($gender == '1') {
                            echo 'Male';
                        } else if ($gender == '2') {
                            echo 'Female';
                        } else {
                            echo 'Unknown';
                        }
                        ?>
                    <?php } ?>
                </div>
            </div>
            <?php
        endforeach;
    } else {
        ?>
        <div class="fineText" style="text-align: center; margin-left: -20%;">Can't load list of users</div>
    <?php }
    ?>

</div>
</body>
</html>