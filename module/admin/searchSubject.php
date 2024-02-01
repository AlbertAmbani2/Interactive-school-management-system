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
$string = "<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Teacher ID</th>
    <th>Student ID</th>
    <th>Class ID</th>
</tr>";

// Create a prepared statement to prevent SQL injection
$sql = "SELECT * FROM subject WHERE id LIKE ? OR name LIKE ? OR teacherid LIKE ? OR classid = ? OR studentid LIKE ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt === false) {
    die("Error in SQL query: " . mysqli_error($conn));
}

// Bind parameters
$searchKeyParam = "%$searchKey%";
mysqli_stmt_bind_param($stmt, "sssss", $searchKeyParam, $searchKeyParam, $searchKeyParam, $searchKey, $searchKeyParam);

// Execute the prepared statement
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_array($result)) {
    $string .= '<tr><td>'.$row['id'].'</td><td>'.$row['name'].
        '</td><td>'.$row['teacherid'].'</td><td>'.$row['studentid'].
        '</td><td>'.$row['classid'].'</td></tr>';
}

// Free the result set
mysqli_free_result($result);

// Close the statement
mysqli_stmt_close($stmt);

// Close the MySQLi connection
mysqli_close($conn);
echo $string;
?>
