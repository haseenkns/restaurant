<?php
ob_start();
session_start();

include_once("../configuration/connect.php");
include_once("../configuration/functions.php");

if(isset($_GET['type'])&&$_GET['type']!=''){	
	$type=$_GET['type'];
	}
	
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
		$class='success';
	break;
	case 'dls':
		$msg='Data deleted successfully !!';
		$class='success';
	break;
	
	case 'dlf':
		$msg='Data not deleted successfully !!!!';
		$class='success';
	break;
	
	case 'default' :
		$msg='';
		break;
	
	}
	}
	
	if(isset($_GET['did'])&&$_GET['did']!=''){
$did=base64_decode($_GET['did']);
$delQry=mysql_query("delete from `login` where `id`='$did'");
	if($delQry){
		header("location:login.php?msg=dls&type=$type");
	}else{
		header("location:login.php?msg=dlf&type=$type");
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
						<h3>Login Management</h3>
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
								<h4><i class="icon-reorder"></i> Login Management</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<table width="100%" border="0" cellpadding="4" cellspacing="1" class="table table-striped table-bordered table-hover  datatable">
             	<thead>
										
  <tr >
    <th align="left" width="7%" class="verysmalltextblack">Sno</th>
    <th align="left"  width="64%"class="verysmalltextblack">Name</th>
        <th align="center"  width="12%"class="verysmalltextblack">Email</th>
        <th align="center"  width="12%"class="verysmalltextblack">Password</th>

    <th width="27%" align="center" class="verysmalltextblack">Action</th>
  </tr>
  </thead>
    <tbody>

  <?php 
  	$sqlQry=mysql_query("select * from `login` where `type` ='$type'");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    
    <td align="left" class="smallfonttext"><?php echo $fetch['name']; ?></td>
    <td align="left" class="smallfonttext"><?php echo $fetch['username']; ?></td>
    <td align="left" class="smallfonttext"><?php echo $fetch['password']; ?></td>
	
    <td align="center" >
	<table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr >
		<td align="right" ><a href="login.php?did=<?php echo base64_encode($fetch['id']) ?>&type=<?php echo $type; ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
        
        
		<td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','login',6)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
        
        <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
	</tr>
	</table>
</td>
    
  </tr>
  <?php }}else{?>
  <tr><td>0</td><td>No Records </td><td>No Records </td><td  align="left" class="blackbold" bgcolor="#FFFFFF">No Records  !</td><td>No Records </td><</tr>
  
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