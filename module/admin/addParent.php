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
    <script src="JS/newParentValidation.js"></script>
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
            <h2>Parent Registration.</h2><hr/>
            <form action="#" method="post" onsubmit="return newParentValidation();">
                <table class="table">
                    <tr>
                        <td>Parent Id:</td>
                        <td><input id="id" type="text" name="id" placeholder="Enter Id"></td>
                    </tr>
                    <tr>
                        <td>Parent Password:</td>
                        <td><input id="password" type="text" name="password" placeholder="Enter Password"></td>
                    </tr>
                    <tr>
                        <td>Father Name:</td>
                        <td><input id="fathername" type="text" name="fathername" placeholder="Enter Father Name"></td>
                    </tr>
                    <tr>
                        <td>Mother Name:</td>
                        <td><input id="mothername" type="text" name="mothername" placeholder="Enter Mother Name"></td>
                    </tr>
                    <tr>
                        <td>Father Phone:</td>
                        <td><input id="fatherphone" type="text" name="fatherphone" placeholder="Enter Father Phone"></td>
                    </tr>
                    <tr>
                        <td>Mother Phone:</td>
                        <td><input id="motherphone" type="text" name="motherphone" placeholder="Enter Mother Phone"></td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td><input id="address" type="text" name="address" placeholder="Enter Address"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit" value="Submit"></td>
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
    $id = $_POST['id'];
    $password = $_POST['password'];
    $fathername = $_POST['fathername'];
    $mothername = $_POST['mothername'];
    $fatherphone = $_POST['fatherphone'];
    $motherphone = $_POST['motherphone'];
    $address = $_POST['address'];

    // Create a prepared statement to prevent SQL injection
    $sqlParents = "INSERT INTO parents VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtParents = mysqli_prepare($conn, $sqlParents);

    if ($stmtParents === false) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmtParents, "sssssss", $id, $password, $fathername, $mothername, $fatherphone, $motherphone, $address);

    // Execute the prepared statement
    mysqli_stmt_execute($stmtParents);

    // Close the statement
    mysqli_stmt_close($stmtParents);

    // Second prepared statement for users table
    $sqlUsers = "INSERT INTO users VALUES (?, ?, 'parent')";
    $stmtUsers = mysqli_prepare($conn, $sqlUsers);

    if ($stmtUsers === false) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmtUsers, "ss", $id, $password);

    // Execute the prepared statement
    mysqli_stmt_execute($stmtUsers);

    // Close the statement
    mysqli_stmt_close($stmtUsers);

    echo "Entered data successfully\n";
}

// Close the MySQLi connection
mysqli_close($conn);
?>

