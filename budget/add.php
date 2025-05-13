<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $db->prepare("INSERT INTO expenses (item, amount, expense_date, note) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_POST['item'],
        $_POST['amount'],
        $_POST['expense_date'],
        $_POST['note'] ?? ''
    ]);
    header("Location: index.php");
    exit;
}
?>

<h2>Add Expense</h2>

<form method="POST">
    <input type="text" name="item" placeholder="What did you buy?" required><br>
    <input type="number" name="amount" step="0.01" placeholder="Amount" required><br>
    <input type="date" name="expense_date" value="<?= date('Y-m-d') ?>" required><br>
    <textarea name="note" placeholder="Optional note"></textarea><br>
    <button type="submit">Add</button>
</form>
<a href="index.php">← Back</a>
