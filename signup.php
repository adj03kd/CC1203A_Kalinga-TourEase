<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "<script>alert('Username already exists!');</script>";
    } else {
       
        $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', 'user')";
        if ($conn->query($query)) {
            echo "<script>alert('Signup successful! You can now log in.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error during signup. Please try again.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Kalinga TourEase</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-image: url('k3.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 40%;
            margin: 80px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
        h1 {
            font-size: 32px;
            color: maroon;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 28px;
            color: rgb(210, 73, 60);
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            font-size: 16px;
            color: #555;
            margin-top: 10px;
        }
        input {
            width: 80%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color:rgb(210, 73, 60);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color:maroon;
        }
        a {
            color: #007BFF;
            text-decoration: none;
            font-size: 14px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kalinga TourEase</h1>
        <h2>Signup</h2>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Signup</button>
        </form>
        <a href="index.php">Back to Homepage</a>
    </div>
</body>
</html>