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

// Fetch feedback only for the manager's site
$query = "SELECT f.id, f.comment, u.username, f.rating 
          FROM feedback f 
          JOIN users u ON f.user_id = u.id 
          WHERE f.site_id = '$site_id'";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Site Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
        h1 {
            text-align: center;
            color: maroon;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color:maroon;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Feedback</h1>
        <table>
            <tr>
                <th>Feedback ID</th>
                <th>Username</th>
                <th>Comment</th>
                
                <th>Rating</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['comment']; ?></td>
                
                <td><?php echo $row['rating']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <a href="manager_dashboard.php" class="logout-btn">Back</a>
</body>
</html>