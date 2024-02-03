<?php
include_once('main.php');
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
            <form action="#" method="post">
                <table class="table">
                    <tr>
                        <td>Exam Schedule Id:</td>
                        <td><input type="text" class="form-control" name="id" placeholder="Exam Schedule ID"></td>
                    </tr>
                    <tr>
                        <td>Exam Date:</td>
                        <td><input type="date" class="form-control" name="examDate" placeholder="Exam Date"></td>
                    </tr>
                    <tr>
                        <td>Exam Time:</td>
                        <td><input type="text" class="form-control" name="examTime" placeholder="Exam Time(H:M - H:M)"></td>
                    </tr>
                    <tr>
                        <td>Subject ID:</td>
                        <td><input type="text" class="form-control" name="courseId" placeholder="Subject ID"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" class="btn btn-primary" name="submit" value="Submit"></td>
                    </tr>
                </table>
            </form>
        </center>
    </div>
</body>
</html>

<?php
include_once('../../service/mysqlcon.php');

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])){
    
     // Validate that required fields are not empty
     if(empty($_POST['id']) || empty($_POST['examDate']) || empty($_POST['examTime']) || empty($_POST['courseId'])) {
        die("Error: All fields are required.");
    }

    $id = $_POST['id'];
    $examDate = date('Y-m-d', strtotime($_POST['examDate'])); // Convert to MySQL-compatible format
    $examTime = $_POST['examTime'];
    $courseId = $_POST['courseId'];

    // Create a prepared statement to prevent SQL injection
    $sql = "INSERT INTO examschedule (id, examDate, examTime, courseId) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('Could not prepare statement: ' . mysqli_error($conn));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'ssss', $id, $examDate, $examTime, $courseId);

    // Execute the prepared statement
    $success = mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    // Close the MySQLi connection
    mysqli_close($conn);

    if(!$success) {
        die('Could not enter data: '.mysqli_error($conn));
    }

    echo "Entered data successfully\n";
}
?>

