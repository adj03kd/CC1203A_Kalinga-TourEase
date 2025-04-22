<?php include 'header.php'; ?>
<?php
session_start();
include 'db.php';

if ($_SESSION['role'] != 'user') {
    header("Location: index.php");
}

$user_id = $_SESSION['user_id'];  

$query = "SELECT b.booking_id, s.site_name, b.price, b.status, b.booking_date 
          FROM bookings b
          JOIN sites s ON b.site_id = s.id  
          WHERE b.user_id = '$user_id'";   
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
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
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color:rgb(210, 73, 60);
            color: white;
        }
        td {
            background-color: #f9f9f9;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color:maroon;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }
        .button:hover {
            background-color:maroon;
        }
        .back-button {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color:rgb(210, 73, 60);
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            border-radius: 4px;
        }
        .back-button:hover {
            background-color:rgb(155, 45, 28);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Bookings</h1>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    
                    <th>Site Name</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        
                        <td><?php echo $row['site_name']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['booking_date']; ?></td>
                        <td><?php echo $row['status']; ?></td>

                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No bookings found.</p>
        <?php endif; ?>

        <button class="back-button" onclick="window.history.back()">Back</button>
    </div>
</body>
</html>