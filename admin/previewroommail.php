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
	
if(isset($_POST['submitpreview'])){
		extract($_POST);
		$flag=1;
		$fromname=mysql_real_escape_string($_POST['fromname']);
		$from=mysql_real_escape_string($_POST['fromemail']);
		$to=mysql_real_escape_string($_POST['toemail']);
		$subject=mysql_real_escape_string($_POST['subject']);
		$msg=mysql_real_escape_string($_POST['contents']);
		$checkin=mysql_real_escape_string($_POST['checkin']);
		$checkout=mysql_real_escape_string($_POST['checkout']);
		$noofrooms=mysql_real_escape_string($_POST['noofrooms']);
		$additionalinfo=mysql_real_escape_string($_POST['additionalinfo']);
		$pdate=date("d/m/Y");
		$ptime=date("h:i a");
		mysql_query("BEGIN");
		
		//$mail=sendBasicMail($to,$from,$fromname,$subject,$msg);
		
		if(1){
		$excQry=mysql_query("INSERT INTO `roommail` (`id`, `mem_id`, `pdate`, `ptime`, `status`, `postedby`, `subject`, `content`,`fromemail`,`toemail`,`prog_id`,`checkin`,`checkout`,`benefits`,`additionalinfo`,`noofrooms`) VALUES (NULL, '$hidMid', '$pdate', '$ptime', '0', '$adminId', '$subject', '$msg','$from','$to','$hidPid','$checkin','$checkout','$benefits','$additionalinfo','$noofrooms');");
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
		header("location:thanksroomreservation.php?msg=ins");					  
	}else{
		mysql_query("REVOKE");
		header("location:thanksroomreservation.php?msg=inf");	
	}
	
	
}


$contents=$_POST['contents'];
	$benefits=$_POST['benefits'];
	if($benefits==1){
	$benefitsText="Complimentry";	
	}else{
	$benefitsText="Paid";		
	}
$addInfo=$_POST['info'];
if($addInfo==''){
	$addInfo='None';	
}
	

$memberName="Members Name : &nbsp;&nbsp;&nbsp;&nbsp;<b>".$_POST['membername']."</b>";
$memberNo="Membership Number : &nbsp;".$_POST['membernumber'];
$memberAdd="Address : ".$_POST['address'];
$memberContact="Contact No : ".$_POST['contact'];
$memberEmail="Email : ".$_POST['email'];
$memberVoucher="Voucher No : ".$_POST['voucher'];
$memberCheckin="Check In Date : <b>".$_POST['checkin']."</b>";
$memberCheckout="Check Out date : <b>".$_POST['checkout']."</b>";
$memberCheckout="Check Out date : <b>".$_POST['checkout']."</b>";
$noofrooms="No Of Rooms : ".$noofrooms;
$memberInfo="Additional Info : ".$addInfo;
$ack=nl2br($_POST['ack']);
$remark=$_POST['remark'];
$disclaimer="Disclaimer : This message is confidential and is intended solely for the addressee, and may also be privileged. If you are not the intended recipient, please delete this email and inform the sender  immediately. Any unauthorized disclosure, copying,  distribution or  use of  this  message  is  strictly  prohibited , and  if  done , will  result  in  strict  legal  action. This  message  is  not guaranteed to be complete or error free. No liability is assumed for any errors and/or omissions in the contents of this message. Nothing in this communication is intended to operate as an electronic signature under applicable law.
";

$message=$contents."<BR/><BR/><hr/>".$memberName."<BR/><BR/>".$memberNo."<BR/><BR/>".$memberAdd."<BR/><BR/>".$memberContact."<BR/><BR/>".$memberEmail."<BR/><BR/>".$memberVoucher."<BR/><BR/>".$memberCheckin."<BR/><BR/>".$memberCheckout."<BR/><BR/>".$memberbenefits."<BR/><BR/>".$memberInfo."<BR/><BR/>".$ack."<BR/>".$remark."<br/><br/><br/>".$disclaimer;





	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo getSiteTitle(); ?></title>
    <script src="javascript/javascript.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/js/libs/jquery-1.10.2.min.js"></script>
    <script src="javascript/sweet-alert.js" language="javascript" type="text/javascript"> </script>
    
    <link rel="stylesheet" href="css/sweet-alert.css" type="text/css">
    <script src="javascript/javascript.js" language="javascript" type="text/javascript"> </script>
    <script>
    function setFocus(val){
		document.getElementById(val).focus();	
	}
    function errorMsg(msg,id){
		//alert(msg)
		swal({
		title: "Error!",
		text: msg,
		type: "error",
		confirmButtonText: "OK"
		},function(){
			//setFocus(id)
			//alert('dsa')
		});
			//return false;
		}
	
	
	function previewMsg(){
		var email=document.getElementById('cemail').value;
		var subject=document.getElementById('subject').value;
		var content=document.getElementById('contents').value;
		var remark=document.getElementById('remark').value;
		msg="<b>To : </b>"+email+" \n<b>Subject :</b> \n"+subject+'\n'+"<b>Content :</b> \n\n" +content+"\n"+remark;
		
		
		swal("Welcome Mail",unescape(msg))
	}
    </script>
    
    <script>
	function validateTemplate()
	{
	var eptrn=/^[a-z0-9]+[a-z0-9\._]*@[a-z0-9\.]+\.[a-z]{2,3}$/;    ///////////mail pattern///////
	var uptrn=/^[!@#&-_a-zA-Z0-9]{6,36}$/;
	var uname=/^[!@#&-_a-zA-Z0-9]+$/;
	var letters = /^[.A-Za-z ]+$/;  
	
	
	if(document.user.program.value=="0")
		{
		//alert('Enter valid Email-address');
		errorMsg('Please select a program','program')
		return false;
		}
		if(document.user.subject.value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Enter a mail subject','subject')
		return false;
		}
		if(document.user.content.value=="0")
		{
		//alert('Enter valid Email-address');
		errorMsg('Entet mail content','contents')
		return false;
		}

		

	}
	</script>
	</head>

<body class="theme-dark">

	<!-- Header -->
	<?php include_once("header.php"); ?> <!-- /.header -->

	<div id="container">
		<?php include_once("leftmenu.php"); ?>
		<!-- /Sidebar -->

		<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<?php include_once("crumb.php"); ?>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>Room Reservation For - <?php echo stripslashes($progName); ?> </h3>
						<!--<span>Good morning, John!</span>-->
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->

				<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>Room Reservation Mail </h4>
							</div>
							<div class="widget-content">
								<p>
                                
                                <table width="100%" border="0" cellpadding="2" cellspacing="2">
              
              
              
              <?php if($msg!=''){ ?>
              <tr>
                <td class="rgt1">&nbsp;</td>
                <td  align="left"><div class="alert alert-<?php echo $class ?> fade in">
									<i class="icon-remove close" data-dismiss="alert"></i>
									<?php echo $msg; ?>
								</div></td>
              </tr>
             <?php } else{?>
			 <tr>
                <td class="rgt1" colspan="2">&nbsp;</td>
               
              </tr>
			 <?php }?>
             
              <tr>
                <td class="rgt1">&nbsp;</td>
                <td valign="top"><table width="100%" border="0" cellpadding="6" cellspacing="0" class="grayfour">
				<form action="" name="user" method="post"  class="form-horizontal row-border" id="validate-1"> 
				
				
            
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-briefcase "></i>&nbsp;Info</b></div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left" class="blackbold">From *</td>
				<td><?php echo $_POST['fromemail']; ?></td>
				<td></td>
				</tr>
                <tr >
				<td align="left" class="blackbold">To *</td>
				<td><?php echo $_POST['toemail']; ?></td>
				<td></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold"> Subject</td>
				<td><?php echo $_POST['subject']; ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
               
                  <tr >
				<td align="left" class="blackbold">  Content</td>
				<td><textarea rows="18"  name="contents" id="contents" class="form-control wysiwyg" placeholder="Add Email Content" style="width:100%" ><?php echo $message; ?></textarea></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
              
             
             
             
             
             
             
                
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left">
                    <input type="hidden" value="<?php echo $_POST['fromemail']; ?>" name="fromemail">
                    <input type="hidden" value="<?php echo $_POST['toemail']; ?>" name="toemail">
                    <input type="hidden" value="<?php echo $_POST['subject']; ?>" name="subject">
                    <input type="hidden" value="<?php echo $_POST['hidMid']; ?>" name="hidMid">
                    <input type="hidden" value="<?php echo $_POST['hidPid']; ?>" name="hidPid">
                    
                    <input type="hidden" value="<?php echo $_POST['checkin']; ?>" name="checkin">
                    <input type="hidden" value="<?php echo $_POST['checkout']; ?>" name="checkout">
                    <input type="hidden" value="<?php echo $_POST['benefits']; ?>" name="benefits">
                    <input type="hidden" value="<?php echo $_POST['info']; ?>" name="additionalinfo">
                    
                    
                    <input type="hidden" value="<?php echo $adminId; ?>" name="postedby">
                    <input type="hidden" value="<?php echo $_POST['progName']; ?>" name="fromname">
                    <input type="submit" name="submitpreview" class="btn" value=" Send Reservation  Mail  ">&nbsp;&nbsp;&nbsp;
                    <input type="button" name="cancel" value=" Cancel & Go Back " onClick="javascript:window.location.href='sendroomreservation.php?aid=<?php echo base64_encode($_POST['hidMid']); ?>'" class="btn"></td>
				</tr>
				
			
  				</form>
</table></td>
              </tr>
			 
          </table>
                                
                                </p>
							</div>
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
				</div>
                
                
                <!--<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Welcome mail</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                         <tr >
            <th >Sno</th>
             <th>Program</th>
            <th  data-hide="phone">Off. Email</th>
            <th data-hide="phone,tablet">Subject</th>
            <th  data-hide="phone,tablet">Preview</th>
            <th style="text-align:center"  data-hide="phone,tablet">Action</th>
  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
  	$sqlQry=mysql_query("select * from `welcome` order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
	<td align="left" class="smallfonttext"><?php echo getProgramNameById($fetch['prog_id']); ?></td>
    <td align="left" class="smallfonttext"><?php echo getProgramEmailById($fetch['prog_id']); ?></td>
	<td align="left" class="smallfonttext"><?php echo limitContent($fetch['subject'],50); ?></td>
	  <td align="center"  ><a href="viewwelcome.php?aid=<?php echo base64_encode( $fetch['id']); ?>" rel="facebox"> <button class="btn"><i class="icon-desktop"></i></button></span></td>
    
    <td align="center" bgcolor="#F9F9F9"><table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr >
		<td align="right" ><a href="welcome.php?did=<?php echo base64_encode($fetch['id']) ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
		<td align="center" ><a href="welcome.php?eid=<?php echo base64_encode($fetch['id']) ?>"><button class="btn"><i class="icon-edit"></i></button>	</a></td>
        
        
		<td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','welcome',5)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
        
        <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
	</tr>
	</table></td>
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>-->
			</div>
			<!-- /.container -->

		</div>
	</div>

</body>
</html>