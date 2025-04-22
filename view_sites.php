<?php include 'header.php'; ?>
<?php
include 'db.php';

$query = "SELECT * FROM sites";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourist Sites</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('k7.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        .site {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .site img {
            width: 500px;
            height: 300px;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .site h2 {
            color: #333;
        }

        .site p {
            color: #555;
            font-size: 16px;
        }

        .site form {
            margin-top: 20px;
        }

        .site textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .site select {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .site button {
            padding: 10px 20px;
            background-color: #D2493C;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }

        .site button:hover {
            background-color: #B13F2D;
        }

        .site hr {
            border: 0;
            height: 1px;
            background-color: #ddd;
            margin-top: 20px;
        }
        .logout-btn {
            background-color:rgb(210, 73, 60);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
           
            width: 100%;
            font-size: 16px;

            display:block;
           margin: 10px auto;
            width: 37px;
        }
        .logout-btn:hover {
            background-color:maroon;}

            .logout-btno {
            background-color:rgb(210, 73, 60);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
           position: absolute;
           top: 150px;
           right: 100px;
            width: 100%;
            font-size: 16px;

            display:block;
           margin: 10px auto;
            width: 37px;
        }
        .logout-btno:hover {
            background-color:maroon;}

    </style>
</head>

<body>

    <h1>Explore Kalinga</h1> <a href="user_dashboard.php" class="logout-btno">Back</a>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="site">
           
            <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['site_name']; ?>">

            <h2><?php echo $row['site_name']; ?></h2>
            <p>Location: <?php echo $row['location']; ?></p>
            <p> <?php echo $row['description']; ?></p>
            <p>Nearest Accommodation: <?php echo $row['accommodation']; ?></p>
            <p>Price: <?php echo $row['price']; ?></p>

            
            <form method="GET" action="book_site.php">
                <input type="hidden" name="site_id" value="<?php echo $row['id']; ?>">
                <button type="submit">Book Site</button>
            </form>

           
            <form method="POST" action="leave_feedback.php">
                <input type="hidden" name="site_id" value="<?php echo $row['id']; ?>">
                <textarea name="comment" placeholder="Leave your feedback here..." required></textarea><br>
                <label for="rating">Rating:</label>
                <select name="rating" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select><br>
                <button type="submit">Submit Feedback</button>
            </form>
        </div>
        
        <hr>
       
    <?php endwhile; ?>
    <a href="user_dashboard.php" class="logout-btn">Back</a>
</body>
</html>