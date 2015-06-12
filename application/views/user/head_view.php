<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>LongWire</title>
        <meta name="author" content="LongWireComp" />
        <meta name="viewport" content="width=480,user-scalable=false" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/flatly.css">
        <link rel="stylesheet/less" type="text/css" href="<?php echo base_url(); ?>/css/user.less">
        <link href='http://fonts.googleapis.com/css?family=Philosopher|Marmelad&subset=cyrillic' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="<?php echo base_url(); ?>/js/less.min.js"></script> 
        <script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/js/jquery-2.1.1.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/js/bootstrap.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/js/user.js"></script>
        <?php
        if (isset($headElements) && $headElements != false) {
            echo $headElements;
        }
        ?>
        <script>
        var url = '<?php echo base_url(); ?>';
        </script>
    </head>
    <body>
        <div id="messageBlock" class="alert alert-warning alert-dismissible" hidden>
            <button type="button" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <p id="messageText"><?php if(isset($messageText) && $messageText != false) {echo $messageText;}; ?></p>
        </div>
        <div id="userTop">
            <div id="userTopInfo"><img id="avatar" src="/img/avatars/<?php echo $this->session->userdata('user_login') ?>.png" 
                                       width="48" height="48" border="0" onerror="this.src='/img/avatars/q.png'">
                <div id="userName">
                    <?php
                    if ($this->session->userdata('user_name')) {
                        echo anchor('/profile', $this->session->userdata('user_name'));
                    } else {
                        echo anchor('/profile', $this->session->userdata('user_login'));
                    }
                    ?></div>
                <?php
                if ($this->session->userdata('user_login') == 'admin') {
                    echo anchor('/admin', '<div id="adminLink"><span class="glyphicon glyphicon-plane" aria-hidden="true"></span></div>');
                }
                ?>
            </div>
            <div id="userTopBlock">
                <div id="panelHamburger" class="hamburger forMob"><span class="glyphicon glyphicon-align-justify"></span></div>
                <?php echo anchor('user/index', '<div id="siteLogo">
                    <div id="companyLogo">
                        <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
                    </div>
                    <h5 id="siteName">Long Wire Company</h5>
                </div>'); ?> 
                <div id="userMenu">
                    <?php foreach ($head_menu as $item): ?>
                        <?php echo $item; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

