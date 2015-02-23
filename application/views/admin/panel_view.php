<div id="userPanel">
    <div class="panelTitle">PAGES</div>
    <ul class="nav nav-pills nav-stacked">
        <li id="profileItem"><?php echo anchor('user/profile', '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>Dashboard') ?></li>
        <li id="messagesItem"><?php echo anchor('user/messages', '<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>Messages') ?></li>
        <li id="postsItem"><?php echo anchor('post/postsList', '<span class="glyphicon glyphicon-book" aria-hidden="true"></span>Posts') ?></li>
        <li id="calendarItem"><?php echo anchor('user/calendar', '<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>Calendar') ?></li>
        <li id="userItem"><?php echo anchor('profile/search', '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>People') ?></li>
        <li id="personItem"><?php echo anchor('user/person', '<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>Person') ?></li>
        <li id="achievItem"><?php echo anchor('user/achiev', '<span class="glyphicon glyphicon-star" aria-hidden="true"></span>Achievements') ?></li>
    </ul>
    <script>var activeItem = "<?php echo $activeItem; ?>";
        var upUrl = '<?php echo anchor("post/up"); ?>';
    </script>
</div>