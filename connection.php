<?php

function connection(){
		
	   $hostname = '192.168.1.151';
	   $username = 'root';
	   $password = 'emile814';
	   $dbname = 'database_1';

	  $db = mysqli_connect ( $hostname, $username, $password, $dbname );

	    if (!db)
	    {
	      echo"Failed to connect to MYSQL<br><br> ". $db->mysqli_connect_error.PHP_EOL;
	      exit(1);
	    }
	    echo "Successfully connected to MySQL<br><br>";
	    return $db;
 }
?>
