<?php
include_once('main.php');
include_once('../../service/mysqlcon.php');

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])) {
    $id = $_POST['id'];

    // Create a prepared statement to prevent SQL injection
    $sql = "DELETE FROM subject WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    // Bind parameter
    mysqli_stmt_bind_param($stmt, "s", $id);

    // Execute the prepared statement
    mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    echo "Delete data successfully\n";
    header("Location:../admin/deleteSubject.php");
    exit(); // Add an exit statement to stop further execution
}

// Close the MySQLi connection
mysqli_close($conn);
?>

