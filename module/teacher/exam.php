<?php 
include('index.php');
include_once('../../service/mysqlcon.php');

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$mod = "SELECT distinct cn.name, cn.id, ex.examdate, ex.time, c.name FROM course cn, examschedule ex, class c WHERE cn.id = ex.courseid and cn.classid = c.id";
$res = mysqli_query($conn, $mod); 

echo "<table align='center' border='2'>";
echo "<tr>";
echo "<th>ID</th> <th>NAME</th> <th>DATE</th> <th>TIME</th> <th>CLASS</th> <br />";
echo "</tr>";

while ($row = $result->fetch_assoc()) { 
    echo "<tr>";
    echo "<td>".$row[1]."</td><td>".$row[0]."</td><td> ".$row[2]."</td><td> ".$row[3]."</td><td>".$row[4]."</td>";
    echo "</tr>";
}

echo "</table>";
?>

