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
    $protocol = "http"; //TODO: enter current parameters
    $siteName = "redirectservice"; //TODO: enter current parameters
    $host = "localhost"; //TODO: enter current parameters
    $link = ConnectDB($host, "RedirectService", "root", "WVClanguniver"); //TODO: enter current parameters
    $shortLinkLength = 10; //TODO: enter current parameters

        //$longLink format
    if ( !(strpos($longLink, "http://") || strpos($longLink, "https://")) )
    {
        $longLink = "http://" . $longLink;
    }

        //Old links check
    $query = "SELECT `id`, `longLink`, `shortLink` FROM `link` WHERE `longLink`='$longLink'";
    $mysqlResult = mysqli_query ($link, $query);
    if ($AllResult = mysqli_fetch_array($mysqlResult))
    {
        $oldShortLink = $AllResult['shortLink'];
        return $protocol . "://" . $host . "/" . $siteName . "/generated/" . $oldShortLink;
    }

    $query = "SELECT `id`,`shortLink` FROM `link` WHERE `id`=( SELECT max(`id`) FROM `link` )";
    $mysqlResult = mysqli_query ($link, $query);

    $lastID = mysqli_fetch_array($mysqlResult)['id'];
    $currentID = $lastID + 1;

    $shortLink = base_convert((string)$currentID, 10, 36);
    while (strlen($shortLink) < $shortLinkLength)
    {
        $shortLink = "0" . $shortLink;
    }

    $query = "INSERT INTO `link`(`longLink`, `shortLink`) VALUES ('$longLink', '$shortLink')";
    $mysqlResult = mysqli_query ($link, $query);

    if ($mysqlResult == 1) return $protocol . "://" . $host . "/" . $siteName . "/generated/" . $shortLink;
    else return "error";
}
?>