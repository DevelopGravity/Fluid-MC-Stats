<?php

/**
* Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
*/

include_once __DIR__ . '/../config.php';

if (!isset($mysql_host)) {
  die("MySQL host not set - Config is probably not set up yet.");
}
$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_pwd, $mysql_database, $mysql_port)
or die("Database connection failed to establish");