
<?php

header("Content-Type: application/json");

session_start();
include 'dbConnect.php';

$username = trim($_POST['username']);
$password = $_POST['password'];

$query = "SELECT id, first_name, last_name, username, password FROM users WHERE username = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        session_regenerate_id(true);
        echo json_encode(['success' => true]);
        exit;
    }
}

echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
?>