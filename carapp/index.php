<?php 
include 'scripts/db.php';
include 'dbConnect.php';
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
    </main>
    <?php include 'components/footer.php'; ?>
</body>
</html>

