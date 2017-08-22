<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
date_default_timezone_set('Asia/Kolkata');
	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Data has been added Successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='Data not inserted Successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='Data updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='Data not updated Successfully !!';
		$class='danger';
	break;
	
	case 'ule':
		$msg='This username already exists!!';
		$class='danger';
	break;
	case 'dls':
		$msg='Data deleted successfully !!';
		$class='success';
	break;
	
	case 'dlf':
		$msg='Data not deleted successfully !!!!';
		$class='danger';
	break;
	
		case 'ads':
		$msg='Administrator rights added successfully !!';
		$class='success';
	break;
	
	case 'adf':
		$msg='Administrator rights not added successfully !!!!';
		$class='danger';
	break;
	
	case 'default' :
		$msg='';
		break;
	
	}
	}
	
	
if(isset($_GET['did'])&&$_GET['did']!=''){
	$did=base64_decode($_GET['did']);
	$delQry=mysql_query("delete from `welcome` where `id`='$did'");
		if($delQry){
			header("location:welcome.php?msg=dls");
		}else{
			header("location:welcome.php?msg=dlf");
		}
}

if(isset($_POST['submit'])){
		extract($_POST);
		$flag=1;
		
		$from=mysql_real_escape_string($_POST['pemail']);
		$to=mysql_real_escape_string($_POST['cemail']);
		$subject=mysql_real_escape_string($_POST['subject']);
		$msg=mysql_real_escape_string($_POST['contents']);
		$fromname=$progname;
		
		$pdate=date("d/m/Y");
		$ptime=date("h:i a");
		mysql_query("BEGIN");
		
		//$mail=sendBasicMail($to,$from,$fromname,$subject,$msg);
		
		if(1){
		$excQry=mysql_query("INSERT INTO `welcomemail` (`id`, `mem_id`, `pdate`, `ptime`, `status`, `postedby`, `subject`, `content`,`pemail`,`cemail`) VALUES (NULL, '$memId', '$pdate', '$ptime', '1', '$adminId', '$subject', '$msg','$from','$to');");
	if($excQry){
		$flag=1;	 
	}else{
		$flag=0;	
	}
		}else{
		$flag=0;	
	}
	
	
	if($flag==1 ){
		mysql_query("COMMIT");
		header("location:thanksmail.php?msg=ins");					  
	}else{
		mysql_query("REVOKE");
		header("location:thanksmail.php?msg=inf");	
	}
	
	
}





if(isset($_GET['aid'])&&$_GET['aid']!=''){
	$aid=base64_decode($_GET['aid']);
	$edtQry=mysql_query("Select * from `members` where `id`='$aid'");
	$userData=mysql_fetch_row($edtQry);	
	
	$prog_id=$userData[1];
	$memno=getMemberShipNumber($prog_id,$aid);
	$date=$userData[26];
	$mem_name=getTabledataById("name","titles",$userData[2])." ".$userData[3]." ".$userData[4]." ".$userData[5];
	$mem_address=getMemberFullAddress($aid);
	$progArr=getProgramDescriptionById($prog_id);
	$progEmail=htmlentities(stripslashes($progArr[2]));
	$progName=htmlentities(stripslashes($progArr[1]));
	$progTemplatesArr=getProgramTemplatesById($prog_id);
	$subject=stripslashes($progTemplatesArr[4]);
	$progContent=stripslashes($progTemplatesArr[5]);
	$remark=stripslashes($progTemplatesArr[6]);
	$content=$progContent;
	
}

	
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=letter.doc");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo getSiteTitle(); ?></title>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</head>

<body style="font-size:13px;font-family:Calibri">
<table width="100%" border="0">
  <tr>
    <td align="left">Membership No : <b><?php echo $memno; ?></b></td>
    <td align="right">Dated : <b><?php echo $date ?></b></td>
  </tr>
  <tr><td colspan="2" height="30px">&nbsp;</td></tr>
  <tr>
    <td align="left" colspan="2"><b><?php echo $mem_name?></b></td>
    
  </tr>
  <tr>
    <td align="left" colspan="2"><?php echo $mem_address?></td>
    
  </tr>
  <tr><td colspan="2" height="120px">&nbsp;</td></tr>
  <tr>
    <td  colspan="2" align="left">Subject : <u><?php echo $subject; ?></u></td>
   
  </tr>
  <tr><td colspan="2" height="15px">&nbsp;</td></tr>
  <tr>
    <td colspan="2" align="left">Dear <?php echo $mem_name; ?></td>
   
  </tr>
   <tr>
    <td colspan="2" align="left"><?php echo $content; ?></td>
   
  </tr>
    <tr><td colspan="2" height="10px">&nbsp;</td></tr>

   <tr>
    <td colspan="2" align="left"><?php echo $remark; ?></td>
   
  </tr>
</table>


</body>
</html>