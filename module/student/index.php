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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>

    <!-- Your custom CSS file -->
    <link rel="stylesheet" type="text/css" href="../../source/CSS/style.css">

    <style>
        .header h1, h4 {
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
						<a class="nav-link" href="subject.php">My Course And Result</a>
                        </li>

						<li class="nav-item">
						<a class="nav-link" href="exam.php">My Exam Schedule</a>

                        </li>

						<li class="nav-item">
						<a class="nav-link" href="attendance.php">My Attendance</a>

                        </li>

                        <!-- Add other navigation links here -->

                    </ul>
                </div>
            </nav>
                        
        </div>

        <div class="row">
            <!-- Hi!admin and Logout -->
            <div class="col-12 text-center">
                <h4>Hi!Student <?php echo $loged_user_name . " "; ?></h4>
                <a class="nav-link" href="logout.php" onmouseover="changemouseover(this);"><?php echo "Logout";?></a>
            </div>
        </div>

        <!-- Students Information -->
        <div class="col-12">
            <div class="table-container">
                <h1 class="text-center">My Information</h1>

                <table class="table table-bordered table-striped">
                    <thead>
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
                            <td><?php echo $stinfo['id'];?></td>
                            <td><?php echo $stinfo['name'];?></td>
                            <td><?php echo $stinfo['phone'];?></td>
                            <td><?php echo $stinfo['email'];?></td>
                            <td><?php echo $stinfo['sex'];?></td>
                            <td><?php echo $stinfo['dob'];?></td>
                            <td><?php echo $stinfo['addmissiondate'];?></td>
                            <td><?php echo $stinfo['address'];?></td>
                            <td><?php echo $stinfo['parentid'];?></td>
                            <td><?php echo $stinfo['classid'];?></td>
                            <td><img src="../images/<?php echo $check . ".jpg"; ?>" height="95" width="95" alt="<?php echo $check . " photo"; ?> " /></td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
