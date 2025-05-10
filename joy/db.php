 <?php
$mysqli = new mysqli('sql103.infinityfree.com', 'if0_38812485', 'qqcg1y65rGVM', 'if0_38812485_cars' );
/* check connection */
if ($mysqli->connect_error) {
    printf("Connect failed: %s\n" . $mysqli->connect_error);
    exit();
}
//select a database to work with
$mysqli->select_db("if0_38812485_cars");
 
?>