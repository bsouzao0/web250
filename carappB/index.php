<?php
session_start();
include 'db.php';
include 'dbConnect.php';
include 'getInventory.php';
include 'carActions.php';

$limit = 10; 

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;  

$cars = getCars($mysqli, $limit, $offset);

$totalCarsResult = $mysqli->query("SELECT COUNT(*) AS total FROM inventory");
$totalCars = $totalCarsResult->fetch_assoc()['total'];
$totalPages = ceil($totalCars / $limit);  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../images/blueorchid.png?">
    <link rel="stylesheet" href="styles/default.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&family=Poppins&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://lint.page/kit/880bd5.js" crossorigin="anonymous"></script>
    <title>Blue Orchid's Used Cars</title>
</head>
<body>

<?php include 'components/header.php'; ?>

<div class="login-btn" id="loginBtn">Login</div>
<div class="login-btn" id="signupBtn" style="right: 120px;">Sign Up</div>

<?php if (isset($_SESSION['user'])): ?>
    <p class="welcome-msg">Welcome, <?= htmlspecialchars($_SESSION['first_name']) ?> <?= htmlspecialchars($_SESSION['last_name']) ?>! 
        <a href="logout.php" class="btn btn-sm btn-danger">Logout</a>
    </p>
<?php endif; ?>

<?php include 'scripts/login-popup.php'; ?>

<main>
    <?php if (isset($_SESSION['user'])): ?>
        <h2>Add a New Car</h2>
        <form action="submitCar.php" method="post" class="car-form">
            <label for="VIN">VIN:</label>
            <input id="VIN" name="VIN" type="text" required /><br /><br />

            <label for="Make">Make:</label>
            <input id="Make" name="Make" type="text" required /><br /><br />

            <label for="Model">Model:</label>
            <input id="Model" name="Model" type="text" required /><br /><br />

            <label for="Asking_Price">Price:</label>
            <input id="Asking_Price" name="Asking_Price" type="number" step="0.01" required /><br /><br />

            <input type="submit" value="Add Car" />
        </form>
    <?php endif; ?>

    <h2>Our Inventory</h2>
    <div class="car-list">
        <?php foreach ($cars as $car): ?>
            <div class="car">
                <h4><?= htmlspecialchars($car['Make']) ?> <?= htmlspecialchars($car['Model']) ?></h4>
                <p>VIN: <?= htmlspecialchars($car['VIN']) ?></p>
                <p>Price: $<?= number_format($car['ASKING_PRICE'], 2) ?></p>
            </div>

            <?php if (isset($_SESSION['user'])): ?>
                <div>
                    <a href="editCars.php?vin=<?= urlencode($car['VIN']) ?>" class="btn btn-sm btn-primary">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="./?delete=<?= urlencode($car['VIN']) ?>" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this car?');">
                        <i class="bi bi-trash"></i> Delete
                    </a>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>">&laquo; Prev</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" class="<?= ($i === $page) ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>">Next &raquo;</a>
        <?php endif; ?>
    </div>

</main>

<?php include 'components/footer.php'; ?>


</body>
</html>
