<?php
include_once('bitly.php');

$baseurl = $_POST['baseurl'];
$urlext = base64_encode($_POST['urlstring']);

$fullurl = $baseurl.$urlext;

$shortened = bitly_v3_shorten($fullurl,'j.mp');

print_r($shortened['url']);
