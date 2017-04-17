<?php include_once 'functions.php';

$longLink = $_POST['input'];

//echo "before-before-func LongLink = " . $longLink . "<br>";

if ($longLink == null || $longLink == '') echo "error";
else
    {
        //echo "before-func LongLink = " . $longLink . "<br>";
        $shortLink = GetNextShortLink($longLink);
        echo $shortLink;
    }
?>

