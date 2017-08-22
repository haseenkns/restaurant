<?php
 ob_start();
 session_start();
 sleep(1);
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
 $sval=mysql_real_escape_string($_GET['sval']);
 $aid=$_GET['aid'];

 
$insQry=mysql_query("Insert into `subsubassignments` set `name`= '$sval' ,`a_id`='$aid',`status`= '1' ");
if($insQry){
	echo "1";	
}else{
	echo "0";	
}
	
?>