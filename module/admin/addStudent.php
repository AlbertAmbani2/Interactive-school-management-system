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
    <script src="JS/newStudentValidation.js"></script>
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
            <h2>Student Registration.</h2><hr/>
            <form action="#" method="post" onsubmit="return newStudentValidation();" enctype="multipart/form-data">
                <table class="table">
                <tr>
                      <td>Student Id:</td>
                      <td><input id="stuId"type="text" name="studentId" placeholder="Enter Id"></td>
                    </tr>
                    <tr>
                        <td>Student Name:</td>
                        <td><input id="stuName" type="text" name="studentName" placeholder="Enter Name"></td>
                    </tr>
                    <tr>
                        <td>Student Password:</td>
                        <td><input id="stuPassword"type="text" name="studentPassword" placeholder="Enter Password"></td>
                    </tr>
                    <tr>
                        <td>Student Phone:</td>
                        <td><input id="stuPhone"type="text" name="studentPhone" placeholder="Enter Phone Number"></td>
                    </tr>
                    <tr>
                        <td>Student Email:</td>
                        <td><input id="stuEmail"type="text" name="studentEmail" placeholder="Enter Email"></td>
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td><input type="radio" name="gender" value="Male" onclick="stuGender = this.value;"> Male <input type="radio" name="gender" value="Female" onclick="this.value"> Female</td>
                    </tr>
                    <tr>
                        <td>Student DOB:</td>
                        <td><input id="stuDOB"type="text" name="studentDOB" placeholder="Enter DOB(yyyy-mm-dd)"></td>
                    </tr>
                    <tr>
                        <td>Student Addmission Date:</td>
                        <td><input id="stuAddmissionDate"name="studentAddmissionDate"value = "<?php echo date('Y-m-d');?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Student Address:</td>
                        <td><input id="stuAddress" type="text" name="studentAddress" placeholder="Enter Address"></td>
                    </tr>
                    <tr>
                        <td>Student Parent Id:</td>
                        <td><input id="stuParentId"type="text" name="studentParentId" placeholder="Enter Parent Id"></td>
                    </tr>
                    <tr>
                        <td>Student Class Id:</td>
                        <td><input id="stuClassId" type="text" name="studentClassId" placeholder="Enter Class Id"></td>
                    </tr>
                    <tr>
                      <td>Student Picture:</td>
                      <td><input id="file"type="file" name="file"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit"value="Submit"></td>
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

if (isset($_POST['submit'])) {
    $stuId = $_POST['studentId'];
    $stuName = $_POST['studentName'];
    $stuPassword = $_POST['studentPassword'];
    $stuPhone = $_POST['studentPhone'];
    $stuEmail = $_POST['studentEmail'];
    $stugender = $_POST['gender'];
    $stuDOB = $_POST['studentDOB'];
    $stuAddmissionDate = $_POST['studentAddmissionDate'];
    $stuAddress = $_POST['studentAddress'];
    $stuParentId = $_POST['studentParentId'];
    $stuClassId = $_POST['studentClassId'];

    // Create a prepared statement to prevent SQL injection
    $sqlStudents = "INSERT INTO students VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtStudents = mysqli_prepare($conn, $sqlStudents);

    if ($stmtStudents === false) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmtStudents, "sssssssssss", $stuId, $stuName, $stuPassword, $stuPhone, $stuEmail, $stugender, $stuDOB, $stuAddmissionDate, $stuAddress, $stuParentId, $stuClassId);

    // Execute the prepared statement
    mysqli_stmt_execute($stmtStudents);

    // Close the statement
    mysqli_stmt_close($stmtStudents);

    // Second prepared statement for users table
    $sqlUsers = "INSERT INTO users VALUES (?, ?, 'student')";
    $stmtUsers = mysqli_prepare($conn, $sqlUsers);

    if ($stmtUsers === false) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmtUsers, "ss", $stuId, $stuPassword);

    // Execute the prepared statement
    mysqli_stmt_execute($stmtUsers);

    // Close the statement
    mysqli_stmt_close($stmtUsers);

    // Move uploaded file to the images directory
    $filetmp = $_FILES['file']['tmp_name'];
    move_uploaded_file($filetmp, "../images/" . $stuId . ".jpg");

    echo "Entered data successfully\n";
}

// Close the MySQLi connection
mysqli_close($conn);
?>
