<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

if(isset($_GET['did'])&&$_GET['did']!=''){
	$did=base64_decode($_GET['did']);
	$delQry=mysql_query("delete from `ppac_user_info` where `id`='$did'");
		if($delQry){
			header("location:user_listing.php?msg=dls");
		}else{
			header("location:user_listing.php?msg=dlf");
		}
}

if(isset($_POST['submit'])){
	extract($_POST);
	
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
	$pwd=md5(mysql_real_escape_string($_POST['pwd']));
	
	$address=mysql_real_escape_string($_POST['address']);
	$empacountnumber=mysql_real_escape_string($_POST['empacountnumber']);
	$empbank=mysql_real_escape_string($_POST['empbank']);
	$emppancard=mysql_real_escape_string($_POST['emppancard']);
	$hra=mysql_real_escape_string($_POST['hra']);
	$medical=mysql_real_escape_string($_POST['medical']);
	$conveyance=mysql_real_escape_string($_POST['conveyance']);
	
	
	if($_POST['norole']==''){
		$norole=0;	
	}else{
		$norole=1;	
	}
	
	
	$logindate=date("d F, Y h:i A");
	
	$chkUsrQry = mysql_fetch_row(mysql_query("select count(*) from `admin` where  `username`='$uname' "));
	if($chkUsrQry[0]>0){
		header("location:user_listing.php?msg=ule");					  
	}else{
		
	$excQry=mysql_query("INSERT INTO `admin` (`id`, `username`, `password`, `email`, `last_login`, `contact`, `status`, `skey`, `firstname`, `lastname`, `dateofbirth`, `designation`, `officialcontact`, `dateofjoining`, `salary`, `target`, `reportto`, `role_id`, `imagepath`,`norole`,`address`,`empacountnumber`,`empbank`,`emppancard`,`salarytype`,`hra`,`medical`,`conveyance`,`taxable`) VALUES (NULL, '$uname', '$pwd', '$email', '$logindate', '$contact', '0', '0', '$fname', '$lname', '$dateofbirth', '$designation', '$officialcontact', '$dateofjoining', '$salary', '$target', '$hidEmp', '$role', '$imagepath','$norole','$address','$empacountnumber','$empbank','$emppancard','$hidsalarytype','$hra','$medical','$conveyance','$hidtaxable');");	
	
	if($excQry ){
		header("location:user_listing.php?msg=ins");					  
	}else{
		header("location:user_listing.php?msg=inf");	
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
	$pwd=md5(mysql_real_escape_string($_POST['pwd']));
	
	
	$address=mysql_real_escape_string($_POST['address']);
	$empacountnumber=mysql_real_escape_string($_POST['empacountnumber']);
	$empbank=mysql_real_escape_string($_POST['empbank']);
	$emppancard=mysql_real_escape_string($_POST['emppancard']);
	$hra=mysql_real_escape_string($_POST['hra']);
	$medical=mysql_real_escape_string($_POST['medical']);
	$conveyance=mysql_real_escape_string($_POST['conveyance']);
	
	
	if($_POST['norole']==''){
		$norole=0;	
	}else{
		$norole=1;	
	}
	
	$chkUsrQry = mysql_fetch_row(mysql_query("select count(*) from `admin` where  `username`='$uname' and `id`!='$id' "));
	if($chkUsrQry[0]>0){
		header("location:user_listing.php?msg=ule");
		
	}else{
	
	
	$sqlQry="UPDATE `admin` SET `username` = '$uname', `password` = '$pwd', `email` = '$email', `contact` = '$contact', `firstname` = '$fname', `lastname` = '$lname', `dateofbirth` = '$dateofbirth', `designation` = '$designation', `officialcontact` = '$officialcontact', `dateofjoining` = '$dateofjoining', `salary` = '$salary', `target` = '$target', `reportto` = '$hidEmp', `role_id` = '$role', `imagepath` = '$imagepath', `norole` = '$norole' ,`address`='$address',`empacountnumber`='$empacountnumber',`empbank`='$empbank',`emppancard`='$emppancard',`salarytype`='$hidsalarytype',`hra`='$hra',`medical`='$medical',`conveyance`='$conveyance',`taxable`='$hidtaxable' WHERE `id` = '$id';";
	$execQry=mysql_query($sqlQry);
	if($execQry){
		header("location:user_listing.php?msg=ups");
	}else{
		header("location:user_listing.php?msg=upf");
	}
	
	}

}



if(isset($_GET['eid'])&&$_GET['eid']!=''){
	$eid=base64_decode($_GET['eid']);
	$edtQry=mysql_query("Select * from `admin` where `id`='$eid'");
	$userData=mysql_fetch_row($edtQry);	
	$reportToDesignation=getEmployeeDesignationbyReportToId($userData[16]);
	
}

	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Administrator has been added Successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='Administrator not inserted Successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='Administrator data updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='Administrator data not updated Successfully !!';
		$class='danger';
	break;
	
	case 'ule':
		$msg='This username already exists!!';
		$class='danger';
	break;
	case 'dls':
		$msg='Administrator data deleted successfully !!';
		$class='success';
	break;
	
	case 'dlf':
		$msg='Administrator data not deleted successfully !!!!';
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo getSiteTitle(); ?></title>
    <script src="../javascript/javascript.js" type="text/javascript"></script>

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
						<h3>User Listing</h3>
						<!--<span>Good morning, John!</span>-->
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->

				
                
                <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>View Users</h4>
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
             <th>Preview</th> 
             <th>Namer</th>
            <th>Registered ON</th>
            <th  data-class="expand">Email</th>
           <!-- <th  data-hide="phone">Email</th>
            <th data-hide="phone,tablet">Contact</th>
            <th  data-hide="phone,tablet">Designation</th>
              <th data-hide="phone,tablet">Change Pwd</th>
           --> <th  data-hide="phone,tablet" style="text-align:center">Action</th>
  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
  	$sqlQry=mysql_query("select * from `ppac_user_info` where `usertype`='1' order by `id` desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;	
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    <td align="center"  ><a href="viewcustomer.php?aid=<?php echo base64_encode( $fetch['id']); ?>" rel="facebox"> <button class="btn"><i class="icon-desktop"></i></button></a></span></td>
   
    <td align="left" class="smallfonttext"><?php echo $fetch['name']; ?></td>
    
    	<td align="left" class="smallfonttext"><?php echo $fetch['date']; ?></td>

	<td align="left" class="smallfonttext"><?php echo $fetch['email']; ?></td>

    <td align="center" bgcolor="#F9F9F9"><table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr >
		<td align="right" ><a href="user_listing.php?did=<?php echo base64_encode($fetch['id']); ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>        
        
		<td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','ppac_user_info',4)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
        
        <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
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
