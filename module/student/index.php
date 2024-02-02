<?php
include_once('main.php');

//  student ID 
$check = $_SESSION['login_id'];

// A connection to the database using MySQLi
$conn = new mysqli($host, $username, $password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch student information from the database
$sql = "SELECT * FROM students WHERE id='$check'";
$result = $conn->query($sql);

// Check if the query was successful and fetch the student information
if ($result) {
    $stinfo = $result->fetch_assoc();
} else {
    // Handle the case where the query fails
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
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
				    <li class="manulist" >
						    <a class ="menulista" href="index.php">Home</a>
						        <a class ="menulista" href="modify.php">Change Password</a>
								<a class ="menulista" href="course.php">My Course And Result</a>
								<a class ="menulista" href="exam.php">My Exam Schedule</a>
								<a class ="menulista" href="attendance.php">My Attendance</a>
								
								<div align="center">
								<h4>Hi!Student <?php echo $check." ";?> </h4>
								<a class ="menulista" href="logout.php" onmouseover="changemouseover(this);" onmouseout="changemouseout(this,'<?php echo ucfirst($loged_user_name);?>');"><?php echo "Logout";?></a>
						</div>
						 
				    
			
						</li>
				</ul>
			  <hr/>
			  
			  <div align="center">
			  	<h1>My Information</h1>
			  <table border="1">
			  <tr>
			  
			  <th>Student ID</th>
			  <th>Student Name</th>
			  <th>Student Phone</th>
			  <th>Student Email</th>
			  <th>Student Gender</th>
			  <th>Student DOB</th>
			  <th>Student Admission Date</th>
			  <th>Student Address</th>
			  <th>Student Parent ID</th>
			  <th>Student class ID</th>
			  <th>Student Picture</th>
			  
			  </tr>
			  <tr>
                    <td><?php echo isset($stinfo['id']) ? $stinfo['id'] : ''; ?></td>
                    <td><?php echo isset($stinfo['name']) ? $stinfo['name'] : ''; ?></td>
                    <td><?php echo isset($stinfo['phone']) ? $stinfo['phone'] : ''; ?></td>
                    <td><?php echo isset($stinfo['email']) ? $stinfo['email'] : ''; ?></td>
                    <td><?php echo isset($stinfo['sex']) ? $stinfo['sex'] : ''; ?></td>
                    <td><?php echo isset($stinfo['dob']) ? $stinfo['dob'] : ''; ?></td>
                    <td><?php echo isset($stinfo['addmissiondate']) ? $stinfo['addmissiondate'] : ''; ?></td>
                    <td><?php echo isset($stinfo['address']) ? $stinfo['address'] : ''; ?></td>
                    <td><?php echo isset($stinfo['parentid']) ? $stinfo['parentid'] : ''; ?></td>
                    <td><?php echo isset($stinfo['classid']) ? $stinfo['classid'] : ''; ?></td>
                    <td><img src="../images/<?php echo $check . ".jpg"; ?>" height="95" width="95" alt="<?php echo $check . " photo"; ?> " /></td>
                </tr>
			  
			  
			  <table
								
							</div>
		</body>
</html>

