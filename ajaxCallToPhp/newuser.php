<?php
 sleep(1);
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
 $email=$_GET['email'];
 $pwd=$_GET['pwd'];
 $name=$_GET['name'];
 $date=date("Y-m-d");
 $phone=$_GET['phone'];
 $country=$_GET['country'];
 $arr=$_GET['arr'];

 $selQry=mysql_query("select * from `user` where `email`='$email' and `password` = '$pwd'");
 $numRows=mysql_num_rows($selQry);
 if($numRows==0){
	$insQry= mysql_query("insert into `user` set `name`='$name', `email`='$email' ,`password`='$pwd' ,`created`='$date' ,`status`='1',`phone`='$phone',`country`='$country',`arr`='$arr'");	  
	if($insQry){
		echo '1';  // done..successfull
	}else{
	    echo '2'; // some problem occured
	}
 }else{
 
   echo '0';
 }
 
 
 ?>
