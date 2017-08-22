<?php
ob_start();
session_start();
$ppac_assign_awardId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($ppac_assign_awardId);

if(isset($_GET['did'])&&$_GET['did']!=''){
	$did=base64_decode($_GET['did']);
	$delQry=mysql_query("delete from `ppac_assign_award` where `id`='$did'");
		if($delQry){
			header("location:assign_award.php?msg=dls");
		}else{
			header("location:assign_award.php?msg=dlf");
		}
}

if(isset($_POST['submit'])){
	extract($_POST);
	$competition=mysql_real_escape_string($_POST['competition']);
	$message=mysql_real_escape_string($_POST['message']);
	$category=mysql_real_escape_string($_POST['category']);
	$gold_user=mysql_real_escape_string($_POST['gold_user']);	
	$silver_user=mysql_real_escape_string($_POST['silver_user']);
	$bronze_user=mysql_real_escape_string($_POST['bronze_user']);

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
	     	$imgName="";				
		}

	$created_at = date('Y-m-d h:i:s');

	$chkUsrQry = mysql_fetch_row(mysql_query("select count(*) from `ppac_assign_award` where  `competition_id`='$competition' "));
	if($chkUsrQry[0]>0){
		header("location:assign_award.php?msg=ule");					  
	}else{
		
	$excQry=mysql_query("INSERT INTO `ppac_assign_award` (`id`, `competition_id`,`banner`, `message`, `status`, `gold_user`, `silver_user`, `bronze_user`,`created_at`,`category`) VALUES 
(NULL, '$competition','$imgName','$message','1','$gold_user','$silver_user','$bronze_user','$created_at','$category')");	
	
	if($excQry ){
		header("location:assign_award.php?msg=ins");					  
	}else{
		header("location:assign_award.php?msg=inf");	
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
	
	
	$chkUsrQry = mysql_fetch_row(mysql_query("select count(*) from `ppac_assign_award` where  `username`='$uname' and `id`!='$id' "));
	if($chkUsrQry[0]>0){
		header("location:assign_award.php?msg=ule");		
	}else{	
	
	$sqlQry="UPDATE `ppac_assign_award` SET   `email` = '$email', `contact` = '$contact', `firstname` = '$fname', `lastname` = '$lname', `dateofbirth` = '$dateofbirth', `designation` = '$designation', `officialcontact` = '$officialcontact', `dateofjoining` = '$dateofjoining', `salary` = '$salary', `target` = '$target', `reportto` = '$hidEmp', `role_id` = '$role', `imagepath` = '$imagepath', `norole` = '$norole' ,`address`='$address',`empacountnumber`='$empacountnumber',`empbank`='$empbank',`emppancard`='$emppancard',`salarytype`='$hidsalarytype',`hra`='$hra',`medical`='$medical',`conveyance`='$conveyance',`taxable`='$hidtaxable' ,`empifsc`='$empifsc' WHERE `id` = '$id';";
	$execQry=mysql_query($sqlQry);
	if($execQry){
		header("location:assign_award.php?msg=ups");
	}else{
		header("location:assign_award.php?msg=upf");
	}
	
	}

}



if(isset($_GET['eid'])&&$_GET['eid']!=''){
	$eid=base64_decode($_GET['eid']);
	$edtQry=mysql_query("Select * from `ppac_assign_award` where `id`='$eid'");
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
		$msg='Data not updated Successfully !!';
		$class='danger';
	break;
	
	case 'ule':
		$msg='Award has been already define for this competition!!';
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
		$msg='Data rights added successfully !!';
		$class='success';
	break;
	
	case 'adf':
		$msg='Datarights not added successfully !!!!';
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
						<h3>Award Assignment</h3>
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
								<h4><i class="icon-reorder"></i>Assign award</h4>
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
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-user"></i>&nbsp;Personal Info</b> </div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left" class="blackbold"> Competition <span class="required">*</span></td>
				<td><select name="competition" id="competition" class="form-control col-md-12" >
                                    <option value="0">Select Competition</option>
         				<?php
					$execQry=mysql_query("select * from `create_competition` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>"><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Competition</option>
					<?php } ?>
                
                                   </select>
                                </td>
				<td><div class="validateText">Select Competition</div></td>
				</tr>

                               <tr>
				<td align="left" class="blackbold"> Category <span class="required">*</span></td>
				<td><select name="category" id="category" class="form-control col-md-12" >
                                    <option value="0">Select Category</option>
         				<?php
					$execQry=mysql_query("select * from `ppac_category` order by `id` desc ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>"><?php echo stripslashes($fetch['titles']) ?></option>
					<?php }	}else{?>
					<option value="0">No Category</option>
					<?php } ?>                
                                   </select>
                                </td>
				<td><div class="validateText">Select Category</div></td>
				</tr>

                              <tr >
				<td align="left" class="blackbold">Select Gold User <span class="required">*</span></td>
				<td><select name="gold_user" id="gold_user" class="form-control col-md-12" >
                                    <option value="0">Select User</option>
         				<?php
					$execQry=mysql_query("select * from `ppac_user_info` order by `name` asc ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>"><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No User</option>
					<?php } ?>                
                                   </select>
                                </td>
				<td><div class="validateText">Select Gold User</div></td>
				</tr>

                                <tr>
				<td align="left" class="blackbold"> Silver User <span class="required">*</span></td>
				<td><select name="silver_user" id="silver_user" class="form-control col-md-12" >
                                    <option value="0">Select User</option>
         				<?php
					$execQry=mysql_query("select * from `ppac_user_info` order by `name` asc ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>"><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No User</option>
					<?php } ?>                
                                   </select>
                                </td>
				<td><div class="validateText">Select Silver User</div></td>
				</tr>

                                <tr>
				<td align="left" class="blackbold"> Bronze User <span class="required">*</span></td>
				<td><select name="bronze_user" id="bronze_user" class="form-control col-md-12" >
                                    <option value="0">Select User</option>
         				<?php
					$execQry=mysql_query("select * from `ppac_user_info` order by `name` asc ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>"><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No User</option>
					<?php } ?>                
                                   </select>
                                </td>
				<td><div class="validateText">Select Bronze User</div></td>
				</tr>
                               
                              <tr >
				<td align="left" class="blackbold">Add Banner <span class="required">*</span></td>
				<td><input type="file" name="image" ></td>
				<td><div class="validateText">Upload image for banner</div></td>
				</tr>

                                <tr>
				<td align="left" class="blackbold">Message</td>
				<td> <textarea class="form-control wysiwyg" style="height:200px;width:100%;" title="" type="text" name="message" id="message"></textarea></td>
				<td><div class="validateText"><span id="selTypeText"></span></div></td>
				</tr>
                            
                                <tr>
				<td align="left"  colspan="3" height="10px;"></td>				
				</tr>
               
                
                
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="hidden" value="<?php echo $userData[0]; ?>" name="hidid"><input type="submit" name="update" class="btn" value="  Update   ">&nbsp;&nbsp;&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='assign_award.php'" class="btn"></td>
				</tr>
				
				<?php }else{?>
                 <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-user"></i>&nbsp;Personal Info</b> </div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left" class="blackbold"> Competition <span class="required">*</span></td>
				<td><select name="competition" id="competition" class="form-control col-md-12" >
                                    <option value="0">Select Competition</option>
         				<?php
					$execQry=mysql_query("select * from `create_competition` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>

					<option value="<?php echo stripslashes($fetch['id']) ?>"><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Competition</option>
					<?php } ?>
                
                                   </select>
                                </td>
				<td><div class="validateText">Select Competition</div></td>
				</tr>

                               <tr>
				<td align="left" class="blackbold"> Category <span class="required">*</span></td>
				<td><select name="category" id="category" class="form-control col-md-12">
                                    <option value="0">Select Category</option>
         				<?php
					$execQry=mysql_query("select * from `ppac_category` order by `id` desc ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>"><?php echo stripslashes($fetch['titles']) ?></option>
					<?php }	}else{?>
					<option value="0">No Category</option>
					<?php } ?>                
                                   </select>
                                </td>
				<td><div class="validateText">Select Category</div></td>
				</tr>

                              <tr >
				<td align="left" class="blackbold">Select Gold User <span class="required">*</span></td>
				<td><select name="gold_user" id="gold_user" class="form-control col-md-12" >
                                    <option value="0">Select User</option>
         				<?php
					$execQry=mysql_query("select * from `ppac_user_info` order by `name` asc ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>"><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No User</option>
					<?php } ?>                
                                   </select>
                                </td>
				<td><div class="validateText">Select Gold User</div></td>
				</tr>

                                <tr>
				<td align="left" class="blackbold"> Silver User <span class="required">*</span></td>
				<td><select name="silver_user" id="silver_user" class="form-control col-md-12" >
                                    <option value="0">Select User</option>
         				<?php
					$execQry=mysql_query("select * from `ppac_user_info` order by `name` asc ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>"><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No User</option>
					<?php } ?>                
                                   </select>
                                </td>
				<td><div class="validateText">Select Silver User</div></td>
				</tr>

                                <tr>
				<td align="left" class="blackbold"> Bronze User <span class="required">*</span></td>
				<td><select name="bronze_user" id="bronze_user" class="form-control col-md-12" >
                                    <option value="0">Select User</option>
         				<?php
					$execQry=mysql_query("select * from `ppac_user_info` order by `name` asc ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>"><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No User</option>
					<?php } ?>                
                                   </select>
                                </td>
				<td><div class="validateText">Select Bronze User</div></td>
				</tr>
                               
                              <tr >
				<td align="left" class="blackbold">Add Banner <span class="required">*</span></td>
				<td><input type="file" name="image" ></td>
				<td><div class="validateText">Upload image for banner</div></td>
				</tr>

                                <tr>
				<td align="left" class="blackbold">Message</td>
				<td> <textarea class="form-control wysiwyg" style="height:200px;width:100%;" title="" type="text" name="message" id="message"></textarea></td>
				<td><div class="validateText"><span id="selTypeText"></span></div></td>
				</tr>
                            
                                <tr>
				<td align="left"  colspan="3" height="10px;"></td>				
				</tr>
               
                
				<tr>
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="hidden" value="0" name="userStatus" id="userStatus"><input class="btn btn-primary pull-left" type="submit" name="submit"  value="  Submit   ">&nbsp;&nbsp;&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='assign_award.php'" class="btn"></td>
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
								<h4><i class="icon-reorder"></i>View Judges</h4>
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
            
            <!-- <th>Name</th> -->
            <th>Competition</th>
            <th data-class="expand">banner</th>
            <th data-hide="phone">Gold User</th>
            <th data-hide="phone,tablet">Silver User</th>
            <th data-hide="phone,tablet">Bronze User</th>  
            <th data-hide="phone,tablet">Message</th>         
            <th data-hide="phone,tablet">Action</th>
         </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
  	$sqlQry=mysql_query("select * from `ppac_assign_award` where `status`='1' order by `id` desc ");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
      $competition=getCompetitionNameById($fetch['competition_id']);
	
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
   <!-- <td align="left" class="smallfonttext"><?php echo getCode($fetch['id']); ?></td>-->
	<td align="left" class="smallfonttext"><?php echo $competition; ?></td>
	<td align="left"><img src="../photos/<?php echo $fetch['banner']; ?>"  width="100px" height="60px" ></td>
	<td align="left" class="smallfonttext"><?php echo getUserNameByIdBy($fetch['gold_user']); ?></td>
	<td align="left" class="smallfonttext"><?php echo getUserNameByIdBy($fetch['silver_user']); ?></td>
	<td align="left" class="smallfonttext"><?php echo getUserNameByIdBy($fetch['bronze_user']); ?></td>
	<td align="left" class="smallfonttext"><?php echo $fetch['message']; ?></td>

<!--    	<td align="left" style="text-align:center" class="smallfonttext"><a href="addtarget.php?aid=<?php echo base64_encode( $fetch['id']); ?>" > <button class="btn"><i class="icon-money"></i></button></a></td>
	--> 
    
    <td align="center" bgcolor="#F9F9F9"><table border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr >
		<td align="right"><a href="assign_award.php?did=<?php echo base64_encode($fetch['id']) ?>" class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
		<!--<td align="center" ><a href="assign_award.php?eid=<?php echo base64_encode($fetch['id']) ?>"><button class="btn"><i class="icon-edit"></i></button>	</a></td>
        
       
		<td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','ppac_assign_award',6)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
        
        <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
          -->
	</tr>
	</table></td>
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td colspan="1" align="center" class="blackbold" bgcolor="#FFFFFF">No Records Found !</td></tr>
  
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
