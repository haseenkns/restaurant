<?php
 sleep(1);
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
 $pwd=$_GET['pwd'];
 $name=$_GET['name'];
 $uid=$_GET['uid'];
 $updQry= mysql_query("Update `user` set `name`='$name', `password`='$pwd' where `id`='$uid' ");	  
	if($updQry){
		echo '1';  // done..successfull
	}else{
		echo '0';
	}
 ?>
