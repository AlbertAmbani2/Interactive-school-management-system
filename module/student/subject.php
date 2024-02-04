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
<body onload="ajaxRequestToGetCourse();">

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
                <h2>Select Class:</h2>
                <select id="myclass" name="myclass" onchange="ajaxRequestToGetCourse();" class="form-control">
                    <?php  
                        $classget = "SELECT name FROM class WHERE id IN (SELECT DISTINCT classid FROM course WHERE studentid='$check')";
                        $res = mysql_query($classget);

                        while($cln = mysql_fetch_array($res)) {
                            echo '<option value="', $cln['name'], '" >', $cln['name'], '</option>';
                        }
                    ?>
                </select>
                
                <h2>Select Course:</h2>
                <select id="mycourse" onchange="ajaxRequestToGetCourseInfo();" name="mycourse" class="form-control"></select>

                <h4>Course Information:</h4>
                <hr/>
                <label id="mycourseteacher"></label>
                <br/>
                <table id="mycourseinfo" class="table"></table>
                <hr/>
            </div>
        </div>
    </div>

</body>
</html>
