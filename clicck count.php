<?php
// Database Configuration
$servername="localhost";
$username="root";
$password="";
$dbname="MP_ajjaks";
// Create a connection

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

// Get current date
$date = date("Y-m-d");

// Update or Insert click count
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $conn->query("SELECT * FROM site_counter WHERE date = '$date'");

    if ($result->num_rows > 0) {
        $conn->query("UPDATE site_counter SET click_count = click_count + 1 WHERE date = '$date'");
    } else {
        $conn->query("INSERT INTO site_counter (date, click_count) VALUES ('$date', 1)");
    }
    exit; // Exit after updating the click count
}

// Retrieve today's click count
$result = $conn->query("SELECT click_count FROM site_counter WHERE date = '$date'");
$row = $result->fetch_assoc();
$click_count = $row ? $row['click_count'] : 0;
?>