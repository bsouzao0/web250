<?php 
include 'db.php';

function addCar($VIN, $Make, $Model, $Asking_Price, $mysqli) {
    $query = "INSERT INTO inventory (VIN, Make, Model, ASKING_PRICE) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sssd", $VIN, $Make, $Model, $Asking_Price);

    if ($stmt->execute()) {
        return ["message" => "You have successfully entered <strong>$Make $Model</strong> into the database", "type" => "success"];
    } else {
        return ["message" => "Error entering $VIN into database: " . $stmt->error, "type" => "error"];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if (isset($_POST['VIN'], $_POST['Make'], $_POST['Model'], $_POST['Asking_Price'])) {
        $VIN = trim($_POST['VIN']);
        $Make = trim($_POST['Make']);
        $Model = trim($_POST['Model']);
        $Asking_Price = floatval($_POST['Asking_Price']);
        
        if (empty($VIN) || empty($Make) || empty($Model) || empty($Asking_Price)) {
            $message = "Please fill in all fields!";
            $message_type = "error";
        } else {
            $response = addCar($VIN, $Make, $Model, $Asking_Price, $mysqli);
            $message = $response['message'];
            $message_type = $response['type'];
        }
    } else {
        $message = "Invalid form submission!";
        $message_type = "error";
    }
    
    $mysqli->close();
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

<?php include 'components/header.php'; ?>

<main>
    <section class="car-form">
        <h4 class="<?= $message_type ?>"><?= $message ?></h4>
        <p><a href="./">Return to Inventory</a></p>
    </section>
</main>

<?php include 'components/footer.php'; ?>

</body>
</html>
