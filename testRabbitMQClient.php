#!/usr/bin/php
<?php

error_reporting(-1);
ini_set('display_errors', false);

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doLogin ($username,$password){
$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}

$request = array();
$request['type'] = "Login";
$request['username'] = "steve";
$request['password'] = "password";
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;
}

function doRegister($email,$username,$password){
    $client = new rabbitMQClient("testRabbitMQ.ini","testServer");
    if (isset($argv[1]))
    {
      $msg = $argv[1];
    }
    else
    {
      $msg = "test message";
    }
    $request = array();
    $request['type'] = "doRegister";
    $request['email'] = $email;
    $request['username'] = $username;
    $request['password'] = $password;
    $request['message'] = $message;
    $response = $client->send_request($request);
   
    return $response;
    echo "\n\n";
    echo $argv[0]." END".PHP_EOL;
}
?>
