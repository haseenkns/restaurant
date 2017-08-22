<?php
ob_start();
session_start();
$ppac_awardimagesId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($ppac_awardimagesId);

if(isset($_GET['did'])&&$_GET['did']!=''){
	$did=base64_decode($_GET['did']);
	$delQry=mysql_query("delete from `ppac_awardimages` where `id`='$did'");
		if($delQry){
			header("location:awardimages.php?msg=dls");
		}else{
			header("location:awardimages.php?msg=dlf");
		}
}

if(isset($_POST['submit'])){
	extract($_POST);
	$name=mysql_real_escape_string($_POST['fname']);
	
	$date=date("Y-m-d h:i A");
	
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
	
	$chkUsrQry = mysql_fetch_row(mysql_query("select count(*) from `ppac_awardimages` where  `name`='$name' "));
	if($chkUsrQry[0]>0){
		header("location:awardimages.php?msg=ule");					  
	}else{
		
	$excQry=mysql_query("INSERT INTO `ppac_awardimages` (`id`, `name`,`image`,`date`,`status`) VALUES (NULL,'$name','$imgName','$date','1');");
	
	
	if($excQry ){
		header("location:awardimages.php?msg=ins");					  
	}else{
		header("location:awardimages.php?msg=inf");	
	}
	
	}
}

if(isset($_POST['update'])){
	extract($_POST);
	$id=$_POST['hidid'];
	
	
	$fname=mysql_real_escape_string($_POST['fname']);
	$lname=mysql_real_escape_string($_POST['lname']);
	$email=mysql_real_escape_string($_POST['email']);
	$contact=mysql_real_escape_string($_POST['contact']);
	$dateofbirth=mysql_real_escape_string($_POST['dateofbirth']);
	$officialcontact=mysql_real_escape_string($_POST['officialcontact']);
	$dateofjoining=mysql_real_escape_string($_POST['dateofjoining']);
	$salary=mysql_real_escape_string($_POST['salary']);
	$target=mysql_real_escape_string($_POST['target']);
	$uname=mysql_real_escape_string($_POST['uname']);
	$pwd=mysql_real_escape_string($_POST['pwd']);
	
	
	$address=mysql_real_escape_string($_POST['address']);
	$empacountnumber=mysql_real_escape_string($_POST['empacountnumber']);
	$empbank=mysql_real_escape_string($_POST['empbank']);
	$emppancard=mysql_real_escape_string($_POST['emppancard']);
	$empifsc=mysql_real_escape_string($_POST['empifsc']);
	$hra=mysql_real_escape_string($_POST['hra']);
	$medical=mysql_real_escape_string($_POST['medical']);
	$conveyance=mysql_real_escape_string($_POST['conveyance']);
	
	
	if($_POST['norole']==''){
		$norole=0;	
	}else{
		$norole=1;	
	}
	
	$chkUsrQry = mysql_fetch_row(mysql_query("select count(*) from `ppac_awardimages` where  `username`='$uname' and `id`!='$id' "));
	if($chkUsrQry[0]>0){
		header("location:awardimages.php?msg=ule");
		
	}else{
	
	
	$sqlQry="UPDATE `ppac_awardimages` SET   `email` = '$email', `contact` = '$contact', `firstname` = '$fname', `lastname` = '$lname', `dateofbirth` = '$dateofbirth', `designation` = '$designation', `officialcontact` = '$officialcontact', `dateofjoining` = '$dateofjoining', `salary` = '$salary', `target` = '$target', `reportto` = '$hidEmp', `role_id` = '$role', `imagepath` = '$imagepath', `norole` = '$norole' ,`address`='$address',`empacountnumber`='$empacountnumber',`empbank`='$empbank',`emppancard`='$emppancard',`salarytype`='$hidsalarytype',`hra`='$hra',`medical`='$medical',`conveyance`='$conveyance',`taxable`='$hidtaxable' ,`empifsc`='$empifsc' WHERE `id` = '$id';";
	$execQry=mysql_query($sqlQry);
	if($execQry){
		header("location:awardimages.php?msg=ups");
	}else{
		header("location:awardimages.php?msg=upf");
	}
	
	}

}



if(isset($_GET['eid'])&&$_GET['eid']!=''){
	$eid=base64_decode($_GET['eid']);
	$edtQry=mysql_query("Select * from `ppac_awardimages` where `id`='$eid'");
	$userData=mysql_fetch_row($edtQry);	
	$reportToDesignation=getEmployeeDesignationbyReportToId($userData[16]);
	
}

	
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
		$msg='Data data updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='ppac_awardimagesistrator data not updated Successfully !!';
		$class='danger';
	break;
	
	case 'ule':
		$msg='This username already exists!!';
		$class='danger';
	break;
	case 'dls':
		$msg='Data data deleted successfully !!';
		$class='success';
	break;
	
	case 'dlf':
		$msg='Data data not deleted successfully !!!!';
		$class='danger';
	break;
	
		case 'ads':
		$msg='ppac_awardimagesistrator rights added successfully !!';
		$class='success';
	break;
	
	case 'adf':
		$msg='ppac_awardimagesistrator rights not added successfully !!!!';
		$class='danger';
	break;
	
	case 'default' :
		$msg='';
		break;
	
	}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo getSiteTitle(); ?></title>
    <script src="javascript/javascript.js" type="text/javascript"></script>

<style>
.validateText{
font-size:11px;
color:#999;
font-style:italic;	
}
</style>

	</head>

<body class="theme-dark">

	
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
			setFocus(id)
			//alert('dsa')
		});
			//return false;
		}
		
    </script>
    
    
    <script type="text/javascript" language="JavaScript">

		
		
	function validateUser()
	{
	var eptrn=/^[a-z0-9]+[a-z0-9\._]*@[a-z0-9\.]+\.[a-z]{2,3}$/;    ///////////mail pattern///////
	var uptrn=/^[!@#&-_a-zA-Z0-9]{6,36}$/;
	var uname=/^[!@#&-_a-zA-Z0-9]+$/;
	var letters = /^[.A-Za-z ]+$/;  
	
	
	if(document.user.fname.value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Enter First Name','fname')
		
		return false;
		}

	if(!document.user.fname.value.match(letters))
	{
		errorMsg('Only Alphabets , space and dot dign is allowed','fname');
		
		return false;
	}
	
	if(document.user.lname.value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Enter Last Name','lname')
		
		return false;
		}

	if(!document.user.lname.value.match(letters))
	{
		errorMsg('Only Alphabets , space and dot dign is allowed','lname');
		
		return false;
	}
	
	
	if(document.user.email.value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Enter valid Email-address','email')
		
		return false;
		}

	if(!document.user.email.value.match(eptrn))
	{
		errorMsg('Enter valid Email-address','email');
		
		return false;
	}
	
	
	if(document.user.designation.value=="0")
		{
		errorMsg("Designation cannot be left blank","designation");
		return false;
		}
	
	
	if(document.user.uname.value=="")
		{
		errorMsg("Username should not blank",'username');
		document.user.uname.focus();
		return false;
		}
	if(document.user.uname.value!="")
		{
		  
		  if(!document.user.uname.value.match(uname)){
				errorMsg("Username - Please enter Alphabets a - z ,numbers 0-9 ,(! @ # & - _ ) symbols only",'username');
				return false;
			}
		}
		
	
	if(document.user.pwd.value=="")
		{
		errorMsg("Password should not be blank",'pwd');
		
		return false;
		}
		
	if(document.user.pwd.value!="")
		{
		  if(document.user.pwd.value.length < 6 || document.user.pwd.value.length > 36)
		   {
				errorMsg("Password should be atleast 6 characters and maximum 20 characters long !","pwd");
				
				return false;
		   }
	}	
	if(document.user.cpwd.value=="")
		{
		errorMsg("Confirm password cannot be left blank","cpwd");
		
		return false;
		}
	if(document.user.cpwd.value!=document.user.pwd.value)
		{
		errorMsg("Password and Confirm Password should match !","cpwd");
		
		return false;
		}
		
	if(document.user.role.value=="0")
		{
		errorMsg("Privileges cannot be left blank","role");
		return false;
		}	
		
	return true;
}
</script>
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
						<h3>PPAC International Awards</h3>
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
								<h4><i class="icon-reorder"></i>Add Award Images</h4>
							</div>
							<div class="widget-content">
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
                <td valign="top"><table width="98%" border="0" cellpadding="6" cellspacing="0" class="grayfour">
				<form action="" name="user" method="post" onSubmit="return validateUser()" class="form-horizontal row-border" id="validate-1"  enctype="multipart/form-data"> 
				<?php if(isset($_GET['eid'])&&$_GET['eid']!=''){ ?>
				
                  <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-user"></i>&nbsp;Award Info</b> </div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left" class="blackbold"> First Name <span class="required">*</span></td>
				<td><input   class="form-control input-width-xxlarge required" placeholder="First name" name="fname"  id="fname" value="<?php echo htmlentities(stripslashes($userData[8])) ?>"></td>
				<td><div class="validateText">Enter  First name</div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold"> Last Name *</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Last Name" name="lname" id="lname" value="<?php echo htmlentities(stripslashes($userData[9])) ?>"></td>
				<td><div class="validateText">Enter  Last name</div></td>
				</tr>
				<tr >
				<td align="left" class="blackbold">  Email *</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="email" id="email" value="<?php echo htmlentities(stripslashes($userData[3])) ?>"></td>
				<td><div class="validateText">Enter Valid email address</div></td>
				</tr>
				<tr >
				<td align="left" class="blackbold">  Contact</td>
				<td><input type="text" class="form-control input-width-xxlarge" placeholder="Contact No." name="contact" id="contact" value="<?php echo htmlentities(stripslashes($userData[5])) ?>"></td>
				<td><div class="validateText">Enter Valid contact number</div></td>
				</tr>
                 <tr >
				<td align="left" class="blackbold"> Date Of Birth</td>
				<td><input type="text" class="form-control input-width-xxlarge" data-mask="99/99/9999" placeholder="Date Of Birth." name="dateofbirth" id="dateofbirth" value="<?php echo htmlentities(stripslashes($userData[10])) ?>"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                <tr >
				<td align="left" class="blackbold">  Address</td>
				<td><input type="text" class="form-control input-width-xxlarge" placeholder="Address" name="address" id="address" value="<?php echo htmlentities(stripslashes($userData[20])) ?>"></td>
				<td><div class="validateText">Enter Full Address</div></td>
				</tr>
                
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-briefcase "></i>&nbsp;Official Info</b></div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left" class="blackbold">Designation *</td>
				<td><select name="designation" id="designation" class="form-control col-md-12" ><option value="0">Select Designation</option>
				<?php
					$execQrys=mysql_query("select * from `designations` where `status` = '1' order by `id` ");
					$numRowss=mysql_num_rows($execQrys);
					if($numRowss>0){
					while($fetchs=mysql_fetch_array($execQrys)){?>
					<option value="<?php echo $fetchs['id']; ?>" <?php if($userData[11]==$fetchs['id']){ ?> selected <?php } ?> ><?php echo stripslashes($fetchs['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Designation</option>
					<?php } ?>
                
                </select></td>
				<td><div class="validateText">Select Designation</div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold">Off.  Contact No</td>
				<td><input type="text" class="form-control " placeholder="Contact No." name="officialcontact" id="officialcontact" value="<?php echo htmlentities(stripslashes($userData[12])) ?>"></td>
				<td><div class="validateText">Enter Valid contact number</div></td>
				</tr>
                
               
               
                <tr >
				<td align="left" class="blackbold"> Joining Date</td>
				<td><input type="text" class="form-control datepicker" placeholder="Date Of Joining." name="dateofjoining" id="dateofjoining" value="<?php echo htmlentities(stripslashes($userData[13])) ?>"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                
                 <tr >
				<td align="left" class="blackbold"> Bank A/c Number</td>
				<td><input type="text" class="form-control " placeholder="Bank account number" onKeyPress="return isNumber(event)" value="<?php echo htmlentities(stripslashes($userData[21])) ?>" name="empacountnumber" id="empacountnumber"></td>
				<td><div class="validateText">Only Numbers (0-9)</div></td>
				</tr>
                
                
                 <tr >
				<td align="left" class="blackbold">Bank Name</td>
				<td><input type="text" class="form-control " placeholder="Bank name & branch" name="empbank" value="<?php echo htmlentities(stripslashes($userData[22])) ?>" id="empbank"></td>
				<td><div class="validateText"></div></td>
				</tr>
                <tr>
                    <td align="left" class="blackbold">IFSC Code</td>
                    <td><input type="text" class="form-control " placeholder="Ifsc code" name="empifsc" id="empifsc" value="<?php echo htmlentities(stripslashes($userData[29])) ?>" ></td>
                    <td><div class="validateText">Alphabets A-Z, Numbers 0-9 only</div></td>
				</tr>
                
                 <tr >
				<td align="left" class="blackbold">Pan Card Number</td>
				<td><input type="text" class="form-control " placeholder="Pan Card" name="emppancard" value="<?php echo htmlentities(stripslashes($userData[23])) ?>" id="emppancard"></td>
				<td><div class="validateText">Alphabets A-Z, Numbers 0-9 only</div></td>
				</tr>
                
              
                 <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-briefcase "></i>&nbsp;Financial Info</b></div></td>
				
				</tr>
                 <tr >
				<td align="left" class="blackbold"> Salary Type</td>
				<td align="left">
                <div class="row">
                
                <div class="col-md-12">
				<div class="col-md-4" style="padding-left:0px;"><label class="radio-inline"><input class="uniform" onClick="setSalaryTypeText(this.value)" <?php if($userData[24]==1){ ?>checked <?php } ?> name="salarytype" value="1"  type="radio"> Monthly</label></div>	
        		<div class="col-md-4"><label class="radio-inline"><input <?php if($userData[24]==2){ ?>checked <?php } ?> class="uniform" name="salarytype" value="2" onClick="setSalaryTypeText(this.value)"   type="radio"> Hourly</label><input type="hidden" name="hidsalarytype" id="hidsalarytype" value="<?php echo $userData[24]; ?>"> </div>
                <div class="col-md-4"></div>						
                    </div>
           </div>
											
										</td>
				<td><div class="validateText">Select Salary Type</div></td>
				</tr>
                <?php
				if($userData[24]==1){
					$salText="Month";	
				}
				if($userData[24]==2){
					$salText="hour";	
				}
				?>
                <tr >
				<td align="left" class="blackbold"> Salary (Rs)</td>
				<td><input type="text" class="form-control input-width-xxlarge" value="<?php echo htmlentities(stripslashes($userData[14])) ?>" onKeyPress="return isNumber(event)" placeholder="Salary" name="salary" id="salary"></td>
				<td><div class="validateText">/<span id="selTypeText"><?php echo $salText; ?></span></div></td>
				</tr>
                  <tr >
				<td align="left" class="blackbold"> HRA (Rs)</td>
				<td><input type="text" class="form-control input-width-xxlarge" onKeyPress="return isNumber(event)" value="<?php echo htmlentities(stripslashes($userData[25])) ?>" placeholder="HRA" name="hra" id="hra"></td>
				<td><div class="validateText">Only Numbers 0-9</div></td>
				</tr>
                  <tr >
				<td align="left" class="blackbold"> Medical (Rs)</td>
				<td><input type="text" class="form-control input-width-xxlarge" value="<?php echo htmlentities(stripslashes($userData[26])) ?>" onKeyPress="return isNumber(event)" placeholder="Medical" name="medical" id="medical"></td>
				<td><div class="validateText">Only Numbers 0-9</div></td>
				</tr>
                  <tr >
				<td align="left" class="blackbold"> Conveyance (Rs)</td>
				<td><input type="text" class="form-control input-width-xxlarge" value="<?php echo htmlentities(stripslashes($userData[27])) ?>" onKeyPress="return isNumber(event)" placeholder="Conveyance" name="conveyance" id="conveyance"></td>
				<td><div class="validateText">Only Numbers 0-9</div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold"> Taxable Salary</td>
				<td align="left">
                <div class="row">
                
                <div class="col-md-12">
				<div class="col-md-4" style="padding-left:0px;"><label class="radio-inline"><input <?php if($userData[28]==1){ ?>checked <?php } ?> class="uniform"  onClick="setTaxableSalary(this.value)" name="taxable" value="1"  type="radio"> Yes</label></div>	
        		<div class="col-md-4"><label class="radio-inline"><input class="uniform" name="taxable" <?php if($userData[28]==2){ ?>checked <?php } ?> value="2" onClick="setTaxableSalary(this.value)"  type="radio"> No</label><input type="hidden" name="hidtaxable" id="hidtaxable" value="<?php echo $userData[28];?>"> </div>
                <div class="col-md-4"></div>						
                    </div>
           </div>
											
										</td>
				<td><div class="validateText"></div></td>
				</tr>
                 <!-- <tr >
				<td align="left" class="blackbold"> Target (Rs)</td>
				<td><input type="text" class="form-control input-width-xxlarge" value="<?php echo htmlentities(stripslashes($userData[15])) ?>" placeholder="Targets" name="target" id="target"></td>
				<td><div class="validateText">Enter Target (Only Numerical Digits, no comma)</div></td>
				</tr>
                -->
                
                
                
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <!--<tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-signin"></i>&nbsp;Login</b></div></td>
				
				</tr>-->
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
			<!--	<tr >
				<td align="left" class="blackbold"> Username *</td>
				<td width="42%"><input type="text"  class="form-control input-width-xxlarge" placeholder="username"  name="uname" id="username" value="<?php echo htmlentities(stripslashes($userData[1])) ?>"></td>
				<td width="33%"><div id="checkUserName">Click <a href="javascript:void(0)" onClick="checkAvailability(document.getElementById('username').value)">here</a> to check  Availability &nbsp;&nbsp; <span id="userMsg"></span></div> </td>
				</tr>
				<tr >
				<td align="left" class="blackbold"> Password *</td>
				<td><input type="password"  class="form-control input-width-xxlarge" placeholder="password" name="pwd" id="pwd" value="<?php echo htmlentities(stripslashes($userData[2])) ?>"></td>
				<td><div class="validateText">Password should be minimum 6 and maximum 20 char</div> </td>
				</tr>
				<tr >
				<td align="left" class="blackbold">Confirm Password*</td>
				<td><input type="password"  class="form-control input-width-xxlarge" placeholder="Confirm Password" name="cpwd" id="cpwd" value="<?php echo htmlentities(stripslashes($userData[2])) ?>"></td>
				<td><div class="validateText">Password and confirm password should match</div></td>
				</tr>-->
                
                
                 <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-copy"></i>&nbsp;Reporting</b> </div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
			
                
				
                
                
                
                <tr >
				<td align="left" class="blackbold">Report To </td>
				<td><div class="col-md-6" style="padding-left:0px;"><input type="hidden" name="hidEmp" id="hidEmp" value="<?php echo $userData[16] ?>"><select name="rdesignation" class="form-control col-md-12" onChange="getEmployeeByDesignation(this.value)" ><option value="0">Select Designation</option>
				<?php
					$execQry=mysql_query("select * from `designations` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($reportToDesignation==$fetch['id']) {?> selected <?php } ?> ><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Designation</option>
					<?php } ?>
                
                </select></div><div class="col-md-5" id="empDiv"><select name="reportto" id="reportto" class="form-control col-md-12" onChange="setEmployeeReportTo(this.value)" ><option value="0">Select Employee</option>
				<?php
					$execQry=mysql_query("select * from `ppac_awardimages` where `status` = '1' and `designation`='$reportToDesignation' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[16]==$fetch['id']) {?> selected <?php } ?> ><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Employee</option>
					<?php } ?>
                
                </select></div><div class="col-md-1" ><input type="checkbox" name="norole" id="norole" <?php if($userData[19]==1){ ?> checked <?php } ?>> No </div></td>
				<td><div class="validateText">( If no reporting `Tick` No )</div></td>
				</tr>
				
                
                <tr>
				<td align="left" class="blackbold">Assign Privileges *</td>
				<td><select name="role" id="role" class="form-control col-md-12" ><option value="0">Select Roles</option>
				<?php
					$execQry=mysql_query("select * from `roles` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[17]==$fetch['id']){ ?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Roles</option>
					<?php } ?>
                
                </select></td>
				<td><div class="validateText">( Assign a role to employee )</div></td>
				</tr>
                
                
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="hidden" value="<?php echo $userData[0]; ?>" name="hidid"><input type="submit" name="update" class="btn" value="  Update   ">&nbsp;&nbsp;&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='awardimages.php'" class="btn"></td>
				</tr>
				
				<?php }else{?>
                 <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-user"></i>&nbsp;Award Info</b> </div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left" class="blackbold"> First Name <span class="required">*</span></td>
				<td><input   class="form-control input-width-xxlarge required" placeholder="First name" name="fname"  id="fname"></td>
				<td><div class="validateText">Enter  First name</div></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold"> Image</td>
				<td><input type="file" name="image" ></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
               
                <!--  <tr >
				<td align="left" class="blackbold"> Target (Rs)</td>
				<td><input type="text" class="form-control input-width-xxlarge" placeholder="Targets" name="target" id="target"></td>
				<td><div class="validateText">Enter Target (Only Numerical Digits, no comma)</div></td>
				</tr>-->
                
                
                
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                
                 <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
               
                
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="hidden" value="0" name="userStatus" id="userStatus"><input class="btn btn-primary pull-left" type="submit" name="submit"  value="  Submit   ">&nbsp;&nbsp;&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='awardimages.php'" class="btn"></td>
				</tr>
				<?php } ?>
  				</form>
</table></td>
              </tr>
			 
          </table>
          
          

							</div>
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
				</div>
                
                <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>View Awards</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                         <tr >
            <th >Sno</th>
              
            <th  data-class="expand">Name</th>
            <th  data-hide="phone">Image</th>
            <th data-hide="phone,tablet">Created at</th>
           <!--  <th data-hide="phone,tablet">Target</th> -->
         
            <th  data-hide="phone,tablet">Action</th>
  </tr>
                                        
                                        
									</thead>
									<tbody>
	<?php 
  	$sqlQry=mysql_query("select * from `ppac_awardimages` where `status`='1' order by `id` desc ");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
	<td align="left" class="smallfonttext"><?php echo $fetch['name']; ?></td>
	<td align="left" class="smallfonttext"><img src="../photos/<?php echo $fetch['image']; ?>" width="80" height="80px"></td>
	<td align="left" style="text-align:center" class="smallfonttext"><?php echo $fetch['date']; ?></td>
<!--    <td align="left" style="text-align:center" class="smallfonttext"><a href="addtarget.php?aid=<?php echo base64_encode( $fetch['id']); ?>" > <button class="btn"><i class="icon-money"></i></button></a></td>
	--> 
    
    <td align="center" bgcolor="#F9F9F9"><table border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr >
		<td align="right" ><a href="awardimages.php?did=<?php echo base64_encode($fetch['id']) ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
		<!--<td align="center" ><a href="awardimages.php?eid=<?php echo base64_encode($fetch['id']) ?>"><button class="btn"><i class="icon-edit"></i></button>	</a></td>
        -->
        
		<!--<td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','ppac_awardimages',6)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
        
        <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>-->
	</tr>
	</table></td>
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.container -->

		</div>
	</div>

   
    
   
</body>
</html>
