<?php

    //Set parameters
$protocol = "http"; //TODO: enter current parameters
$host = "localhost"; //TODO: enter current parameters
$siteName = "redirectservice"; //TODO: enter current parameters
$dbName = "RedirectService"; //TODO: enter current parameters
$user = "root"; //TODO: enter current parameters
$password = "password123"; //TODO: enter current parameters

    //Connect DB
$dbLink = mysqli_connect($host, $user, $password, $dbName) or trigger_error(mysql_error(),E_USER_ERROR);

mysqli_query($dbLink, "SET NAMES 'utf8'")                                      or die(mysql_error());
mysqli_query($dbLink, "SET CHARACTER SET 'utf8'")                              or die(mysql_error());
mysqli_query($dbLink, "SET SESSION collation_connection = 'utf8_general_ci'")  or die(mysql_error());

mysqli_select_db($dbLink, $dbName);

    //DB queries

$shortURI = $_GET['shortUrl'];
$query = "SELECT `longLink` FROM `link` WHERE `shortLink`='$shortURI'";
$mysqlResult = mysqli_query($dbLink, $query);
$longURI = mysqli_fetch_array($mysqlResult)['longLink'];

header('Location: ' . $longURI);

?>