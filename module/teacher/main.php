<?php
include_once('../../service/mysqlcon.php');

$check = $_SESSION['login_id'];

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch teacher's name from the database
$result = $conn->query("SELECT name FROM teachers WHERE id='$check'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $login_session = $loged_user_name = $row['name'];
} else {
    // If teacher is not logged in, redirect to the homepage
    header("Location: ../../");
    exit(); // Ensure that the script stops execution after redirect
}

// Close the database connection
$conn->close();
?>

