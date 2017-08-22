<?php
ob_start();
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");

if(isset($_GET['id'])&&$_GET['id']!=''){	
	$uid=$_GET['id'];
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
	$delQry=mysql_query("delete from `cities` where `city_id`='$did'");
	if($delQry){
		header("location:addcities.php?msg=dls&id=$uid");
	}else{
		header("location:addcities.php?msg=dlf&id=$uid");
	}
}


if(isset($_POST['submit'])){
	$name=mysql_real_escape_string($_POST['name']);
	$uid=$_POST['hidUid'];
	$premium=$_POST['premium'];
	$sqlQry="insert into `cities` set `city_name`='$name',`status`='1',`city_state`='$uid' ,`premium`='$premium'";
	
	$execQry=mysql_query($sqlQry);
	if($execQry){
		header("location:addcities.php?msg=ins&id=$uid");
	}else{
		header("location:addcities.php?msg=inf&id=$uid");
	}
}

if(isset($_POST['update'])){
	$name=mysql_real_escape_string($_POST['name']);
	$id=$_POST['hidval'];
	$premium=$_POST['premium'];
	$sqlQry="Update `cities` set `city_name`='$name' , `premium`='$premium' where `city_id`='$id' ";
	$execQry=mysql_query($sqlQry);
	if($execQry){
		header("location:addcities.php?msg=ups&id=$uid");
	}else{
		header("location:addcities.php?msg=upf&id=$uid");
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
						<h3><?php echo getStateNameById($uid); ?> Cities Management</h3>
						<span><a href="states.php">Go Back To States</a></span>
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
								<h4><i class="icon-reorder"></i> Add cities</h4>
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
                $execQry=mysql_fetch_row(mysql_query("select * from `cities` where `city_id`='$eid'"));
                $name=$execQry[1];
				$premium=$execQry[4];
            ?>
                <tr>
				<td width="17%" align="left" class="blackbold">Update  Cities Name</td>
				<td width="44%"><input type="text"  class="form-control bs-focus-tooltip" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only"  size="45" name="name" value="<?php echo $name; ?>"><input type="hidden" name="hidval" value="<?php echo $eid;  ?>"></td>
				<td width="39%">Alphabets (A-Z),space and period(.) sign only</td>
				</tr>
				<tr >
				  <td>We are Operational here</td>
				  <td align="left"><input type="checkbox" name="premium" value="1" <?php if($premium==1){ ?> checked <?php } ?>></td>
				  <td align="left">Check if services are available here</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="submit" name="update" class="btn" value=" Update  ">&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='addcities.php&id=<?php echo $uid; ?>'" class="btn"></td>
				</tr>
				<?php }else{?>
				
                <tr >
				<td align="left" class="blackbold">Add cities  Name</td>
				<td width="44%"><input class="form-control bs-focus-tooltip" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="name"></td>
				<td width="39%" ></td>
				</tr>
				<tr >
				  <td>We are Operational here</td>
				  <td align="left"><input type="checkbox" name="premium" value="1"></td>
				  <td align="left">Check if services are available here</td>
				</tr>
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="hidden" name="hidUid" value="<?php echo $uid; ?>"><input type="submit" name="submit" class="btn" value=" Add Cities  ">&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='addcities.php&id=<?php echo $uid; ?>'" class="btn"></td>
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
                <th align="left" width="4%" class="verysmalltextblack">Sno</th>
                <th align="left"  width="24%"class="verysmalltextblack">Name</th>
                <th align="left"  width="25%" style="text-align:center" class="verysmalltextblack">Operational</th>
                <th align="center"  width="13%"class="verysmalltextblack">Add Locations</th>
                <th width="23%" align="center" class="verysmalltextblack">Action</th>
              </tr>
 		 </thead>
<tbody>

  <?php 
  	$sqlQry=mysql_query("select * from `cities` where `city_state`='$uid'");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    <td align="left" class="smallfonttext"><?php echo $fetch['city_name']; ?></td>
    <td align="left" style="text-align:center" class="smallfonttext"><?php if($fetch['premium']==1){ echo "<b style='color:#51A351'>Yes</b>"; }else{ echo "No" ;} ?></td>
    <td align="center" class="smallfonttext"><a href="locations.php?id=<?php echo $fetch['city_id'] ?>"><img src="../images/plus.png"></a></td>
    <td align="center" >
      <table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
        <tr>
  <td align="right" ><a href="addcities.php?did=<?php echo base64_encode($fetch['city_id']) ?>&id=<?php echo $uid; ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
          <td align="center" ><a href="addcities.php?eid=<?php echo base64_encode($fetch['city_id']) ?>&id=<?php echo $uid; ?>"><button class="btn"><i class="icon-edit"></i></button>	</a></td>
          <td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateCityStatus('<?php echo $fetch['city_id'];  ?>','cities',3)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
          <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['city_id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
  </tr>
      </table></td>
  </tr>
  <?php }}else{?>
  <tr><td>&nbsp;</td><td>No Records Found</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   
    <td width="11%"  align="left" bgcolor="#FFFFFF" class="blackbold">No Records Found !</td></tr>
  
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