<div class="col-md-12 postListLine">
    <ul class="nav nav-tabs" style="padding-left: 30px;">
        <li class="active">
            <a href="#own_posts" data-toggle="tab">    
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <text>Own</text>
            </a>
        </li>
        <li>
            <a href="#fav_posts" data-toggle="tab">
                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                <text>Favorite</text>
            </a>
        </li>
        <li>
            <a href="#liked_posts" data-toggle="tab">
                <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                <text>Liked</text>
            </a>
        </li>
        <li>
            <a href="#best_posts" data-toggle="tab">
                <span class="glyphicon glyphicon-king" aria-hidden="true"></span>
                <text>Best</text>
            </a>
        </li>
    </ul>
</div>

<div id="data" class='content'> 
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="own_posts">
            <?php
            if (isset($postsList) && $postsList != false) {
                foreach ($postsList as $item): {
                        $isAuthor = ($item['post_user'] == $this->session->userdata('user_login'));
                        Elements::postToHtml($item, $likes, $dislikes, $favs, $isAuthor);
                    }
                endforeach;
            } else {
                ?>
                <div class="fineText" style="text-align: center; margin-left: -20%;">Your haven't any posts</div>
            <?php }
            ?>
        </div>
        <div class="tab-pane fade" id="fav_posts">
            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit.</p>
        </div>
        <div class="tab-pane fade" id="liked_posts">
            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.</p>
        </div>
        <div class="tab-pane fade" id="best_posts">
            <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater.</p>
        </div>
    </div>
</div>

</body>
</html>