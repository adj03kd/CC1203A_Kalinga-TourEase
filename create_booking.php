<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // Assuming user is logged in
    $site_id = $_POST['site_id']; // The site selected by the user
    $price = $_POST['price']; // Price of the site

    // Insert booking into the database with status 'pending'
    $query = "INSERT INTO bookings (user_id, site_id, price, status) 
              VALUES ('$user_id', '$site_id', '$price', 'pending')";

    if ($conn->query($query)) {
        echo "Booking successfully placed! Your booking ID will be confirmed soon.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>