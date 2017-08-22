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
 $mail=mysql_real_escape_string($_GET['mail']);
 $password=mysql_real_escape_string(md5($_GET['password']));
 $type=$_GET['type'];

 $selQry=mysql_query("select * from `login` where `username`='$mail' and `password` = '$password' and `status` = '1' and `type` = '$type'");
 $numRows=mysql_num_rows($selQry);
 if($numRows>0){
	 $execQry=mysql_fetch_row($selQry);
   	 $uid=$execQry[0];
	 $insName=strreplace($execQry[1]);
	 $_SESSION['uid']=$uid;
	 $_SESSION['type']=$type;
  	 echo '1##'.$insName; 
 }else{
 
   echo '0';
 }
 
 
 ?>
