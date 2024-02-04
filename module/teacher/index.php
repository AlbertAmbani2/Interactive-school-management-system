<?php
include_once('main.php');
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
                        <!-- Add your navbar links here -->
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="updateTeacher.php">Update Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="viewProfile.php">View Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="subject.php">Students Grade</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="subject.php">Subjects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Attendance</a>
                            <!-- Add dropdown items here -->
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Item 1</a>
                                <a class="dropdown-item" href="#">Item 2</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="exam.php">Exam Schedule</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="salary.php">Salary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="report.php">Report</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="searchStudent.php">Search Portal</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- Hi!admin and Logout -->
        <div class="row">
            <div class="col-12 text-center">
                <h4>Hi! <?php echo $loged_user_name . " "; ?></h4>
                <a class="nav-link" href="logout.php" onmouseover="changemouseover(this);"><?php echo "Logout";?></a>
            </div>
        </div>

    </div>
</body>
</html>

