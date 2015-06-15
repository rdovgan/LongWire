<div class="br br-shad"></div>
<div class="br br-line"></div>
<nav id="menu" class="navbar navbar-default" role="navigation">
    <div id='menuContainer' class="menu-container">
        <ul class="nav nav-pills">
            <li id="liHome"><?php echo anchor('/', 'Home<span class="badge">42</span>'); ?></li>
            <li id="liAction"><?php echo anchor('user/action', 'Action'); ?></li>
            <div id='invBtns' class="animated">
                <?php foreach ($head_menu as $item): ?>
                    <?php echo $item; ?>
                <?php endforeach; ?>
            </div>
        </ul>
    </div>
</nav>