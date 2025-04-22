<?php
include 'db.php';


$username = 'user1';
$password = 'regularuserpassword';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', 'user')";

if ($conn->query($query) === TRUE) {
    echo "User inserted successfully!";
} else {
    echo "Error: " . $conn->error;
}
?>