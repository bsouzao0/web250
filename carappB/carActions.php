<?php
include 'db.php'; 

/* - DELETE car - */
function deleteCar($VIN_to_delete, $mysqli) {
    $delete_query = "DELETE FROM inventory WHERE VIN = ?";
    $delete_stmt = $mysqli->prepare($delete_query);
    $delete_stmt->bind_param("s", $VIN_to_delete);

    if ($delete_stmt->execute()) {
        return ["message" => "Car deleted successfully!", "type" => "success"];
    } else {
        return ["message" => "Error deleting car.", "type" => "error"];
    }
}

/* - EDIT car - */
function editCar($VIN, $Make, $Model, $Asking_Price, $mysqli) {
    $update_query = "UPDATE inventory SET Make = ?, Model = ?, ASKING_PRICE = ? WHERE VIN = ?";
    $update_stmt = $mysqli->prepare($update_query);

    $update_stmt->bind_param("ssds", $Make, $Model, $Asking_Price, $VIN);

    if ($update_stmt->execute()) {
        return ["message" => "Car updated successfully!", "type" => "success"];
    } else {
        return ["message" => "Error updating car: " . $update_stmt->error, "type" => "error"];
    }
}

/* Handle POST request */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $VIN = $_POST['VIN'] ?? null;
    $Make = $_POST['Make'] ?? '';
    $Model = $_POST['Model'] ?? '';
    $Asking_Price = $_POST['Asking_Price'] ?? 0;

    if ($VIN) {
        $response = editCar($VIN, $Make, $Model, $Asking_Price, $mysqli);
        $message = $response["message"];
        $message_type = $response["type"];
    }
}

/* Handle DELETE request */
if (isset($_GET['delete'])) {
    $VIN_to_delete = $_GET['delete'];
    $response = deleteCar($VIN_to_delete, $mysqli);
    $message = $response["message"];
    $message_type = $response["type"];
}
?>