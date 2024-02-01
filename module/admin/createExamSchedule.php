<?php
include_once('main.php');
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
            <form action="#" method="post">
              <table cellpadding="6">
                  <tr>
                      <td>Exam Schedule Id:</td>
                      <td><input type="text" name="id" placeholder="Exam Schedule ID"></td>
                  </tr>
                  <tr>
                      <td>Exam Date:</td>
                      <td><input type="date" name="examDate" placeholder="Exam Date"></td>
                  </tr>
                  <tr>
                      <td>Exam Time:</td>
                      <td><input type="text" name="examTime" placeholder="Exam Time(H:M - H:M)"></td>
                  </tr>
                  <tr>
                      <td>Subject ID:</td>
                      <td><input type="text" name="courseId" placeholder="Subject ID"></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td><input type="submit" name="submit"value="Submit"></td>
                  </tr>
              </table>
            </form>
        </center>
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

if(isset($_POST['submit'])){
    
     // Validate that required fields are not empty
     if(empty($_POST['id']) || empty($_POST['examDate']) || empty($_POST['examTime']) || empty($_POST['courseId'])) {
        die("Error: All fields are required.");
    }

    $id = $_POST['id'];
    $examDate = date('Y-m-d', strtotime($_POST['examDate'])); // Convert to MySQL-compatible format
    $examTime = $_POST['examTime'];
    $courseId = $_POST['courseId'];

    // Create a prepared statement to prevent SQL injection
    $sql = "INSERT INTO examschedule (id, examDate, examTime, courseId) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('Could not prepare statement: ' . mysqli_error($conn));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'ssss', $id, $examDate, $examTime, $courseId);

    // Execute the prepared statement
    $success = mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    // Close the MySQLi connection
    mysqli_close($conn);

    if(!$success) {
        die('Could not enter data: '.mysqli_error($conn));
    }

    echo "Entered data successfully\n";
}
?>

