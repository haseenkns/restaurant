<?php
 sleep(1);
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
 $email=mysql_real_escape_string($_GET['email']);
 

 $selQry=mysql_fetch_row(mysql_query("select count(*) from `login` where `username`='$email' "));
 	  
	if($selQry[0]==0){
		echo '1';  // done..successfull
	}else{
	    echo '0'; // some problem occured
	}

 
 ?>
