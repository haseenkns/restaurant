<?php
ob_start();
session_start();
//echo md5('superadmin');
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");


	
	//echo $linkId;
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Data inserted Successfully !!';
		$class='successmsg';
	break;
	
	case 'inf':
		$msg='Data not inserted Successfully !!';
		$class='errormsg';
	break;
	case 'ups':
		$msg='Data updated Successfully !!';
		$class='successmsg';
	break;
	
	case 'upf':
		$msg='Data not updated Successfully !!';
		$class='errormsg';
	break;
	case 'dls':
		$msg='Data deleted successfully !!';
		$class='successmsg';
	break;
	
	case 'dlf':
		$msg='Data not deleted successfully !!!!';
		$class='errormsg';
	break;
	
	case 'default' :
		$msg='';
		break;
	
	}
	}
	
	
if(isset($_GET['aid'])&&$_GET['aid']!=''){
	$aid=base64_decode($_GET['aid']);
	$adminName=getAdminNameById($aid);	
	$rightsArray=getadminRightsById($aid);
}
	
if(isset($_POST['submit'])){
$rights=$_POST['rights'];
$aid=$_POST['hidid'];	
$chkQry=mysql_fetch_row(mysql_query("select count(*) from `adminrights` where `a_id`='$aid'"));
if($chkQry[0]>0){
	$delExQry=mysql_query("delete from `adminrights` where `a_id`='$aid'");
	if($delExQry){
		foreach($rights as $right){
			$insQry=mysql_query("insert into `adminrights` set `menu_id`= '$right',`a_id`='$aid'");
		}
		$successFlag=1;	
	}else{
		$successFlag=0;
	}
}else{
	foreach($rights as $right){
				$insQry=mysql_query("insert into `adminrights` set `menu_id`= '$right',`a_id`='$aid'");
			}
   $successFlag=1;			
	}
if($successFlag==1){
	header("location:addusers.php?msg=ads");
}else{
	header("location:addusers.php?msg=adf");
}	
	
	
 }	 
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Admin Panel </title>
    <script src="javascript/javascript.js" type="text/javascript"></script>

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
						<h3>Administrator Rights</h3>
						<span>Go Back To roles</span>
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
								<h4><i class="icon-reorder"></i>  <span style="color:#4d7496"><?php echo strtoupper($adminName); ?></span>   Rights  Management</h4>
                                
							</div>
							<div class="widget-content">
								<form action="" method="post" name="admin">
		  <table width="100%" border="0" cellpadding="2" cellspacing="2">
              
             
            <?php if($msg!=''){ ?>
              <tr>
                <td width="99%"  align="left"><div class="alert alert-<?php echo $class ?> fade in">
									<i class="icon-remove close" data-dismiss="alert"></i>
									<?php echo $msg; ?>
					</div></td>
              </tr>
             <?php } ?>
			 
			 
             <tr><td  align="left" ><label class=" control-label">* Click To Assign Privilege !</label></td></tr>
              <tr>
                <td valign="top">
					<!--------------------code starts here---------------->
				<table cellpadding="0" width="100%" cellspacing="2" class="table table-striped table-bordered table-hover  " >
				<?php 
				$mainMenus=getMainMenus();
				$i=0;
				if($mainMenus[0]!=0){
				foreach($mainMenus as $menu){
				$i++;
				$menuName=getMenuNameById($menu);
				?>
				<tr><td align="left" width="20px"><?php echo $i; ?></td><td align="left" width="30px"><input class='uniform' type="checkbox" name="rights[]" <?php if(in_array($menu,$rightsArray))echo 'checked="checked"'; ?>  value="<?php echo $menu; ?>"></td><td align="left"><span <?php if(in_array($menu,$rightsArray)){ ?>  style="color:#0066CC;font-weight:normal;"  <?php }?>><?php echo $menuName; ?></span></td></tr>
				
				<tr><td colspan="3" height="2px"></td></tr>
			  <?php }}else{?>
			  <tr><td align="left"  colspan="3">No Menu Added Yet !</td></tr>
			  <?php }?>
               </table>
					
				<!--------------------code ends here---------------->
				</td>
              </tr>
			   <tr>
                <td valign="top"><input type="hidden" value="<?php echo $aid; ?>" name="hidid"><input type="submit" name="submit" style="width:160px;"  class="btn" value="  Assign   ">&nbsp;&nbsp;&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='addusers.php'" class="btn"></td></tr>
			  
          </table>
		  </form>
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