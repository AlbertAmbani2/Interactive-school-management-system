<?php
include_once('main.php');

include_once('../../service/mysqlcon.php');

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch Class IDs from the database
$string = "<option>SELECT AN OPTION</option>";
$sql = "SELECT id FROM class";

$result = mysql_query($sql);

while($row = mysql_fetch_array($result)){
    $string .= "<option value='".$row['id']."'>".$row['name']." [".$row['section']."]</option>";
}
echo $string;
?>
