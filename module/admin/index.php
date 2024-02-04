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
		.header h1 {
			color: blue;
		}
        h4{
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

				<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="manageStudentDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Manage Student
            </a>
            <div class="dropdown-menu" aria-labelledby="manageStudentDropdown">
                <a class="dropdown-item" href="addStudent.php">New Student</a>
                <a class="dropdown-item" href="viewStudent.php">View Student</a>
                <a class="dropdown-item" href="updateStudent.php">Update Student</a>
                <a class="dropdown-item" href="deleteStudent.php">Delete Student</a>
            </div>
        </li>

                <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="manageTeacherDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Manage Teacher
                            </a>
                            <div class="dropdown-menu" aria-labelledby="manageTeacherDropdown">
                                <a class="dropdown-item" href="addTeacher.php">New Teacher</a>
                                <a class="dropdown-item" href="viewTeacher.php">View Teacher</a>
                                <a class="dropdown-item" href="updateTeacher.php">Update Teacher</a>
                                <a class="dropdown-item" href="deleteTeacher.php">Delete Teacher</a>
                            </div>
                        </li>

                <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="manageParentDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Manage Parent
                            </a>
                            <div class="dropdown-menu" aria-labelledby="manageParentDropdown">
                                <a class="dropdown-item" href="addParent.php">New Parent</a>
                                <a class="dropdown-item" href="viewParent.php">View Parent</a>
                                <a class="dropdown-item" href="updateParent.php">Update Parent</a>
                                <a class="dropdown-item" href="deleteParent.php">Delete Parent</a>
                            </div>
                        </li>

                <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="manageStaffDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Manage Staff
                            </a>
                            <!-- <div class="dropdown-menu" aria-labelledby="manageStaffDropdown">
                                <a class="dropdown-item" href="addStaff.php">New Staff</a>
                                <a class="dropdown-item" href="viewStaff.php">View Staff</a>
                                <a class="dropdown-item" href="updateStaff.php">Update Staff</a>
                                <a class="dropdown-item" href="deleteStaff.php">Delete Staff</a>
                            </div> -->
                        </li>

               <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="manageSubjectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Manage Subject
                            </a>
                            <div class="dropdown-menu" aria-labelledby="manageSubjectDropdown">
                                <a class="dropdown-item" href="addSubject.php">New Subject</a>
                                <a class="dropdown-item" href="viewSubject.php">View Subject</a>
                                <a class="dropdown-item" href="deleteSubject.php">Delete Subject</a>
                            </div>
                        </li>

                <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="manageSubjectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Attendance
                            </a>
                            <!-- <div class="dropdown-menu" aria-labelledby="manageSubjectDropdown">
                                <a class="dropdown-item" href="teacherAttendance.php">Teacher Attendance</a>
                                <a class="dropdown-item" href="staffAttendance.php">Staff Attendance</a>
                                <a class="dropdown-item" href="viewAttendance.php">View Attendance</a>
                            </div> -->
                        </li>

						<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="manageExamScheduleDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Manage Exam Schedule
                            </a>
                            <div class="dropdown-menu" aria-labelledby="manageExamScheduleDropdown">
                                <a class="dropdown-item" href="createExamSchedule.php">Create Exam Schedule</a>
                                <a class="dropdown-item" href="viewExamSchedule.php">View Exam Schedule</a>
                                <a class="dropdown-item" href="updateExamSchedule.php">Update Exam Schedule</a>
                            </div>
                        </li>

                <li class="nav-item">
                    <a class="nav-link" href="salary.php">Salary</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="report.php">Report</a>
                </li>
                
            </ul>
			</div>
            </nav>
        </div>

        <div class="row">
           <!-- Hi!admin and Logout -->
           <div class="col-12 text-center">
            <h4>Hi!admin <?php echo $loged_user_name . " "; ?></h4>
            <a class="btn btn-primary" href="logout.php">
                <?php echo "Logout";?>
            </a>
          </div>

      </div>


    </div>
    <hr />
</body>
</html>
