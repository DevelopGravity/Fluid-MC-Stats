<!DOCTYPE html>
<!--
  ~ Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
-->
<?php
if (!file_exists('config.php')) {
    echo "<h1>config.php missing!</h1>";
    die();
}
include 'config.php';
if ($mysql_host == '' && file_exists("pages/install/")) {
    $http = ($_SERVER['HTTPS'] ? 'https://' : 'http://');
    $installLoc = $http . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] . "pages/install/install.php";
    header("Location: " . $installLoc);
    die();
}
if ($mysql_host == '') {
    die("Config misconfigured and install folder is not at default location, can't launch website");
}
if (file_exists("pages/install/")) {
    die("install folder still exists! Due to security reasons, please delete/move it.");
}
?>
<html>
    <head>
        <title><?php echo $site_name; ?> - Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/custom.css">
        <!-- TODO: Keep correct paths but local links to avoid XSS -->
    </head>
    <body>

        <!-- Navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

            <!-- Mobile -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><i class="fa <?php echo $fa_icon; ?>"></i> <?php echo $site_name; ?></a>
            </div>
            <!-- /Mobile -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="pages/server-stats.php"><i class="fa fa-hdd-o"></i> Server Stats</a></li>
                    <li><a href="pages/top-players.php"><i class="fa fa-bar-chart-o"></i> Top Players</a></li>
                    <li><a href="pages/player-list.php"><i class="fa fa-list"></i> Player List</a></li>
                </ul>
                <form class="navbar-form navbar-right" role="search" action="pages/search.php">
                    <div class="form-group">
                        <input name='name' type="text" class="form-control" placeholder="Player Name">
                    </div>
                    <button type="submit" class="btn btn-default">Find <i class="fa fa-chevron-right"></i></button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-link"></i> Links <b
                                class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php
                            if (empty($custom_links)) {
                                echo "No links here!";
                            }
                            foreach ($custom_links as $key => $link) {
                                echo "<li><a href='" . $link . "'>" . $key . "</a></li>";
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /Navbar -->

        <!-- Location -->
        <div class="container content-container">
            <div class="hidden-sm">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <ol class="breadcrumb">
                            <li class="active"><i class="fa fa-home"></i> Home</li>
                            <!-- TODO: Apply class active to li when page is current -->
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /Location -->

            <!-- Content -->
            <div class="row">
                <!-- Main Content -->
                <div class="col-md-6 col-md-offset-1">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-home"></i> Home</h3>
                        </div>
                        <div class="panel-body">
                            <div class="jumbotron">
                                <h1>Welcome!</h1>
                                <p>to the new Fluid MC Stats interface for your <?php echo $server_name; ?> powered by <a href="http://developgravity.com/">Develop
                                        Gravity</a> and <a href="http://lolmewn.nl">Lolmewn</a>.</p>

                                <p>Get started by searching for your stats on this server or...</p>

                                <form role="search" action='pages/search.php'>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <!-- BUG: Scale is off on group-addon when in jumbotron -->
                                        <input name='name' type="text" class="form-control" placeholder="Username">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-default">
                                                Find <i class="fa fa-chevron-right"></i>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                                <p>Explore...</p>

                                <div class="list-group">
                                    <a href="index.php" class="list-group-item active"><i class="fa fa-home"></i> Home</a>
                                    <!-- TODO: Apply class active to li when page is current -->
                                    <a href="pages/server-stats.php" class="list-group-item"><i class="fa fa-hdd-o"></i> Server Stats</a>
                                    <a href="pages/top-players.php" class="list-group-item"><i class="fa fa-bar-chart-o"></i> Top Players</a>
                                    <a href="pages/player-list.php" class="list-group-item"><i class="fa fa-list"></i> Player List</a>
                                </div>
                                <?php if (isset($custom_links) && !empty($custom_links)) { ?>
                                    <div class="list-group">
                                        <?php
                                        foreach ($custom_links as $key => $link) {
                                            echo "<a href='" . $link . "' class='list-group-item'>" . $key . "</a>";
                                        }
                                        ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Main Content -->

                <!-- Sidebar -->
                <div class="col-md-3 col-md-offset-1">

                    <!-- Server status -->
                    <?php include "inc/serverstatusui.php"; ?>
                    <!-- /Server status -->

                    <!-- Quick Links -->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-link"></i> Quick Links</h3>
                        </div>
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="index.php" class="list-group-item active"><i class="fa fa-home"></i> Home</a>
                                <!-- TODO: Apply class active to li when page is current -->
                                <a href="pages/server-stats.php" class="list-group-item"><i class="fa fa-hdd-o"></i> Server Stats</a>
                                <a href="pages/top-players.php" class="list-group-item"><i class="fa fa-bar-chart-o"></i> Top Players</a>
                                <a href="pages/player-list.php" class="list-group-item"><i class="fa fa-list"></i> Player List</a>
                            </div>
                            <div class="list-group">
                                <?php
                                foreach ($custom_links as $key => $link) {
                                    echo "<a href='" . $link . "' class='list-group-item'>" . $key . "</a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- /Quick Links -->

                </div>
                <!-- /Sidebar -->

            </div>
            <!-- /Content -->

            <!-- Footer -->
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="well well-sm">
                        <p class="make-center"><?php
                            if (!empty($custom_footer_text)) {
                                echo "[" . $custom_footer_text . "]";
                            }
                            ?> <i class="fa fa-info-circle"></i> Fluid MC Stats
                            v0.0.1
                            Pre-Alpha is &copy; Copyright <a href="http://accountproductions.com/">AccountProductions</a> and <a
                                href="http://lolmewn.nl">Lolmewn</a>, 2014. All rights reserved.</p>
                        <!-- DND: Keep this link here! This is copyrighted content -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /Footer -->

        <!-- TODO: Keep correct paths but local links to avoid XSS -->
        <script src="js/jquery-2.1.0.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/d3.v3.min.js"></script>
    </body>
</html>
