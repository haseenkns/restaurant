<?php
ob_start();
session_start();
$ppac_cmsId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($ppac_cmsId);

if(isset($_GET['did'])&&$_GET['did']!=''){
	$did=base64_decode($_GET['did']);
	$delQry=mysql_query("delete from `ppac_cms` where `id`='$did'");
		if($delQry){
			header("location:membership.php?msg=dls");
		}else{
			header("location:membership.php?msg=dlf");
		}
}

if(isset($_POST['update'])){
	extract($_POST);
	$id=$_POST['hidId'];	
	
	$membership_type=mysql_real_escape_string($_POST['membership_type']);
	$free_images=mysql_real_escape_string($_POST['free_images']);	
	
	$sqlQry="UPDATE `ppac_membership` SET   `membership_type` = '$membership_type', `free_images` = '$free_images', `rate` = '$price' WHERE `id` = '$id'";
	$execQry=mysql_query($sqlQry);
	if($execQry){
		header("location:membership.php?msg=ups");
	}else{
		header("location:membership.php?msg=upf");
	}

}

	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Judge has been added Successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='Judge not inserted Successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='Judge data updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='ppac_cmsistrator data not updated Successfully !!';
		$class='danger';
	break;
	
	case 'ule':
		$msg='This username already exists!!';
		$class='danger';
	break;
	case 'dls':
		$msg='Judge data deleted successfully !!';
		$class='success';
	break;
	
	case 'dlf':
		$msg='Judge data not deleted successfully !!!!';
		$class='danger';
	break;
	
		case 'ads':
		$msg='ppac_cmsistrator rights added successfully !!';
		$class='success';
	break;
	
	case 'adf':
		$msg='ppac_cmsistrator rights not added successfully !!!!';
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
						<h3>Membership</h3>
						<!--<span>Good morning, John!</span>-->
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->

	<?php if(isset($_GET['eid'])&&$_GET['eid']!=''){ 
					$eid=base64_decode($_GET['eid']);
					$execQry=mysql_fetch_row(mysql_query("select * from `ppac_membership` where `id`='$eid'"));
					
					$membership_type=$execQry[1];
					$price=$execQry[3];
					$free_images=$execQry[7];				
							
				?>
                <div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">                            
                            
                  						<h4><i class="icon-reorder"></i> Add Competition </h4>
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
             <?php } ?>
			
              <tr>
                <td class="rgt1">&nbsp;</td>
                <td valign="top" align="left">
				<!--------------------code starts here---------------->
				<table width="100%" border="0" cellpadding="10" cellspacing="0" class="grayfourcurve">
				<form action="" name="program" method="post" onSubmit="return validate()" enctype="multipart/form-data">				
                
				<tr >
				<td width="17%" align="left" class="blackbold">Membership Type</td>
				<td colspan="2" ><input type="text"  class="form-control" style="letter-spacing:1px;"  title=""  size="45" name="membership_type" id="title" value="<?php echo htmlentities(stripslashes($membership_type)); ?>">         </td>
<td></td>
				</tr>
              
                                <tr >
				<td width="17%" align="left" class="blackbold">Price per image</td>
				<td colspan="2" ><input type="text"  class="form-control" style="letter-spacing:1px;"  title=""  size="5" name="price" id="title" value="<?php echo htmlentities(stripslashes($price)); ?>"> $        </td>
<td></td>
				</tr>
                                
                                <tr >
				<td width="17%" align="left" class="blackbold">No. of free images </td>
				<td colspan="2" ><input type="text"  class="form-control" style="letter-spacing:1px;"  title=""  size="5" name="free_images" id="title" value="<?php echo htmlentities(stripslashes($free_images)); ?>">         </td>
<td></td>
				</tr>
              
                 
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="hidden" name="hidId" value="<?php echo $eid; ?>">
<input type="hidden" name="updateId" id="updateId"><input type="submit" name="update" class="btn" value=" Update Membership">&nbsp;
<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='membership.php'" class="btn"></td>
				</tr>			
				
  				</form>
</table>

							
				<!--------------------code ends here---------------->
				</td>
              </tr>
			  <tr><td colspan="2">
			  
              
              
              
              
			 
			  
			  </td></tr>
			  
          </table>
          
                              
							</div>
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
				</div>
<?php } ?>

                <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>View Membership</h4>
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
            <th>Membership Type</th>
            <th  data-class="expand">Price</th> 
            <th  data-class="expand">No of free images</th>
            <th  data-hide="phone">Created at</th>         
            <th  data-hide="phone,tablet">Action</th>
           </tr>                                       
                                        
	</thead>
	<tbody>
 <?php 
  	$sqlQry=mysql_query("select * from `ppac_membership` where `status`='1' order by `id` asc ");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;	
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
	<td align="left" class="smallfonttext"><?php echo $fetch['membership_type']; ?></td>
	<td  align="left" class="smallfonttext"><?php echo $fetch['rate']; ?></td> 
	<td  align="left" class="smallfonttext"><?php echo $fetch['free_images']; ?></td>
	<td align="left" class="smallfonttext"><?php echo $fetch['created_at']; ?></td>
    <td align="center" bgcolor="#F9F9F9"><table border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr ><!--
		<td align="right" ><a href="membership.php?did=<?php echo base64_encode($fetch['id']) ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
        -->
		<td align="center" ><a href="membership.php?eid=<?php echo base64_encode($fetch['id']) ?>"><button class="btn"><i class="icon-edit"></i></button></a></td>
        
       <!-- 
		<td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','ppac_cms',6)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
        
        <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
        -->
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
