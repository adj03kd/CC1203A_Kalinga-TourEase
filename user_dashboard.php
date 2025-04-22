<?php include 'header.php'; ?>
<?php
session_start();
if ($_SESSION['role'] != 'user') {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('k6.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .container {
            width: 30%;
            margin: 170px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
          
            text-align: center; 
        }
        h1 {
            color: maroon;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: rgb(210, 73, 60);
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
            text-align: center;
        }
        .button:hover {
            background-color: #7a2a24;
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
    <div class="container">
        <h1>Welcome to Kalinga</h1>
        <a href="view_sites.php" class="button">View Tourist Sites</a>
        <a href="my_bookings.php" class="button">My Bookings</a>
    </div>
    <a href="index.php" class="logout-btn">Logout</a>
</body>
</html>