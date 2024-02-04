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
    <script type="text/javascript" src="studentClassSubject.js"></script>
    <script src="JS/login_logout.js"></script>
</head>
<body onload="ajaxRequestToGetMySubject();">

    <?php include('index.php'); ?>

    <form action="grade.php" method="POST" class="container mt-4">
        <div align="center">
            <label for="myclass">Select Class:</label>
            <select id="myclass" name="myclass" onchange="ajaxRequestToGetMySubject()" class="form-control">
                <?php  
                $classget = "SELECT  * FROM class where id in(select DISTINCT classid from subject where teacherid='$check')";
                $res = mysql_query($classget);
                while ($cln = mysql_fetch_array($res)) {
                    echo '<option value="', $cln['id'], '" >', $cln['name'], '</option>';
                }
                ?>
            </select>

            <label for="mysubject" class="mt-3">Select Subject:</label>
            <select id="mysubject" onchange="ajaxRequestToGetSubjectStudent()" name="mysubject" class="form-control"></select>

            <label for="mystudent" class="mt-3">Select Student:</label>
            <select id="mystudent" name="mystudent" class="form-control"></select>

            <div class="mt-4">
                <input class="btn btn-primary" type="submit" value="Grade" name="submit"/>
                <input class="btn btn-primary ml-3" type="submit" value="Update Grade" name="update"/>
            </div>
        </div>
    </form>

    <hr/>

</body>
</html>
