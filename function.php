<?php    

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('account.php');
    
	
    //Functions for different cases
    $connection = connection();
	
function doLogin($username, $password){
        
        $connection = connection();
        
        $query = "SELECT * FROM users WHERE username = '$username' and  password = '$password'";

	$result = $connection->query($query);
	print_r($result);
	
        if($result){
            if($result->num_rows == 0){
		echo "Login Failed ! Try again!";
                return "False";
            }
	    else
		{
		   echo "Login Successful.";
		   return "True";	
		}
	}	
 }
		
function doRegister($username, $firstname, $lastname, $email, $password){
        
        //Makes connection to database
        $connection = connection();
            
        
        //Query to check if the username exists
        $check_uname = "SELECT username FROM users WHERE upper(username) = upper('$username')";
        $check_rs = $connection->query($check_uname);
        
	if($check_rs){
            if($check_rs->num_rows == 0){
                
        	echo "<br>Registration Completed! ";
       		echo $result;
        	$registered = "INSERT INTO users(username, password, email) VALUES ('$username', '$password', '$email')";
		
		$regis = $connection->query($registered);
		$newuser = "INSERT INTO registered VALUES ($firstname, $lastname, $username , $password, $email')";
		$r = "commit";
       		$result = $connection->query($newuser);
		$regis1 = $connection->query($r);
		return 1;
            }
	    else
		{
		   echo "Login Failed ! Try again!";
		   return 0;	
		}
}
        
function doLogout($username, $password) 
	{
	   session_start();
	   session_destroy();
	}

           
function requestProcessor($request){
        echo "Request received ".PHP_EOL;
        echo $request['type'];
        var_dump($request);
        
        if(!isset($request['type'])){
            return array('message'=>"ERROR: Message type is not supported");
        }
        switch($request['type']){
                
            //Login & Authentication request    
            case "login":
                $response_msg = doLogin($request['username'],$request['password']);
                break;
                
            //New User registration
            case "register":
                echo "<br>in register";
                $response_msg = doRegister($request['username'], $request['firstname'], $request['lastname'], $request['email'], $request['password']);
                break;
				
		}	 
        return $response_msg;
    }
	//creating a new server
    $server = new rabbitMQServer("testRabbitMQ.ini", "testServer");
    
    //processes the request sent by client
    $server->process_requests('requestProcessor');
?>
