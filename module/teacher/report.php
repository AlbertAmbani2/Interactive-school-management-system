<?php
include('main.php');


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
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="deleterep.php">Delete report</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <form action="reportupdate.php" method="POST">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <label for="myclass">Select Class:</label>
                    <select id="myclass" name="myclass" class="form-control" onchange="ajaxRequestToGetMyCourse();">
                        <?php  
                            $classget = "SELECT * FROM class WHERE id IN (SELECT DISTINCT classid FROM course WHERE teacherid='$check')";
                            $res = mysqli_query($conn, $classget); 

                            while ($cln = mysqli_fetch_array($res)) {
                                echo '<option value="' . $cln['id'] . '" >' . $cln['name'] . '</option>';
                            }
                        ?>
                    </select>

                    <label for="mycourse">Select Course:</label>
                    <select id="mycourse" name="mycourse" class="form-control" onchange="ajaxRequestToGetCourseStudent();"></select>

                    <label for="mystudent">Select Student:</label>
                    <select id="mystudent" name="mystudent" class="form-control"></select>

                    <label for="report">Report:</label>
                    <textarea name="report" class="form-control"></textarea>

                    <br />
                    <input type="submit" class="btn btn-primary" value="Report Submit" name="submit"/>
                </div>
            </div>
        </form>
    </div>

    <hr/>

</body>
</html>
