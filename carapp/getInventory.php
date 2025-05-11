<?php

function getCars($mysqli) {
    $result = $mysqli->query("SELECT VIN, Make, Model, ASKING_PRICE FROM inventory");

    if ($result === false) {
        die("Query failed: " . $mysqli->error);
    }

    $cars = [];
    while ($row = $result->fetch_assoc()) {
        $cars[] = $row;
    }

    return $cars;
}


?>
