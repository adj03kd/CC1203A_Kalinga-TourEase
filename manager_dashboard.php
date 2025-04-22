<?php include 'header.php';?>
<?php session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'manager') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manager Dashboard - Kalinga TourEase</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('k8.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
           
        }

        h1 {
            text-align: center;
            margin-top: 130px;
            color: maroon;
        }

        .button-container {
            text-align: center;
            margin-top: 40px;
        }

        .button-container a {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            background-color:rgb(210, 73, 60);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
        }

        .button-container a:hover {
            background-color:maroon;
        }
        .logout-btn {
            background-color:rgb(210, 73, 60);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            position: absolute;
            top: 160px;
            right: 30px;
        }
        .logout-btn:hover {
            background-color:maroon;}
    </style>
</head>
<body>
    <h1>Manager</h1>

    <div class="button-container">
        <a href="view_site.php">Manage Site</a>
        <a href="feedbacksite.php">Feedback</a>
        <a href="bookingsite.php">View Bookings</a>
        
    </div>
    <a href="index.php" class="logout-btn">Logout</a>
</body>
</html>