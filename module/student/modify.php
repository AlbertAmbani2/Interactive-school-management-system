<?php
include_once('main.php');

// student ID or any unique identifier
$check = $_SESSION['login_id'];

// Create a connection to the database using MySQLi
$host="localhost";
$username="root";
$password="";
$db_name="schoolmsdb";

$conn = new mysqli($host, $username, $password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch student password from the database
$sql = "SELECT password FROM students WHERE id='$check'";
$result = $conn->query($sql);

// Check if the query was successful and fetch the password
if ($result) {
    $stinfo = $result->fetch_assoc();
} else {
    // Handle the case where the query fails
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();

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
    <script src="JS/modifyValidate.js"></script>

    <style>
        input {
            text-align: center;
            background-color: gray;
        }
    </style>
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
                <h1>Change Password</h1>
                <form onsubmit="return modifyValidate();" action="modifysave.php" method="post">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Student Password</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" id="password" name="password" value="<?php echo $stinfo['password']; ?>"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    <input type="submit" class="btn btn-primary" value="Change Password"/>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
