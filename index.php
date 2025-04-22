<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalinga TourEase</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('k1.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .container {
            width: 50%;
            margin: 200px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 40px;
            color: maroon;
        }

        .button {
            display: inline-block;
            margin: 10px;
            padding: 15px 25px;
            font-size: 16px;
            background-color:rgb(210, 73, 60);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .button:hover {
            background-color:maroon;
        }

        .link-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Kalinga TourEase</h1>
        
        <div class="link-container">
            <a href="login.php" class="button">Login</a>
            <a href="signup.php" class="button">Sign Up</a>
        </div>
    </div>

</body>
</html>