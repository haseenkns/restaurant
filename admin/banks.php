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
	
if(isset($_GET['did'])&&$_GET['did']!=''){
	$did=base64_decode($_GET['did']);
	$delQry=mysql_query("delete from `banks` where `id`='$did'");
	if($delQry){
		header("location:banks.php?msg=dls");
	}else{
		header("location:banks.php?msg=dlf");
	}
}

if(isset($_POST['submit'])){
	$name=mysql_real_escape_string($_POST['name']);
	$address=mysql_real_escape_string($_POST['address']);
	$sqlQry="insert into `banks` set `name`='$name',`status`='1' ,`servicetax`='$address'";
	$execQry=mysql_query($sqlQry);
	if($execQry){
		header("location:banks.php?msg=ins");
	}else{
		header("location:banks.php?msg=inf");
	}

}

if(isset($_POST['update'])){
$name=mysql_real_escape_string($_POST['name']);
$address=mysql_real_escape_string($_POST['address']);
$id=$_POST['hidval'];
$sqlQry="Update `banks` set `name`='$name' ,`servicetax`='$address' where `id`='$id' ";
$execQry=mysql_query($sqlQry);
if($execQry){
	header("location:banks.php?msg=ups");
}else{
	header("location:banks.php?msg=upf");
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo getSiteTitle(); ?></title>
   <script src="javascript/sweet-alert.js" language="javascript" type="text/javascript"> </script>
    <link rel="stylesheet" href="css/sweet-alert.css" type="text/css">
    <script src="javascript/javascript.js" language="javascript" type="text/javascript"> </script>
    <script type="text/javascript" language="JavaScript">
    function validate()
    {
    var eptrn=/^[a-z0-9]+[a-z0-9\._]*@[a-z0-9\.]+\.[a-z]{2,3}$/;    ///////////mail pattern///////
    var namePtrn=/^[.a-zA-Z0-9 ]+$/;
    
	if(document.program.name.value=="")
    {
		errorText("Bank Name cannot be left blank");
		return false;
    }
    
    if(!document.program.name.value.match(namePtrn))
    {
		errorText('Only alphabets A - Z,numbers  ,dot  and spaces are allowed !! ');
		return false;
    
    }
    
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
						<h3>Banks Management</h3>
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
								<h4><i class="icon-reorder"></i> Add Banks</h4>
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
                
					<?php 
					if(isset($_GET['eid'])&&$_GET['eid']!=''){ 
                        $eid=base64_decode($_GET['eid']);
                        $execQry=mysql_fetch_row(mysql_query("select * from `banks` where `id`='$eid'"));
                        $name=htmlentities(stripslashes($execQry[1]));
						$address=htmlentities(stripslashes($execQry[3]));
                    ?>
				
                <tr >
				<td width="17%" align="left" class="blackbold">Update  Banks Name</td>
				<td width="44%"><input type="text"  class="form-control " style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only"  size="45" name="name" value="<?php echo $name; ?>"><input type="hidden" name="hidval" value="<?php echo $eid;  ?>"></td>
				<td width="39%">Alphabets (A-Z),space,forward slash and period(.) sign only</td>
				</tr>
                
                <tr >
				<td width="17%" align="left" class="blackbold">Service Tax</td>
				<td width="44%"><input type="check"   name="address" value="1" <?php if($address==1){ ?> checked <?php } ?>> </td>
				<td width="39%">Alphabets (A-Z),space,forward slash and period(.) sign only</td>
				</tr>
                
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="submit" name="update" class="btn" value=" Update banks	 ">&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='banks.php'" class="btn"></td>
				</tr>
				
				<?php }else{?>
				<tr >
				<td align="left" class="blackbold">Add Banks  Name</td>
				<td width="44%"><input class="form-control  " style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="name"></td>
				<td width="39%" ></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold">Service Tax</td>
				<td width="54%" align="left" style="float:left;"><input   type="checkbox" name="address" value="1">&nbsp;Check if service tax applicable</td>
				<td width="30%" ></td>
				</tr>
                
                
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="submit" name="submit" class="btn" value=" Add banks  ">&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='banks.php'" class="btn"></td>
				</tr>
				<?php } ?>
  				</form>
</table>

							
				<!--------------------code ends here---------------->
				</td>
              </tr>
			  <tr><td colspan="2"></td></tr>
			  
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
								<h4><i class="icon-reorder"></i> Banks</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
                            
		<div class="widget-content">
<table width="100%" border="0" cellpadding="4" cellspacing="1" class="table table-striped table-bordered table-hover  datatable">
<thead>
  <tr>
    <th align="left" width="6%" class="verysmalltextblack">Sno</th>
    <th align="left"  width="29%"class="verysmalltextblack">Name</th>
    <th align="left"  width="23%"class="verysmalltextblack">Tax</th>
    <th width="26%" align="center" class="verysmalltextblack">Action</th>
  </tr>
</thead>
    <tbody>
 <?php 
  	$sqlQry=mysql_query("select * from `banks` order by `id` desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
  ?>
<tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    <td align="left" class="smallfonttext"><?php echo stripslashes($fetch['name']); ?></td>
    <td align="left" class="smallfonttext"><?php if($fetch['servicetax']==1){ echo "Yes";}else{ echo "No";} ?></td>
  
    <td align="center" >
<table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
<tr>
<td align="right" ><a href="banks.php?did=<?php echo base64_encode($fetch['id']) ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
  <td align="center" ><a href="banks.php?eid=<?php echo base64_encode($fetch['id']) ?>"><button class="btn"><i class="icon-edit"></i></button>	</a></td>
  <td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','banks',2)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
<td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
          </tr>
        </table>
</td>
  </tr>
  <?php }}else{?>
  <tr><td>--</td><td>No Records Found</td>
   
    <td colspan="1">No Records </td><td  align="left" class="blackbold" bgcolor="#FFFFFF">No Records Found !</td></tr>
  
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