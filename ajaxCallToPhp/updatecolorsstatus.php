<?php
 sleep(1);
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");

 $id=$_GET['id'];
 $selQry=mysql_fetch_row(mysql_query("select * from `colors` where id='$id'"));
 $status=$selQry[2];
 
 if($status==1){
 	$actorStatus=0;
 }elseif($status==0){
	$actorStatus=1;
 }
 $textStatus=getColorsStatus($actorStatus);
 $sqlQry="UPDATE `colors` set status= '$actorStatus' where `id`='$id' ";
 $execQry=mysql_query($sqlQry);

 if($execQry){
 	echo $actorStatus."###".$textStatus;
 }else{
 	echo "-1###Error";
 }
 
 ?>
