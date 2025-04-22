<?php include 'header.php'; ?>
<?php
session_start();
include 'db.php';


// Check if the user is a manager and logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'manager') {
    header("Location: login.php");
    exit();
}

// Get the manager's username and assign their site_id based on the owner
$manager_username = $_SESSION['username'];
$site_id = 0; // Default value, to be changed based on manager

// Assign the appropriate site_id based on the manager (owner1, owner2, owner3)
if ($manager_username == 'owner1') {
    $site_id = 7;
} elseif ($manager_username == 'owner2') {
    $site_id = 8;
} elseif ($manager_username == 'owner3') {
    $site_id = 9;
}

// Fetch bookings only for the manager's site
$query = "SELECT b.booking_id, s.site_name, u.username, b.price, b.booking_date 
          FROM bookings b 
          JOIN users u ON b.user_id = u.id 
          JOIN sites s ON b.site_id = s.id 
          WHERE s.id = '$site_id' AND b.status = 'confirmed'";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirmed Bookings - Kalinga TourEase</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 40px;
            color:black;
        }

        .container {
            width: 80%;
            margin: 40px auto;
            background-color:white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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

        th {
            background-color:maroon;
            color: white;
        }

        tr:nth-child(even) {
            background-color:white;
        }

        tr:hover {
            background-color: #ddd;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            background-color:rgb(210, 73, 60);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
        }

       
    </style>
</head>
<body>
    <h1>Confirmed Bookings</h1>

    <div class="container">
        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                <th>Username</th>
                    <th>Site Name</th>
                    
                    <th>Price</th>
                    <th>Date</th>

                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                    <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['site_name']; ?></td>
                        
                        <td><?php echo $row['price']; ?></td>
                        
                        <td><?php echo $row['booking_date']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p style="text-align: center; color: #555;">No confirmed bookings yet.</p>
        <?php endif; ?>
    </div>

    <a href="manager_dashboard.php">Back</a>
</body>
</html>