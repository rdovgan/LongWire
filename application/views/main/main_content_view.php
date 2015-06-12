<div id="content" class="container content"> 
    <div class="news">
        <?php
        if (isset($newsList) && $newsList != false) {
            foreach ($newsList as $item):{
                Elements::newToHtml($item);
            }
            endforeach;
        }
        ?>
    </div>
    <div class="br"></div>
</div>