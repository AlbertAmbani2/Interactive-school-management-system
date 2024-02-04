<?php
include_once('main.php');

include_once('../../service/mysqlcon.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Return Home</a>
            </li>
        </ul>
    </nav>


    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-6 text-center">
                <form action="#" method="GET">
                    <div class="form-group">
                        <label for="key">Key:</label>
                        <input type="text" class="form-control" name="key" id="key" placeholder="st-XXX-X" />
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<table border="2" align="center">
<?php
if(!empty($_GET['submit'])){
$searchKey = $_GET['key'];
$images_dir = "../images";
$string = "<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Gender</th>
    <th>DOB</th>
    <th>Addmission Date</th>
    <th>Address</th>
    <th>Parent Id</th>
    <th>Class Id</th>
    <th>picture</th>

</tr>";
$sql = "SELECT * FROM students WHERE id like '$searchKey%' OR name like '$searchKey%' OR classid = '$searchKey';";
$res = mysql_query($sql);
while($row = mysql_fetch_array($res)){
    $picname = $row['id'];
	echo "<div align='center'>";
	
    echo '<tr><td>'.$row['id'].'</td><td>'.$row['name'].
    '</td><td>'.$row['phone'].'</td><td>'.$row['email'].
    '</td><td>'.$row['sex'].'</td><td>'.$row['dob'].
    '</td><td>'.$row['addmissiondate'].'</td><td>'.$row['address'].
    '</td><td>'.$row['parentid'].'</td><td>'.$row['classid'].'</td>';
	
	echo "</div>";
	
  // echo $string;
echo "<td><img src='".$images_dir."/".$picname.".jpg' alt='$picname' width='150' height='150' >".'</td></tr>'; 
}

echo "</table>";

//echo $images_dir.$picname.".jpg";
}
?>

