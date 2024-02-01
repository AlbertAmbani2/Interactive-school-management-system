<?php
include_once('main.php');
include_once('../../service/mysqlcon.php');

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use MySQLi for database operations
$sql = "SELECT * FROM examschedule WHERE MONTH(examdate) = MONTH(CURRENT_DATE) AND YEAR(examdate) = YEAR(CURRENT_DATE)";
$result = mysqli_query($conn, $sql);

$string = "<tr>
               <th>ID</th>
               <th>Exam Date</th>
               <th>Time</th>
               <th>Course Id</th>
           </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    $string .= '<tr><td>' . $row['id'] . '</td><td>' . $row['examdate'] .
        '</td><td>' . $row['time'] . '</td><td>' . $row['courseid'] . '</td></tr>';
}

// Close the MySQLi result set
mysqli_free_result($result);

// Close the MySQLi connection
mysqli_close($conn);
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
								<a class ="menulista" href="manageStudent.php">Manage Student</a>
								<a class ="menulista" href="manageTeacher.php">Manage Teacher</a>
								<a class ="menulista" href="manageParent.php">Manage Parent</a>
								<a class ="menulista" href="manageStaff.php">Manage Staff</a>
								<a class ="menulista" href="course.php">Course</a>
								<a class ="menulista" href="attendance.php">Attendance</a>
								<a class ="menulista" href="examSchedule.php">Exam Schedule</a>
								<a class ="menulista" href="salary.php">Salary</a>
								<a class ="menulista" href="report.php">Report</a>
								<a class ="menulista" href="payment.php">Payment</a>
								<div align="center">
								<h4>Hi!admin <?php echo $check." ";?></h4>
								    <a class ="menulista" href="logout.php" onmouseover="changemouseover(this);" onmouseout="changemouseout(this,'<?php echo ucfirst($loged_user_name);?>');"><?php echo "Logout";?></a>
						    </div>
						</li>
				</ul>
			  <hr/>
        <center>
            <h2>Exam Schedule List</h2>
            <table border="1">
                <?php echo $string; ?>
            </table>
        </center>
		</body>
</html>
