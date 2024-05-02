<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute SQL statement to insert log
$user_email = $_POST['user_email'];
$user_city = $_POST['user_city'];
$user_country = $_POST['user_country'];
$user_ip = $_SERVER['REMOTE_ADDR'];

$sql = "INSERT INTO tblsyslogs (user_email, user_city, user_country, user_ip) VALUES ('$u_email', '$u_city', '$u_country', '$u_ip')";

if ($conn->query($sql) === TRUE) {
    echo "Log saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
