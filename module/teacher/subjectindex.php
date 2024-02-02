<?php
include_once('main.php');
include_once('index.php');

$dept=mysql_query("SELECT name FROM subject");


?>

<html>

<title>Attendance Department Wise</title>

<center>
<h1>Please Select Department To Make All Staff Attendance</h1>
<form action="grade.php" method="post">
Select Subject:<select name="subject" selected="selected"><br/>
<?php

while($r=mysql_fetch_array($dept))
{
echo '<option value="',$r['name'],'">',$r['name'],'</option>';


}
?>
</select>

<input type="submit" value="Make Attendance"/>
</form>

</html>