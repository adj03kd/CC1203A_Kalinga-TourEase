<?php
session_start();
include 'db.php';

if ($_SESSION['role'] != 'manager') {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];

$query = "SELECT b.booking_id, u.username, s.site_name, b.price, b.status 
          FROM bookings b 
          JOIN users u ON b.user_id = u.id 
          JOIN tourist_sites s ON b.site_id = s.site_id 
          WHERE s.assigned_to='$username' AND b.status='pending'";
$result = $conn->query($query);

echo "<h1>Pending Bookings</h1>";
while ($row = $result->fetch_assoc()) {
    echo "<div class='booking'>";
    echo "<p>Booking ID: " . $row['booking_id'] . "</p>";
    echo "<p>User: " . $row['username'] . "</p>";
    echo "<p>Site: " . $row['site_name'] . "</p>";
    echo "<p>Price: " . $row['price'] . "</p>";

    // Include the booking_id in the form for confirming
    echo "<form method='POST'>";
    echo "<input type='hidden' name='booking_id' value='" . $row['booking_id'] . "'>";  // Hidden field for booking_id
    echo "<button type='submit' class='button'>Confirm Booking</button>";
    echo "</form>";
    echo "</div>";
}

// Update the booking status only after the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['booking_id'])) {
    $booking_id = $_POST['booking_id'];  // Get the booking_id from the form submission

    // Update the status of the specific booking to 'confirmed'
    $update_query = "UPDATE bookings SET status='confirmed' WHERE booking_id='$booking_id'";

    if ($conn->query($update_query) === TRUE) {
        echo "<script>alert('Booking confirmed!');</script>";
        header("Location: manager_dashboard.php");  // Redirect to the dashboard after confirmation
        exit();
    } else {
        echo "<script>alert('Error confirming booking.');</script>";
    }
}
?>