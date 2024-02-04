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
    <script src="JS/searchForUpdateTeacher.js"></script>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Return Home</a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center mt-5">
                <h2>Update Your Profile</h2>
                <form action="#" method="post" onsubmit="return newTeacherValidation();">
                    <table class="table" border="1" cellpadding="6" id='updateTeacherData'>
                        <?php include('searchForUpdateTeacher.php'); ?>
                    </table>
                </form>
            </div>
        </div>
    </div>

</body>
</html>

<?php
include_once('../../service/mysqlcon.php');

if (!empty($_POST['submit'])) {
    $teaId = $_POST['id'];
    $teaName = $_POST['name'];
    $teaPassword = $_POST['password'];
    $teaPhone = $_POST['phone'];
    $teaEmail = $_POST['email'];
    $teagender = $_POST['gender'];
    $teaDOB = $_POST['dob'];
    $teaAddress = $_POST['address'];

    // Create connection
    $conn = new mysqli($host, $username, $password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $sql = "UPDATE teachers SET name=?, password=?, phone=?, email=?, sex=?, dob=?, address=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $teaName, $teaPassword, $teaPhone, $teaEmail, $teagender, $teaDOB, $teaAddress, $teaId);

    // Execute the statement
    $stmt->execute();

    // Close the statement
    $stmt->close();

    // Update the password in the users table
    $sql1 = "UPDATE users SET password=? WHERE userid=?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("ss", $teaPassword, $teaId);

    // Execute the statement
    $stmt1->execute();

    // Close the statement
    $stmt1->close();

    // Close the connection
    $conn->close();

    echo "Update data successfully\n";
}
?>

