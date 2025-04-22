<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        
        if (($user['role'] == 'admin' || $user['role'] == 'manager') && $user['password'] === $password) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['user_id'] = $user['id'];

            if ($user['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: manager_dashboard.php");
            }
        }
        
        elseif (password_verify($password, $user['password']) && $user['role'] == 'user') {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['user_id'] = $user['id'];

            header("Location: user_dashboard.php");
        } else {
            echo "<script>alert('Incorrect username or password!');</script>";
        }
    } else {
        echo "<script>alert('User not found!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kalinga TourEase</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('k4.png'); 
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
        <h2>Login</h2>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <a href="signup.php">Don't have an account? Sign Up</a>
    </div>
</body>
</html>