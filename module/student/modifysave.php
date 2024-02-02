<?php
include_once('main.php');

// Student ID or any unique identifier
$check = $_SESSION['login_id'];

// Check if there is a modify_message in the session
if (isset($_SESSION['modify_message'])) {
    echo "<p>{$_SESSION['modify_message']}</p>";

    // Clear the session variable after displaying the message
    unset($_SESSION['modify_message']);
}

// Create a connection to the database using MySQLi
$host = "localhost";
$username = "root";
$password = "";
$db_name = "schoolmsdb";

$conn = new mysqli($host, $username, $password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the new password from the form
$newPassword = $_POST['password'];

// Update the password in the database
$sql = "UPDATE students SET password = '$newPassword' WHERE id = '$check'";
$result = $conn->query($sql);

// Check if the update was successful
if ($result) {
    echo "Password updated successfully!";
} else {
    // Handle the case where the update fails
    echo "Error updating password: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
