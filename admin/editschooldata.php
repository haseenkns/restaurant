<?php
ob_start();
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");

if(isset($_GET['id'])&&$_GET['id']!=''){	
	$cid=$_GET['id'];
	$uv=$_GET['uv'];
	$cl=$_GET['cl'];
	$eid=base64_decode($cid);
	$edtQry=mysql_query("Select * from `schools` where `id`='$eid'");
	$userData=mysql_fetch_row($edtQry);	
}


	

if(isset($_POST['update'])){
	extract($_POST);
	$id=$_POST['hidid'];
	$cid=$hidCid;
	
	
	$fname=mysql_real_escape_string($fname);
	$mname=mysql_real_escape_string($mname);
	$lname=mysql_real_escape_string($lname);
	$fathername=mysql_real_escape_string($fathername);
	$gender=mysql_real_escape_string($gender);
	$dob=mysql_real_escape_string($dob);
	$email=mysql_real_escape_string($email);
	
	$phone=mysql_real_escape_string($phone);
	$mobile=mysql_real_escape_string($mobile);
	$landline=mysql_real_escape_string($landline);
	$country=mysql_real_escape_string($country);
	$state=mysql_real_escape_string($state);
	$city=mysql_real_escape_string($city);
	$address1=mysql_real_escape_string($address1);
	
	$address2=mysql_real_escape_string($address2);
	$address3=mysql_real_escape_string($address3);
	$pincode=mysql_real_escape_string($pincode);
	$course=mysql_real_escape_string($course);
	$yearofadmission=mysql_real_escape_string($yearofadmission);
	$yearofpassing=mysql_real_escape_string($yearofpassing);
	$university=mysql_real_escape_string($university);
	
	$college=mysql_real_escape_string($college);
	$totalpercent=mysql_real_escape_string($totalpercent);
	$firstpercent=mysql_real_escape_string($firstpercent);
	$secondpercent=mysql_real_escape_string($secondpercent);
	$thirdpercent=mysql_real_escape_string($thirdpercent);
	$fourthpercent=mysql_real_escape_string($fourthpercent);
	$honors=mysql_real_escape_string($honors);
	
	
	$sqlQry="UPDATE  `schools` SET  `firstname` =  '$fname',
`middlename` =  '$mname',
`lastname` =  '$lname',
`gender` =  '$gender',
`fathername` =  '$fathername',
`dob` =  '$dob',
`email` =  '$email',
`phone` =  '$phone',
`mobile` =  '$mobile',
`landline` =  '$landline',
`country` =  '$country',
`state` =  '$state',
`city` =  '$city',
`address1` =  '$address1',
`address2` =  '$address2',
`address3` =  '$address3',
`pincode` =  '$pincode',
`course` =  '$course',
`yearofadmission` =  '$yearofaddmission',
`yearofpassing` =  '$yearofpassing',
`university` =  '$university',
`college` =  '$college',
`totalpercent` =  '$totalpercent',
`firstyearpercent` =  '$firstpercent',
`secondyearpercent` =  '$secondpercent',
`thirdyearpercent` =  '$thirdpercent',
`fourthyearpercent` =  '$fourtpercent',
`honors` =  '$honors' WHERE  `schools`.`id` ='$id'";
	$execQry=mysql_query($sqlQry);
	if($execQry){
		header("location:schools.php?msg=ups&uv=$uv&cl=$cl");
	}else{
		header("location:schools.php?msg=upf&uv=$uv&cl=$cl");
	}

}


	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='College Courses Information Has Been Added Successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='College Courses Information Not Added Successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='College Courses Information Has Been  updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='College Courses Information not updated Successfully !!';
		$class='danger';
	break;
	case 'dls':
		$msg='College Courses Information Has Been  deleted successfully !!';
		$class='success';
	break;
	
	case 'dlf':
		$msg='College Courses Information  not deleted successfully !!!!';
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
	<title>Admin Panel </title>
    <script src="../javascript/javascript.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript">
	function validateUser()
	{
	var eptrn=/^[a-z0-9]+[a-z0-9\._]*@[a-z0-9\.]+\.[a-z]{2,3}$/;    ///////////mail pattern///////
	var uptrn=/^[a-zA-Z_0-9]{4,}$/;
	/*if(document.user.email.value=="")
		{
		alert('Enter valid Email-address');
		document.user.email.focus();
		return false;
		}

	if(!document.user.email.value.match(eptrn))
	{
		alert('Enter valid Email-address');
		document.user.email.focus();
		return false;
	}
	if(document.user.address.value=="")
		{
		alert("Address should not blank");
		document.user.address.focus();
		return false;
		}
	
		
	

	if(document.user.contact.value=="")
		{
		alert("Contact Number cannot be left blank");
		document.user.contact.focus();
		return false;
		}	*/
		
	return true;
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
					<h3>Student Data  - <?php echo $userData[1]; ?></h3>
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
								<h4><i class="icon-reorder"></i>Update Details </h4><span style="float:right;cursor:pointer;" onClick="window.location.href='schools.php?uv=<?php echo $uv; ?>&cl=<?php echo $cl; ?>'">Go Back</span>
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
				<form action="" name="user" method="post" onSubmit="return validateUser()">
			
				  <tr >
				<td align="left" class="blackbold">Add First Name</td>
				<td width="45%"><input type="text"  class="form-control input-width-xxlarge" placeholder="Course Name"  name="fname" id="fname" value="<?php echo stripslashes($userData[1]); ?>"></td>
				<td width="26%"><div id="checkUserName"> Enter Valid FirstName<span id="userMsg"></span></div> </td>
				</tr>
				  <tr >
				<td align="left" class="blackbold">Add Middle Name</td>
				<td width="45%"><input type="text"  class="form-control input-width-xxlarge" placeholder="Course Name"  name="mname" id="mname" value="<?php echo stripslashes($userData[2]); ?>"></td>
				<td width="26%"><div id="checkUserName"> Enter Valid Middle Name<span id="userMsg"></span></div> </td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold">Add Last Name</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Fees Structure " name="lname" id="fees" value="<?php echo stripslashes($userData[3]); ?>"></td>
				<td><div class="validateText">Enter Valid Last Name</div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold">Add Gender</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Seats" name="gender" id="seats" value="<?php echo stripslashes($userData[4]); ?>"></td>
				<td><div class="validateText">Enter Valid Gender</div></td>
				</tr>
				<tr >
				<td align="left" class="blackbold">Update Father Name</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="fathername" id="eligibility" value="<?php echo stripslashes($userData[5]); ?>"></td>
				<td><div class="validateText">Enter Valid Fathers Name</div></td>
				</tr>
				
				
				
				<tr >
				<td align="left" class="blackbold">Update Date Of Birth</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="dob" id="eligibility" value="<?php echo stripslashes($userData[6]); ?>"></td>
				<td><div class="validateText">Enter Valid Date of Birth</div></td>
				</tr>
                
                
                <tr >
				<td align="left" class="blackbold">Update Email</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="email" id="eligibility" value="<?php echo stripslashes($userData[7]); ?>"></td>
				<td><div class="validateText">Enter Valid Email</div></td>
				</tr>
               
                <tr >
				<td align="left" class="blackbold">Update Phone</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="phone" id="eligibility" value="<?php echo stripslashes($userData[8]); ?>"></td>
				<td><div class="validateText">Enter Valid Phone Number</div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold">Update Mobile</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="mobile" id="eligibility" value="<?php echo stripslashes($userData[9]); ?>"></td>
				<td><div class="validateText">Enter Valid Mobile Number</div></td>
				</tr>
                
                
                <tr >
				<td align="left" class="blackbold">Update Landline</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="landline" id="eligibility" value="<?php echo stripslashes($userData[10]); ?>"></td>
				<td><div class="validateText">Enter Valid Landline</div></td>
				</tr>
                
                
                <tr >
				<td align="left" class="blackbold">Update Country</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="country" id="eligibility" value="<?php echo stripslashes($userData[11]); ?>"></td>
				<td><div class="validateText">Enter Valid Country</div></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold">Update State</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="state" id="eligibility" value="<?php echo stripslashes($userData[12]); ?>"></td>
				<td><div class="validateText">Enter Valid State</div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold">Update City</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="city" id="eligibility" value="<?php echo stripslashes($userData[13]); ?>"></td>
				<td><div class="validateText">Enter Valid City</div></td>
				</tr>
                
                
                <tr >
				<td align="left" class="blackbold">Update Address1</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="address1" id="eligibility" value="<?php echo stripslashes($userData[14]); ?>"></td>
				<td><div class="validateText">Enter Valid Address 1</div></td>
				</tr>
                
                
                
                <tr >
				<td align="left" class="blackbold">Update Address 2</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="address2" id="eligibility" value="<?php echo stripslashes($userData[15]); ?>"></td>
				<td><div class="validateText">Enter Valid Address2</div></td>
				</tr>
                
                
                <tr >
				<td align="left" class="blackbold">Update Address 3</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="address3" id="eligibility" value="<?php echo stripslashes($userData[16]); ?>"></td>
				<td><div class="validateText">Enter Valid Address3</div></td>
				</tr>
                
                
                
                <tr >
				<td align="left" class="blackbold">Update Pincode</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="pincode" id="eligibility" value="<?php echo stripslashes($userData[17]); ?>"></td>
				<td><div class="validateText">Enter Valid Pincode</div></td>
				</tr>
                
                
                
                <tr >
				<td align="left" class="blackbold">Update Course</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="course" id="eligibility" value="<?php echo stripslashes($userData[18]); ?>"></td>
				<td><div class="validateText">Enter Valid Course</div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold">Update Year Of Addmission</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="yearofaddmission" id="eligibility" value="<?php echo stripslashes($userData[19]); ?>"></td>
				<td><div class="validateText">Enter Valid <span class="blackbold">Year Of Addmission</span></div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold">Update Year Of Passing</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="yearofpassing" id="eligibility" value="<?php echo stripslashes($userData[20]); ?>"></td>
				<td><div class="validateText">Enter Valid <span class="blackbold">Year Of Passing</span></div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold">Update University</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="university" id="eligibility" value="<?php echo stripslashes($userData[21]); ?>"></td>
				<td><div class="validateText">Enter Valid <span class="blackbold">University</span></div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold">Update College</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="college" id="eligibility" value="<?php echo stripslashes($userData[22]); ?>"></td>
				<td><div class="validateText">Enter Valid <span class="blackbold">College</span></div></td>
				</tr>
                <tr >
            <td align="left" class="blackbold">Update Total %</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="totalpercent" id="eligibility" value="<?php echo stripslashes($userData[23]); ?>"></td>
				<td><div class="validateText">Enter Valid <span class="blackbold">Total %</span></div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold">Update % First Year</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="firstpercent" id="eligibility" value="<?php echo stripslashes($userData[24]); ?>"></td>
				<td><div class="validateText">Enter Valid <span class="blackbold">% First Year</span></div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold">Update % Second Year</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="secondpercent" id="eligibility" value="<?php echo stripslashes($userData[25]); ?>"></td>
				<td><div class="validateText">Enter Valid <span class="blackbold">% Second Year</span></div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold">Update % Third Year</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="thirdpercent" id="eligibility" value="<?php echo stripslashes($userData[26]); ?>"></td>
				<td><div class="validateText">Enter Valid <span class="blackbold">% Third Year</span></div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold">Update % Fourth Year</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="fourthpercent" id="eligibility" value="<?php echo stripslashes($userData[27]); ?>"></td>
				<td><div class="validateText">Enter Valid <span class="blackbold">% Fourth Year</span></div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold">Update Honors</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Email" name="honors" id="eligibility" value="<?php echo stripslashes($userData[28]); ?>"></td>
				<td><div class="validateText">Enter Valid Honors</div></td>
				</tr>
                
                
                
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left">
                <input type="hidden" value="<?php echo $uv; ?>" name="hiduv">
                <input type="hidden" value="<?php echo $cl; ?>" name="hidcl">
                <input type="hidden" value="<?php echo $userData[0]; ?>" name="hidid">
                <input type="submit" style="width:250px" name="update" class="btn" value="  Update   ">&nbsp;&nbsp;&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='schools.php?uv=<?php echo $uv; ?>&cl=<?php echo $cl ?>'" class="btn"></td>
				</tr>
				
				
             
  				</form>
</table></td>
              </tr>
			 
          </table>
          
          

							</div>
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
				</div>
                
                <!--<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Administrators</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<table width="100%" class="table table-striped table-bordered table-hover  datatable">
									<thead>
										
                                        
                                         <tr >
    <th align="left" width="4%" class="verysmalltextblack">Sno</th>
    <th align="left"  width="32%"class="verysmalltextblack">Name</th>
	 <th align="left"  width="10%"class="verysmalltextblack">Duration</th>
          <th align="center"  width="12%" class="verysmalltextblack">Fees</th>

	 <th width="14%" align="left"  class="verysmalltextblack">Seats</th>
	  <th align="left"  width="12%"class="verysmalltextblack">Eligibility</th>
      <th width="16%"  align="center" class="verysmalltextblack">Action</th>
  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
  	$sqlQry=mysql_query("select * from `collegecourses` where `c_id`='$cid'");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    
	<td align="left" class="smallfonttext"><div><?php echo $fetch['name']; ?></div></td>
	<td  align="left" class="smallfonttext"><?php echo getDurationNameById($fetch['duration']); ?></td>
	<td align="left" class="smallfonttext"><?php echo $fetch['fees']; ?></td>
	<td align="left" class="smallfonttext"><?php echo $fetch['seats']; ?></td>
	  <td align="center"  ><?php echo $fetch['eligibility']; ?></td>
    
    <td align="center" bgcolor="#F9F9F9"><table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr >
		<td align="right" ><a href="addcollegecourses.php?did=<?php echo base64_encode($fetch['id']) ?>&id=<?php echo $cid; ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
		<td align="center" ><a href="addcollegecourses.php?eid=<?php echo base64_encode($fetch['id']) ?>&id=<?php echo $cid; ?>"><button class="btn"><i class="icon-edit"></i></button>	</a></td>
        
        
		<td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','collegecourses',6)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
        
        <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
	</tr>
	</table></td>
  </tr>
  <?php }}else{?>
  <tr><td>1</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td  align="center" class="blackbold" bgcolor="#FFFFFF">No Records Found !</td></tr>
  
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