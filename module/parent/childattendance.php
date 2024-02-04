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
    <script type="text/javascript" src="Attendance.js"></script>
    <script src="JS/login_logout.js"></script> 
</head>
<body onload="ajaxRequestToGetAttendancePresentThisMonth();">

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Return Home</a>
            </li>
        </ul>
    </nav>

    <div align="center" style="background-color:light;">
        Select your Child:
        <select id="childid" name="childid" onchange="ajaxRequestToGetAttendancePresentThisMonth();" style="background-color:white;">
            <?php  
                $classget = "SELECT  * FROM students where parentid='$check'";
                $res= mysql_query($classget);

                while($cln=mysql_fetch_array($res))
                {
                    echo '<option value="',$cln['id'],'" >',$cln['name'],'</option>';
                }
            ?>
        </select>
        

        Select Attendance that your child present: Current Month:
        <input type="radio" onclick="ajaxRequestToGetAttendancePresentThisMonth();" value="thismonth" id="present" name="present" checked="checked"/> 
        ALL : 
        <input type="radio" onclick="ajaxRequestToGetAttendancePresentAll();" value="all" id="present" name="present"/>
    </div>  
    
    <div align="center">
        <table id="mypresent" class="table table-bordered">
            <!-- Table content goes here -->
        </table>
    </div>
    <hr/>
    <div align="center" style="background-color:gray;">
        Select Attendance that your child are absent : Current Month:
        <input type="radio" onclick="ajaxRequestToGetAttendanceAbsentThisMonth();" value="thismonth" id="absent" name="absent" checked="checked"/> 
        ALL : 
        <input type="radio" onclick="ajaxRequestToGetAttendanceAbsentAll();" value="all" id="absent" name="absent"/>
    </div>  
    <hr/>
    <div align="center">
        <table id="myabsent" class="table table-bordered">
            <!-- Table content goes here -->
        </table>
    </div>
</body>
</html>
