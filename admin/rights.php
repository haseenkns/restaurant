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
	case 'ads':
		$msg='Administrative Rights Added Successfully !!';
		$class='successmsg';
	break;
	
	case 'adf':
		$msg='Administrative Rights Not Added Successfully !!';
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
	
	
if(isset($_GET['id'])&&$_GET['id']!=''){
	$id=$_GET['id'];
	$rightsArray=getRightsById($id);
}
	
if(isset($_POST['submit'])){
		$rights=$_POST['rights'];
		$id=$_POST['hidid'];	
		$chkQry=mysql_fetch_row(mysql_query("select count(*) from `rights` where `role_id`='$id'"));
		if($chkQry[0]>0){
		$delExQry=mysql_query("delete from `rights` where `role_id`='$id'");
		if($delExQry){
		foreach($rights as $right){
			$insQry=mysql_query("insert into `rights` set `menu_id`= '$right',`role_id`='$id'");
		}
			$successFlag=1;	
		}else{
			$successFlag=0;
		}
		}else{
		foreach($rights as $right){
				$insQry=mysql_query("insert into `rights` set `menu_id`= '$right',`role_id`='$id'");
		}
		$successFlag=1;			
		}
		if($successFlag==1){
			header("location:rights.php?msg=ads&id=$id");
		}else{
			header("location:rights.php?msg=adf&id=$id");
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
						<h3>Administrator Rights ( <?php echo getRoleNameById($id) ?> )</h3>
						<span style="color:#06C;cursor:pointer;" onClick="window.location.href='roles.php'">&laquo;&nbsp;Go Back To Roles</span>
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
                <tr><td colspan="3" >
                 <div class="row">
				<?php 
				$execQry=mysql_query("select * from `menucategory` where `status` = '1' order by `position` Asc,`id` desc ");
				$numRows=mysql_num_rows($execQry);
				if($numRows>0){
				while($fetch=mysql_fetch_array($execQry)){
				$menuId=$fetch['id'];
				$menuName=stripslashes($fetch['category']);
				
				?>
                
                    
               
               
					<div class="col-md-3">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> <?php echo $menuName; ?></h4>
							</div>
							<div class="widget-content">
								<div style="min-height:200px;" >
							<?php
                            $execQrysub=mysql_query("select * from `menusubcategory` where `status` = '1' and `c_id`='$menuId'");
                            $numRowssub=mysql_num_rows($execQrysub);
                            if($numRowssub>0){
                            while($fetchsub=mysql_fetch_array($execQrysub)){
								$submenuId=$fetchsub['id'];
								$submenuName=stripslashes($fetchsub['subcategory']);
								
								?>
                          	  <div><input class='uniform' type="checkbox" name="rights[]"  <?php if(in_array($submenuId,$rightsArray))echo 'checked="checked"'; ?>  value="<?php echo $submenuId; ?>"><span <?php if(in_array($submenuId,$rightsArray)){ ?> style="font-weight:bold;" <?php } ?>> <?php echo stripslashes($submenuName); ?></span>
							  
							 </div>
                            <?php }}else{?>
                          	  <div> No Sub Menu Yet</div>
                            <?php }?>
                        
                        	
                        
                        
                        
                        </div>
							</div>
						</div>
					</div>
				
				
				
				
			  <?php }}else{?>
			  <div>
                        <div style="width:100%">No Menu</div>
                        <div style="width:100%">
                        	<div> No Sub Menu </div>
                        
                        </div>
                    </div>
			  <?php }?>
              </div>
               </td></tr>
              
               </table>
					
				<!--------------------code ends here---------------->
				</td>
              </tr>
			   <tr>
                <td valign="top"><input type="hidden" value="<?php echo $id; ?>" name="hidid"><input type="submit" name="submit" style="width:160px;"  class="btn" value="  Assign   ">&nbsp;&nbsp;&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='roles.php'" class="btn"></td></tr>
			  
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