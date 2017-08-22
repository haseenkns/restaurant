<?php
 sleep(2);
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
  
	$name=mysql_real_escape_string($_GET['name']);
	$email=mysql_real_escape_string($_GET['mail']);
	$subject=mysql_real_escape_string($_GET['subject']);
	$msg=mysql_real_escape_string($_GET['msg']);
	
	$to=getAdminEmail();
    
	$sub="A New Enquiry has been Received ";
	$message="A new enquiry has been received from verisumed.com.Log in to admin panel for further details..";
		$mail=sendBasicMail($to,'verisumed.com','Verisumed' ,$sub,$message);
        $dates=date('Y-m-d');
if($mail){
    $excQry=mysql_query("INSERT INTO `enquiry` (`id` ,`name` ,`mail` ,`subject`,`message`,`pdate`) VALUES (NULL , '$name', '$email', '$subject','$msg','$dates')");
		echo "1";
	}else{
    $excQry=mysql_query("INSERT INTO `enquiry` (`id` ,`name` ,`mail` ,`subject`,`message`,`pdate`) VALUES (NULL , '$name', '$email', '$subject','$msg','$dates')");
		echo "0";
	}
 ?>
