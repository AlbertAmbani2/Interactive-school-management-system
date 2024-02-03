<?php
include_once('main.php');

include_once('../../service/mysqlcon.php');

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM subject;";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt === false) {
    die("Error in SQL query: " . mysqli_error($conn));
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$string = "";
while($row = mysqli_fetch_array($result))	{
    $string .= '<tr><td>'.$row['id'].'</td><td>'.$row['name'].
    '</td><td>'.$row['teacherid'].'</td><td>'.$row['studentid'].
    '</td><td>'.$row['classid'].'</td></tr>';
}
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
    <script src="JS/searchSubject.js"></script>
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
            <div class="form-group">
                <label for="searchId"><b>Search By Id Or Name: </b></label>
                <input type="text" class="form-control" id="searchId" placeholder="Search By Id Or Name:" onkeyup="getSubject(this.value);">
            </div>
        </center>
        <br/>
        <center><h2>Subject List</h2></center>
        <center>
            <table class="table table-bordered" id='subjectList'>
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Teacher ID</th>
                        <th>Student ID Name</th>
                        <th>Class ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $string;?>
                </tbody>
            </table>
        </center>
    </div>
</body>
</html>
