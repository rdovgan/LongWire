<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>LongWire</title>
        <meta name="author" content="LongWireComp" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/darkly.css">
        <link rel="stylesheet/less" type="text/css" href="<?php echo base_url(); ?>/fonts/fonts.css">  
        <link rel="stylesheet/less" type="text/css" href="<?php echo base_url(); ?>/css/style.less">  
        <script type="text/javascript" src="<?php echo base_url(); ?>/js/less.min.js"></script> 
        <script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/js/jquery-2.1.1.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/js/bootstrap.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/js/main.js"></script>
    </head>
    <body>
        <div id="header">
            <div id="headerGroup">
                <div id="logo">
                    <a class="invlink" href="http://longwire.ua/"><h4 id="logoPic">
                            <span class="glyphicon glyphicon-flash" aria-hidden="true"></span>
                            <h3 id="logoText"> LongWire</h3>
                        </h4></a>
                </div>
                <div id="mainMenu">
                    <div class="navbar navbar-default">
                        <div class="navbar-collapse collapse navbar-responsive-collapse">
                            <ul class="nav navbar-nav">
                                <li class="active under"><a href="#">Active</a></li>
                                <li><a href="#">Link</a></li>
                                <li><a href="#">Link</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </li>
                                <?php foreach ($head_menu as $item): ?>
                                    <?php echo $item; ?>
                                <?php endforeach; ?>
                            </ul>
                            <form class="navbar-form navbar-left">
                                <input id="searchInput" disabled type="text" class="form-control col-lg-8" placeholder="Search">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="br-shad"></div>
        </div>
        <div id="messageBlock" class="alert alert-warning alert-dismissible" hidden>
            <button type="button" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <p id="messageText"></p>
        </div>