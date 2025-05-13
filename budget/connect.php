<?php

$allowed_origins = [
    'http://localhost',
    'http://127.0.0.1',
    'https://boweb-250.free.nf'  
];

if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowed_origins)) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE");
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

function getDB(): mysqli {
    static $mysqli = null;

    if ($mysqli === null) {
   
        if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_ADDR'] === '127.0.0.1') {
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

        $mysqli = new mysqli($host, $username, $password, $dbname);

        if ($mysqli->connect_error) {
            die('Database connection failed: ' . $mysqli->connect_error);
        }
    }

    return $mysqli;
}
?>
