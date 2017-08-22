<?php
 sleep(1);
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
  
	$name=mysql_real_escape_string($_GET['name']);
	$email=mysql_real_escape_string($_GET['mail']);
	$mobile=mysql_real_escape_string($_GET['mob']);
	$msg=mysql_real_escape_string($_GET['msg']);
	
	//$baseurl=$Global['baseurl'];
	
	$to=getAdminEmail();
    
	//$cemail= "support@tfl.com";
	$sub="A New Contact Message has been Received ";
	$message="A New contact enquiry has been received from thefootballlink.com.Log in to admin panel for further details..";
		/*$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: TFL<thefootballlink.com>' . "\r\n";*/

		$mail=sendBasicMail($to,'thefootballlink.com','The Football Link' ,$sub,$message);
        $dates=date('Y-m-d');
if($mail){
    $excQry=mysql_query("INSERT INTO `contact` (`id` ,`name` ,`mail` ,`phone`,`message`,`pdate`,`address`) VALUES (NULL , '$name', '$email', '$mobile','$msg','$dates','$address')");
		echo "Mail Sent Successfully..!";
	}else{
	 $excQry=mysql_query("INSERT INTO `contact` (`id` ,`name` ,`mail` ,`phone`,`message`,`pdate`,`address`) VALUES (NULL , '$name', '$email', '$mobile','$msg','$dates','$address')");
		echo "Mail not Sent.Try Again Later";
	}
 ?>
