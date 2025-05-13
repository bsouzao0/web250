<?php
require_once 'connect.php';
$db = getDB();

$id = $_GET['id'] ?? null;
if (!$id) header("Location: index.php");

$stmt = $db->prepare("SELECT * FROM expenses WHERE id = ?");
$stmt->execute([$id]);
$expense = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $db->prepare("UPDATE expenses SET item = ?, amount = ?, expense_date = ?, note = ? WHERE id = ?");
    $stmt->execute([
        $_POST['item'],
        $_POST['amount'],
        $_POST['expense_date'],
        $_POST['note'],
        $id
    ]);
    header("Location: index.php");
    exit;
}
?>

<h2>Edit Expense</h2>

<form method="POST">
    <input type="text" name="item" value="<?= htmlspecialchars($expense['item']) ?>" required><br>
    <input type="number" step="0.01" name="amount" value="<?= $expense['amount'] ?>" required><br>
    <input type="date" name="expense_date" value="<?= $expense['expense_date'] ?>" required><br>
    <textarea name="note"><?= htmlspecialchars($expense['note']) ?></textarea><br>
    <button type="submit">Update</button>
</form>
<a href="index.php">← Back</a>
