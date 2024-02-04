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
                    <a class="nav-link" href="index.php">Return Home</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="deleterep.php">Delete report</a>
            </li>
        </ul>
    </div>

    <hr/>

</body>
</html>

		
<?php
echo '<form align="center"  action="#" method="post">';
$conn = new mysqli($host, $username, $password, $db_name);
if ($conn->connect_error) {
    die('Error connecting to the database');
}

mysqli_select_db($conn, 'schoolmanagementsystemdb');

$sql = "SELECT reportid, courseid, studentid, message FROM report WHERE teacherid='$check'";
$res = mysqli_query($conn, $sql);

if (!$res) {
    die('Error executing query: ' . mysqli_error($conn));
}

echo "<center>";
echo "<table align='center' border='2'>
    <tr>
        <th> Report id</th>
        <th>Course id</th>
        <th>Student id</th>
        <th> Message</th>
        <th> checkbox</th>
    </tr>";

while ($rn = mysqli_fetch_array($res)) {
    echo "<tr>
            <td>$rn[0]</td>
            <td>$rn[1]</td>
            <td>$rn[2]</td>
            <td>$rn[3]</td>
            <td><input type='checkbox' checked='checked' name='attendance[]' value=".$rn[0]." /></td>
          </tr>";
}

echo "</table>";
echo "<input class='menulista' type='submit' value='Delete' name='submit' />";
echo "</form> </html>";
echo "</center>";

?>


<?php
//print_r($_REQUEST);
if(!empty($_POST['submit'])){
$atten=$_REQUEST['attendance'];
foreach($atten as $a)
   {
	   
	   $sql="delete from report where reportid='$a'";
		$s=mysql_query($sql);
   }

if(!$s)
{
echo "failed!!!";
}
echo "succeed";
}
?>


</div>

