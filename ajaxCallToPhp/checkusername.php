<?php
sleep(1);
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 $uname=mysql_real_escape_string($_GET['uname']);

		 $checkqry=mysql_query("select * from `admin` where `username`='$uname'  ");
	
	

	if(mysql_num_rows($checkqry)>0)
	{
		echo '0';
	}else{
		echo '1';
	}

?> 
