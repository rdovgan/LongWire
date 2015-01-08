<div id="userPanel">
    <div class="panelTitle">PAGES</div>
    <ul class="nav nav-pills nav-stacked">
        <li id="profileItem"><?php echo anchor('user/profile', '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>Dashboard') ?></li>
        <li id="messagesItem"><?php echo anchor('user/messages', '<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>Messages') ?></li>
        <li id="peopleItem"><?php echo anchor('user/people', '<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>People') ?></li>
        <li id="calendarItem"><?php echo anchor('user/calendar', '<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>Calendar') ?></li>
        <li id="galleryItem"><?php echo anchor('user/gallery', '<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>Gallery') ?></li>
        <li id="personItem"><?php echo anchor('user/person', '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>Person') ?></li>
    </ul>
    <div class="panelTitle">ELEMENTS</div>
    <ul class="nav nav-pills nav-stacked">
        <li><a href="#"><span class="glyphicon glyphicon-text-width" aria-hidden="true"></span>Typography</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>Layout</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Tables</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>Form</a></li>
        <li><?php echo anchor('#', '<span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>Buttons') ?></li>
        <li><a href="#"><span class="glyphicon glyphicon-phone" aria-hidden="true"></span>Mobile</a></li>
    </ul>
    <script>var activeItem = "<?php echo $activeItem; ?>"</script>
</div>