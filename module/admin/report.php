<?php
include_once('main.php');
include_once('../../service/mysqlcon.php');

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$string = "<tr>
    <th>Teacher</th>
    <th>Subject Id</th>
    <th>Class</th>
    <th>#OF Students</th>
</tr>";

$sql = "SELECT t.name AS teacher, ac.name AS course, ac.classid AS class, COUNT(g.id) AS no_of_std
        FROM teachers t
        JOIN takencoursebyteacher tc ON t.id = tc.teacherid
        JOIN availablecourse ac ON ac.id = tc.courseid
        LEFT JOIN grade g ON tc.courseid = g.courseid
        WHERE g.grade NOT IN ('A+', 'A', 'A-', 'B+', 'B', 'B-')
        GROUP BY ac.id";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Error in SQL query: ' . mysqli_error($conn));
}

while ($row = mysqli_fetch_array($result)) {
    $string .= "<tr><td>" . $row['teacher'] . "</td><td>" . $row['course'] . "</td><td>" . $row['class'] .
        "</td><td>" . $row['no_of_std'] . "</td></tr>";
}

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
								<a class ="menulista" href="course.php">Subject</a>
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
            <h1>Teacher Evaluation</h1>
            <table border="1">
                <?php echo $string;?>
            </table>
        </center>
		</body>
</html>
