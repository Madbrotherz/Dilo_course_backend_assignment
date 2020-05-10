<?php

$text = "HASH TESTING";

echo $text."<br>";

echo md5($text)."<br>";

$salt = "sfds8fdsf8df8";

echo md5($text.$salt);

?>