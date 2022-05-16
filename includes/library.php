<?php
$servername = "stars4uni.com";
$database = "u119600147_Star4uni";
$username = "u119600147_stars4uni";
$password = "Unistar1234!";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
mysqli_close($conn);
?>