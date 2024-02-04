<?php
include_once('main.php');
include_once('../../service/mysqlcon.php');

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use MySQLi for database operations
$sql = "SELECT * FROM examschedule WHERE MONTH(examdate) = MONTH(CURRENT_DATE) AND YEAR(examdate) = YEAR(CURRENT_DATE)";
$result = mysqli_query($conn, $sql);

$string = "<tr>
               <th>ID</th>
               <th>Exam Date</th>
               <th>Time</th>
               <th>Course Id</th>
           </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    $string .= '<tr><td>' . $row['id'] . '</td><td>' . $row['examdate'] .
        '</td><td>' . $row['examTime'] . '</td><td>' . $row['courseid'] . '</td></tr>';
}

// Close the MySQLi result set
mysqli_free_result($result);

// Close the MySQLi connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Your custom CSS file -->
    <link rel="stylesheet" type="text/css" href="../../source/CSS/style.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Your custom JS files -->
    <script src="JS/login_logout.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Return Home</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <center>
            <h2>Exam Schedule List</h2>
            <table class="table table-bordered">
                <?php echo $string; ?>
            </table>
        </center>
    </div>
</body>
</html>
