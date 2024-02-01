<?php
include_once('main.php');
include_once('../../service/mysqlcon.php');

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchKey = $_GET['key'];

$string = "";
$sql = "SELECT * FROM teachers WHERE id LIKE ? OR name LIKE ?;";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt === false) {
    die("Error in SQL query: " . mysqli_error($conn));
}

// Bind parameters
$searchKeyParam = "%$searchKey%";
mysqli_stmt_bind_param($stmt, "ss", $searchKeyParam, $searchKeyParam);

// Execute the prepared statement
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

while($row = mysqli_fetch_array($result)){
    $string .= '<tr><td>'.$row['id'].'</td><td>'.$row['name'].
    '</td><td>'.$row['phone'].'</td><td>'.$row['email'].
    '</td><td>'.$row['address'].'</td><td>'.$row['sex'].'</td><td>'.$row['dob'].
    '</td><td>'.$row['hiredate'].'</td><td>'.$row['salary'].'</td></tr>';
}
echo $string;
?>
