<?php include 'header.php'; ?>
<?php
session_start();
include 'db.php';

if ($_SESSION['role'] != 'user') {
    header("Location: index.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('User is not logged in. Please log in again.'); window.location.href='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];  

if (isset($_GET['site_id']) && is_numeric($_GET['site_id'])) {
    $site_id = $_GET['site_id'];

    $query = "SELECT * FROM sites WHERE id='$site_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $site = $result->fetch_assoc();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $payment_option = $_POST['payment_option'];
            $booking_date = $_POST['booking_date']; // Get the selected booking date

            // Insert the booking details into the database
            $query = "INSERT INTO bookings (user_id, site_id, price, status, booking_date) 
                      VALUES ('$user_id', '$site_id', '" . $site['price'] . "', 'pending', '$booking_date')";
            
            if ($conn->query($query) === TRUE) {
                $booking_id = $conn->insert_id;
                $custom_booking_id = 'BOOK-' . $booking_id;

                // Update the booking ID with the custom format
                $update_query = "UPDATE bookings SET booking_id = '$custom_booking_id' WHERE id = '$booking_id'";
                if ($conn->query($update_query) === TRUE) {
                    echo "<script>alert('Successfully booked! Your Booking ID is: $custom_booking_id.'); window.location.href='view_sites.php';</script>";
                } else {
                    echo "<script>alert('Error updating the booking ID.');</script>";
                }
            } else {
                echo "<script>alert('Error in booking. Please try again.');</script>";
            }
        }

        echo "<div class='container'>";
        echo "<h1>" . htmlspecialchars($site['site_name']) . "</h1>";
        echo "<p>Location: " . htmlspecialchars($site['location']) . "</p>";
        echo "<p>Price: ₱" . number_format($site['price'], 2) . "</p>";

        echo "<form method='POST'>";
        
        // Date Picker Field
        echo "<label for='booking_date'>Select Booking Date:</label>";
        echo "<input type='date' name='booking_date' id='booking_date' required><br><br>";

        // Payment Option Field
        echo "<label for='payment_option'>Payment Option:</label>";
        echo "<select name='payment_option' id='payment_option' required>";
        echo "<option value='Gcash'>Gcash</option>";
        echo "<option value='PayPal'>PayPal</option>";
        echo "</select><br><br>";

        // Submit Button
        echo "<button type='submit' class='button'>Pay Now</button>";
        echo "</form>";
        echo "</div>";

        echo "<div class='back-btn'>";
        echo "<a href='view_sites.php' class='button'>Back</a>";
        echo "</div>";
    } else {
        echo "<p>Site not found!</p>";
    }
} else {
    echo "<p>Invalid site ID provided.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Site</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 18px;
            color: #555;
        }
        form {
            margin-top: 20px;
        }
        input[type="date"], select, .button {
            display: block;
            width: 50%;
            margin: 10px auto;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
        }
        .button {
            background-color: rgb(210, 73, 60);
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
        .button:hover {
            background-color: maroon;
        }
        .back-btn {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
</body>
</html>