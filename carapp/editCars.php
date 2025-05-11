<?php
include 'db.php';
include 'dbConnect.php';
include 'carActions.php';

if (isset($_GET['vin'])) {
    $VIN = $_GET['vin'];

    $query = "SELECT * FROM inventory WHERE VIN = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $VIN);
    $stmt->execute();
    $car = $stmt->get_result()->fetch_assoc();

    if (!$car) {
        die("Car not found.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['VIN'], $_POST['Make'], $_POST['Model'], $_POST['Asking_Price'])) {

    $VIN = $_POST['VIN'];
    $Make = trim($_POST['Make']);
    $Model = trim($_POST['Model']);
    $Asking_Price = filter_var($_POST['Asking_Price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    if (!is_numeric($Asking_Price) || $Asking_Price <= 0) {
        $message = "Please enter a valid price.";
        $message_type = "error";
    } else {
        $response = editCar($VIN, $Make, $Model, $Asking_Price, $mysqli);
        $message = $response["message"];
        $message_type = $response["type"];

        if ($message_type === "success") {
            header('Location: ./'); 
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/blueorchid.png?">
    <link rel="stylesheet" href="styles/default.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://lint.page/kit/880bd5.js" crossorigin="anonymous"></script>
    <title>Blue Orchid's Used Cars</title>
</head>
<body>
    <?php include 'components/header.php'; ?>
    <main>

        <?php if (isset($message)): ?>
            <h3 class="<?= $message_type ?>"><?= $message ?></h3>
        <?php endif; ?>

        <h2>Edit Car</h2>

        <form action="editCars.php" method="post" class="car-form">
            <input type="hidden" name="VIN" value="<?= htmlspecialchars($car['VIN']) ?>" />
            <label for="Make">Make:</label>
            <input id="Make" name="Make" type="text" value="<?= htmlspecialchars($car['Make']) ?>" required /><br /><br />

            <label for="Model">Model:</label>
            <input id="Model" name="Model" type="text" value="<?= htmlspecialchars($car['Model']) ?>" required /><br /><br />

            <label for="Asking_Price">Price:</label>
            <input id="Asking_Price" name="Asking_Price" type="number" step="0.01" value="<?= htmlspecialchars($car['ASKING_PRICE']) ?>" required /><br /><br />

            <input type="submit" value="Update Car" />
        </form>

    </main>
    <?php include 'components/footer.php'; ?>
</body>
</html>
