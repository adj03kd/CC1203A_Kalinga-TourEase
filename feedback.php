<?php
session_start();
include 'db.php';

if ($_SESSION['role'] != 'user') {
    header("Location: index.php");
}

if (isset($_GET['site_id'])) {
    $site_id = $_GET['site_id'];
    $user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $comment = $_POST['comment'];
        $rating = $_POST['rating'];
        $conn->query("INSERT INTO feedback (user_id, site_id, comment, rating) VALUES ('$user_id', '$site_id', '$comment', '$rating')");
        echo "<script>alert('Feedback submitted!');</script>";
        header("Location: view_sites.php");
    }

    echo "<h1>Leave Feedback</h1>";
    echo "<form method='POST'>";
    echo "<textarea name='comment' placeholder='Your comment' required></textarea><br>";
    echo "<input type='number' name='rating' placeholder='Rating (1-5)' min='1' max='5' required><br>";
    echo "<button type='submit' class='button'>Submit Feedback</button>";
    echo "</form>";
}
?>