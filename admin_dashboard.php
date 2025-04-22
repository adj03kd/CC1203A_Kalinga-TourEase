<?php include 'header.php'; ?>
<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}


$feedback_query = "SELECT f.comment, f.rating, u.username AS user_name, s.site_name 
                   FROM feedback f
                   JOIN users u ON f.user_id = u.id
                   JOIN sites s ON f.site_id = s.id";
$feedback_result = $conn->query($feedback_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kalinga TourEase</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('k5.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin: 100px;
            color: maroon;
            
        }

        .button-container {
            text-align: center;
            margin: 20px 0 60px;
        }

        .button-container a {
            background-color:rgb(210, 73, 60);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            font-weight: bold;
        }

        .button-container a:hover {
            background-color:maroon;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            margin: 0 auto 40px;
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

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        th {
            background-color:maroon;
            color: white;
        }

        p {
            text-align: center;
            font-size: 18px;
            color: #333;
        }
        .logout-btn {
            background-color:rgb(210, 73, 60);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            position: absolute;
            top: 150px;
            right: 30px;
        }
        .logout-btn:hover {
            background-color:maroon;}
    </style>
</head>
<body>
   
    <h1>Admin</h1>

   
    <div class="button-container">
        <a href="add_site.php">Add New Tourist Site</a>
        <a href="confirmed_bookings.php">View Bookings</a>
    </div>

   
    <div class="container">
        <h2 style="text-align:center;">User Feedback</h2>
        <?php if ($feedback_result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>User</th>
                    <th>Site Name</th>
                    <th>Rating</th>
                    <th>Comment</th>
                </tr>
                <?php while ($row = $feedback_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['user_name']; ?></td>
                        <td><?php echo $row['site_name']; ?></td>
                        <td><?php echo $row['rating']; ?></td>
                        <td><?php echo $row['comment']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No feedback yet.</p>
        <?php endif; ?>
    </div>

    <a href="index.php" class="logout-btn">Logout</a>
</body>
</html>