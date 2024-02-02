<?php
include_once('main.php');
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../source/CSS/style.css">
    <script type="text/javascript" src="jquery-1.12.3.js"></script>
    <script type="text/javascript" src="studentClassCourse.js"></script>
    <script src="JS/login_logout.js"></script>
</head>
<body onload="ajaxRequestToGetMyCourse();">
    <?php include('index.php'); ?>
    <div align="center" style="background-color: orange;">
        Select Class:
        <select id="myclass" style="background-color: cyan;" name="myclass" onchange="ajaxRequestToGetMyCourse();">
            <?php  
            $classget = "SELECT * FROM class WHERE id IN (SELECT DISTINCT classid FROM subject WHERE teacherid='$check')";
            $res = mysqli_query($conn, $classget); // Assuming you have a valid mysqli connection named $conn

            while ($cln = mysqli_fetch_array($res)) {
                echo '<option value="' . $cln['id'] . '">' . $cln['name'] . '</option>';
            }
            ?>
        </select>
        <label for="fname">Class</label>
        <select name="Grade" id="Grade" required>
            <option value="">Grade</option>
            <option value="PG">PG</option>
            <option value="PP1">PP1</option>
            <option value="PP2">PP2</option> 
            <option value="1">1</option> 
            <option value="2">2</option> 
            <option value="3">3</option> 
            <option value="4">4</option> 
            <option value="5">5</option> 
            <option value="6">6</option> 
            <option value="7">7</option> 
            <option value="8">8</option> 
            <option value="9">9</option> 
            <option value="0">0</option>
        </select>
        <div style="background-color: black; color: white;">
            <label id="mycourse" onload="ajaxRequestToGetMyC();" name="mycourse"></label>
        </div>
        <hr/>
    </div>
</body>
</html>
