<?php
// Check if the server is local or remote
if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_ADDR'] == '127.0.0.1') {  
  
    $host = 'localhost';
    $username = 'root';        
    $password = '';            
    $dbname = 'cars'; 
} else {
    
    $host = 'sql103.infinityfree.com';
    $username = 'if0_38812485';
    $password = 'qqcg1y65rGVM';
    $dbname = 'if0_38812485_cars';
}

// Create the connection
$mysqli = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

?>
