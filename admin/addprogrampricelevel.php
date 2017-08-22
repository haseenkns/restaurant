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
	
	
	if(isset($_GET['pid'])&&$_GET['pid']!=''){
		$pid=base64_decode($_GET['pid']);
		$encId=$_GET['pid'];
		
		$progName=getProgramNameById($pid);
        
	}
	
	
	if(isset($_GET['did'])&&$_GET['did']!=''){
		
$did=base64_decode($_GET['did']);
$delQry=mysql_query("delete from `relations` where `id`='$did'");
	if($delQry){
		header("location:relations.php?msg=dls");
	}else{
		header("location:relations.php?msg=dlf");
	}
}


if(isset($_POST['submit'])){
$hidPid=$_POST['hidPid'];	
$name=mysql_real_escape_string($_POST['name']);
$pricename=mysql_real_escape_string($_POST['pricename']);
$sqlQry="insert into `program_price` set `prog_id`='$hidPid',`status`='1',`price`='$name' ,`pricename`='$pricename'";
$execQry=mysql_query($sqlQry);
if($execQry){
	header("location:addprograms.php?eid=".base64_encode($hidPid)."&msg=pas#finfo");
}else{
	header("location:addprograms.php?eid=".base64_encode($hidPid)."&msg=paf#finfo");
}

}

if(isset($_POST['update'])){
$pricename=mysql_real_escape_string($_POST['pricename']);
$id=$_POST['hidval'];
$sqlQry="Update `program_price` set `pricename`='$pricename' where `id`='$id' ";
$execQry=mysql_query($sqlQry);
if($execQry){
	header("location:addprogrampricelevel.php?msg=ups&pid=$encId");
}else{
	header("location:addprogrampricelevel.php?msg=upf&pid=$encId");
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
	var namePtrn=/^[/.a-zA-Z0-9 ]+$/;
	if(document.program.name.value=="")
		{
		alert('Name cannot be left blank !!');
		document.program.name.focus();
		return false;
		}

	if(!document.program.name.value.match(namePtrn))
	{
		alert('Only alphabets A - Z ,dot ,forward slash and spaces are allowed !! ');
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
						<h3>Price Level Management (<?php echo $progName; ?>)</h3>
						<span><a href="addprograms.php?eid=<?php $encId; ?>">Go Back To Program</a></span>
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
								<h4><i class="icon-reorder"></i> Add Level</h4>
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
				<form action="" name="program" method="post" onSubmit="return validate()">
				<?php if(isset($_GET['eid'])&&$_GET['eid']!=''){ 
					$eid=base64_decode($_GET['eid']);
					$execQry=mysql_fetch_row(mysql_query("select * from `program_price` where `id`='$eid'"));
					$name=$execQry[2];
					$pricename=htmlentities(stripslashes($execQry[4]));
					
							
				?>
                
				<tr >
				<td width="17%" align="left" class="blackbold">Update Price </td>
				<td width="44%"><?php echo $name; ?> <input type="hidden" name="hidval" value="<?php echo $eid;  ?>"></td>
				<td width="39%"></td>
				</tr>
                
                <tr >
				<td width="17%" align="left" class="blackbold">Update Price Name </td>
				<td width="44%"><input type="text"  class="form-control " style="letter-spacing:1px;"  title=""  size="45" name="pricename" value="<?php echo $pricename; ?>"></td>
				<td width="39%">Only Alphanumeric values</td>
				</tr>
                
                
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="submit" name="update" class="btn" value=" Update Price Level	 ">&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='addprograms.php'" class="btn"></td>
				</tr>
				
				<?php }else{?>
				<tr >
				<td align="left" class="blackbold">Add Price</td>
				<td width="44%"><input class="form-control  " style="letter-spacing:1px;"  onkeypress="return isNumber(event)" title="Alphabets (A-Z),space and period(.) sign only" type="text" name="name"></td>
				<td width="39%" >Only Numeric values</td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold">Add Price Name</td>
				<td width="44%"><input class="form-control  " style="letter-spacing:1px;"   title="Alphabets (A-Z),space and period(.) sign only" type="text" name="pricename"></td>
				<td width="39%" >Only Alphanumeric values</td>
				</tr>
                
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="submit" name="submit" class="btn" value=" Add Price Level  ">&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='addprograms.php'" class="btn"><input type="hidden" name="hidPid" value="<?php echo $pid; ?>"></td>
				</tr>
				<?php } ?>
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
                <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Price Level</h4>
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
    <th align="left" width="13%" class="verysmalltextblack">Sno</th>
    <th align="left"  width="25%"class="verysmalltextblack">Added Price Level </th>
    <th align="left"  width="31%"class="verysmalltextblack">Add Price Name</th>
    <th align="center" style="text-align:center;"  width="31%"class="verysmalltextblack">Change Price Name</th>

  
  </tr>
  </thead>
    <tbody>

  <?php 
  	$sqlQry=mysql_query("select * from `program_price` where `prog_id`='$pid' order by `id`");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    
    <td align="left" class="smallfonttext"><?php echo $fetch['price']; ?></td>
    <td align="left" class="smallfonttext"><?php echo stripslashes($fetch['pricename']); ?></td>
    <td align="center" class="smallfonttext"><img src="images/b_edit.png"> <a href="addprogrampricelevel.php?eid=<?php echo base64_encode($fetch['id']) ?>&pid=<?php echo base64_encode($pid); ?>">Change Name</a></td>

	
    
    
  </tr>
  <?php }}else{?>
  <tr><td>&nbsp;</td><td colspan="4"  align="left" bgcolor="#FFFFFF" class="blackbold">No Records Found !</td></tr>
  
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