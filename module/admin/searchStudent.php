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
$images_dir = "../images/";
$string = "<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Gender</th>
    <th>DOB</th>
    <th>Addmission Date</th>
    <th>Address</th>
    <th>Parent Id</th>
    <th>Class Id</th>
    <th>Picture</th>
</tr>";

$sql = "SELECT * FROM students WHERE id LIKE ? OR name LIKE ? OR classid = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt === false) {
    die("Error in SQL query: " . mysqli_error($conn));
}

// Bind parameters
$searchKeyParam = "%$searchKey%";
mysqli_stmt_bind_param($stmt, "sss", $searchKeyParam, $searchKeyParam, $searchKey);

// Execute the prepared statement
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

while($row = mysqli_fetch_array($result)){
    $picname = $row['id'];
    $string .= '<tr><td>'.$row['id'].'</td><td>'.$row['name'].
    '</td><td>'.$row['phone'].'</td><td>'.$row['email'].
    '</td><td>'.$row['sex'].'</td><td>'.$row['dob'].
    '</td><td>'.$row['addmissiondate'].'</td><td>'.$row['address'].
    '</td><td>'.$row['parentid'].'</td><td>'.$row['classid'].
    "</td><td><img src='".$images_dir.$picname.".jpg' alt='$picname' width='150' height='150'>".'</td></tr>';
}
echo $string;
?>
