<?php
include_once('mysqlcon.php');

session_start();

$myid = $_POST['myid'];
$mypassword = $_POST['mypassword'];

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT usertype FROM users WHERE userid=? AND password=?");
$stmt->bind_param("ss", $myid, $mypassword);
$stmt->execute();

$stmt->store_result();
$count = $stmt->num_rows;

$stmt->bind_result($control);
$stmt->fetch();
$stmt->close();

$_SESSION['login_id'] = $myid;

if ($count != 1 || !isset($control)) {
    header("Location:../index.php?login=false");
} else {
    switch ($control) {
        case "admin":
            header("Location:../module/admin");
            break;
        case "teacher":
            header("Location:../module/teacher");
            break;
        case "student":
            header("Location:../module/student");
            break;
        case "staff":
            header("Location:../module/staff");
            break;
        case "parent":
            header("Location:../module/parent");
            break;
        default:
            header("Location:../index.php?login=false");
            break;
    }
}

$conn->close();
?>
