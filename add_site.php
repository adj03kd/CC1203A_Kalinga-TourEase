<?php include 'header.php'; ?>
<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $site_name = $_POST['site_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $accommodation = $_POST['accommodation'];
    $location = $_POST['location'];
    $manager = $_POST['manager'];

    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $query = "INSERT INTO sites (site_name, image, price, description, accommodation, location, manager) 
                  VALUES ('$site_name', '$image', '$price', '$description', '$accommodation', '$location', '$manager')";
        if ($conn->query($query)) {
            echo "<script>alert('Site added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding site.');</script>";
        }
    } else {
        echo "<script>alert('Failed to upload image.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Tourist Site - Kalinga TourEase</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: maroon;
        }

        .form-container {
            width: 60%;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color:rgb(210, 73, 60);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color:maroon;
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

        a:hover {
            background-color:maroon;
        }
    </style>
</head>
<body>
    <h1>Add New Tourist Site</h1>
    <div class="form-container">
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="site_name">Site Name:</label>
            <input type="text" name="site_name" required>

            <label for="image">Image:</label>
            <input type="file" name="image" required>

            <label for="price">Price:</label>
            <input type="number" name="price" required>

            <label for="description">Description:</label>
            <textarea name="description" rows="5" required></textarea>

            <label for="accomodation">Nearest Accomodation:</label>
            <textarea name="accommodation" rows="5" required></textarea>

            <label for="location">Location:</label>
            <input type="text" name="location" required>

            <label for="manager">Assign Manager:</label>
            <select name="manager" required>
                <option value="owner1">Owner 1</option>
                <option value="owner2">Owner 2</option>
                <option value="owner3">Owner 3</option>
            </select>

            <button type="submit">Add Site</button>
        </form>
    </div>
    <a href="admin_dashboard.php">Back</a>
</body>
</html>