<?php include_once 'functions.php';

$longLink = $_POST['input'];

if ($longLink == null || $longLink == '') echo "error";
else
    {
        $shortLink = GetNextShortLink($longLink);
        echo $shortLink;
    }
?>

