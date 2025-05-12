<?php
include './dbConnect.php';

$file = './data/inventory.csv';

if (!file_exists($file)) {
    die('CSV file not found.');
}

$handle = fopen($file, 'r');

if ($handle === FALSE) {
    die('Error opening the file.');
}

fgetcsv($handle);

while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
    if (count($data) < 4) {

        continue;
    }

    list($vin, $make, $model, $asking_price) = $data;

    if (empty($vin)) {
        continue; 
    }

    $asking_price = ($asking_price === '') ? 'NULL' : $asking_price;

    $query = "
        INSERT INTO inventory 
        (VIN, Make, Model, ASKING_PRICE)
        VALUES (
            '$vin', '$make', '$model', $asking_price
        )
    ";

    echo $query . "<br>";

    if (!$mysqli->query($query)) {
        echo "Error inserting VIN $vin: " . $mysqli->error . "<br>";
    } else {
        echo "Successfully inserted VIN $vin.<br>";
    }
}

fclose($handle);
echo "CSV data import completed.";

$mysqli->close();
?>
