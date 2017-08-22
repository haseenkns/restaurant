<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

if(isset($_POST['sid']))
{
$stateid=$_POST['sid'];
$cname=trim($_POST['cname']);
$query2=mysql_query("SELECT * FROM `cities` WHERE `city_state` ='$stateid' and `city_name` like '%$cname%' ");
echo "<ul>";
while($query3=mysql_fetch_array($query2))
{
?>
<li style="cursor:pointer;"  onclick="fill('<?php echo $query3['city_name']; ?>','<?php echo $query3['city_id']; ?>')"><?php echo stripslashes($query3['city_name']); ?></li>
<?php
}
}
?>
</ul>