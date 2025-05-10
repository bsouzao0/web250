<?php
/**
 * Joy of PHP sample code
 * Demonstrates how to create a database, create a table, and insert records.
 */

include 'db.php';

   if (!$mysqli) { 
      die('Could not connect: ' . $mysqli->connect_error);
  } 
  echo 'Connected successfully to MySQL. <BR>'; 


//select a database to work with
$mysqli->select_db("if0_38812485_cars");
echo ("Selected the Cars database <br>");

$query = " CREATE TABLE IMAGES (ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT, VIN varchar(17), ImageFile varchar(250))";
//echo "<p>***********</p>";
//echo $query ;
//echo "<p>***********</p>";
if ($mysqli->query($query) === TRUE) 
{
    echo "Database table 'Images' created</br>";
}
else
{
    echo "<p>Error: " . $mysqli->error; "</p>";
}
 echo "<br><br><a href='index.html'>Home</a>";
$mysqli->close();
?>