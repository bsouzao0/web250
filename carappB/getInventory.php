<?php

function getCars($mysqli, $limit = 10, $offset = 0) {
    $stmt = $mysqli->prepare("SELECT VIN, Make, Model, ASKING_PRICE FROM inventory LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();

    $cars = [];
    while ($row = $result->fetch_assoc()) {
        $cars[] = $row;
    }

    return $cars;
}



?>
