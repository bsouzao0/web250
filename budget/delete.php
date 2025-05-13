<?php
require_once 'connect.php';
$db = getDB();

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $db->prepare("DELETE FROM expenses WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: index.php");
exit;
