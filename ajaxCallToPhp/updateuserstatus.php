<?php
 sleep(1);
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
 $baseurl=$Global['baseurl'];
 $id=$_GET['id'];
 $selQry=mysql_fetch_row(mysql_query("select * from `user` where id='$id'"));
 $status=$selQry[5];

 if($status==1){
 	$testStatus=0;
 }elseif($status==0){
	$testStatus=1;
 }
 $textStatus=getStatus($testStatus);
 $sqlQry="UPDATE `user` set status= '$testStatus' where `id`='$id' ";
 $execQry=mysql_query($sqlQry);

 if($execQry){
 	echo $testStatus."###".$textStatus;
 }else{
 	echo "-1###Error";
 }
 
 ?>