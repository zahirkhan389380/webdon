<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "donations";

$con = new mysqli($server, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection to this database failed due to " . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("DELETE FROM donations WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
}

$con->close();
?>
