<?php

ini_set("allow_url_fopen", 1);

$url = "https://www.goodreads.com/search.xml?key=vkocu8cqXPKDJc7wnPw";

echo $url;
echo $json;

$data = file_get_contents($url);
$data = ""
$data=$more;

header('Content-Type: application/json;charset=utf-8');

echo json_decode($data);
echo ($data);
$arr=$data;
header("Content-type: text/javascript");
echo json_encode($arr);

?>
