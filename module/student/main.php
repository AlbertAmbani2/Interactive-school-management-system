<?php
include_once('../../service/mysqlcon.php');

$check = $_SESSION['login_id'];

// Use prepared statements to prevent SQL injection
$stmt = mysqli_prepare($conn, "SELECT name FROM students WHERE id = ?");
mysqli_stmt_bind_param($stmt, "s", $check);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if the query was successful
if ($result) {
    $row = mysqli_fetch_array($result);

    // Check if the user is logged in
    if (isset($row['name'])) {
        $login_session = $loged_user_name = $row['name'];
    } else {
        header("Location:../../");
    }
} else {
    // Handle the error if the query fails
    die('Error in SQL query: ' . mysqli_error($conn));
}

// Close the MySQLi statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

