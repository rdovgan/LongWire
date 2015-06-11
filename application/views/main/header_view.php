<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>LongWire</title>
        <meta name="author" content="LongWireComp" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/darkly.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/animate.css">
        <link rel="stylesheet/less" type="text/css" href="<?php echo base_url(); ?>/fonts/fonts.css">
        <link rel="stylesheet/less" type="text/css" href="<?php echo base_url(); ?>/css/fonts.less">
        <link rel="stylesheet/less" type="text/css" href="<?php echo base_url(); ?>/css/style.less">
        <link href='http://fonts.googleapis.com/css?family=Bad+Script|Lobster&subset=cyrillic' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="<?php echo base_url(); ?>/js/less.min.js"></script> 
        <script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/js/jquery-2.1.1.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/js/bootstrap.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/js/main.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/js/social-likes.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/social-likes_flat.css">
    </head>
    <body>
        <div id="header">
            <div id="headerGroup">
                <div id="logo">
                    <a class="invlink" href="http://longwire.ho.ua/"><h4 id="logoPic">
                            <span class="glyphicon glyphicon-flash" aria-hidden="true"></span></h4>
                        <h3 id="logoText"> LongWire</h3>
                    </a>
                </div>
                <div id="mainMenu">
                    <div class="navbar navbar-default">
                        <div class="navbar-collapse collapse navbar-responsive-collapse">
                            <ul id="navbarItems" class="nav navbar-nav">
                                <li class="active under"><a href="#">Active</a></li>
                                <li><a href="#">Link</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" id="btnCreatePost" onclick="createPostDialog();">Create post</a></li>
                                        <li><?php echo anchor("post/lastPost", "Last post"); ?></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </li>
                                <?php foreach ($head_menu as $item): ?>
                                    <?php echo $item; ?>
                                <?php endforeach; ?>
                            </ul>
                            <form id="formSearch" class="navbar-form navbar-left">
                                <input id="searchInput" disabled type="text" class="form-control col-lg-8" placeholder="Search">
                            </form>
                            <ul id="hiddenHamburger" class="navbar-form navbar-left">
                                <h4 class="some"><span class="glyphicon glyphicon-home"></span></h4>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="br-shad"></div>
        </div>
        <?php
        $this->session->userdata('user_id') . "<br>" . $this->session->userdata('user_name') . "<br>" . $this->session->userdata('user_login') . "<br>" . $this->session->userdata('logged_in');
        ?>
        <div id="messageBlock" class="alert alert-warning alert-dismissible" hidden>
            <button type="button" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <p id="messageText"><?php echo $this->session->flashdata('message'); ?></p>
        </div>