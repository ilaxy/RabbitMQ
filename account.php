<?php
    
    function connection(){
        
        $hostname = 'localhost';
        $username = 'root';
        $password = 'Database1';
        $dbname = 'readBuster';
        
        $connection = mysqli_connect($hostname, $username, $password, $dbname);
        
        if (!$connection){
            echo "Error connecting to database: ".$connection->connect_errno.PHP_EOL;
            exit(1);
        }
        echo "Connection established to database".PHP_EOL;
        return $connection;
    }
    
?>
