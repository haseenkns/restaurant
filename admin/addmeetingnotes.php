<?php
	ob_start();
	session_start();
	$adminId=$_SESSION['aid'];
	include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
	checkIntrusion($adminId);
	$currentDate=date("d")."/".date("m")."/".date("Y");

if(isset($_GET['aid'])&&$_GET['aid']!=''){	
	$aid=base64_decode($_GET['aid']);
	$leadArr=getAssignedLeadDetailsById($aid);
	$lid=$leadArr[1];
	$leadText=getLeadId($lid);
}

	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Followup has been  added Successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='Followup not added Successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='Followup data updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='Followup data not updated Successfully !!';
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
	$delQry=mysql_query("delete from `members` where `id`='$did'");
		if($delQry){
			$delqry=mysql_query("delete from `paymentstats` where `mode`='$did'");
			$delqry=mysql_query("delete from `referencemembers` where `mem_id`='$did'");
			header("location:addleads.php?msg=dls");
		}else{
			header("location:addleads.php?msg=dlf");
		}
}


if(isset($_POST['submit'])){
		extract($_POST);
		$flag=1;
		$conversation=mysql_real_escape_string($_POST['conversation']);
		$meetingdate=changeDate($_POST['meetingdate']);
		$meetingtime=mysql_real_escape_string($_POST['meetingtime']);
		$dateofsale=changeDate($_POST['dateofsale']);

		$pdate=date("d/m/Y");
		$ptime=date("h:m a");
		mysql_query("BEGIN");
       
		
		$upQry=mysql_query("Update `leads` set `leadtype`='$leadtype' where `id`='$hidLid'");
		if($upQry){
			$flag=1;	
		}else{
			$flag=0;		
		}
		

	
if( $leadtype==3){

	$meetingdate=$dateofsale;
	$meetingtime=date("h:m a");
	
	}


if( $leadtype==4){

	$meetingdate=getLatestMeetingDatesByLid($hidLid);
	$meetingtime=date("h:m a");
	
	}

	
$excQry=mysql_query("INSERT INTO `meetings` (`id`, `lid`, `conversation`, `meetingdate`, `meetingtime`, `pdate`, `ptime`, `status`,`display`) VALUES (NULL,'$hidLid','$conversation',  '$meetingdate', '$meetingtime' ,'$pdate','$ptime','1','$display');");

if($excQry){
	$flag=1;	
	}else{
		$flag=0;	
	}


if($leadtype==3){
	$upsQry=mysql_query("Update `leads` set `ecost`='$ecost' ,`servicetax`='$servicetax' ,`taxinclusion`='$taxinclusion' ,`dateofsale`='$dateofsale' where `id`='$hidLid'");
	$orderqty=$_POST['orderqty'];
		for($i=1;$i<=$orderqty;$i++){
			 if(isset($_POST['paymentplan'.$i]) && $_POST['paymentplan'.$i]!='' ){
				 $description=mysql_real_escape_string(trim($_POST['paymentplan'.$i]));
				 $cost=mysql_real_escape_string(trim($_POST['cost'.$i]));
				 
				// echo "Update `leads` set `ecost`='$ecost' ,`servicetax`='$servicetax' ,`taxinclusion`='$taxinclusion' where `id`='$hidLid'";
			
				//echo "INSERT INTO `paymentplans` (`id`, `lid`, `a_id`, `description`, `cost`) VALUES (NULL, '$hidLid', '$adminId', '$description', '$cost')";
				$inssQry=mysql_query("INSERT INTO `paymentplans` (`id`, `lid`, `a_id`, `description`, `cost`) VALUES (NULL, '$hidLid', '$adminId', '$description', '$cost')");
	//die;
				 if(!$inssQry){
					//$flag=0; 
				 }
				 
			 }
			
		}

}


	
	if($flag==1 ){
		mysql_query("COMMIT");
		header("location:viewmeetings.php?msg=ins&id=".base64_encode($hidLid)."");					  
	}else{
		mysql_query("REVOKE");
		header("location:viewmeetings.php?msg=inf&id=".base64_encode($hidLid)."");	
	}
	
	
}

if(isset($_POST['update'])){
	extract($_POST);
	$id=$_POST['hidId'];
	$flag=1;
	$detailArr=mysql_fetch_row(mysql_query("select * from `members` where `id`='$id' "));
	$imgName=$detailArr[20];
	
		$fname=mysql_real_escape_string($_POST['fname']);
		$mname=mysql_real_escape_string($_POST['mname']);
		$lname=mysql_real_escape_string($_POST['lname']);
		
		$email=mysql_real_escape_string($_POST['email']);
		$pcontact=mysql_real_escape_string($_POST['pcontact']);
		$scontact=mysql_real_escape_string($_POST['scontact']);
		
		$address1=mysql_real_escape_string($_POST['address1']);
		$address2=mysql_real_escape_string($_POST['address2']);
		$pincode=mysql_real_escape_string($_POST['pincode']);
		$city=mysql_real_escape_string($_POST['city']);
		$amount=mysql_real_escape_string($_POST['amount']);
		
		
		$dateofsale=mysql_real_escape_string($_POST['dateofsale']);
		$phoneres=mysql_real_escape_string($_POST['phoneres']);
		$phoneoff=mysql_real_escape_string($_POST['phoneoff']);
		$spname=mysql_real_escape_string($_POST['spname']);
		$spmobile=mysql_real_escape_string($_POST['spmobile']);
		$spemail=mysql_real_escape_string($_POST['spemail']);
		$source=mysql_real_escape_string($_POST['source']);
		$remark=mysql_real_escape_string($_POST['remark']);
		
		$nameoncard=mysql_real_escape_string($_POST['nameoncard']);
		$designation=mysql_real_escape_string($_POST['designation']);
		$compname=mysql_real_escape_string($_POST['compname']);
		
		$voucherno=mysql_real_escape_string($_POST['voucherno']);
		
		
	    	
		$nwsimg=$_FILES['image']['name'];
		if(!$nwsimg==''){
			$newsimagename=basename($_FILES['image']['name']);
			$newsimagenamesrc=$_FILES['image']['tmp_name'];
			$postednewsdate=base64_encode(date('Y-m-d h:i:s'));
			$imgName=$postednewsdate."_".$newsimagename;
			$moveimg=move_uploaded_file($newsimagenamesrc,'photos/'.$imgName);
			if(!$moveimg){
				$flag=0;	
			}
		}
	
	if($complimentry==1){
			
			$modeofpayment=0;
			$pickup=0;
			$employee=0;
			$creditedon='';
		}else{
			$complimentry=0;	
		}
	
	
		mysql_query("BEGIN");
		if($flag==1){
			
			
		 $sqlQry="UPDATE `members` SET `prog_id` = '$program', `title` = '$title', `fname` = '$fname', `mname` = '$mname', `lname` = '$lname', `gender` = '$gender', `email` = '$email', `pcontact` = '$pcontact', `scontact` = '$scontact', `dob` = '$dob', `marital` = '$marital', `doa` = '$doa', `address1` = '$address1', `address2` = '$address2', `state` = '$state', `city` = '$hidCity', `cityother` = '$city', `pincode` = '$pincode', `source` = '$source', `imagepath` = '$imgName', `amount` = '$amount', `modeofpayment` = '$modeofpayment', `pickup` = '$pickup', `employee` = '$employee', `tenure` = '$tenure'
,`mlevel`='$hidMlevel',`dateofsale`='$dateofsale',`a_id`='$consultants',`phoneres`='$phoneres',`phoneoff`='$phoneoff',`spname`='$spname',`spemail`='$spname',`spmobile`='$spmobile',`spdob`='$spdob',`remark`='$remark',`nameoncard`='$nameoncard',`designation`='$designation',`compname`='$compname',`spousecard`='$spcard',`voucherno`='$voucherno' ,`addresstype`='$addresstype' ,`creditedon`='$creditedon' ,`complimentry`='$complimentry' ,`approvedby`='$approvedby' ,`processedby`='$processedby' ,`referredby`='$hidRmemId'  WHERE `members`.`id` = '$id';";
		 
		 
		 
		 
		 
		 
		//die;
	$execQry=mysql_query($sqlQry);
	if(!$execQry){
	$flag=0;	
	}else{
		$delQry=mysql_query("delete from `paymentstats` where  `mode`='$id' ");
	if(!$delQry){
		$flag=0;	
	}else{
	if(!$complimentry==1){
	$execQry=mysql_query("select * from `paymentfields` where `status` = '1' and `u_id`='$modeofpayment' order by `id`  ");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
			while($fetch=mysql_fetch_array($execQry)){
				$statid=$fetch['id'];
				 $optVal=$statid."options";
				 $svalues= $_POST[$optVal];
			
				$insqry=mysql_query("Insert into `paymentstats` set `mode`='$id' ,`stats`='$statid',`svalues`='$svalues' ");
				if(!$insqry){$flag=0;}
			}
		}
		
	}
	
	}
	
	if($flag==1 ){
		mysql_query("COMMIT");
		header("location:modifymembers.php?msg=ups");					  
	}else{
		mysql_query("REVOKE");
		header("location:modifymembers.php?msg=upf");	
	}
}
}

}



if(isset($_GET['eid'])&&$_GET['eid']!=''){
	$eid=base64_decode($_GET['eid']);
	$edtQry=mysql_query("Select * from `members` where `id`='$eid'");
	$userData=mysql_fetch_row($edtQry);	
	$progId=$userData[1];
	$mlevel=$userData[28];
	$membershipNumber=getMemberShipNumber($progId,$eid);
	
	$refmemId=$userData[50];
	$referredBy=getRefferredByMem($refmemId);
	//$paymentStats=mysql_fetch_row(mysql_query("Select * from `paymentstats` where `mode`='$eid'"));
	//print_r($userData);
	//die;
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
    
 <script> 
 
 
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
    function ValidateLead()
	{
		
	
	
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
		
		
		   if(document.getElementById('dateofsale').value=="")
			{
			//alert('Enter valid Email-address');
			errorMsg('Please enter date of sale','dateofsale')
			return false;
			}
			
		
		
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
			
		}
	
	//return false

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
						<h3>Leads Management - <?php echo $leadText; ?></h3>
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
    if(isset($_GET['eid'])&&$_GET['eid']!=''){
		
		
		?>

			
     <?php }else{ ?>
     
     
   				
                
                <div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>Add Meeting Notes</h4>
							</div>
							
                                    
                                    
                            <div class="widget-content">        
                              
                                    
                                    
                                  <div class="form-group">
										
                                        <div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												<div class="col-md-9">
                                                	<label class="control-label">Conversation</label>
														<textarea  name="conversation" id="conversation" class="form-control wysiwyg" style="height:80px;" ></textarea>
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
									$execQry=mysql_query("select * from `leadtypes` where `status` = '1' and `id`!='1' order by `id` ");
									$numRows=mysql_num_rows($execQry);
									if($numRows>0){
									while($fetch=mysql_fetch_array($execQry)){?>
									<div class="col-md-2" ><div class="imagenew">
									<span ><i class="icon-<?php echo $fetch['class'] ?>"></i></span><br/>
									<span class="title"><label><?php echo $fetch['name'] ?></label></span><br/>
									<span class="title"><input type="radio" <?php if(2==$fetch['id']) {?> checked <?php }?> onClick="showDateTimeDiv(this.value)"  name="leadtype" value="<?php echo $fetch['id'] ?>"></span>
									
									</div>
									</div>
									<?php }
									}
									?>
                                           
                                            
                                        
                                     
                                        </div>
                                        
                                        </div>
                                     </div>
                                    
                                    
                                    
                                    <div class="form-group" style="display:block;" id="meetingdatetimediv">
										
										
											<div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												
												<div class="col-md-5">
                                                
                                                   
                                                    <label class="control-label">Next (Followup / Meeting) Date</label>
													<input type="text" name="meetingdate" id="meetingdate" class="form-control datepicker" >
												 <span class="help-block">dd/mm/YYYY</span>
                                                
                                                </div>
												<div class="col-md-4">
                                                
                                               
                                                <label class="control-label">Next (Followup / Meeting)  Time</label>
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
                                                
                                                   
                                                    <label class="control-label">Service Tax </label>
													
												
                                                
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
                                                
                                                   
                                                    <label class="control-label">Service Tax Inclusion </label>
													
												
                                                
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
                                    
                                     <!--<div class="form-group">
										<div class="row">
                                            <div class="col-md-1">
                                                
											</div>
												<div class="col-md-9">
                                                	<label class="control-label">Remarks (If any)</label>
														<input type="text" name="remark" id="remark" class="form-control" >
												</div>
												
												
											</div>
                                    
                                            
                                    
									</div>-->  
                                    
                                    
                                    <div class="form-group">
                                    
											
                                            
                                            <div class="row" style="padding-top:30px;">
										
										<div class="col-md-11">
                                    
                                        
                                            <div class="col-md-1">	</div>
                                            <div class="col-md-3" align="left">
                                           <input type="submit" name="submit" class="btn btn-primary btn-block" value=" Submit Status ">
                                           <input type="hidden" name="hidLid" id="hidLid" value="<?php echo $lid; ?>"> 
                                            
 
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
                            </div>
                            
                            
                            
                            
                             <div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>View Past Conversation</h4>
							</div>
							
                                    
                                    
                            <div class="widget-content">        
                              
                                    
                                    
                                  <div class="form-group">
										
                                        <div class="row">
                                           
												<div class="col-md-12">
                                                	
                                                    <?php echo showPastConversation($lid); ?>
 
                                                    
                                                    
                                                    
                                                    
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
    </div>
</body>
</html>