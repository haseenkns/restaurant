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
 $email=$_GET['email'];
 $pwd=$_GET['pwd'];
 $prid=$_GET['pid'];

 $selQry=mysql_query("select * from `user` where `email`='$email' and `password` = '$pwd' and `status` = '1'");
 $numRows=mysql_num_rows($selQry);
 if($numRows>0){
	 $execQry=mysql_fetch_row($selQry);
   	 $uid=$execQry[0];
	 $_SESSION['uid']=$uid;
	 $_SESSION['type']='1';
  	 echo '1'; 
 }else{
 
   echo '0';
 }
 
 
 ?>
