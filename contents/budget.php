<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<?php
require_once 'budget/connect.php'; 
$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = $_POST['item'];
    $amount = $_POST['amount'];
    $expense_date = $_POST['expense_date'];
    $note = $_POST['note'] ?? '';
    $id = $_POST['id'] ?? null;

    if ($id) {
        $stmt = $db->prepare("UPDATE expenses SET item = ?, amount = ?, expense_date = ?, note = ? WHERE id = ?");
        $stmt->execute([$item, $amount, $expense_date, $note, $id]);
    } else {
        $stmt = $db->prepare("INSERT INTO expenses (item, amount, expense_date, note) VALUES (?, ?, ?, ?)");
        $stmt->execute([$item, $amount, $expense_date, $note]);
    }

    header("Location: index.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $db->prepare("DELETE FROM expenses WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: index.php");
    exit();
}

$result = $db->query("SELECT * FROM expenses ORDER BY expense_date DESC, id DESC");
$total = $db->query("SELECT SUM(amount) FROM expenses")->fetch_row()[0] ?? 0;
?>
<h2>Daily Budget Tracker</h2>
<p><button id="openPopupBtn">Add New Expense</button></p>
<h3>Total Spent: $<?= number_format($total, 2) ?></h3>

<div id="expensePopup" class="popup">
    <div class="popup-content">
        <span id="closePopupBtn" class="close-btn">×</span>

        <?php
        $id = $_GET['edit'] ?? null;
        $item = '';
        $amount = '';
        $expense_date = date('Y-m-d');
        $note = '';

        if ($id) {
            $stmt = $db->prepare("SELECT * FROM expenses WHERE id = ?");
            $stmt->execute([$id]);
            $expense = $stmt->fetch(PDO::FETCH_ASSOC);
            $item = $expense['item'];
            $amount = $expense['amount'];
            $expense_date = $expense['expense_date'];
            $note = $expense['note'];
        }
        ?>

        <h3><?= $id ? 'Edit Expense' : 'Add New Expense' ?></h3>
        <form method="POST" action="index.php">
            <input type="hidden" name="id" value="<?= $id ?? '' ?>">
            <input type="text" name="item" value="<?= htmlspecialchars($item) ?>" placeholder="What did you buy?" required><br>
            <input type="number" name="amount" value="<?= htmlspecialchars($amount) ?>" step="0.01" placeholder="Amount" required><br>
            <input type="date" name="expense_date" value="<?= $expense_date ?>" required><br>
            <textarea name="note" placeholder="Optional note"><?= htmlspecialchars($note) ?></textarea><br>
            <button type="submit"><?= $id ? 'Update Expense' : 'Add Expense' ?></button>
        </form>
    </div>
</div>

<table>
    <tr><th>Date</th><th>Item</th><th>Amount</th><th>Note</th><th>Actions</th></tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['expense_date']) ?></td>
        <td><?= htmlspecialchars($row['item']) ?></td>
        <td>$<?= number_format($row['amount'], 2) ?></td>
        <td><?= htmlspecialchars($row['note']) ?></td>
        <td>
            <a href="index.php?edit=<?= $row['id'] ?>">Edit</a>
            <a href="index.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this expense?')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<script>
  
    document.getElementById("openPopupBtn").addEventListener("click", function() {
        document.getElementById("expensePopup").style.display = "flex"; 
    });

    document.getElementById("closePopupBtn").addEventListener("click", function() {
        document.getElementById("expensePopup").style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target == document.getElementById("expensePopup")) {
            document.getElementById("expensePopup").style.display = "none";
        }
    });
</script>