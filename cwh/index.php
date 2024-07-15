<?php
$insert = false;
if(isset($_POST['hotel'])){
    // Set connection variables
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "donations";

    // Create a database connection
    $con = new mysqli($server, $username, $password, $dbname);

    // Check for connection success
    if($con->connect_error){
        die("Connection to this database failed due to " . $con->connect_error);
    }

    // Collect post variables
    $hotel = htmlspecialchars($_POST['hotel']);
    $food = htmlspecialchars($_POST['food']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $email = htmlspecialchars($_POST['email']);

    // Prepare the SQL statement
    $stmt = $con->prepare("INSERT INTO donations (hotel, food, phone, address, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $hotel, $food, $phone, $address, $email);

    // Execute the query
    if($stmt->execute()){
        // Flag for successful insertion
        $insert = true;
        header("Location: index.html?success=true");
        exit;
    } else {
        echo "ERROR: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $con->close();
} else {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Donation Form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <h1>LADAKH FOOD DONATION WEBSITE</h1>
            <ul>
                <li><a href="../list/index.html">Food List</a></li>
                <li><a href="../compline/index.html">Complain</a></li>
                <li><a href="../front pages/pr.html">Home</a></li>
            </ul>
        </nav>
    </header>
    <img class="bg" src="bg.jpg" alt="Donation Background">
    <div class="container">
        <?php
        if(isset($_GET['success']) && $_GET['success'] == true){
            echo "<p class='submitMsg'>Thanks for submitting your form. We are happy to receive your food donation</p>";
        }
        ?>
        <form action="index.php" method="post">
            <input type="text" name="hotel" id="hotel" placeholder="Enter the hotel name" required><br>
            <input type="text" name="food" id="food" placeholder="Enter the food description" required><br>
            <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" required><br>
            <textarea name="address" id="address" placeholder="Enter your address" rows="4" cols="50" required></textarea><br>
            <input type="email" name="email" id="email" placeholder="Enter your email" required><br>
            <button class="btn">Submit</button> 
        </form>
    </div>
    <footer>
        <div class="footer-content">
            <div class="footer-section about">
                <h3>About Us</h3>
                <p>Our mission is to facilitate the donation of food items to those in need, helping to reduce food waste and hunger.</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Donate Food. All rights reserved.</p>
        </div>
    </footer>
    <script src="index.js"></script>
</body>
</html>
