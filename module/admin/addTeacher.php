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
    <script src="JS/newTeacherValidation.js"></script>
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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center">Teacher Registration</h2>
                <hr/>

                <form action="#" method="post" onsubmit="return newTeacherValidation();" enctype="multipart/form-data">
                    <table class="table">
                        <tr>
                            <td>Teacher Id:</td>
                            <td><input id="teaId" type="text" name="teacherId" class="form-control" placeholder="Enter Id"></td>
                        </tr>
                        
                    <tr>
                        <td>Teacher Name:</td>
                        <td><input id="teaName" type="text" name="teacherName" placeholder="Enter Name"></td>
                    </tr>
                    <tr>
                        <td>Teacher Password:</td>
                        <td><input id="teaPassword" type="text" name="teacherPassword" placeholder="Enter Password"></td>
                    </tr>
                    <tr>
                        <td>Teacher Phone:</td>
                        <td><input id="teaPhone" type="text" name="teacherPhone" placeholder="Enter Phone Number"></td>
                    </tr>
                    <tr>
                        <td>Teacher Email:</td>
                        <td><input id="teaEmail" type="text" name="teacherEmail" placeholder="Enter Email"></td>
                    </tr>
                    <tr>
                        <td>Teacher Address:</td>
                        <td><input id="teaAddress" type="text" name="teacherAddress" placeholder="Enter Address"></td>
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td><input type="radio" name="gender" value="Male" onclick="teaGender = this.value;"> Male <input type="radio" name="gender" value="Female" onclick="teaGender = this.value;"> Female</td>
                    </tr>
                    <tr>
                        <td>Teacher DOB:</td>
                        <td><input id="teaDOB" type="text" name="teacherDOB" placeholder="Enter DOB(yyyy-mm-dd)"></td>
                    </tr>
                    <tr>
                        <td>Teacher Hire Date:</td>
                        <td><input id="teaHireDate" name="teacherHireDate" value="<?php echo date('Y-m-d');?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Salary</td>
                        <td><input id="teaSalary" type="text" name="teacherSalary" placeholder="Enter Salary"></td>
                    </tr>
                    <tr>
                      <td>Teacher Picture:</td>
                      <td><input id="file" type="file" name="file"></td>
                    </tr>
                
                        <tr>
                            <td></td>
                            <td><input type="submit" name="submit" value="Submit" class="btn btn-primary"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
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

if (!empty($_FILES) && isset($_POST['submit'])) {
    $teaId = $_POST['teacherId'];
    $teaName = $_POST['teacherName'];
    $teaPassword = $_POST['teacherPassword'];
    $teaPhone = $_POST['teacherPhone'];
    $teaEmail = $_POST['teacherEmail'];
    $teaGender = $_POST['gender'];
    $teaDOB = $_POST['teacherDOB'];
    $teaHireDate = $_POST['teacherHireDate'];
    $teaAddress = $_POST['teacherAddress'];
    $teaSalary = $_POST['teacherSalary'];

    // Create a prepared statement to prevent SQL injection
    $sqlTeachers = "INSERT INTO teachers VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtTeachers = mysqli_prepare($conn, $sqlTeachers);

    if ($stmtTeachers === false) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmtTeachers, "ssssssssss", $teaId, $teaName, $teaPassword, $teaPhone, $teaEmail, $teaAddress, $teaGender, $teaDOB, $teaHireDate, $teaSalary);

    // Execute the prepared statement
    mysqli_stmt_execute($stmtTeachers);

    // Close the statement
    mysqli_stmt_close($stmtTeachers);

    // Second prepared statement for users table
    $sqlUsers = "INSERT INTO users VALUES (?, ?, 'teacher')";
    $stmtUsers = mysqli_prepare($conn, $sqlUsers);

    if ($stmtUsers === false) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmtUsers, "ss", $teaId, $teaPassword);

    // Execute the prepared statement
    mysqli_stmt_execute($stmtUsers);

    // Close the statement
    mysqli_stmt_close($stmtUsers);

    // Move uploaded file to the images directory
    $filetmp = $_FILES['file']['tmp_name'];
    move_uploaded_file($filetmp, "../images/" . $teaId . ".jpg");

    echo "Entered data successfully\n";
}

// Close the MySQLi connection
mysqli_close($conn);
?>
