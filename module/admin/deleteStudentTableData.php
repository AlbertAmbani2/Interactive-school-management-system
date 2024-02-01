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
    $sqlTeachers = "DELETE FROM students WHERE id = ?";
    $stmtTeachers = mysqli_prepare($conn, $sqlTeachers);

    if ($stmtTeachers === false) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    // Bind parameter
    mysqli_stmt_bind_param($stmtTeachers, "s", $id);

    // Execute the prepared statement
    mysqli_stmt_execute($stmtTeachers);

    // Close the statement
    mysqli_stmt_close($stmtTeachers);

    // Second prepared statement for users table
    $sqlUsers = "DELETE FROM users WHERE userid = ?";
    $stmtUsers = mysqli_prepare($conn, $sqlUsers);

    if ($stmtUsers === false) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    // Bind parameter
    mysqli_stmt_bind_param($stmtUsers, "s", $id);

    // Execute the prepared statement
    mysqli_stmt_execute($stmtUsers);

    // Close the statement
    mysqli_stmt_close($stmtUsers);

    // Delete image file
    unlink('../images/'.$id.'.jpg');

    echo "Delete data successfully\n";
    header("Location:../admin/deleteTeacher.php");
    exit(); // Add an exit statement to stop further execution
}

// Close the MySQLi connection
mysqli_close($conn);
?>

