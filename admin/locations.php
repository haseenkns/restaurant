<?php
ob_start();
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");

if(isset($_GET['id'])&&$_GET['id']!=''){	
	$uid=$_GET['id'];
	$stateId=getStateIdByCityId($uid);
	
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
	$delQry=mysql_query("delete from `locations` where `id`='$did'");
	if($delQry){
		header("location:locations.php?msg=dls&id=$uid");
	}else{
		header("location:locations.php?msg=dlf&id=$uid");
	}
}


if(isset($_POST['submit'])){
	$name=mysql_real_escape_string($_POST['name']);
	$uid=$_POST['hidUid'];
	$sqlQry="insert into `locations` set `name`='$name',`status`='1',`a_id`='$uid'";
	$execQry=mysql_query($sqlQry);
	if($execQry){
		header("location:locations.php?msg=ins&id=$uid");
	}else{
		header("location:locations.php?msg=inf&id=$uid");
	}
}

if(isset($_POST['update'])){
	$name=mysql_real_escape_string($_POST['name']);
	$id=$_POST['hidval'];
	$sqlQry="Update `locations` set `name`='$name' where `id`='$id' ";
	$execQry=mysql_query($sqlQry);
	if($execQry){
		header("location:locations.php?msg=ups&id=$uid");
	}else{
		header("location:locations.php?msg=upf&id=$uid");
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
		/*alert('Only alphabets A - Z ,dot  and spaces are allowed !! ');
		document.program.name.focus();
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
						<h3><b style="color:#069;"><?php echo getCitiesNameById($uid); ?></b> LocationManagement</h3>
						<span><a href="addcities.php?id=<?php echo $stateId; ?>">Go Back To Cities</a></span>
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
								<h4><i class="icon-reorder"></i> Add locations</h4>
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
                $execQry=mysql_fetch_row(mysql_query("select * from `locations` where `id`='$eid'"));
                $name=$execQry[1];
            ?>
                <tr>
				<td width="17%" align="left" class="blackbold">Update   Name</td>
				<td width="44%"><input type="text"  class="form-control " style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only"  size="45" name="name" value="<?php echo $name; ?>"><input type="hidden" name="hidval" value="<?php echo $eid;  ?>"></td>
				<td width="39%">Alphabets (A-Z),space and period(.) sign only</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="submit" name="update" class="btn" value=" Update  ">&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='locations.php&id=<?php echo $uid; ?>'" class="btn"></td>
				</tr>
				<?php }else{?>
				
                <tr >
				<td align="left" class="blackbold">Add   Name</td>
				<td width="44%"><input class="form-control " style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="name"></td>
				<td width="39%" ></td>
				</tr>
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="hidden" name="hidUid" value="<?php echo $uid; ?>"><input type="submit" name="submit" class="btn" value=" Add locations  ">&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='locations.php&id=<?php echo $uid; ?>'" class="btn"></td>
				</tr>
				<?php } ?>
  				</form>
</table>
				<!--------------------code ends here---------------->
				</td>
              </tr>
			  <tr><td colspan="2">
<table width="100%" border="0" cellpadding="4" cellspacing="1" class="table table-striped table-bordered table-hover  datatable">
    	<thead>
              <tr>
                <th align="left" width="9%" class="verysmalltextblack">Sno</th>
                <th align="left"  width="51%"class="verysmalltextblack">Name</th>
                <th width="29%" align="center" class="verysmalltextblack">Action</th>
              </tr>
 		 </thead>
<tbody>

  <?php 
  	$sqlQry=mysql_query("select * from `locations` where `a_id`='$uid'");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    <td align="left" class="smallfonttext"><?php echo $fetch['name']; ?></td>
    <td align="center" >
	<table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr>
<td align="right" ><a href="locations.php?did=<?php echo base64_encode($fetch['id']) ?>&id=<?php echo $uid; ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
		<td align="center" ><a href="locations.php?eid=<?php echo base64_encode($fetch['id']) ?>&id=<?php echo $uid; ?>"><button class="btn"><i class="icon-edit"></i></button>	</a></td>
	<td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateCityStatus('<?php echo $fetch['id'];  ?>','locations',3)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
    <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
</tr>
	</table></td>
  </tr>
  <?php }}else{?>
  <tr><td>&nbsp;</td><td colspan="2">No Records Found</td><td  align="left" class="blackbold" bgcolor="#FFFFFF">No Records Found !</td></tr>
  
  <?php } ?>
  </tbody>
</table>
			  
			  </td></tr>
			  
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