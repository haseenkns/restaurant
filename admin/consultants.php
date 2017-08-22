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
	$selQry=mysql_fetch_row(mysql_query("select `imagepath` from `members` where `id`='$did' "));
	$oldImg=$selQry[0];
	
	$delQry=mysql_query("delete from `members` where `id`='$did'");

		if($delQry){
			unlink("../photos/$oldImg");
			header("location:consultants.php?msg=dls");
		}else{
			header("location:consultants.php?msg=dlf");
		}
}

if(isset($_POST['submit'])){
		extract($_POST);
		$flag=1;
		

		$fname=mysql_real_escape_string($_POST['fname']);
		$mname=mysql_real_escape_string($_POST['mname']);
		$lname=mysql_real_escape_string($_POST['lname']);
		$email=mysql_real_escape_string($_POST['email']);
		$pcontact=mysql_real_escape_string($_POST['pcontact']);
		$scontact=mysql_real_escape_string($_POST['scontact']);
		$address1=mysql_real_escape_string($_POST['address1']);
		$pincode=mysql_real_escape_string($_POST['pincode']);
		$city=mysql_real_escape_string($_POST['city']);
		$description=mysql_real_escape_string($_POST['description']);
		$username=mysql_real_escape_string($_POST['username']);
		$password=md5(mysql_real_escape_string($_POST['password']));
		$experience=mysql_real_escape_string($_POST['experience']);
		$subservice=$_POST['subservice'];
	
		$chkUsrQry = mysql_fetch_row(mysql_query("select count(*) from `members` where  `username`='$username' "));
			if($chkUsrQry[0]>0){
			header("location:consultants.php?msg=ule");					  
			}else{
		$nwsimg=$_FILES['image']['name'];
		if(!$nwsimg==''){
			$newsimagename=basename($_FILES['image']['name']);
			$newsimagenamesrc=$_FILES['image']['tmp_name'];
			$postednewsdate=base64_encode(date('Y-m-d h:i:s'));
			$imgName=$postednewsdate."_".$newsimagename;
			$moveimg=move_uploaded_file($newsimagenamesrc,'../photos/'.$imgName);
			if(!$moveimg){
				$flag=0;	
			}
		}else{
	     	$imgName="nophoto.jpg";	
		}
		
		$pdate=date("d/m/Y");
		$ptime=date("h:m a");
		mysql_query("BEGIN");
		
		if($flag==1){
		$excQry=mysql_query("INSERT INTO `members` (`id`, `title`, `fname`, `mname`, `lname`, `gender`, `email`, `pcontact`, `address1`, `state`, `city`, `cityother`, `pincode`, `source`, `imagepath`, `status`, `username`, `password`, `pdate`, `ptime`,`profession`,`description`,`tools`,`experience`,`special`) VALUES (NULL, '$title', '$fname', '$mname', '$lname', '$gender', '$email', '$pcontact', '$address1', '$state', '$hidCity', '$city', '$pincode', '$source', '$imgName', '1', '$username', '$password', '$pdate', '$ptime','$profession','$description','$tools','$experience','$special');");
}
	if($flag==1 ){
		
		$insId=mysql_insert_id();
		if( (count($subservice)>0) ){
			foreach($subservice as $sid){
				$insQry=mysql_query("INSERT INTO `consultantsubservices` (`id`, `c_id`, `s_id`, `status`) VALUES (NULL, '$insId', '$sid', '1');");
				if(!$insQry){
					$flag=0;	
				}
			}
		
			
		}
		
		mysql_query("COMMIT");
		
		header("location:consultants.php?msg=ins");					  
	}else{
		mysql_query("REVOKE");
		header("location:consultants.php?msg=inf");	
	}
	
	}
}

if(isset($_POST['update'])){
	extract($_POST);
	$id=$_POST['hidId'];
	$flag=1;
	//echo "select * from `consultants` where `id`='$id' ";
	$detailArr=mysql_fetch_row(mysql_query("select * from `members` where `id`='$id' "));
	
	
		$fname=mysql_real_escape_string($_POST['fname']);
		$mname=mysql_real_escape_string($_POST['mname']);
		$lname=mysql_real_escape_string($_POST['lname']);
		$email=mysql_real_escape_string($_POST['email']);
		$pcontact=mysql_real_escape_string($_POST['pcontact']);
		$scontact=mysql_real_escape_string($_POST['scontact']);
		$address1=mysql_real_escape_string($_POST['address1']);
		$pincode=mysql_real_escape_string($_POST['pincode']);
		$city=mysql_real_escape_string($_POST['city']);
		$description=mysql_real_escape_string($_POST['description']);
		
		$tools=mysql_real_escape_string($_POST['tools']);
		$experience=mysql_real_escape_string($_POST['experience']);
		$special=mysql_real_escape_string($_POST['special']);
	    	
		$nwsimg=$_FILES['image']['name'];
		if($nwsimg!=''){
			$newsimagename=basename($_FILES['image']['name']);
			$newsimagenamesrc=$_FILES['image']['tmp_name'];
			$postednewsdate=base64_encode(date('Y-m-d h:i:s'));
			$imgName=$postednewsdate."_".$newsimagename;
			$moveimg=move_uploaded_file($newsimagenamesrc,'../photos/'.$imgName);
			if(!$moveimg){
				$flag=0;	
			}
		}else{
			$imgName=$detailArr[14];
		}
	

	
		mysql_query("BEGIN");
		if($flag==1){
			
			
		   $sqlQry="UPDATE `members` SET `title` = '$title', `fname` = '$fname', `mname` = '$mname', `lname` = '$lname', `gender` = '$gender', `email` = '$email', `pcontact` = '$pcontact', `address1` = '$address1', `state` = '$state', `city` = '$hidCity', `cityother` = '$city', `pincode` = '$pincode', `source` = '$source', `imagepath` = '$imgName', `profession` = '$profession', `description` = '$description' ,`tools`='$tools',`experience`='$experience',`special`='$special' WHERE `members`.`id` = '$id';";
		 
	//	 die;
		 $excQry=mysql_query($sqlQry);
		 if($excQry){
			$flag=1; 
		 }else{
			 $flag=0;
		 }
		 
		 
		if($flag==1 ){
		mysql_query("COMMIT");
		header("location:consultants.php?msg=ups");					  
	}else{
		mysql_query("REVOKE");
		header("location:consultants.php?msg=upf");	
	}
  }

}



if(isset($_GET['eid'])&&$_GET['eid']!=''){
	$eid=base64_decode($_GET['eid']);
	$edtQry=mysql_query("Select * from `members` where `id`='$eid'");
	$userData=mysql_fetch_row($edtQry);	
	$subservice=getTechnicianSubServices($eid);
	//print_r($subservice);
	$sval=$userData[20];
}
	
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo getSiteTitle(); ?></title>
    <script type="text/javascript" src="../assets/js/libs/jquery-1.10.2.min.js"></script>
  
    <script src="../javascript/javascript.js" language="javascript" type="text/javascript"> </script>
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

		
		
function ValidateMember()
	{
		
	var eptrn=/^[a-z0-9]+[a-z0-9\._]*@[a-z0-9\.]+\.[a-z]{2,3}$/;    ///////////mail pattern///////
	var uptrn=/^[!@#&-_a-zA-Z0-9]{6,36}$/;
	var uname=/^[!@#&-_a-zA-Z0-9]+$/;
	var letters = /^[.A-Za-z ]+$/;  
	var numbers = /^[0-9]+$/;
	
	


	if(document.getElementById('fname').value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Please enter first name','fname')
		return false;
		}
	
		
	
	if(document.getElementById('profession').value=="0")
		{
		errorMsg('Please selecta profession','profession')
		return false;
		}
	
	
		
	if(document.getElementById('username').value=="")
		{
		errorMsg("Username should not blank",'username');
		document.getElementById('username').focus();
		return false;
		}
		
		
	if(document.getElementById('username').value!="")
		{
		  
		  if(!document.getElementById('username').value.match(uname)){
				errorMsg("Username - Please enter Alphabets a - z ,numbers 0-9 ,(! @ # & - _ ) symbols only",'username');
				return false;
			}
		}
		
	
	if(document.getElementById('password').value=="")
		{
		errorMsg("Password should not be blank",'password');
		
		return false;
		}
		
	if(document.getElementById('password').value!="")
		{
		  if(document.getElementById('password').value.length < 6 || document.getElementById('password').value.length > 36)
		   {
				errorMsg("Password should be atleast 6 characters and maximum 20 characters long !","password");
				
				return false;
		   }
	}	
	if(document.getElementById('cpassword').value=="")
		{
		errorMsg("Confirm password cannot be left blank","cpassword");
		
		return false;
		}
	if(document.getElementById('cpassword').value!=document.getElementById('password').value)
		{
		errorMsg("Password and Confirm Password should match !","cpassword");
		
		return false;
		}
	
	

}
  function setFocus(val){
		document.getElementById(val).focus();	
		//alert('dasd')
	}
</script>
    
    <style>
	#display{
	border:dotted 1px #F0F0F0;
	position:absolute;
	min-width:237px;
	z-index:9999;
	
	}
	#display ul
{
	list-style: none;
	margin: 0px;
	padding:0px;
	width: auto;
	max-height:150px;
	overflow:auto;
	z-index:9999;
}
#display li
{
display: block;
padding: 3px;
background-color: #4C9ED9;
z-index:9999;
color:#FFF;
}
	</style>
    <script type="text/javascript">
function fill(Value,id) 
{	
//alert(id)	
$('#city').val(Value); 
$('#hidCity').val(id);
$('#display').hide();
}

$(document).ready(function(){ 
$("#city").keyup(function() {
$('#hidCity').val(0);
        var state = $('#state').val();
		 var cname = $('#city').val();
		
		if(state=="" || state=="0")
		{
			alert("Please select a state ")
			$("#display").html("");
			$('#city').val(""); 
		}
		else
		{
		$.ajax({  
                type: "POST",  
                url: "cities.php",  
                data: "sid="+ state+"&cname="+cname ,  
                success: function(html){  
                    $("#display").html(html).show();
                }  
            });
		}
});
});
</script>
	</head>

<body class="theme-dark">

	<!-- Header -->
	<?php include_once("header.php"); ?> <!-- /.header -->
   

	<div id="container" >
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
						<h3>Technicians</h3>
						<!--<span>Good morning, John!</span>-->
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->
<form action="" method="post" enctype="multipart/form-data" onSubmit="return ValidateMember()">
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

		<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>Update Personal Detail</h4>
							</div>
							<div class="widget-content">
                                  
                                <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                <label class="control-label">Title </label>
													<select name="title" id="title" class="form-control " ><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `titles` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[1]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Title</option>
					<?php } ?>
                
                </select>
												</div>
												<div class="col-md-3">
                                                 <label class="control-label">First Name *</label>
													<input type="text" name="fname" id="fname" autocomplete="off" class="form-control" value="<?php echo htmlentities(stripslashes($userData[2])); ?>" 	>
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Middle Name</label>
													<input type="text" name="mname" id="mname" autocomplete="off" class="form-control" value="<?php echo htmlentities(stripslashes($userData[3])); ?>">
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Last Name</label>
													<input type="text" name="lname" id="lname" autocomplete="off" class="form-control" value="<?php echo htmlentities(stripslashes($userData[4])); ?>">
												</div>
											</div>
										
									</div>
                                     
                                     <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                               
												</div>
                                                <div class="col-md-3">
                                                
                                                 <label class="control-label">Gender</label>
                                                 <select name="gender" id="gender" class="form-control " ><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `genders` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[5]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Gender</option>
					<?php } ?>
                
                </select>
                                                
                        </div>                        
												<div class="col-md-3">
                                                <label class="control-label">Email*</label>
                                                <input type="text" name="email" id="email" class="form-control" value="<?php echo htmlentities(stripslashes($userData[6])); ?>">
												</div>
												<div class="col-md-3">
                                                <label class="control-label"> Contact No</label>
													<input type="text" name="pcontact" id="pcontact" class="form-control" value="<?php echo htmlentities(stripslashes($userData[7])); ?>">
												</div>
											
											</div>
										
									</div>
                                     
                              		  
                                      <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-4">
                                                	<label class="control-label">Profession*</label>
										<select name="profession" id="profession" class="form-control "  >
                                        <option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `services` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[20]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['title']) ?></option>
					<?php }	}else{?>
					<option value="0">No Services</option>

					<?php } ?>
                
                </select>
												</div>
												
												<div class="col-md-5">
                                                	<label class="control-label">Sub Services*</label>
														<select  multiple="multiple" name="subservice[]" id="subservice[]" placeholder="Select SubServices" class="form-control SlectBox">
             <?php
					$execQry=mysql_query("select * from `subservices` where `status` = '1' and `s_id`='$sval' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if(in_array($fetch['id'],$subservice)){ ?> selected <?php } ?> ><?php echo stripslashes($fetch['title']) ?></option>
					<?php }	}else{?>
					<option value="0">No Subservices</option>

					<?php } ?>
  
   </select>
												</div>
												
											</div>
										
									</div>
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-9">
                                                	<label class="control-label">About Self</label>
														<textarea type="text" name="description" id="description" class="form-control"  style="height:150px;"><?php echo stripslashes($userData[21]) ?></textarea>
												</div>
												
												
											</div>
										
									</div>
                                    
                                    
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-9">
                                                	<label class="control-label">Experience</label>
														<textarea type="text" name="experience" id="experience" class="form-control"  style="height:80px;"><?php echo stripslashes($userData[24]) ?></textarea>
												</div>
												
												
											</div>
										
									</div>
                                    
                                    
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-12" style="text-align:right;font-weight:bold;">
                                              <hr/>
                                            Add Address
                                           
                                            </div>
                                           
                                                
											</div>
												
												
										
									</div>
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-9">
                                                	<label class="control-label">Address</label>
														<input type="text" name="address1" id="address1" class="form-control" value="<?php echo htmlentities(stripslashes($userData[8])) ?>" >
												</div>
												
												
											</div>
										
									</div>
                                    
                                      
                                      <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-3">
                                                	<label class="control-label">State</label>
													<select name="state" id="state" class="form-control "  onChange="clearPrevCity()"><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `state` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[9]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No State</option>

					<?php } ?>
                
                </select>
             
												</div>
												<div class="col-md-3"><input type="hidden" name="hidCity" id="hidCity" value="<?php echo $userDate[10] ?>">
                                                <label class="control-label">City</label>
													<input type="text" name="city" id="city" class="form-control" autocomplete="off" value="<?php echo htmlentities(stripslashes($userData[11])); ?>">
                                                     <div id="display"></div>
                                                      <span class="help-block">Type Few Char</span>
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Pin Code</label>
													<input type="text" name="pincode" id="pincode" class="form-control" value="<?php echo htmlentities(stripslashes($userData[12])); ?>">
												</div>
											</div>
										
									</div>
                                <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												
												<div class="col-md-7">
                                                <label class="control-label">Profile Picture</label>
													<input type="file" name="image" id="image" data-style="fileinput">
												</div>
                                                
                                                <div class="col-md-3">
                                               <img src="../photos/<?php echo $userData[14]; ?>" style="border-radius:20px;width:100px;height:100px" >
												</div>
												
											</div>
										
									</div>
                                <div class="form-group">
										
										
											<div class="row" style="padding-top:30px;">
										
										<div class="col-md-12">
                                        
                                            <div class="col-md-2">	</div>
                                            <div class="col-md-3" align="left">
                                           <input type="hidden" name="hidId" value="<?php echo $eid; ?>">
                                           <input type="submit" name="update" class="btn btn-primary btn-block" value=" Update Consultant"> 
                                           
 
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
                
                
                
                
                
            
     <?php }else{ ?>
     
     
   				
                
                <div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>Personal Detail</h4>
							</div>
							<div class="widget-content">
                                  
                                <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                <label class="control-label">Title </label>
													<select name="title" id="title" class="form-control " ><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `titles` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[1]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Title</option>
					<?php } ?>
                
                </select>
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
                                            <div class="col-md-2">
                                               
												</div>
                                                <div class="col-md-3">
                                                
                                                 <label class="control-label">Gender</label>
                                                 <select name="gender" id="gender" class="form-control " ><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `genders` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" ><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Gender</option>
					<?php } ?>
                
                </select>
                                                
                        </div>                        
												<div class="col-md-3">
                                                <label class="control-label">Email</label>
                                                <input type="text" name="email" id="email" class="form-control">
												</div>
												<div class="col-md-3">
                                                <label class="control-label"> Contact No</label>
													<input type="text" name="pcontact" id="pcontact" class="form-control">
												</div>
											
											</div>
										
									</div>
                                     
                              		  
                                      <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-4">
                                                	<label class="control-label">Services/Profession</label>*                                                	*
														<select name="profession"  id="profession" class="form-control " onChange="getSubServices(this.value)"  ><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `services` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[1]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['title']) ?></option>
					<?php }	}else{?>
					<option value="0">No State</option>

					<?php } ?>
                
                </select>
												</div>
												<div class="col-md-5">
                                                	<label class="control-label">Sub Services</label>*                                               
													<div id="subservicediv"><select  multiple="multiple" name="subservice[]" id="subservice[]" placeholder="Select Sub Services" class="form-control SlectBox">
            <option value="0">Select Sub Services</option>
  
   </select></div>
												</div>
												
											</div>
										
									</div>
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-9">
                                                	<label class="control-label">About Self</label>
														<textarea type="text" name="description" id="description" class="form-control"  style="height:150px;"></textarea>
												</div>
												
												
											</div>
										
									</div>
                                    
                                    
                                    
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-9">
                                                	<label class="control-label">Experience</label>
														<textarea type="text" name="experience" id="experience" class="form-control"  style="height:80px;"></textarea>
												</div>
												
												
											</div>
										
									</div>
                                    
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-12" style="text-align:right;font-weight:bold;">
                                              <hr/>
                                            Add Address
                                           
                                            </div>
                                           
                                                
											</div>
												
												
										
									</div>
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-9">
                                                	<label class="control-label">Address</label>
														<input type="text" name="address1" id="address1" class="form-control" value="<?php echo htmlentities(stripslashes($userData[37])) ?>" >
												</div>
												
												
											</div>
										
									</div>
                                    
                                      
                                      <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-3">
                                                	<label class="control-label">State</label>
													<select name="state" id="state" class="form-control "  onChange="clearPrevCity()"><option value="0">Select</option>
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
												<div class="col-md-3"><input type="hidden" name="hidCity" id="hidCity" value="">
                                                <label class="control-label">City</label>
													<input type="text" name="city" id="city" class="form-control" autocomplete="off">
                                                     <div id="display"></div>
                                                      <span class="help-block">Type Few Char</span>
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Pin Code</label>
													<input type="text" name="pincode" id="pincode" class="form-control">
												</div>
											</div>
										
									</div>
                                <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												
												<div class="col-md-7">
                                                <label class="control-label">Profile Picture</label>
													<input type="file" name="image" id="image" data-style="fileinput">
												</div>
												
											</div>
										
									</div>
                                <div class="form-group">
										
										
											<div class="row">
                                            
                                            <div class="col-md-12" style="text-align:right;font-weight:bold;">
                                             <hr/>
                                            Add Login Credentials
                                            </div>
                                           
                                                
											</div>
												
												
										
									</div>  
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-4">
                                                	<label class="control-label">Add Username*</label>
														<input type="text" name="username" id="username" class="form-control" >
												</div>
												<div class="col-md-6" style="padding-top:30px;">
                                               Click <a href="javascript:void(0)" onClick="checkAvailability(document.getElementById('username').value)">here</a>  to check Availability  &nbsp;&nbsp; <span id="userMsg"></span>  
												</div>
												
											</div>
										
									</div>
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-4">
                                                	<label class="control-label">Password</label>
                                                	*
														<input type="password" name="password" id="password" class="form-control" >
												</div>
												<div class="col-md-6" style="padding-top:30px;">
                                                <label class="control-label"></label>
													Password should be minimum 6 and maximum 20 char
												</div>
												
											</div>
										
									</div>
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-4">
                                                	<label class="control-label">Confirm Password</label>
                                                	*
														<input type="password" name="cpassword" id="cpassword" class="form-control" >
												</div>
												<div class="col-md-6" style="padding-top:30px;">
                                                <label class="control-label">&nbsp;</label>
													Password should be minimum 6 and maximum 20 char
												</div>
												
											</div>
										
                                        
                                        <div class="row" style="padding-top:30px;">
										
										<div class="col-md-12">
                                        
                                            <div class="col-md-2">	</div>
                                            <div class="col-md-3" align="left">
                                           <input type="submit" name="submit" class="btn btn-primary btn-block" value=" Add Consultant"> 
                                           
 
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
                

     
     
     <?php } ?>       
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
                          
<!--  <script type="text/javascript" src="../javascript/jquery-1.3.2.min.js"></script>
-->   
  <script>
		var $j = jQuery.noConflict();
</script>

  <script type="text/javascript" src="../javascript/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript">
$j(document).ready(function(){ 
						   
	$j(function() {
		$("tbody").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings&type=members'; 
			$.post("updateposition.php", order, function(theResponse){
				
			}); 															 
		}								  
		});
	});

});	
</script>  
  <script src="../javascript/jquery.sumoselect.js"></script>
       <link href="../css/sumoselect.css" rel="stylesheet" />
		<script type="text/javascript">
         jQuery(document).ready(function () {
            window.asd = jQuery('.SlectBox').SumoSelect({ csvDispCount: 3 });
        
        });
  </script>
  
  <script>
  function convert(){
            window.asd = jQuery('.SlectBox').SumoSelect({ csvDispCount: 3 });
        
  };
  </script>    
            
        <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Members</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<table  class="table table-striped table-bordered table-hover   datatable">
									<thead>
										
                                        
                                         <tr >
                                                <th >Sno</th>
                                                <th  data-hide="phone,tablet">Preview</th>
                                                <th>Name</th>
                                                <th  data-hide="phone">Email</th>
                                                <th  data-hide="phone">Profession</th>
                                                <th  data-hide="phone,tablet">State</th>
                                                <th  data-hide="phone,tablet">City</th>
                                                <th data-hide="phone,tablet">Change Password</th>
                                             
                                                <th style="text-align:center"  data-hide="phone,tablet">Action</th>
  										</tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
  	$sqlQry=mysql_query("select * from `members` where `status`='1' order by `position` Asc, `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
		
		$name=getTabledataById("name","titles",$fetch['title'])." ".$fetch['fname']." ".$fetch['mname']." ".$fetch['lname'];
		
	
  ?>
  <tr bgcolor="#FFFFFF" id="recordsArray_<?php echo $fetch['id']; ?>" onMouseOver="this.style.cursor='move'">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
       <td align="center"  ><a href="viewmember.php?aid=<?php echo base64_encode( $fetch['id']); ?>"  > <button type="button" class="btn"><i class="icon-desktop"></i></button></a></td>
    <td align="left" class="smallfonttext"><?php echo $name; ?></td>
    <td align="left" class="smallfonttext"><?php echo stripslashes($fetch['email']); ?></td>
    <td align="left" class="smallfonttext"><?php echo getTabledataById("title","services",$fetch['profession']); ?></td>
	
    <td align="center"  ><?php echo getTabledataById("name","state",$fetch['state']); ?></td>
    <td align="center"  ><?php echo stripslashes($fetch['cityother']); ?></td>
    <td align="left" class="smallfonttext" style="text-align:center;"><a href="changepassword.php?id=<?php echo base64_encode( $fetch['id']); ?>"><img src="../images/privacy.jpg"></a></td>
  
    <td align="center" bgcolor="#F9F9F9"><table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr>
		<td align="right" ><a href="consultants.php?did=<?php echo base64_encode($fetch['id']) ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn" type="button"><i class="icon-trash"></i></button></a></td>
		<td align="center" ><a href="consultants.php?eid=<?php echo base64_encode($fetch['id']) ?>"><button class="btn" type="button"><i class="icon-edit"></i></button>	</a></td>
        
        
		<td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','members',15)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
        
        <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
	</tr>
	</table></td>
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>    
            
            
			<!-- /.container -->
</form>
		</div>
	</div>
   
    
<script>
function checkCourses(course,stream,country){
	/*if(country==0){
		errorText('Please select a country  !!')
		return false;
	}
	*/
	if( (course=='0')  && (stream=='0' ) ){
		errorText('Please select a course atleast !!')
		return false	
	}else{
      window.location.href='all-courses.php?cid='+course+'&sid='+stream+'&cty='+country		
	}
	
	
	
}



function getCitySelected(){
	
	 var select1 = document.getElementById("cities");
    var selected1 = [];
    for (var i = 0; i < select1.length; i++) {
        if (select1.options[i].selected) selected1.push(select1.options[i].value);
    }
    return selected1;
}



</script>

</body>
</html>