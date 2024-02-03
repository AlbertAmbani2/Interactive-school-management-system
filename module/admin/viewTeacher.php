<?php
include_once('main.php');

include_once('../../service/mysqlcon.php');

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM teachers;";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt === false) {
    die("Error in SQL query: " . mysqli_error($conn));
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$string = "";
$images_dir = "../images/";

while($row = mysqli_fetch_array($result)){
    $picname = $row['id'];
    $string .= '<tr><td>'.$row['id'].'</td><td>'.$row['name'].
    '</td><td>'.$row['phone'].'</td><td>'.$row['email'].
    '</td><td>'.$row['address'].'</td><td>'.$row['sex'].'</td><td>'.$row['dob'].
    '</td><td>'.$row['hiredate'].'</td><td>'.$row['salary'].
    "</td><td><img src='".$images_dir.$picname.".jpg' alt='$picname' width='150' height='150'>".'</td></tr>';
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
    <script src="JS/searchTeacher.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Return Home</a>
            </li>
        </ul>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form>
                    <div class="form-group row">
                        <label for="searchId" class="col-sm-3 col-form-label"><b>Search By Id Or Name:</b></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="searchId" name="searchId" placeholder="Search By Id Or Name:" onkeyup="getTeacher(this.value);">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <h2 class="text-center">Teachers List</h2>
                <div class="table-responsive">
                    <table class="table table-bordered" id="teacherList">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>DOB</th>
                                <th>Hire Date</th>
                                <th>Salary</th>
                                <th>Picture</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $string; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
