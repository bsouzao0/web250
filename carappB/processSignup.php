<?php
session_start();
include 'db.php';

if (isset($_POST['new_username']) && isset($_POST['new_password']) && isset($_POST['first_name']) && isset($_POST['last_name'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $new_username = $_POST['new_username'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);


    $checkQuery = "SELECT * FROM users WHERE username = '$new_username'";
    $checkResult = $mysqli->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Username already exists']);
    } else {

        $insertQuery = "INSERT INTO users (first_name, last_name, username, password) VALUES ('$first_name', '$last_name', '$new_username', '$new_password')";
        if ($mysqli->query($insertQuery)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error creating account']);
        }
    }
}
?>
