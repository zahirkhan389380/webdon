<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "donations";

$con = new mysqli($server, $username, $password, $dbname);

if($con->connect_error){
    die("Connection to this database failed due to " . $con->connect_error);
}

$sql = "SELECT id, hotel, food, phone, address, email FROM donations";
$result = $con->query($sql);

$foodItems = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $foodItems[] = $row;
    }
}

$con->close();

header('Content-Type: application/json');
echo json_encode($foodItems);
?>
