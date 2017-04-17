<?php
$host = "localhost";
$db = "RedirectService";
$user = "root";
$password = "WVClanguniver";
$link = mysqli_connect($host, $user, $password) or trigger_error(mysql_error(),E_USER_ERROR);

mysqli_query($link, "SET NAMES 'utf8'")                                      or die(mysql_error());
mysqli_query($link, "SET CHARACTER SET 'utf8'")                              or die(mysql_error());
mysqli_query($link, "SET SESSION collation_connection = 'utf8_general_ci'")  or die(mysql_error());

mysqli_select_db($link, $db);
?>