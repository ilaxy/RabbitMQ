<?php
error_reporting(-1);

ini_set('display_errors', true);

include ('testrabbitMQClient.php');

$username = $_POST['username'];
$password = $_POST['password'];

$response = login($username,$password);

if($response == false)
  {
    echo "unathorized";
  }
  else
  {
  echo "authorized";
  }
?>
