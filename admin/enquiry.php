<?php
ob_start();
session_start();

include_once("../configuration/connect.php");
include_once("../configuration/functions.php");


	
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
$delQry=mysql_query("delete from `enquiry` where `id`='$did'");
	if($delQry){
		header("location:enquiry.php?msg=dls");
	}else{
		header("location:enquiry.php?msg=dlf");
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
	function validate()
	{
	var eptrn=/^[a-z0-9]+[a-z0-9\._]*@[a-z0-9\.]+\.[a-z]{2,3}$/;    ///////////mail pattern///////
	var namePtrn=/^[.a-zA-Z0-9 ]+$/;
	if(document.program.name.value=="")
		{
		alert('Name cannot be left blank !!');
		document.program.name.focus();
		return false;
		}

	if(!document.program.name.value.match(namePtrn))
	{
		alert('Only alphabets A - Z ,dot  and spaces are allowed !! ');
		document.program.name.focus();
		return false;
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
						<h3>Enquiry Management</h3>
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
								<h4><i class="icon-reorder"></i> Enquiry</h4>
                                
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
                                
							</div>
							<div class="widget-content">
								<table width="100%" border="0" cellpadding="4" cellspacing="1" class="table table-striped table-bordered table-hover  datatable">
             	<thead>
			   <?php if($msg!=''){ ?>
              <tr>
                <td  align="left" colspan="5"><div class="alert alert-<?php echo $class ?> fade in">
									<i class="icon-remove close" data-dismiss="alert"></i>
									<?php echo $msg; ?>
								</div></td>
              </tr>
             <?php }?>							
  <tr >
    <th align="left" width="3%" class="verysmalltextblack">Sno</th>
    <th align="left"  width="18%"class="verysmalltextblack">Name</th>
      <th align="left"  width="14%"class="verysmalltextblack">Mail</th>
      <th align="left"  width="53%"class="verysmalltextblack">Subject</th>
      <!--  <th align="center"  width="12%"class="verysmalltextblack">Add College</th>-->

    <th width="12%" align="center" class="verysmalltextblack">Action</th>
  </tr>
  
  </thead>
    <tbody>

  <?php 
  	$sqlQry=mysql_query("select * from `enquiry`");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    
    <td align="left" class="smallfonttext"><?php echo stripslashes($fetch['name']); ?></td>
        <td align="left" class="smallfonttext"><?php echo stripslashes($fetch['mail']); ?></td>
        <td align="left" class="smallfonttext"><?php echo substr(stripslashes($fetch['subject']),0,80)."..."; ?></td>
    <td align="center" >
	<table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr >
		<td align="right" ><a href="enquiry.php?did=<?php echo base64_encode($fetch['id']) ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
	</tr>
	</table></td>
  </tr>
  <?php }}else{?>
  <tr><td>&nbsp;</td><td>No Records Found</td>
    <td>No Record</td>
    <td>No Record</td>
    <td  align="left" class="blackbold" bgcolor="#FFFFFF">No Records Found !</td></tr>
  
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