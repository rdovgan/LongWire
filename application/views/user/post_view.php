<div id="data" class='content col-md-12'>
    <?php
    if (isset($postData) && $postData != false) {
        $isAuthor = ($postData['post_user'] == $this->session->userdata('user_login'));
        Elements::postToHtml($postData, $likes, $dislikes, $favs, $isAuthor);
    } else {
        ?>
        <div class="fineText" style="text-align: center; margin-left: -20%;">Your haven't any posts</div>
    <?php }
    ?>
</div>