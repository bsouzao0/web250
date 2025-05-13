<?php
function getDB(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_ADDR'] === '127.0.0.1') {
            $host = 'localhost';
            $dbname = 'cars'; // your local database name
            $username = 'root';
            $password = '';
        } else {
            $host = 'sql103.infinityfree.com';
            $dbname = 'if0_38812485_cars';
            $username = 'if0_38812485';
            $password = 'qqcg1y65rGVM';
        }

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    return $pdo;
}
?>
