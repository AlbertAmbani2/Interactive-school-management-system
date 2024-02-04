<?php
include_once('main.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Your custom CSS file -->
    <link rel="stylesheet" type="text/css" href="../../source/CSS/style.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Your custom JS files -->
    <script type="text/javascript" src="jquery-1.12.3.js"></script>
    <script type="text/javascript" src="studentClassCourse.js"></script>
    <script src="JS/login_logout.js"></script>

</head>
<body onload="ajaxRequestToGetCourseCurrentExamSchedule();">

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Return Home</a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center mt-5">
                <h1>Exam Schedule</h1>

                <!-- Select Running Course Exam Schedule -->
                <div class="form-group">
                    <label for="curcourse">Select Running Course Exam Schedule:</label>
                    <select id="curcourse" class="form-control" onchange="ajaxRequestToGetCourseCurrentExamSchedule();" name="curcourse">
                        <?php
                        $classget = "SELECT  DISTINCT id, name FROM course WHERE classid IN (SELECT DISTINCT classid FROM students WHERE id='$check') AND studentid='$check'";
                        $res = mysql_query($classget);

                        while ($clnn = mysql_fetch_array($res)) {
                            echo '<option value="', $clnn['id'], '" >', $clnn['name'], '</option>';
                        }
                        ?>
                    </select>
                </div>
                <!-- End Select Running Course Exam Schedule -->

                <hr/>

                <!-- Display Exam Schedule Table -->
                <div align="center">
                    <table id="mycourseexamschedule" class="table table-bordered">
                        <!-- Your table contents here -->
                    </table>
                </div>
                <!-- End Display Exam Schedule Table -->

            </div>
        </div>
    </div>

</body>
</html>
