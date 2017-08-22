<?php
sleep(1);
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
 $baseurl=$Global['baseurl'];
 $name=mysql_real_escape_string($_GET['name']);
 $mail=mysql_real_escape_string($_GET['mail']);
 $password=mysql_real_escape_string(md5($_GET['password']));
 $type=mysql_real_escape_string($_GET['type']);
 $pdate=date("d-m-Y");
 $checkqry=mysql_query("select * from `login` where `username`='$mail'   ");

	if(mysql_num_rows($checkqry)>0)
	{
		echo 'This username is already registered...';
	}else{
	
	$insQry=mysql_query("Insert into `login` set `name`= '$name' ,`username`='$mail',`password`= '$password' ,`type`='$type' ,`pdate`='$pdate' ,`status`='0'");
	
	
	if($type==3){
			if($insQry){
				echo 'Account will be active soon.Thanks for registering';
				}else{
				echo 'Some Problem occoured.Please try again later';
				}
			}
	

    if($type==2){
			if($insQry){
			$insId=mysql_insert_id();
					$to=$mail;
			  		$msg=activationText($to,$insId,$baseurl);
					$sendMail=sendBasicMail($to,"resume@verisumed.com","Verisumed","Activation Link",$msg);
				 	if($sendMail){
						echo 'Activation link has been sent to your registered mail.';
					}else{
						echo 'Some Problem occoured.Please try again later';
				}
				}else{
					echo 'Some Problem occoured.Please try again later';
				}
			}
	
}

?> 
