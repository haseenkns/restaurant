<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Data inserted Successfully !!';
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
	case 'dls':
		$msg='Data deleted successfully !!';
		$class='success';
	break;
	
	case 'dlf':
		$msg='Data not deleted successfully !!!!';
		$class='danger';
	break;
	case 'ais':
		$msg='Administrative information updated Successfully !!';
		$class='success';
	break;
	
	case 'aif':
		$msg='Administrative information not updated Successfully !!';
		$class='danger';
	break;
	
	case 'aie':
		$msg='This username already exists in the system !!';
		$class='danger';
	break;
	
	case 'default' :
		$msg='';
		break;
	
	}
	}
	
if(isset($_POST['update_admin']))
	{
	$pass=$_POST['pass'];
	$email=mysql_real_escape_string($_POST['email1']);
	$username=mysql_real_escape_string($_POST['username']);
	$contact=mysql_real_escape_string($_POST['contact']);	
	$check=checkUsername($username,$adminId);
	if($check){
		header("location:account.php?msg=aie");	
		exit;
	}
	
	
		$sql="update `admin` set  `password`='$pass',`username`='$username' ,`email`='$email',`contact` = '$contact' where `id`='$adminId'";
		if(@mysql_query($sql))
		{
			header("location:account.php?msg=ais");
		}
		else
		{
			header("location:account.php?msg=aif");
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
<script type="text/javascript" language="JavaScript">
	function validate()
	{
	var eptrn=/^[a-z0-9]+[a-z0-9\._]*@[a-z0-9\.]+\.[a-z]{2,3}$/;    ///////////mail pattern///////
	var uptrn=/[^a-zA-Z 0-9 &_()-]/;
	if(document.form1.email1.value=="")
		{
		alert('Enter valid Email-address');
		document.form1.email1.focus();
		return false;
		}

	if(!document.form1.email1.value.match(eptrn))
	{
		alert('Enter valid Email-address');
		document.form1.email1.focus();
		return false;
	}
	if(document.form1.username.value=="")
		{
		alert("Username should not blank");
		document.form1.username.focus();
		return false;
		}
	if(document.form1.pass.value=="")
		{
		alert("Password should not blank");
		document.form1.pass.focus();
		return false;
		}
	if(document.form1.cpass.value=="")
		{
		alert("confirm password not blank");
		document.form1.cpass.focus();
		return false;
		}
	if(document.form1.cpass.value!=document.form1.pass.value)
		{
		alert("password and confirm password should match !");
		document.form1.cpass.focus();
		return false;
		}
	if(document.form1.contact.value=="")
		{
		/*alert("Contact no should not blank");
		document.form1.contact.focus();
		return false;*/
		}
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
						<h3>Account Setting</h3>
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
								<h4><i class="icon-reorder"></i> My Acount</h4>
							</div>
                           
							<div class="widget-content">
								<table width="100%" border="0" cellpadding="2" cellspacing="2"  >
              
           <?php  
		   $aid=$adminId;
		    $admin=mysql_fetch_object(mysql_query("select * from `admin` where `id` = '$adminId'"));
 ?>
                 <?php if($msg!=''){ ?>
              <tr>
                <td  align="left" colspan="1"><div class="alert alert-<?php echo $class ?> fade in">
									<i class="icon-remove close" data-dismiss="alert"></i>
									<?php echo $msg; ?>
								</div></td>
              </tr>
             <?php }?>
           
              <tr>
               
                <td valign="top" colspan="2"><form method="post" action="" name="form1" enctype="multipart/form-data"  onsubmit="javascript:return validate()";>
                  <table class="table table-striped table-bordered table-hover  datatable" cellpadding="0" cellspacing="0">
                   
					 <tr>
                      <td align="left" class="blackbold">Admin Email</td>
                      <td align="left" class="head2"><input name="email1" type="text" class="form-control input-width-xxlarge" value="<?php echo htmlentities(stripslashes($admin->email))?>" size="50"/></td>
                    </tr>
                    
                     <tr>
                       <td align="left" class="head2">Admin Username </td>
                       <td align="left" class="head2"><input name="username" type="text" class="form-control input-width-xxlarge readonly" readonly value="<?php echo htmlentities(stripslashes($admin->username))?>" size="50"/></td>
                     </tr>
                     <tr>
                      <td align="left" class="head2">Admin Password</td>
                      <td align="left" class="head2"><input name="pass" type="password" class="form-control input-width-xxlarge" value="<?php echo htmlentities(stripslashes($admin->password))?>" size="50"/></td>
                    </tr>
                    <tr>
                      <td align="left" class="head2">Password Confirmation</td>
                      <td align="left" class="head2"><input name="cpass" type="password" class="form-control input-width-xxlarge" value="<?php echo htmlentities(stripslashes($admin->password))?>" size="50"/></td>
                    </tr>
                    <tr>
                      <td align="left" class="head2">Admin Contact</td>
                      <td align="left" class="head2"><input name="contact" type="text" class="form-control input-width-xxlarge" value="<?php echo htmlentities(stripslashes($admin->contact))?>" size="50"/></td>
                    </tr>
					
                    <tr>
                      <td class="head2"></td>
                      <td ><br />
                        <input name="update_admin" type="submit" class="btn" value="Update Acount"/></td>
                    </tr>
                  </table>
                </form></td>
              </tr>
          </table>
							</div>
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
				</div>
			</div>
			<!-- /.container -->

		</div>
	</div>

</body>
</html>