<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
$currentDate=date("d")."/".date("m")."/".date("Y");
	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Member has been  added Successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='Member not added Successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='Members data updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='Members data not updated Successfully !!';
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
	$delQry=mysql_query("update  `leads` set `status`='2' where `id`='$did' ");
		if($delQry){
		
			
			header("location:viewleads.php?msg=dls");
		}else{
			header("location:viewleads.php?msg=dlf");
		}
}

if(isset($_POST['submit'])){
	
	
		extract($_POST);
		$flag=1;
		$fname=mysql_real_escape_string($_POST['fname']);
		$mname=mysql_real_escape_string($_POST['mname']);
		$lname=mysql_real_escape_string($_POST['lname']);
		$compname=mysql_real_escape_string($_POST['compname']);
		$activity=mysql_real_escape_string($_POST['activity']);
		$email=mysql_real_escape_string($_POST['email']);
		$pcontact=mysql_real_escape_string($_POST['pcontact']);
		$scontact=mysql_real_escape_string($_POST['scontact']);
		$address1=mysql_real_escape_string($_POST['address1']);
		$address2=mysql_real_escape_string($_POST['address2']);
		$state=mysql_real_escape_string($_POST['state']);
		$city=mysql_real_escape_string($_POST['hidCity']);
		$area=mysql_real_escape_string($_POST['hidArea']);
		$assignments=mysql_real_escape_string($_POST['assignments']);
		$subassignment=mysql_real_escape_string($_POST['hidAssignmentVal']);
		$subsubassignment=mysql_real_escape_string($_POST['hidSubAssignmentVal']);
		
		$source=mysql_real_escape_string($_POST['source']);
		$doa=mysql_real_escape_string($_POST['doa']);
		$dateofsale=mysql_real_escape_string($_POST['dateofsale']);
		
		$conversation=mysql_real_escape_string($_POST['conversation']);
		
		$meetingdate=changeDate($_POST['meetingdate']);
		$meetingtime=mysql_real_escape_string($_POST['meetingtime']);
        
		
		
		$remark=mysql_real_escape_string($_POST['remark']);
		$pdate=date("d/m/Y");
		$ptime=date("h:m a");
		mysql_query("BEGIN");
		
		if( ($leadtype==3) || ($leadtype==4 ) ){
			$meetingdate=changeDate($doa);
			$meetingtime=$ptime;
		}
		
		
		
if($flag==1){
	$excQry=mysql_query("INSERT INTO `leads` (`id`, `fname`, `mname`, `lname`, `email`, `pcontact`, `scontact`, `doa`, `address1`, `address2`, `state`, `city`, `area`, `activity`, `source`, `createdon`, `status`, `a_id`, `remark`, `compname`, `addresstype`, `assignment`, `createdtime`, `subassignment`, `conversation`, `leadtype`, `meetingdate`, `meetingtime`,`ecost`,`servicetax`,`taxinclusion`,`subsubassignment`,`dateofsale`) VALUES (NULL, '$fname', '$mname', '$lname', '$email', '$pcontact', '$scontact', '$doa', '$address1', '$address2', '$state', '$city', '$area', '$activity', '$source', '$pdate', '1', '$adminId', '$remark', '$compname', '$addresstype', '$assignments', '$ptime', '$subassignment', '$conversation', '$leadtype', '$meetingdate', '$meetingtime','$ecost','$servicetax','$taxinclusion','$subsubassignment','$dateofsale');");
		
if($excQry){
	$insId=mysql_insert_id();
	if($leadtype==3){
	
	
	$orderqty=$_POST['orderqty'];
		for($i=1;$i<=$orderqty;$i++){
			 if(isset($_POST['paymentplan'.$i]) && $_POST['paymentplan'.$i]!='' ){
				 $description=mysql_real_escape_string(trim($_POST['paymentplan'.$i]));
				 $cost=mysql_real_escape_string(trim($_POST['cost'.$i]));
				
				$insQry=mysql_query("INSERT INTO `paymentplans` (`id`, `lid`, `a_id`, `description`, `cost`) VALUES (NULL, '$insId', '$adminId', '$description', '$cost')");
	
				 if(!$insqry){
					$flag=0; 
				 }
				 
			 }
			
		}
	
	
	
	
	
	}
	
		$flag=1;
		
		
	}else{
		$flag=0;	
	}
}

	
	
	if($flag==1 ){
		mysql_query("COMMIT");
		header("location:thanksleads.php?msg=ins&id=".base64_encode($insId)."");					  
	}else{
		mysql_query("REVOKE");
		header("location:thanksleads.php?msg=inf");	
	}
	
	
}

if(isset($_POST['update'])){
	extract($_POST);
	$id=$_POST['hidLid'];
	$flag=1;
		$flag=1;
		$fname=mysql_real_escape_string($_POST['fname']);
		$mname=mysql_real_escape_string($_POST['mname']);
		$lname=mysql_real_escape_string($_POST['lname']);
		$compname=mysql_real_escape_string($_POST['compname']);
		$activity=mysql_real_escape_string($_POST['activity']);
		$email=mysql_real_escape_string($_POST['email']);
		$pcontact=mysql_real_escape_string($_POST['pcontact']);
		$scontact=mysql_real_escape_string($_POST['scontact']);
		$address1=mysql_real_escape_string($_POST['address1']);
		$address2=mysql_real_escape_string($_POST['address2']);
		$state=mysql_real_escape_string($_POST['state']);
		$city=mysql_real_escape_string($_POST['hidCity']);
		$area=mysql_real_escape_string($_POST['hidArea']);
		$assignments=mysql_real_escape_string($_POST['assignments']);
		$subassignment=mysql_real_escape_string($_POST['hidAssignmentVal']);
		$subsubassignment=mysql_real_escape_string($_POST['hidSubAssignmentVal']);
		
		$source=mysql_real_escape_string($_POST['source']);
		$doa=mysql_real_escape_string($_POST['doa']);
		$conversation=mysql_real_escape_string($_POST['conversation']);
		$meetingdate=changeDate($_POST['meetingdate']);
		$meetingtime=mysql_real_escape_string($_POST['meetingtime']);
		$remark=mysql_real_escape_string($_POST['remark']);
		
		$dateofsale=changeDate($_POST['dateofsale']);
		
		mysql_query("BEGIN");
		
		$upQry=mysql_query("UPDATE `leads` SET `fname` = '$fname', `mname` = '$mname', `lname` = '$lname', `email` = '$email', `pcontact` = '$pcontact', `scontact` = '$scontact', `doa` = '$doa', `address1` = '$address1', `address2` = '$address2', `state` = '$state', `city` = '$city', `area` = '$area', `activity` = '$activity', `source` = '$source',`remark` = '$remark', `compname` = '$compname', `addresstype` = '$addresstype', `assignment` = '$assignments', `subassignment` = '$subassignment', `conversation` = '$conversation', `subsubassignment` = '$subsubassignment',`leadtype`='$leadtype' WHERE `leads`.`id` = '$id';");
	if($upQry){
		$flag=1;
		
		if($leadtype==1){
		  
			if(checkleadhasfollowups($lid)){
			 	 $fquery = mysql_query("UPDATE  `followups` set `meetingdate`='$meetingdate',`meetingtime`='$meetingtime' where `lid` = '$id' ");
				 $ffquery = mysql_query("UPDATE  `leads`  set `dateofsale`='',`ecost`='',`servicetax`='',`taxinclusion`='0' where `id` = '$id' ");
			
			}else{
				$fquery = mysql_fetch_row(mysql_query("UPDATE  `leads` set `meetingdate`='$meetingdate',`meetingtime`='$meetingtime' ,`dateofsale`='',`ecost`='',`servicetax`='',`taxinclusion`='0' where `id` = '$id' "));
			}
		  
		  
		
		}
		
		
		if($leadtype==2){
		  
			if(checkleadhasMeetings($lid)){
				 $fquery = mysql_query("UPDATE  `meetings` set `meetingdate`='$meetingdate',`meetingtime`='$meetingtime' where `lid` = '$id' ");
				 $ffquery =mysql_query("UPDATE  `leads`  set `dateofsale`='',`ecost`='',`servicetax`='',`taxinclusion`='0' where `id` = '$id' ");
			
			}else{
			$fquery = mysql_query("UPDATE  `leads` set `meetingdate`='$meetingdate',`meetingtime`='$meetingtime' ,`dateofsale`='',`ecost`='',`servicetax`='',`taxinclusion`='0' where `id` = '$id' ");
			}
		  
		  
		
		}
		
		
		
		if($leadtype==3){
		$fquery = mysql_query("UPDATE  `leads` set `dateofsale`='$dateofsale',`ecost`='$ecost',`servicetax`='$servicetax',`taxinclusion`='$taxinclusion' where `id` = '$id' ");
		
		$numrows=mysql_num_rows(mysql_query("select * from `paymentplans`  where `lid`='$id' "));
		if($numrows>0){
				$delQry=mysql_query("delete from `paymentplans`  where `lid`='$id'");
		}
	
	$orderqty=$_POST['orderqty'];
		for($i=1;$i<=$orderqty;$i++){
			 if(isset($_POST['paymentplan'.$i]) && $_POST['paymentplan'.$i]!='' ){
				 $description=mysql_real_escape_string(trim($_POST['paymentplan'.$i]));
				 $cost=mysql_real_escape_string(trim($_POST['cost'.$i]));
				
				$insQry=mysql_query("INSERT INTO `paymentplans` (`id`, `lid`, `a_id`, `description`, `cost`) VALUES (NULL, '$id', '$adminId', '$description', '$cost')");
	
				 if(!$insqry){
					//$flag=0; 
				 }
				 
			 }
			
		}
	
	
	
	
	
	}
		
		
			/*if($leadtype==3){
	
	
	$orderqty=$_POST['orderqty'];
		for($i=1;$i<=$orderqty;$i++){
			 if(isset($_POST['paymentplan'.$i]) && $_POST['paymentplan'.$i]!='' ){
				 $description=mysql_real_escape_string(trim($_POST['paymentplan'.$i]));
				 $cost=mysql_real_escape_string(trim($_POST['cost'.$i]));
				
				$insQry=mysql_query("INSERT INTO `paymentplans` (`id`, `lid`, `a_id`, `description`, `cost`) VALUES (NULL, '$insId', '$adminId', '$description', '$cost')");
	
				 if(!$insqry){
					$flag=0; 
				 }
				 
			 }
			
		}
	
	
	
	
	
	}*/
		
		
		
		
		
		
		
		
	}else{
		$flag=0;
	}
	
	if($flag==1 ){
		mysql_query("COMMIT");
		header("location:thanksleads.php?msg=ups&id=".base64_encode($id)."");					  
	}else{
		mysql_query("REVOKE");
		header("location:thanksleads.php?msg=upf");	
	}
	
	

}



if(isset($_GET['eid'])&&$_GET['eid']!=''){
	$eid=base64_decode($_GET['eid']);
	$edtQry=mysql_query("Select * from `leads` where `id`='$eid'");
	$userData=mysql_fetch_row($edtQry);	
	$assignment=$userData[21];	
	$subassignment=$userData[23];	
	$subsubassignment=$userData[31];	
	
	
}

	
	
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
	function showHideAmountDiv(id){
		if(document.getElementById(id).style.display=='none'){
			document.getElementById(id).style.display='block';
			document.getElementById('compdiv').style.display='none';
				
		}else{
			document.getElementById(id).style.display='none'	
			document.getElementById('compdiv').style.display='block';
		}
			
	}
    function showHideDiv(id){
		var count=document.getElementById('hidTotal').value
		for(i=1;i<=count;i++){
		document.getElementById('podiv'+i).style.display='none'	
		}
		document.getElementById('podiv'+id).style.display='block'	
			
	}
    function errorMsg(msg,id){
		//alert(msg)
		swal({
		title: "Error!",
		text: msg,
		type: "error",
		confirmButtonText: "OK"
		},function(){
			document.getElementById(id).focus();	
			//alert(id)
		});
			//return false;
		}
		
    </script>
    
    <script type="text/javascript" language="JavaScript">

		
		
function ValidateLead()
	{
		
	if(document.getElementById('doa').value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Please select date of enquiry','doa')
		return false;
		}

	if(document.leadform.leadtype.value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Pleas select lead type - followup,meeting,sale,not int','leadtype1')
		return false;
		}	
	
	if( document.leadform.leadtype.value=="1")
		{
		
				if(document.getElementById('meetingdate').value=="")
				{
				//alert('Enter valid Email-address');
				errorMsg('Pleas select Followup date','meetingdate')
				return false;
				}
		
		
			if(document.getElementById('meetingtime').value=="")
				{
				//alert('Enter valid Email-address');
				errorMsg('Pleas select Followup time','meetingtime')
				return false;
				}
		
		}
	
	if( document.leadform.leadtype.value=="2")
		{
		
			if(document.getElementById('meetingdate').value=="")
			{
			//alert('Enter valid Email-address');
			errorMsg('Pleas select Meeting date','meetingdate')
			return false;
			}
			
			if(document.getElementById('meetingtime').value=="")
			{
			//alert('Enter valid Email-address');
			errorMsg('Pleas select Meeting time','meetingtime')
			return false;
			}
		
		}
		if( document.leadform.leadtype.value=="3")
		{
		
			if(document.getElementById('ecost').value=="")
			{
			//alert('Enter valid Email-address');
			errorMsg('Please enter sales cost','ecost')
			return false;
			}
			
			
			if(document.getElementById('taxinclusion').value=="0")
			{
			//alert('Enter valid Email-address');
			errorMsg('Please enter tax type included or excluded','servicetax')
			return false;
			}
			
			
			if(document.getElementById('dateofsale').value=="")
			{
			//alert('Enter valid Email-address');
			errorMsg('Please enter date of sale','dateofsale')
			return false;
			}
			
		
		}
	
	

}
  
</script>


    
    <style>
.imagenew{
width:150px;
background-color:#E85959;
padding:10px;
text-align:center;
border:solid 1px #E33737;
color:#FFF;
border-radius:10px;	
font-size:15px;
font-style:italic;
box-shadow:2px 2px 1px #888888;

}

	</style>
    
    
    
    
    <script src="<?php echo $baseurl ?>/facefiles/jquery-1.2.2.pack.js" type="text/javascript"></script>
<link href="<?php echo $baseurl ?>/facefiles/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="<?php echo $baseurl ?>/facefiles/facebox.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox() 
    })

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
						<h3>Leads Management</h3>
						<!--<span>Good morning, John!</span>-->
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->
<form action="" method="post" enctype="multipart/form-data" name="leadform" onSubmit="return ValidateLead()">
 <?php if($msg!=''){ ?>
             <div class="row">
             <div class="col-md-12">
             <div class="alert alert-<?php echo $class ?> fade in">
									<i class="icon-remove close" data-dismiss="alert"></i>
									<?php echo $msg; ?>
								</div>
                                </div>
             </div>
             <?php } ?>
			 
			 
   <?php 
    if(isset($_GET['eid'])&&$_GET['eid']!=''){ //<?php echo htmlentities(stripslashes($userData[42])) ?>
		
		<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>Update Leads Detail</h4>
							</div>
							<div class="widget-content">
                                  
                                <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                              
												</div>
												<div class="col-md-3">
                                                 <label class="control-label">First Name *</label>
													<input type="text" name="fname" id="fname" autocomplete="off" class="form-control" value="<?php echo htmlentities(stripslashes($userData[1]))  ?>" >
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Middle Name</label>
													<input type="text" name="mname" id="mname" autocomplete="off" class="form-control" value="<?php echo htmlentities(stripslashes($userData[2]))  ?>"  >
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Last Name</label>
													<input type="text" name="lname" id="lname" autocomplete="off" class="form-control" value="<?php echo htmlentities(stripslashes($userData[3]))  ?>"  >
												</div>
											</div>
										
									</div>
                                     
                                     <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                               
												</div>
											
												<div class="col-md-6">
                                                <label class="control-label"> Company Name</label>
													<input type="text" name="compname" id="compname" class="form-control" value="<?php echo htmlentities(stripslashes($userData[19]))  ?>" >
												</div>
                                                <div class="col-md-3">
                                                <label class="control-label"> Activity/Sector</label>
													<input type="text" name="activity" id="activity" class="form-control" value="<?php echo htmlentities(stripslashes($userData[13]))  ?>" >
												</div>
											</div>
										
									</div>
                                     
                              		  <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                          
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Email</label>
                                                <input type="text" name="email" id="email" class="form-control" value="<?php echo htmlentities(stripslashes($userData[4]))  ?>" >
												</div>
												<div class="col-md-3">
                                                <label class="control-label"> Contact No.( Primary )</label>
													<input type="text" name="pcontact" id="pcontact" class="form-control" value="<?php echo htmlentities(stripslashes($userData[5]))  ?>">
												</div>
												<div class="col-md-3">
                                                <label class="control-label"> Contact No.( Secondary )</label>
													<input type="text" name="scontact" id="scontact" class="form-control" value="<?php echo htmlentities(stripslashes($userData[6]))  ?>">
												</div>
											</div>
										
									</div>
                                      
                                    
                                    
                                    
                                    
                                      <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                                
											</div>
                                            <div class="col-md-3">
                                                	<label class="control-label">Address Type</label>
													<div class="col-md-10" style="padding-left:0px;">
											
											<label class="radio-inline">
												<input type="radio" class="uniform" name="addresstype" value="2" <?php if($userData[20]==2){ ?> checked <?php } ?>>
												Official
											</label>
                                            <label class="radio-inline">
												<input type="radio" class="uniform" name="addresstype" value="1" <?php if($userData[20]==1){ ?> checked <?php } ?>>
												Residential
											</label>
											
										</div>
												</div>
												<div class="col-md-3">
                                                	<label class="control-label">Address Line 1</label>
													<input type="text" name="address1" id="address1" class="form-control" value="<?php echo htmlentities(stripslashes($userData[8]))  ?>">
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Address Line 2</label>
													<input type="text" name="address2" id="address2" class="form-control" value="<?php echo htmlentities(stripslashes($userData[9]))  ?>">
												</div>
												
											</div>
										
									</div>
                                      <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												<div class="col-md-3">
                                                <?php
												  $state=$userData[10];
				    $city=$userData[11];
				   $area=$userData[12];
												?>
                                                	<label class="control-label">State</label>
                                                    <input type="hidden" name="hidCity" id="hidCity" value="<?php echo $userData[11];  ?>">
                                                    <input type="hidden" name="hidArea" id="hidArea" value="<?php echo $userData[12];  ?>">
													<select name="state" id="state" class="form-control "  onChange="getCityByStateId(this.value)"><option value="0">Select</option>
				<?php
				 
					$execQry=mysql_query("select * from `state` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[10]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No State</option>

					<?php } ?>
                
                </select>
             
												</div>
												<div class="col-md-3">
                                                <label class="control-label">City</label>
													<div id="citydiv">
                                                    <select name="city" id="city" class="form-control " onChange="getAreaByCityId(this.value)" >
                                                    <option value="0">Select City</option>
                                                    	<?php
					$execQryc=mysql_query("select * from `cities` where `status` = '1' and `city_state`='$state'  ");
					$numRowsc=mysql_num_rows($execQryc);
					if($numRowsc>0){
					while($fetchc=mysql_fetch_array($execQryc)){?>
					<option value="<?php echo stripslashes($fetchc['city_id']) ?>" <?php if($city==$fetchc['city_id']) {?> selected <?php } ?>><?php echo stripslashes($fetchc['city_name']) ?></option>
					<?php }	}else{?>
					<option value="0">No City</option>

					<?php } ?>
                                                    </select></div>
                                                  
                                                      <span class="help-block">City not Found? Click <a id="othercity"  href="addothercity.php?id=<?php echo $userData[10]; ?>" rel="facebox" >Here</a></span>
												</div>
												<div class="col-md-3"><label class="control-label">Area</label>
												 <div id="areadiv"><select name="area" id="area" class="form-control " onChange="setHiddenArea(this.value)">
                                           <option value="0">Select Area</option>      
                                               <?php
					$execQrya=mysql_query("select * from `locations` where `status` = '1' and `a_id`='$city' order by `id` ");
					$numRowsa=mysql_num_rows($execQrya);
					if($numRowsa>0){
					while($fetcha=mysql_fetch_array($execQrya)){?>
					<option value="<?php echo stripslashes($fetcha['id']) ?>" <?php if($area==$fetcha['id']) {?> selected <?php } ?>><?php echo stripslashes($fetcha['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Area</option>

					<?php } ?>
				
                
              									  </select></div>
                                                   <span class="help-block">Area not Found? Click <a id="otherarea"  href="addotherarea.php?id=<?php echo $city; ?>" rel="facebox" >Here</a></span>
												</div>
											</div>
										
									</div>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <hr/>
                                                
											</div>
												
												
										
									</div>
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                               
												</div>
											
												<div class="col-md-3">
                                                <label class="control-label"> Type Of Assignment</label>
                                                <input type="hidden" name="hidAssignmentVal" id="hidAssignmentVal" value="<?php echo $userData[23] ?>">
                                                 <input type="hidden" name="hidSubAssignmentVal" id="hidSubAssignmentVal" value="<?php echo $userData[31] ?>">
                                                
													<select name="assignments" id="assignments" class="form-control " onChange="getSubAssignments(this.value)" ><option value="0">Select Program</option>
				<?php
					$assignment=$userData[21];
					$execQryas=mysql_query("select * from `assignment` where `status` = '1' order by `id` ");
					$numRowscs=mysql_num_rows($execQryas);
					if($numRowscs>0){
					while($fetchas=mysql_fetch_array($execQryas)){?>
					<option value="<?php echo stripslashes($fetchas['id']) ?>" <?php if($assignment==$fetchas['id']) {?> selected <?php } ?>><?php echo stripslashes($fetchas['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Assignment</option>
					<?php } ?>
                
                </select>
												</div>
                                                <div class="col-md-3">
                                                
                                                <label class="control-label">Sub Assignment</label>
													<div id="assignmentdiv"><select name="subassignment" id="subassignment" class="form-control " onChange="setHidAssignmentValue(this.value)" ><option value="0">Select Sub Assignments</option>
                                                    
                                               <?php
					$execQry=mysql_query("select * from `subassignments` where `status` = '1' and `a_id`='$assignment' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){
						$subid=$fetch[0];
						
						?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[23]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No SubAssignment</option>
					<?php } ?>     
                                                    
                                                    
                                                    
				
                
                </select></div>
              										  <span class="help-block">Not Found ? Click <a id="otherhref"  href="addsubassignment.php?id=<?php echo $userData[23]; ?>" rel="facebox" >Here</a></span>
												</div>
                                                
                                                <div class="col-md-3">
                                                
                                                <label class="control-label">Sub Sub Assignment</label>
													<div id="subassignmentdiv"><select name="subsubassignment" id="subsubassignment" class="form-control " onChange="setHidSubAssignmentValue(this.value)" ><option value="0">Select Sub Assignments</option>
                                                    
                                               <?php
					$execQry=mysql_query("select * from `subsubassignments` where `status` = '1' and `a_id`='$subassignment' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){
						$subid=$fetch[0];
						
						?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[31]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Sub SubAssignment</option>
					<?php } ?>     
                                                    
                                                    
                                                    
				
                
                </select></div>
              										  <span class="help-block">Not Found ? Click <a id="subotherhref"  href="addsubsubassignment.php?id=<?php echo $userData[31];?>" rel="facebox" >Here</a></span>
												</div>
                                                
                                                
                                                <div class="col-md-2">
                                                 <label class="control-label">&nbsp;</label>
													
												</div>
											</div>
										
									</div>
                                    
                                    <!--<div class="form-group" id="otherassignment" style="display:block;">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                               
												</div>
											
												<div class="col-md-5">
                                                
                                                
													
												</div>
                                                <div class="col-md-4">
                                                 <label class="control-label">Other Sub Assignment</label>
													<input type="text" name="othersubassignment" id="othersubassignment" class="form-control"></div>
												</div>
                                                
                                                
											</div>-->
										
									</div>
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-5">
                                                
                                                   
                                                    <label class="control-label">Lead Source</label>
													<select name="source" id="source" class="form-control " ><option value="0">Select Source</option>
				<?php
					$execQry=mysql_query("select * from `sources` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[14]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Lead</option>
					<?php } ?>
                
                </select>
												
                                                
                                                </div>
												<div class="col-md-4">
                                                
                                               
                                                <label class="control-label">Date Of Enquiry</label>
													<input type="text" name="doa" id="doa" class="form-control datepicker"  value="<?php echo htmlentities(stripslashes($userData[26]))  ?>">
                                                    <span class="help-block">DD/MM/YYYY</span>
												</div>
                                                
                                                
                                              
											</div>
										
									</div>
                                    
                              <div class="form-group">
										<div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												<div class="col-md-9">
                                                	<label class="control-label">Remarks (If any)</label>
														<input type="text" name="remark" id="remark" class="form-control" value="<?php echo htmlentities(stripslashes($userData[18]))  ?>" >
												</div>
												
												
											</div>
                                    
                                            
                                    
									</div>
                                    
        <div class="row"><hr/></div>
        
                                    
                                  <div class="form-group">
										
                                        <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												<div class="col-md-9">
                                                	<label class="control-label">Current Conversation</label>
														<textarea  name="conversation" id="conversation" class="form-control wysiwyg" style="height:150px;" ><?php echo htmlentities(stripslashes($userData[24]))  ?></textarea>
												</div>
												
												
											</div>
										
										
                                             
										
                                        
                                        	
                                            
                                            
                                         
										
									</div>  
                                    
                                     <div class="form-group" style="margin:20px 0px;">
                                        <div class="row">
                                        <div class="col-md-11">
                                            <div class="col-md-1">	</div>
                                            <div class="col-md-11"><label class="control-label">Current Meeting Status</label></div>
                                        </div>
                                        
                                        </div>
										
										<div class="row">
                                        <div class="col-md-11">
                                            <div class="col-md-1">	</div>
                                           
                                           <?php
									$leadtype=$userData[25];
									$currentMeetingDate=getCurrentMeetingDateTimeByLeadType($eid,$leadtype);
									$explodeDateTime=explode("###",$currentMeetingDate);
									
									$execQry=mysql_query("select * from `leadtypes` where `status` = '1' order by `id` ");
									$numRows=mysql_num_rows($execQry);
									if($numRows>0){
									while($fetch=mysql_fetch_array($execQry)){?>
									<div class="col-md-2" ><div class="imagenew">
									<span ><i class="icon-<?php echo $fetch['class'] ?>"></i></span><br/>
									<span class="title"><label><?php echo $fetch['name'] ?></label></span><br/>
									<span class="title"><input type="radio" onClick="showDateTimeDiv(this.value)" <?php if($fetch['id']==$leadtype){ ?> checked<?php } ?>  name="leadtype" value="<?php echo $fetch['id'] ?>"></span>
									
									</div>
									</div>
									<?php }
									}
									?>
                                           
                                            
                                        
                                     
                                        </div>
                                        
                                        </div>
                                     </div>
                                    
                                    
                                    
                                    <div class="form-group" style="display:<?php if( ($leadtype==1) || ($leadtype==2) ){ ?>block<?php }else{ ?>none<?php } ?>;" id="meetingdatetimediv">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-5">
                                                
                                                   
                                                    <label class="control-label">Current Date</label>
													<input type="text" name="meetingdate" id="meetingdate" class="form-control datepicker" value="<?php echo revertDate($explodeDateTime[0])  ?>" >
												
                                                
                                                </div>
												<div class="col-md-4">
                                                
                                               
                                                <label class="control-label">Current Time</label>
													<input type="text" name="meetingtime" id="meetingtime" class="form-control timepicker"  value="<?php echo $explodeDateTime[1]   ?>">
                                                    <span class="help-block">hh:mm am/pm</span>
												</div>
                                                
                                                
                                              
											</div>
										
									</div>
                                    
                                    <div  style="display:<?php if( $leadtype==3 ){ ?>block<?php }else{ ?>none<?php } ?>;" id="salesdiv">
										
                                        
                                        <div class="form-group">
											<div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                    <label class="control-label">Date of Sale</label>
													
												
                                                
                                                </div>
												<div class="col-md-5">
                                                
                                              <?php  //echo $userData[32]; ?>
                                             
													<input type="text" name="dateofsale" id="dateofsale" class="form-control datepicker"  value="<?php echo revertDate($userData[32]) ?>">
                                                   
												</div>
                                                
                                                
                                              
											</div>
                                            </div>
                                        
                                        
										<div class="form-group">
											<div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                    <label class="control-label">Estimated Cost</label>
													
												
                                                
                                                </div>
												<div class="col-md-5">
                                                
                                               
                                             
						<input type="text" name="ecost" id="ecost" class="form-control " onKeyUp="clearServiceTax()" value="<?php echo htmlentities(stripslashes($userData[28]))  ?>"  >
                                                   
												</div>
                                                
                                                
                                              
											</div>
                                            </div>
                                            
                                            <div class="form-group">       
                                            <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                    <label class="control-label">Service Tax (%) </label>
													
												
                                                
                                                </div>
												<div class="col-md-5">
                                                
                                               
                                             
												     <input type="text" class="form-control" name="servicetax" id="servicetax" data-mask="99.99" onKeyUp="clearServiceTax()"  value="<?php echo $userData[29]  ?>"><span class="help-block">Add Tax in format xx.xx eg 10.23</span>
                                                   
												</div>
                                                
                                                
                                              
											</div>
                                            </div>
                                            
                                     	<div class="form-group">       
                                            <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                    <label class="control-label">Service Tax Inclusion </label>
													
												
                                                
                                                </div>
												<div class="col-md-5">
                                                
                                               
                                             
													<select class="form-control" name="taxinclusion"  id="taxinclusion" onChange="calculateTax(this.value)">
                                                    <option value="0" <?php if($userData[30]==0){ ?> selected <?php } ?>>Select Service Tax</option>
                                                    <option value="1" <?php if($userData[30]==1){ ?> selected <?php } ?>>Included in Cost</option>
                                                    <option value="2" <?php if($userData[30]==2){ ?> selected <?php } ?>>Not Included in Cost</option>
                                                    
                                                    </select>
                                                   
												</div>
                                                
                                                
                                              
											</div>
                                            </div>
                                      	<div class="form-group">            
                                            <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                    <label class="control-label">Total Cost</label>
													
												
                                                
                                                </div>
												<div class="col-md-5">
                                             
													<label class="control-label" id="showcost"><?php echo calculateServiceTax($userData[28],$userData[29],$userData[30]) ?></label>
                                                   
												</div>
                                                
                                                
                                              
											</div>
                                            </div>
                                            	<div class="form-group">      
                                            <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                   
													
												
                                                
                                                </div>
												<div class="col-md-5">
                                                
                                               
                                                    <label class="control-label">Add Payment Plan Description</label>
													
                                                   
												</div>
                                                <div class="col-md-2">
                                                
                                               
                                             
													  <label class="control-label">Cost</label>
                                                   
												</div>
                                                
                                                
                                              
											</div>
                                            </div>
                                            
                                            <?php
												$plan=0;
												//echo "select * from `paymentplans` where `lid` = '$eid' order by `id` asc ";
												$execQryPlan=mysql_query("select * from `paymentplans` where `lid` = '$eid' order by `id` asc ");
												$numRowsPlan=mysql_num_rows($execQryPlan);
												if($numRowsPlan>0){
													
													
												while($fetchPlan=mysql_fetch_array($execQryPlan)){
													$plan++;
													?>
														<div class="form-group">      
                                            <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                   
													
												
                                                
                                                </div>
												<div class="col-md-5">
                                                
                                               
                                                   <input value="<?php echo htmlentities(stripslashes($fetchPlan['description']))  ?>" type="text" name="paymentplan<?php echo $plan; ?>" id="paymentplan<?php echo $plan; ?>" class="form-control " >
													
                                                   
												</div>
                                                <div class="col-md-2">
                                                
                                               
                                             
													<input type="text" value="<?php echo htmlentities(stripslashes($fetchPlan['cost']))  ?>" name="cost<?php echo $plan; ?>" id="cost<?php echo $plan; ?>" class="form-control " >
                                                   
												</div>
                                                
                                                
                                              
											</div>
                                            </div>
												<?php }	}else{
													
													$numRowsPlan=1;
													?>
														<div class="form-group">      
                                            <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                   
													
												
                                                
                                                </div>
												<div class="col-md-5">
                                                
                                               
                                                   <input type="text" name="paymentplan1" id="paymentplan1" class="form-control " >
													
                                                   
												</div>
                                                <div class="col-md-2">
                                                
                                               
                                             
													<input type="text" name="cost1" id="cost1" class="form-control " >
                                                   
												</div>
                                                
                                                
                                              
											</div>
                                            </div>
												<?php }	?>
                                            
                                            
                                            
                                            
                                            
                                            	<div class="form-group" id="addmore">      
                                            <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                  
													
												
                                                
                                                </div>
												<div class="col-md-4">
                                                <input type="hidden" name="orderqty" id="orderqty" value="<?php echo $numRowsPlan; ?>">
                                                   
                                                    <label class="control-label" onClick="addElement()" style="cursor:pointer;">+ Add More</label>
													
												
                                                
                                                </div>
                                                
                                                
                                              
											</div>
                                            </div>
										
									</div>
                                    
                                       
                                    
                                    
                                    <div class="form-group">
                                    
											
                                            
                                            <div class="row" style="padding-top:30px;">
										
										<div class="col-md-11">
                                    
                                        
                                            <div class="col-md-1">	</div>
                                            <div class="col-md-3" align="left">
                                            
                                             <input type="hidden" name="hidLid" id="hidLid" value="<?php echo $eid; ?>">
                                             <input type="submit" name="update" class="btn btn-primary btn-block" value=" Update  "> 
                                           
 
 </div>
                                            <div class="col-md-3" align="left">
                                           <input type="reset" name="reset" class="btn  btn-block" value=" Reset "> 
                                           
 
 </div>
										</div>
									</div>
										
									</div>
                                    
                            
                            </div>
                            </div>
                            </div>
		

            
     <?php }else{ ?>
     
     
   				
                
                <div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>Add Leads Detail</h4>
							</div>
							<div class="widget-content">
                                  
                                <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                              
												</div>
												<div class="col-md-3">
                                                 <label class="control-label">First Name *</label>
													<input type="text" name="fname" id="fname" autocomplete="off" class="form-control" onKeyUp="fillPrintableName()">
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Middle Name</label>
													<input type="text" name="mname" id="mname" autocomplete="off" class="form-control" onKeyUp="fillPrintableName()">
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Last Name</label>
													<input type="text" name="lname" id="lname" autocomplete="off" class="form-control" onKeyUp="fillPrintableName()">
												</div>
											</div>
										
									</div>
                                     
                                     <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                               
												</div>
											
												<div class="col-md-6">
                                                <label class="control-label"> Company Name</label>
													<input type="text" name="compname" id="compname" class="form-control">
												</div>
                                                <div class="col-md-3">
                                                <label class="control-label"> Activity/Sector</label>
													<input type="text" name="activity" id="activity" class="form-control">
												</div>
											</div>
										
									</div>
                                     
                              		  <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                          
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Email</label>
                                                <input type="text" name="email" id="email" class="form-control">
												</div>
												<div class="col-md-3">
                                                <label class="control-label"> Contact No.( Primary )</label>
													<input type="text" name="pcontact" id="pcontact" class="form-control">
												</div>
												<div class="col-md-3">
                                                <label class="control-label"> Contact No.( Secondary )</label>
													<input type="text" name="scontact" id="scontact" class="form-control">
												</div>
											</div>
										
									</div>
                                      
                                    
                                    
                                    
                                    
                                      <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                                
											</div>
                                            <div class="col-md-3">
                                                	<label class="control-label">Address Type</label>
													<div class="col-md-10" style="padding-left:0px;">
											
											<label class="radio-inline">
												<input type="radio" class="uniform" name="addresstype" value="2" checked>
												Official
											</label>
                                            <label class="radio-inline">
												<input type="radio" class="uniform" name="addresstype" value="1">
												Residential
											</label>
											
										</div>
												</div>
												<div class="col-md-3">
                                                	<label class="control-label">Address Line 1</label>
													<input type="text" name="address1" id="address1" class="form-control">
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Address Line 2</label>
													<input type="text" name="address2" id="address2" class="form-control">
												</div>
												
											</div>
										
									</div>
                                      <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												<div class="col-md-3">
                                                	<label class="control-label">State</label>
                                                    <input type="hidden" name="hidCity" id="hidCity" value="">
                                                    <input type="hidden" name="hidArea" id="hidArea" value="">
													<select name="state" id="state" class="form-control "  onChange="getCityByStateId(this.value)"><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `state` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[1]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No State</option>

					<?php } ?>
                
                </select>
             
												</div>
												<div class="col-md-3">
                                                <label class="control-label">City</label>
													<div id="citydiv"><select name="city" id="city" class="form-control " onChange="getAreaByCity(this.value)" ><option value="0">Select City</option>
				
                
                </select></div>
                                                  
                                                      <span class="help-block">City not Found? Click <a id="othercity"  href="addothercity.php?id=0" rel="facebox" >Here</a></span>
												</div>
												<div class="col-md-3"><label class="control-label">Area</label>
												 <div id="areadiv"><select name="area" id="area" class="form-control " ><option value="0">Select Area</option>
				
                
                </select></div>
                                                   <span class="help-block">Area not Found? Click <a id="otherarea"  href="addotherarea.php?id=0" rel="facebox" >Here</a></span>
												</div>
											</div>
										
									</div>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <hr/>
                                                
											</div>
												
												
										
									</div>
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                               
												</div>
											
												<div class="col-md-3">
                                                <label class="control-label"> Type Of Assignment</label>
                                                <input type="hidden" name="hidAssignmentVal" id="hidAssignmentVal" value="0">
                                                
                                                  <input type="hidden" name="hidSubAssignmentVal" id="hidSubAssignmentVal" value="0">
													<select name="assignments" id="assignments" class="form-control " onChange="getSubAssignments(this.value)" ><option value="0">Select Program</option>
				<?php
					$execQry=mysql_query("select * from `assignment` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[1]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Programs</option>
					<?php } ?>
                
                </select>
												</div>
                                                <div class="col-md-3">
                                                <label class="control-label">Sub Assignment</label>
													<div id="assignmentdiv"><select name="subassignment" id="subassignment" class="form-control " onChange="setHidAssignmentValue(this.value)" ><option value="0">Select Sub Assignments</option>
				
                
                </select></div>
              										  <span class="help-block">Not Found ? Click <a id="otherhref"  href="addsubassignment.php?id=0" rel="facebox" >Here</a></span>
												</div>
                                                <div class="col-md-3">
                                                <label class="control-label">Sub Sub Assignment</label>
													<div id="subassignmentdiv"><select name="subsubassignment" id="subsubassignment" class="form-control "  ><option value="0">Select Sub Sub Assignments</option>
				
                
                </select></div>
              										  <span class="help-block">Not Found ? Click <a id="subotherhref"  href="addsubsubassignment.php?id=0" rel="facebox" >Here</a></span>
												</div>
                                                
                                                <div class="col-md-2">
                                                 <label class="control-label">&nbsp;</label>
													
												</div>
											</div>
										
									</div>
                                    
                                    <!--<div class="form-group" id="otherassignment" style="display:block;">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                               
												</div>
											
												<div class="col-md-5">
                                                
                                                
													
												</div>
                                                <div class="col-md-4">
                                                 <label class="control-label">Other Sub Assignment</label>
													<input type="text" name="othersubassignment" id="othersubassignment" class="form-control"></div>
												</div>
                                                
                                                
											</div>-->
										
									</div>
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-5">
                                                
                                                   
                                                    <label class="control-label">Lead Source</label>
													<select name="source" id="source" class="form-control " ><option value="0">Select Source</option>
				<?php
					$execQry=mysql_query("select * from `sources` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[1]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Lead</option>
					<?php } ?>
                
                </select>
												
                                                
                                                </div>
												<div class="col-md-4">
                                                
                                               
                                                <label class="control-label">Date Of Enquiry</label>
													<input type="text" name="doa" id="doa" class="form-control datepicker" >
                                                    <span class="help-block">DD/MM/YYYY</span>
												</div>
                                                
                                                
                                              
											</div>
										
									</div>
                                    
                              
                                    
                                    
                                  <div class="form-group">
										
                                        <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												<div class="col-md-9">
                                                	<label class="control-label">Conversation</label>
														<textarea  name="conversation" id="conversation" class="form-control wysiwyg" style="height:150px;" ></textarea>
												</div>
												
												
											</div>
										
										
                                             
										
                                        
                                        	
                                            
                                            
                                         
										
									</div>  
                                    
                                     <div class="form-group" style="margin:20px 0px;">
                                        <div class="row">
                                        <div class="col-md-11">
                                            <div class="col-md-1">	</div>
                                            <div class="col-md-11"><label class="control-label">Meeting Status</label></div>
                                        </div>
                                        
                                        </div>
										
										<div class="row">
                                        <div class="col-md-11">
                                            <div class="col-md-1">	</div>
                                           
                                           <?php
									$execQry=mysql_query("select * from `leadtypes` where `status` = '1' order by `id` ");
									$numRows=mysql_num_rows($execQry);
									if($numRows>0){
									while($fetch=mysql_fetch_array($execQry)){?>
									<div class="col-md-2" ><div class="imagenew">
									<span ><i class="icon-<?php echo $fetch['class'] ?>"></i></span><br/>
									<span class="title"><label><?php echo $fetch['name'] ?></label></span><br/>
									<span class="title"><input type="radio" onClick="showDateTimeDiv(this.value)"  name="leadtype" id="leadtype<?php echo $fetch['id'] ?>" value="<?php echo $fetch['id'] ?>"></span>
									
									</div>
									</div>
									<?php }
									}
									?>
                                           
                                            
                                        
                                     
                                        </div>
                                        
                                        </div>
                                     </div>
                                    
                                    
                                    
                                    <div class="form-group" style="display:none;" id="meetingdatetimediv">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-5">
                                                
                                                   
                                                    <label class="control-label">Date</label>
													<input type="text" name="meetingdate" id="meetingdate" class="form-control datepicker" >
												
                                                
                                                </div>
												<div class="col-md-4">
                                                
                                               
                                                <label class="control-label">Time</label>
													<input type="text" name="meetingtime" id="meetingtime" class="form-control timepicker" >
                                                    <span class="help-block">hh:mm am/pm</span>
												</div>
                                                
                                                
                                              
											</div>
										
									</div>
                                    
                                    	
                                    <div  style="display:none;" id="salesdiv">
                                    
                                    <div class="form-group">
											<div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                    <label class="control-label">Date of Sale</label>
													
												
                                                
                                                </div>
												<div class="col-md-5">
                                                
                                               
                                             
													<input type="text" name="dateofsale" id="dateofsale" class="form-control datepicker"  value="">
                                                   
												</div>
                                                
                                                
                                              
											</div>
                                            </div>
										
										<div class="form-group">
											<div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                    <label class="control-label">Estimated Cost</label>
													
												
                                                
                                                </div>
												<div class="col-md-5">
                                                
                                               
                                             
													<input type="text" name="ecost" id="ecost" class="form-control " onKeyUp="clearServiceTax()"  >
                                                   
												</div>
                                                
                                                
                                              
											</div>
                                            </div>
                                            
                                            
                                            
                                            
                                            <div class="form-group">       
                                            <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                    <label class="control-label">Service Tax (%) </label>
													
												
                                                
                                                </div>
												<div class="col-md-5">
                                                
                                               
                                             
												     <input type="text" class="form-control" name="servicetax" id="servicetax" data-mask="99.99" onKeyUp="clearServiceTax()"  value="<?php echo getEffectiveServiceTax();  ?>"><span class="help-block">Add Tax in format xx.xx eg 10.23</span>
                                                   
												</div>
                                                
                                                
                                              
											</div>
                                            </div>
                                     	<div class="form-group">       
                                            <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                    <label class="control-label">Service Tax Inclusion (<?php echo getEffectiveServiceTax(); ?> %)</label>
													
												
                                                
                                                </div>
												<div class="col-md-5">
                                                
                                               
                                             
													<select class="form-control" name="taxinclusion"  id="taxinclusion" onChange="calculateTax(this.value)">
                                                    <option value="0">Select Service Tax</option>
                                                    <option value="1">Included in Cost</option>
                                                    <option value="2">Not Included in Cost</option>
                                                    
                                                    </select>
                                                   
												</div>
                                                
                                                
                                              
											</div>
                                            </div>
                                      	<div class="form-group">            
                                            <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                    <label class="control-label">Total Cost</label>
													
												
                                                
                                                </div>
												<div class="col-md-5">
                                             
													<label class="control-label" id="showcost">- - -</label>
                                                   
												</div>
                                                
                                                
                                              
											</div>
                                            </div>
                                            	<div class="form-group">      
                                            <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                   
													
												
                                                
                                                </div>
												<div class="col-md-5">
                                                
                                               
                                                    <label class="control-label">Add Payment Plan Description</label>
													
                                                   
												</div>
                                                <div class="col-md-2">
                                                
                                               
                                             
													  <label class="control-label">Cost</label>
                                                   
												</div>
                                                
                                                
                                              
											</div>
                                            </div>
                                            
                                            <div class="form-group">      
                                            <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                   
													
												
                                                
                                                </div>
												<div class="col-md-5">
                                                
                                               
                                                   <input type="text" name="paymentplan1" id="paymentplan1" class="form-control " >
													
                                                   
												</div>
                                                <div class="col-md-2">
                                                
                                               
                                             
													<input type="text" name="cost1" id="cost1" class="form-control " >
                                                   
												</div>
                                                
                                                
                                              
											</div>
                                            </div>
                                            <div class="form-group">      
                                            <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                   
													
												
                                                
                                                </div>
												<div class="col-md-5">
                                                
                                               
                                                   <input type="text" name="paymentplan2" id="paymentplan2" class="form-control " >
													
                                                   
												</div>
                                                <div class="col-md-2">
                                                
                                               
                                             
													<input type="text" name="cost2" id="cost2" class="form-control " >
                                                   
												</div>
                                                
                                                
                                              
											</div>
                                            </div>
                                            <div class="form-group">      
                                            <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                   
													
												
                                                
                                                </div>
												<div class="col-md-5">
                                                
                                               
                                                   <input type="text" name="paymentplan3" id="paymentplan3" class="form-control " >
													
                                                   
												</div>
                                                <div class="col-md-2">
                                                
                                               
                                             
													<input type="text" name="cost3" id="cost3" class="form-control " >
                                                   
												</div>
                                                
                                                
                                              
											</div>
                                            </div>
                                            
                                            
                                            	<div class="form-group" id="addmore">      
                                            <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-2">
                                                
                                                   
                                                  
													
												
                                                
                                                </div>
												<div class="col-md-4">
                                                <input type="hidden" name="orderqty" id="orderqty" value="3">
                                                   
                                                    <label class="control-label" onClick="addElement()" style="cursor:pointer;">+ Add More</label>
													
												
                                                
                                                </div>
                                                
                                                
                                              
											</div>
                                            </div>
										
									</div>
                                    
                                    
                                    
                                    
                                     <div class="form-group">
										<div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												<div class="col-md-9">
                                                	<label class="control-label">Remarks (If any)</label>
														<input type="text" name="remark" id="remark" class="form-control" >
												</div>
												
												
											</div>
                                    
                                            
                                    
									</div>  
                                    
                                    
                                    <div class="form-group">
                                    
											
                                            
                                            <div class="row" style="padding-top:30px;">
										
										<div class="col-md-11">
                                    
                                        
                                            <div class="col-md-1">	</div>
                                            <div class="col-md-3" align="left">
                                       
                                           <input type="submit" name="submit" class="btn btn-primary btn-block" value=" Submit "> 
                                           
 
 </div>
                                            <div class="col-md-3" align="left">
                                           <input type="reset" name="reset" class="btn  btn-block" value=" Reset "> 
                                           
 
 </div>
										</div>
									</div>
										
									</div>
                                    
                            
                            </div>
                            </div>
                            </div>
                           
                

     
     
     <?php } ?>       
            
            
            
            
            
			<!-- /.container -->
</form>
		</div>
	</div>
    
    </div>
<!-- <script language="javascript" type="text/javascript" src="javascript/jquery1.4.js">   </script>
-->
 <link href="css/timepicker.css" rel="stylesheet">
 <script src="javascript/timepicker.js"></script>
    <script>
	$('#meetingtime').timepicki();
    </script>
    
  
    
    
    <script>
    function showDateTimeDiv(val){
		if( (val==1) || (val==2)){
			$('#meetingdatetimediv').slideDown();	
		}else{
				$('#meetingdatetimediv').slideUp();	
		}
		if(val==3){
			$('#salesdiv').slideDown();	
		}else{
		$('#salesdiv').slideUp();		
		}
		
		
    }
  </script>  
  
  
  
  <script>
	function addElement(){
		ress=new Array();
		val = document.getElementById('orderqty').value;
		rowid=parseInt(val)+1;
		document.getElementById('orderqty').value=rowid;
		
	
		var htmlele='<div class="form-group" id="row'+rowid+'"><div class="row"><div class="col-md-1"></div><div class="col-md-2"></div><div class="col-md-5"><input type="text" name="paymentplan'+rowid+'" id="paymentplan'+rowid+'" class="form-control " ></div><div class="col-md-2"><input type="text" name="cost'+rowid+'" id="cost'+rowid+'" class="form-control " ></div><div class="col-md-1"><img style="cursor:pointer" src="images/delete.png" onclick="removeElement('+rowid+')"></div></div></div>';
	
		
	$( "#addmore" ).before( htmlele );	
	}
	
	function removeElement(rowid){
	
		$("#row"+rowid).remove();
	}
	
	
	  function clearServiceTax(){
    	document.getElementById('taxinclusion').selectedIndex=0;
		document.getElementById('showcost').innerHTML=" - - -"
    }
	
	function calculateTax(val){
	
			cost = parseInt(document.getElementById('ecost').value);	
			tax =  parseFloat(document.getElementById('servicetax').value);	
			
			if(val==1){
				totalAmt=(cost*100)/(tax+100);
				
			}else if(val==2){
				totalAmt=(cost+ (cost*tax)/100);
			}else{
				totalAmt=cost;
			}
		
		document.getElementById('showcost').innerHTML=Math.ceil(totalAmt)
		
	}
	
</script>

    
</body>
</html>