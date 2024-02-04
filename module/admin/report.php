<?php
include_once('main.php');
include_once('../../service/mysqlcon.php');

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$string = "<tr>
    <th>Teacher</th>
    <th>Subject Id</th>
    <th>Class</th>
    <th>#OF Students</th>
</tr>";

$sql = "SELECT t.name AS teacher, ac.name AS course, ac.classid AS class, COUNT(g.id) AS no_of_std
        FROM teachers t
        JOIN takencoursebyteacher tc ON t.id = tc.teacherid
        JOIN availablecourse ac ON ac.id = tc.courseid
        LEFT JOIN grade g ON tc.courseid = g.courseid
        WHERE g.grade NOT IN ('A+', 'A', 'A-', 'B+', 'B', 'B-')
        GROUP BY ac.id";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Error in SQL query: ' . mysqli_error($conn));
}

while ($row = mysqli_fetch_array($result)) {
    $string .= "<tr><td>" . $row['teacher'] . "</td><td>" . $row['course'] . "</td><td>" . $row['class'] .
        "</td><td>" . $row['no_of_std'] . "</td></tr>";
}

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
            <h1>Teacher Evaluation</h1>
            <table class="table table-bordered">
                <?php echo $string; ?>
            </table>
        </center>
    </div>
</body>
</html>

