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
    <script src="JS/searchForUpdateParent.js"></script>
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
            <h2>Update Parent Information</h2>
            <table>
                <tr>
                    <td><b>Search By Id Or Name:</b></td>
                    <td><input type="text" name="searchId" class="form-control" placeholder="Search By Id Or Name:" onkeyup="getParentForUpdate(this.value);"></td>
                </tr>
            </table>
        </center>
        <br/>
        <center>
            <h2>Update One Parent at a time.</h2>
            <form action="#" method="post" onsubmit="return newParentValidation();" enctype="multipart/form-data">
                <table class="table" border="1" cellpadding="6" id="updateParentData">
                    <!-- Parent data will be dynamically inserted here -->
                </table>
            </form>
        </center>
    </div>
</body>
</html>

<?php
include_once('../../service/mysqlcon.php');
if(!empty($_POST['submit'])){
    $id = $_POST['id'];
    $password = $_POST['password'];
    $fathename = $_POST['fathername'];
    $mothername = $_POST['mothername'];
    $fatherphone = $_POST['fatherphone'];
    $motherphone = $_POST['motherphone'];
    $address = $_POST['address'];
    $sql = "UPDATE parents SET id='$id', password='$password', fathername='$fathename', mothername='$mothername', fatherphone='$fatherphone', motherphone='$motherphone', address='$address' WHERE id='$id'";
    $success = mysql_query( $sql,$link );
    if(!$success) {
        die('Could not Update data: '.mysql_error());
    }
    echo "Update data successfully\n";
}
?>
