<?php
include_once('main.php');
?>
<html>
    <head>
		    <link rel="stylesheet" type="text/css" href="../../source/CSS/style.css">
				<script src = "JS/login_logout.js"></script>
               <script src = "JS/searchForUpdateTeacher.js"></script>
		</head>
    <body>
			 <?php include('index.php'); ?>
						</li>
				</ul>
			  <hr/>

        </center>
        <br/>
        <center>
          <h2>Update your profile!!!.</h2>
            <form action="#" method="post" onsubmit="return newTeacherValidation();">
                <table border="1" cellpadding="6" id='updateTeacherData'>
				<?php include ('searchForUpdateTeacher.php'); ?>
                </table>
            </form>
        </center>
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

