<?php
include_once('../../service/mysqlcon.php');

$check=$_SESSION['login_id'];

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT name FROM admin WHERE id=?");
$stmt->bind_param("s", $check);
$stmt->execute();

$stmt->bind_result($loged_user_name);
$stmt->fetch();
$stmt->close();

// Close the database connection
$conn->close();

// Check if the user is not logged in
if (!isset($loged_user_name)) {
    header("Location:../../");
    exit(); 
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
    <script src="JS/currentDate.js"></script>
    <script src="JS/getClassName.js"></script>
    <script src="JS/getSubjectIdAndNAme.js"></script>
</head>
<body onload="getClassNameAndId();">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Return Home</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <center>
            <h2>Subject Registration For Student.</h2><hr/>
            <form action="#" method="post">
                <table class="table">
                    <tr>
                        <td>Class ID:</td>
                        <td>
                            <select id="className" class="form-control" onchange="getSubjectNameAndId();"></select>
                        </td>
                    </tr>
                    <tr>
                        <td>Subject Name:</td>
                        <td>
                            <select id="subjectName" class="form-control" onchange="setSubjectId()"></select>
                        </td>
                    </tr>
                    <tr>
                        <td><input id="subjectId" type="hidden" name="name" placeholder="Enter Name"></td>
                    </tr>
                    <tr>
                        <td>Teacher ID:</td>
                        <td>
                            <select id="teacherId" class="form-control"></select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="button" class="btn btn-primary" name="submit" value="Submit" onclick="getAllSubjectStudentAndSubmit();">
                        </td>
                    </tr>
                </table>
            </form>
        </center>
    </div>
</body>
</html>
