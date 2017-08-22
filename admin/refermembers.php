<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

if(isset($_POST['name']))
{
$name=$_POST['name'];
//$cname=trim($_POST['cname']);
$query2=mysql_query("SELECT * FROM `members` WHERE `fname` like '%$name%' or  `mname` like '%$name%' or `lname` like '%$name%' ");
echo "<ul>";?>
<li style="cursor:pointer;"  onclick="fillVal('','')">None</li>
<?php 
while($query3=mysql_fetch_array($query2))
{
	$memId=$query3['id'];
	$progId=$query3['prog_id'];
	$memShipNo=getMemberShipNumber($progId,$memId);
	$memname=$query3['fname']." ".$query3['mname']." ".$query3['lname']." - ".$memShipNo;
?>
<li style="cursor:pointer;"  onclick="fillVal('<?php echo $memname; ?>','<?php echo $memId; ?>')"><?php echo stripslashes($memname); ?></li>
<?php
}
}
?>
</ul>