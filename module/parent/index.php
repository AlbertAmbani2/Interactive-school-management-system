<?php
include_once('main.php');

$st = mysqli_query($conn, "SELECT * FROM parents WHERE id='$check'");
$stinfo = mysqli_fetch_array($st);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <!-- Your custom CSS file -->
    <link rel="stylesheet" type="text/css" href="../../source/CSS/style.css">
    
    <style>
        .header h1 {
            color: blue;
        }
        h4 {
            color: blue;
        }
        /* Add hover background color to navbar items */
        .navbar-nav .nav-item:hover {
            background-color: #e9ecef; /* Change this color to your preferred hover color */
        }

        /* Add hover effect to navbar links */
        .navbar-nav .nav-item:hover .nav-link {
            color: #007bff; /* Change this color to your preferred link hover color */
        }
    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Your custom JS files -->
    <script src="JS/login_logout.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row bg-light">
            <!-- Header -->
            <div class="header text-center col-12">
                <a class="navbar-brand float-left" href="#">
                    <img src="../../source/goodtimes.jpg" height="70" width="70" alt="School Management System" />
                </a>
                <h1>School Management System</h1>
            </div>
        </div>

        <!-- Navigation Bar -->
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light col-12">
                <!-- Navbar Toggler Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Links -->
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                    <ul class="navbar-nav mb-0 d-flex">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="modify.php">Change Password</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="checkchild.php">Childs Information</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="childsubject.php">Childs Course And Result</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="childpayment.php">Child Payments</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="childattendance.php">Childs Attendance</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="childreport.php">Childs Report</a>
                        </li>

                    </ul>
                </div>
            </nav>
                        
        </div>

		<div class="row">
           <!-- Hi!admin and Logout -->
		                    <div class="col-12 text-center">
                                <h4>Hi!Parents <?php echo $check . " "; ?></h4>
                                <a class="nav-link" href="logout.php" onmouseover="changemouseover(this);" onmouseout="changemouseout(this,'<?php echo ucfirst($loged_user_name);?>');"><?php echo "Logout";?></a>
                            </div>
	    </div>
          <!-- Parents Information -->
		  <div class="col-12">
                <div class="table-container">
                    <h1 class="text-center">Parents Information</h1>

                    <table class="table table-bordered table-striped">
                        <thead>
							<tr>
								<th>Parents ID</th>
								<th>Parent Male Name</th>
								<th>Parent Female Name</th>
								<th>Parent Male Phone</th>
								<th>Parent Female Phone</th>
								<th>Student Address</th>
							</tr>
							<tr>
								<td><?php echo $stinfo['id'];?></td>
								<td><?php echo $stinfo['fathername'];?></td>
								<td><?php echo $stinfo['mothername'];?></td>
								<td><?php echo $stinfo['fatherphone'];?></td>
								<td><?php echo $stinfo['motherphone'];?></td>
								<td><?php echo $stinfo['address'];?></td>
							</tr>
	                    </thead>
                    </table>
                </div>
            </div>
		</body>
</html>

