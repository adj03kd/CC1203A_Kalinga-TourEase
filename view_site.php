<?php
include 'header.php'; 
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'manager') {
    header("Location: login.php");
    exit();
}

$manager_username = $_SESSION['username'];


// Handle the booking confirmation
if (isset($_GET['confirm_booking_id'])) {
    $booking_id = $_GET['confirm_booking_id'];

    // Update the booking status to 'confirmed'
    $update_query = "UPDATE bookings SET status='confirmed' WHERE booking_id='$booking_id'";

    if ($conn->query($update_query)) {
        echo "<script>alert('Booking confirmed successfully!');</script>";
    } else {
        echo "<script>alert('Error confirming booking: " . $conn->error . "');</script>";
    }
}

// Handle the form submission to update site details
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_site'])) {
    // Get the updated site details from the form
    $site_name = $_POST['site_name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $accommodation = $_POST['accommodation'];
    $price = $_POST['price'];
    $site_id = $_POST['site_id'];

    // Update the site in the database
    $update_query = "UPDATE sites SET site_name='$site_name', location='$location', description='$description', accommodation='$accommodation', price='$price' WHERE id='$site_id'";

    if ($conn->query($update_query) === TRUE) {
        echo "<script>alert('Site updated successfully!');</script>";
        header("Location: view_site.php"); // Redirect after successful update
        exit();
    } else {
        echo "<script>alert('Error updating site: " . $conn->error . "');</script>";
    }
}
$feedback_query = "SELECT f.comment, f.rating, u.username AS user_name, s.site_name 
                   FROM feedback f
                   JOIN users u ON f.user_id = u.id
                   JOIN sites s ON f.site_id = s.id";
$feedback_result = $conn->query($feedback_query);

$site_query = "SELECT * FROM sites WHERE manager = '$manager_username'";
$site_result = $conn->query($site_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Sites - Kalinga TourEase</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container, .booking-container {
            margin-bottom: 40px;
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        h2 {
            margin-top: 0;
            color: maroon;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
        }

        input, textarea, select {
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .button-container {
            text-align: right;
            margin-top: 20px;
        }

        .button-container a {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .button-container a:hover {
            background-color: #45a049;
        }

        .logout-btn {
            background-color: rgb(210, 73, 60);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            display: block;
            margin: 10px auto;
            width: 37px;
        }

        .logout-btn:hover {
            background-color: maroon;
        }
    </style>
</head>

<body>

<div class="container">
    <h1>Manage Your Tourist Sites</h1>

    <?php while ($site = $site_result->fetch_assoc()): ?>
        <div class="form-container">
            <h2> <?php echo $site['site_name']; ?></h2>
            <form method="POST" action="view_site.php">
                <input type="hidden" name="site_id" value="<?php echo $site['id']; ?>"> 
                
                <label for="site_name">Site Name:</label>
                <input type="text" name="site_name" value="<?php echo $site['site_name']; ?>" required>

                <label for="location">Location:</label>
                <input type="text" name="location" value="<?php echo $site['location']; ?>" required>

                <label for="description">Description:</label>
                <textarea name="description" required><?php echo $site['description']; ?></textarea>

                <label for="accommodation">Nearest Accommodation:</label>
                <textarea name="accommodation" required><?php echo $site['accommodation']; ?></textarea>

                <label for="price">Price:</label>
                <input type="number" name="price" value="<?php echo $site['price']; ?>" required>

                <input type="submit" name="edit_site" value="Save Changes">
            </form>
        </div>

        
        <div class="booking-container">
            <h2>Pending Bookings</h2>
            
            <?php 
        
            $booking_query = "SELECT b.booking_id, u.username, b.price, b.booking_date
                              FROM bookings b
                              JOIN users u ON b.user_id = u.id
                              WHERE b.site_id = '" . $site['id'] . "' AND b.status = 'pending'";
            $booking_result = $conn->query($booking_query);

            if ($booking_result->num_rows > 0): ?>
                <table>
                    <tr>
                        <th>Username</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Confirm</th>

                    </tr>
                    <?php while ($row = $booking_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['booking_date']; ?></td>
                            <td><a href="view_site.php?confirm_booking_id=<?php echo $row['booking_id']; ?>">Confirm Booking</a></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No pending bookings.</p>
            <?php endif; ?>
        </div>

    <?php endwhile; ?>
</div>


<a href="manager_dashboard.php" class="logout-btn">Back</a>

</body>
</html>