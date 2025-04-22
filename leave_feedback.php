<?php
session_start();
include 'db.php';


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


$user_query = "SELECT id FROM users WHERE username = '" . $_SESSION['username'] . "'";
$user_result = $conn->query($user_query);

if ($user_result->num_rows > 0) {
    $user = $user_result->fetch_assoc();
    $user_id = $user['id'];
} else {
  
    echo "<script>alert('User not found.'); window.location.href='login.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    $site_id = $_POST['site_id'];
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];

    
    $insert_feedback_query = "INSERT INTO feedback (site_id, user_id, comment, rating) 
                              VALUES ('$site_id', '$user_id', '$comment', '$rating')";

    if ($conn->query($insert_feedback_query)) {
       
        echo "<script>alert('Feedback submitted successfully!'); window.location.href='view_sites.php';</script>";
    } else {
        
        echo "<script>alert('Error submitting feedback.');</script>";
    }
}
?>


<form method="POST" action="leave_feedback.php">
    <input type="hidden" name="site_id" value="<?php echo $_GET['site_id']; ?>">
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