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
<html>
    <head>
		    <link rel="stylesheet" type="text/css" href="../../source/CSS/style.css">
				<script src = "JS/login_logout.js"></script>
		</head>
    <body>
			  <div class="header"><h1>School Management System</h1></div>
			  <div class="divtopcorner">
				    <img src="../../source/logo.jpg" height="150" width="150" alt="School Management System"/>
				</div>
			<br/><br/>
				<ul>
				    <li class="manulist">
						    <a class ="menulista" href="index.php">Home</a>
                <a class ="menulista" href="addTeacher.php">New Teacher</a>
                <a class ="menulista" href="viewTeacher.php">View Teacher</a>
                <a class ="menulista" href="updateTeacher.php">Update Teacher</a>
                <a class ="menulista" href="deleteTeacher.php">Delete Teacher</a>
							<div align="center">
								<h4>Hi!admin <?php echo $check." ";?></h4>
								<a class ="menulista" href="logout.php" onmouseover="changemouseover(this);" onmouseout="changemouseout(this,'<?php echo ucfirst($loged_user_name);?>');"><?php echo "Logout";?></a>
						</div>
							</li>
				</ul>
			  <hr/>
		</body>
</html>
