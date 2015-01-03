<div class="br br-shad"></div>
<div class="br br-line"></div>
<nav id="menu" class="navbar navbar-default" role="navigation">
    <div class="menu-container">
        <ul class="nav nav-pills">
            <li class="active"><a href="#">Home <span class="badge">42</span></a></li>
            <li><?php echo anchor('user/action', 'Action'); ?></li>
            <li><a href="#">Messages <span class="badge">3</span></a></li>
            <div id='invBtns' hidden="true">
                <?php foreach ($head_menu as $item): ?>
                    <?php echo $item; ?>
                <?php endforeach; ?>
            </div>
        </ul>
    </div>
</nav>