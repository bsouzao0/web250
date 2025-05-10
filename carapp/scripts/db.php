<?php
if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
    $mysqli = new mysqli('localhost', 'root', '', 'cars');
} else {
    $mysqli = new mysqli('sql103.infinityfree.com', 'if0_38812485', 'qqcg1y65rGVM', 'if0_38812485_cars');
}

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
