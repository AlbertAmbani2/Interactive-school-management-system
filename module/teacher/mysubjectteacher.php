<?php  
include_once('main.php');
 $em = $_REQUEST['cid'];


$subjectinfo = "SELECT * FROM teachers WHERE id in (select teacherid from subject where id='$em' and studentid='$check')";
$rescou = mysql_query($subjectinfo);
$subjectid = "SELECT * FROM class WHERE id in (select classid from subject where id='$em' and studentid='$check')";
$rescoud = mysql_query($courseid);
$st=mysql_fetch_array($rescoud);

while($rn=mysql_fetch_array($rescou))
{
 echo "Teacher ID: ",$rn['id'],"<br/>";
 echo "Teacher Name: ",$rn['name'],"<br/>";
 echo "Teacher Email: ",$rn['email'],"<br/>";
  echo " Your Section : ",$st['section'],"<br/>";
  echo " Your Class Room : ",$st['room'],"<br/>";
 

}


?>
