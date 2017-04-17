<?php

function ConnectDB($host, $db, $user, $password)
{
    $link = mysqli_connect($host, $user, $password) or trigger_error(mysql_error(),E_USER_ERROR);

    mysqli_query($link, "SET NAMES 'utf8'")                                      or die(mysql_error());
    mysqli_query($link, "SET CHARACTER SET 'utf8'")                              or die(mysql_error());
    mysqli_query($link, "SET SESSION collation_connection = 'utf8_general_ci'")  or die(mysql_error());

    mysqli_select_db($link, $db);

    return $link;
}

function GetNextShortLink($longLink)
{
    $protocol = "http";
    $siteName = "redirectservice"; //TODO: enter current parameters
    $host = "localhost";
    $link = ConnectDB($host, "RedirectService", "root", "WVClanguniver"); //TODO: enter current parameters
    $shortLinkLength = 10; //TODO: enter current parameters

    $query = "SELECT `id`,`shortLink` FROM `link` WHERE `id`=( SELECT max(`id`) FROM `link` )";
    $mysqlResult = mysqli_query ($link, $query);

    $lastID = mysqli_fetch_array($mysqlResult)['id'];
    $currentID = $lastID + 1;

    //echo "lastID = " . $lastID . "<br>"; //TODO: delete this line
    //echo "currentID = " . $currentID . "<br>"; //TODO: delete this line
    //echo "in-func Link = " . $longLink . "<br>"; //TODO: delete this line

    $shortLink = base_convert((string)$currentID, 10, 36);
    while (strlen($shortLink) < $shortLinkLength)
    {
        $shortLink = "0" . $shortLink;
    }

    $query = "INSERT INTO `link`(`longLink`, `shortLink`) VALUES ('$longLink', '$shortLink')";
    $mysqlResult = mysqli_query ($link, $query);

    //echo "query = " . $query . "<br>"; //TODO: delete this line
    //echo "mysqlResult = " . $mysqlResult . "<br>"; //TODO: delete this line

    if ($mysqlResult == 1) return $protocol . "://" . $host . "/" . $siteName . "/" . $shortLink;
    else return "error";
}
?>