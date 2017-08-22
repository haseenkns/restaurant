<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

if(isset($_GET['aid'])&&$_GET['aid']!=''){	
	$aid=base64_decode($_GET['aid']);
	
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
$delQry=mysql_query("delete from `tds` where `id`='$did'");
	if($delQry){
		header("location:tds.php?msg=dls");
	}else{
		header("location:tds.php?msg=dlf");
	}
}


if(isset($_POST['submit'])){
	extract($_POST);
    $name=mysql_real_escape_string($_POST['name']);
    $edate=changeDate($edate);
	$edateend=changeDate($edateend);

$sqlQry="insert into `tds` set `name`='$name',`status`='1' ,`edate`='$edate' ,`edateend`='$edateend'";
$execQry=mysql_query($sqlQry);
if($execQry){
	header("location:tds.php?msg=ins");
}else{
	header("location:tds.php?msg=inf");
}

}

if(isset($_POST['update'])){
	extract($_POST);
$name=mysql_real_escape_string($_POST['name']);
 $edate=changeDate($edate);
	$edateend=changeDate($edateend);

$id=$_POST['hidval'];
$sqlQry="Update `tds` set `name`='$name' ,`edate`='$edate' ,`edateend`='$edateend' where `id`='$id' ";
$execQry=mysql_query($sqlQry);
if($execQry){
	header("location:tds.php?msg=ups");
}else{
	header("location:tds.php?msg=upf");
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
		alert('tds cannot be left blank !!');
		document.program.name.focus();
		return false;
		}

	if(!document.program.name.value.match(namePtrn))
	{
		alert('Only alphabets A - Z ,dot ,forward slash and spaces are allowed !! ');
		document.program.name.focus();
		return false;
	}
	
	if(document.program.edate.value=="")
		{
		alert('Date cannot be left blank !!');
		document.program.edate.focus();
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
						<h3>Tds Management</h3>
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
								<h4><i class="icon-reorder"></i> Add Tds</h4>
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
					$execQry=mysql_fetch_row(mysql_query("select * from `tds` where `id`='$eid'"));
					$name=$execQry[1];
					$edate=$execQry[3];
					$edateend=$execQry[4];
					
							
				?>
                
				<tr >
				<td width="17%" align="left" class="blackbold">Update Tds tax </td>
				<td width="44%"><input type="text"  class="form-control input-width-large" data-mask="99.99"  autocomplete="off" style="letter-spacing:1px;"  title=""  size="45" name="name" value="<?php echo $name; ?>"><input type="hidden" name="hidval" value="<?php echo $eid;  ?>"></td>
				<td width="39%">&nbsp;</td>
				</tr>
                
				<tr >
				  <td>Update Effective Date </td>
				  <td colspan="2" align="left"><input type="text"  class="form-control input-width-large datepicker"  autocomplete="off" style="letter-spacing:1px;"  title=""  size="45" name="edate" id="edate" value="<?php echo revertDate($edate); ?>"></td>
				  </tr>
				<tr >
				  <td>Update Effective Till </td>
				  <td colspan="2" align="left"><input type="text"  class="form-control input-width-large datepicker"  autocomplete="off" style="letter-spacing:1px;"  title=""  size="45" name="edateend" id="edateend" value="<?php echo revertDate($edateend); ?>"></td>
				  </tr>
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="submit" name="update" class="btn" value=" Update tds	 ">&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='tds.php'" class="btn"></td>
				</tr>
				
				<?php }else{?>
				<tr >
				<td align="left" class="blackbold">Add Tds tax</td>
				<td width="44%"><input class="form-control  input-width-large" data-mask="99.99"  autocomplete="off" style="letter-spacing:1px;"   title="" type="text" name="name"></td>
				<td width="39%" >&nbsp;</td>
				</tr>
				<tr >
				  <td>Effective From</td>
				  <td colspan="2" align="left"><input class="form-control input-width-large datepicker" autocomplete="off"  style="letter-spacing:1px;"   title="" type="text" name="edate" id="edate"></td>
				  </tr>
				<tr >
				  <td>Effective Till</td>
				  <td colspan="2" align="left"><input class="form-control input-width-large datepicker" autocomplete="off"  style="letter-spacing:1px;"   title="" type="text" name="edateend" id="edateend"></td>
				  </tr>
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="submit" name="submit" class="btn" value=" Add tds  ">&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='tds.php'" class="btn"></td>
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
								<h4><i class="icon-reorder"></i> Tds</h4>
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
    <th align="left"  width="37%"class="verysmalltextblack">Tax</th>
    <th align="left"  width="18%"class="verysmalltextblack">Effective from</th>
    <th align="left"  width="19%"class="verysmalltextblack">Effective Till</th>

    <th width="27%" align="center" class="verysmalltextblack">Action</th>
  </tr>
  </thead>
    <tbody>

  <?php 
  	$sqlQry=mysql_query("select * from `tds` order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    
    <td align="left" class="smallfonttext"><?php echo $fetch['name']; ?> %</td>
    <td align="left" class="smallfonttext"><?php echo changeToStdDate($fetch['edate']); ?></td>
    <td align="left" class="smallfonttext"><?php echo changeToStdDate($fetch['edateend']); ?></td>

	
    <td align="center" >
      <table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
        <tr >
          <td align="right" ><a href="tds.php?did=<?php echo base64_encode($fetch['id']) ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
          <td align="center" ><a href="tds.php?eid=<?php echo base64_encode($fetch['id']) ?>"><button class="btn"><i class="icon-edit"></i></button>	</a></td>
          
          
          
          <td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','tds',2)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
          
          <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
          </tr>
        </table>
</td>
    
  </tr>
  <?php }}else{?>
  <tr><td>&nbsp;</td><td>No Records Found</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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