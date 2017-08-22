<?php
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
	
	$id=$_GET['id'];
	
	$selQry=mysql_fetch_row(mysql_query("select `price` from `program_price` where  `id`='$id' "));
	echo $selQry[0];
	
 ?>

